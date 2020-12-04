<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

use PHPMailer\PHPMailer\PHPMailer;
class ControllerCatalogProductExchange extends Controller {
	private $error = array();

	public function index() {		

		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['add_from_exel'] = $this->url->link('catalog/product_exchange/getProductsFromExel', 'user_token=' . $this->session->data['user_token'], true);
		$data['add_package'] = $this->url->link('catalog/product_exchange/getProductsWithoutPackages', 'user_token=' . $this->session->data['user_token'], true);
		$data['update_configurator'] = $this->url->link('catalog/product_exchange/updateDataForConfigurator', 'user_token=' . $this->session->data['user_token'], true);
		$data['info_about_configurator'] = $this->url->link('catalog/product_exchange/sendInfoAboutMissingViewInConfigurator', 'user_token=' . $this->session->data['user_token'], true);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');	

		if (isset($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		else if ($this->session->data['warning']) {
			$data['error_warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));
	}
	
	public function sendInfoAboutMissingViewInConfigurator() {

		require_once DIR_STORAGE. 'phpmailer/PHPMailer.php';
		require_once DIR_STORAGE. 'phpmailer/SMTP.php';
		require_once DIR_STORAGE. 'phpmailer/Exception.php';
						
		$url = '';
		$message = '';
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));

		$info = $this->model_catalog_product->sendInfoAboutMissingViewInConfigurator();

		foreach ($info as $key => $value) {
			$message .= 'Missing view: ' . $value['view_name'] .'('. $value['view_id'] .') '. '(Category: ' . $value['category_name'] .'('. $value['category_id'] . '))' . '<br>';
		}

		$mail = new PHPMailer;
		
		$mail->isSMTP();
		$mail->Host = $this->config->get('config_mail_smtp_hostname');
		$mail->SMTPAuth = true;
		$mail->Username = $this->config->get('config_mail_smtp_username'); // логин от вашей почты
		$mail->Password = $this->config->get('config_mail_smtp_password'); // пароль от почтового ящика
		$mail->SMTPSecure = 'ssl';
		$mail->Port = $this->config->get('config_mail_smtp_port');

		$mail->CharSet = 'UTF-8';
		$mail->From = $this->config->get('config_mail_smtp_username'); // адрес почты, с которой идет отправка
		$mail->FromName = $this->config->get('config_name'); // имя отправителя
		$mail->addAddress($this->config->get('config_email'));

		$mail->isHTML(true);

		$mail->Subject = 'Недостающие view в конфигураторе';
		$mail->Body = $message;

		if($mail->send()){
			$this->session->data['success'] = $this->language->get('text_email_success');
		}else{
			$this->session->data['warning'] = $this->language->get('error_email');
			//echo 'Ошибка: ' . $mail->ErrorInfo;
		}
		$this->response->redirect($this->url->link('catalog/product_exchange', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}

	public function updateDataForConfigurator() {

		$url = '';
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->model_catalog_product->updateDataForConfigurator();

		$this->session->data['success'] = $this->language->get('text_success');

		$this->response->redirect($this->url->link('catalog/product_exchange', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}

	public function getProductsWithoutPackages() {

		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['token'] = $this->session->data['user_token'];

		$products_without_package = $this->model_catalog_product->getProductsWithoutPackage();
		$name_of_packages = $this->model_catalog_product->getNameOfPackages();
		
		foreach ($name_of_packages as $name_of_package)
		{			
			$data['name_of_package'][] = $name_of_package;
		}
		
		foreach ($products_without_package as $product)
		{
			$data['products_without_package'][] = $product;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));
	}

	public function getProductsFromExel() {

		$url = '';
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));
		
		//$line_number_in_exel = 0;
		$data['token'] = $this->session->data['user_token'];
		$data['file_found'] = true;
		require_once DIR_STORAGE.'exchange/SimpleXLSX.php';

		if ( $xlsx = SimpleXLSX::parse(DIR_STORAGE.'exchange/123.xlsx') ) {


			foreach ( $xlsx->rows() as $k => $r ) {
				
				/* $line_number_in_exel++;	
				if ($line_number_in_exel < 10) continue;
				if ($line_number_in_exel == 2000) break; */
				
				$product = $this->model_catalog_product->getProductExchange($r);
				
				if ($product){

					if ($r[2] == null && $r[3] == null ) continue;

					//There is a quantity, no price
					if ($r[2] == 1 && $r[3] == 0){					
						$data['error'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],	
							'sku' => $r[0],	
							'class' => 'danger',
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . $product['product_id'],
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $product['product_id'] . $url, true)	
						);
					}
					
					//There is a quantity, There is a price
					if ($r[2] == 1 && $r[3] > 0 ) {

						$data['products'][] = array(
							'product_id' => $product['product_id'],
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],
							'sku' => $r[0],	
							'class' => 'success',	
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . $product['product_id'],
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $product['product_id'] . $url, true)
															
						);			
					}
					
					//no quantity, There is a price 
					if ($r[2] == 0 && $r[3] > 0 ) {
						
						$data['products'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],
							'sku' => $r[0],	
							'class' => 'info',
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . $product['product_id'],
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $product['product_id'] . $url, true)
										
						);	
					}
					
					//no quantity, no price 
					if ($r[2] == 0 && $r[3] == 0 ) {
						
						$data['products'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],
							'sku' => $r[0],	
							'class' => 'warning',	
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . $product['product_id'],
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $product['product_id'] . $url, true)
									
						);	
					}
				}else{
					
					if ($r[2] == null && $r[3] == null ) continue;

					//There is quantity OR There is price, product for adding 
					if ($r[2] == 1 || $r[3] > 0){					
						$data['newProducts'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],	
							'sku' => $r[0],	
							'class' => 'danger'								
						);
					//no quantity, no price 
					}else{
						$data['products'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],
							'sku' => $r[0],	
							'class' => 'warning',	
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . '',
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . '' . $url, true)
						);	
					}
				}			
			}	
						  	
		} else {
				$data['file_found'] = false;
			}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));
	}


}
