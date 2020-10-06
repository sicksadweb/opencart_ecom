<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ControllerCatalogProductExchange extends Controller {
	private $error = array();
	public function index() {
		
		//print_r($this->request);
		
		$url = '';
		//$line_number_in_exel = 0;
		
		$this->load->language('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');
	
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

					//There is quantity, product for adding 
					if ($r[2] == 1){					
						$data['newProducts'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],	
							'sku' => $r[0],	
							'class' => 'danger',
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . '',
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . '' . $url, true)	
						);
					}					
					
					//no, there is price
					if ($r[2] == 0 && $r[3] > 0 ) {

						$data['products'][] = array(
							'name' => $r[1],
							'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
							'status' => $r[2],
							'sku' => $r[0],	
							'class' => '',
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . '',
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . '' . $url, true)
										
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
							'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . '',
							'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . '' . $url, true)
									
						);	
					}
					}			

				}
		//			print_r ($data['products'].'<br>');
		//			print_r ($data['error'].'<br>');		  	
			} else {
				echo SimpleXLSX::parseError();
			}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_exchange', $data));

	}


}
