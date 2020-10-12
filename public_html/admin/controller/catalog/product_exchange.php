<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ControllerCatalogProductExchange extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');
	
		require_once DIR_STORAGE.'exchange/SimpleXLSX.php';

		if ( $xlsx = SimpleXLSX::parse(DIR_STORAGE.'exchange/price.xlsx') ) { 

			foreach ( $xlsx->rows() as $k => $r ) {

				if ($r[2] == 1 && $r[3] == 0 ){

					$this->model_catalog_product->getProductExchange($r);
					$data['error'][] = array(
						'name' => $r[1],
						'price' => $this->currency->format($r[3], $this->config->get('config_currency')),
						'status' => $r[2],	
						'sku' => $r[0],	
						'class' => 'danger',
						'href_shop'  => HTTP_CATALOG . 'index.php?route=product/product&product_id=' . $product['product_id'],
						'edit'       => $this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $product['product_id'] . $url, true)
							
					);

				 } else {

					$product = $this->model_catalog_product->getProductExchange($r);

					//---------
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
					}						//---------



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
