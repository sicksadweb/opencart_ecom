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
		else if (isset($this->session->data['warning'])) {
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
		
		$column_of_sku = 7;
		$column_of_product_name = 13;
		$columns_in_excel = array(
			'Askiz'     		    => array('id'=> 1, 'price' => 18, 'quantity' => 24),
			'Itigina'   		    => array('id'=> 2, 'price' => 15, 'quantity' => 25),
			'Karatuz'   		    => array('id'=> 3, 'price' => 19, 'quantity' => 26),
			'Kuragino'  		    => array('id'=> 4, 'price' => 20, 'quantity' => 27),
			'Minusinsk' 		    => array('id'=> 5, 'price' => 21, 'quantity' => 28),
			'Molodejka' 		    => array('id'=> 6, 'price' => 15, 'quantity' => 29),
			'Molodejka_necondiciya' => array('id'=> 7, 'price' => 15, 'quantity' => 30),
			'Molodejka_rezerv' 	 	=> array('id'=> 8, 'price' => 15, 'quantity' => 31),
			'Roskrovlya' 			=> array('id'=> 9, 'price' => 15, 'quantity' => 32),
			'Sayanogorsk' 			=> array('id'=> 10, 'price' => 22, 'quantity' => 33),
			'Sib_fasadi' 			=> array('id'=> 11, 'price' => 15, 'quantity' => 34),
			'Skladskaya' 			=> array('id'=> 12, 'price' => 15, 'quantity' => 35),
			'Tashtip' 				=> array('id'=> 13, 'price' => 23, 'quantity' => 36),
			'Torg_predi' 			=> array('id'=> 14, 'price' => 17, 'quantity' => 37),
			'Shira' 				=> array('id'=> 15, 'price' => 24, 'quantity' => 38)
		);
		
		$data['token'] = $this->session->data['user_token'];
		$data['file_found'] = true;
		
		$line_number_in_exel = 0;
		require_once DIR_STORAGE.'exchange/SimpleXLSX.php';

		if ( $xlsx = SimpleXLSX::parse(DIR_STORAGE.'exchange/new price.xlsx') ) {

			foreach ( $xlsx->rows() as $k => $r ) {
				
				//Need for skip lines which are no valid in begin of excel file
				if ($line_number_in_exel < 4) {
					
					$line_number_in_exel++;	
					continue;	
				}
				$line_number_in_exel++;

				//if ($line_number_in_exel == 30) break;
				
				$product = $this->model_catalog_product->getProductBySku($r[$column_of_sku]);
				
				if ($product) {

					foreach($columns_in_excel as $location => $values) {
						
						//There are price and quantity
						if ( ($r[$values['price']] != null) && ($r[$values['quantity']] != null) ) {
							
							$data['products_for_adding'][] = array(
								'product_id' => $product['product_id'],
								'name'		 => $r[$column_of_product_name],
								'location_name'=> $location,
								'location_id'=> $values['id'],
								'quantity'	 => $r[$values['quantity']],
								'price'	  	 => $this->currency->format($r[$values['price']], $this->config->get('config_currency')),
								'class'		 => 'success'
							);
						}

						//There is quantity and there is not price
						else if (($r[$values['price']] == null) && ($r[$values['quantity']] != null)) {
							
							$data['products_for_adding'][] = array(
								'product_id' => $product['product_id'],
								'name'		 => $r[$column_of_product_name],
								'location_name'=> $location,
								'location_id'=> $values['id'],
								'quantity'	 => $r[$values['quantity']],
								'price'	  	 => $this->currency->format(0, $this->config->get('config_currency')),
								'class'		 => 'warning'
							);
						}
					}
				}else {

					$data['error'][] = array(
						'name'		 => $r[$column_of_product_name],
						'class'		 => 'danger'
					);
				}		
			}	
						  	
		} else {
				$data['file_found'] = false;
		}

		$this->model_catalog_product->getProductExchange($data['products_for_adding']);	
		//print_r($data['products_for_adding']);		
		//return;
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));
	}


}
