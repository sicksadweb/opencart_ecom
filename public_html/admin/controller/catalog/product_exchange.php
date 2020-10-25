<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ControllerCatalogProductExchange extends Controller {
	private $error = array();	

	public function index() {		

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
		require_once DIR_STORAGE.'exchange/SimpleXLSX.php';

		if ( $xlsx = SimpleXLSX::parse(DIR_STORAGE.'exchange/123.xlsx') ) {


			foreach ( $xlsx->rows() as $k => $r ) {
				
				/* $line_number_in_exel++;	
				if ($line_number_in_exel < 10) continue;
				if ($line_number_in_exel == 2000) break; */
				
				$product = $this->model_catalog_product->getProductExchange($r);
				//print_r($product);	
				if ($product){
					
					//print_r($data['products']);

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
				echo SimpleXLSX::parseError();
			}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));
	}


}
