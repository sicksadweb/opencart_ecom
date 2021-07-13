<?php

require_once DIR_CATALOG . 'model/catalog/offers.php';
require_once DIR_CATALOG . 'model/catalog/offer.php';
class ControllerToolReportFilters extends Controller {

    public function index() {
        
        $this->load->language('catalog/product');
		$this->document->setTitle($this->language->get('text_filters'));
        
        //Offers
        $offersObj = new ModelCatalogOffers($this->registry);
        //Offer
        $offerObj = new ModelCatalogOffer($this->registry);
		
		$categories = $offersObj->getAllCategories();
        
        foreach ($categories as $key => $value) {
            
            $filter_groups = $offersObj->getCategoryFilters($value['offers_id']);
            
            if ($filter_groups) {
				foreach ($filter_groups as $filter_group) {

					foreach ($filter_group['filter'] as $filter) {
						$filter_data = array(
							'filter_offers_id'=> $value['offers_id'],
							'filter_group_id' => $filter_group['filter_group_id'],
							'filter_filter'   => $filter['filter_id']
						);

						$filter_data_for_pagination = array(
							'filter_offers_id'	 => $value['offers_id'],
							'filter_filter'      => $filter['filter_id']
						);

						if ( $offerObj->getTotalProducts($filter_data) != $offerObj->getTotalProducts($filter_data_for_pagination)   || 
							 $offerObj->getTotalProducts($filter_data) != count($offerObj->getProducts($filter_data_for_pagination)) ||
							 $offerObj->getTotalProducts($filter_data_for_pagination) != count($offerObj->getProducts($filter_data_for_pagination)) ||
							 $offerObj->getTotalProducts($filter_data) == 0 || 
							 $offerObj->getTotalProducts($filter_data_for_pagination) == 0 || 
							 count($offerObj->getProducts($filter_data_for_pagination)) == 0) {

							$data['filters'][] = array(
								'filter_id'		  => $filter['filter_id'],							
								'filter_name'     => $filter['name'] . ($this->config->get('config_product_count') ? ' (' . $offerObj->getTotalProducts($filter_data) . ')' : ''),
								'category_name'   => $value['name'],
								'pagination_val'  => $offerObj->getTotalProducts($filter_data_for_pagination),
								'number_of_goods' => count($offerObj->getProducts($filter_data_for_pagination)),
								'class' 		   => 'danger'
							);
						} 
						else {

							$data['filters'][] = array(
								'filter_id'		  => $filter['filter_id'],							
								'filter_name'     => $filter['name'] . ($this->config->get('config_product_count') ? ' (' . $offerObj->getTotalProducts($filter_data) . ')' : ''),
								'category_name'   => $value['name'],
								'pagination_val'  => $offerObj->getTotalProducts($filter_data_for_pagination),
								'number_of_goods' => count($offerObj->getProducts($filter_data_for_pagination))
							);
						}
					}

				}				
            }

		}
		
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');	
		$this->response->setOutput($this->load->view('tool/report_filters', $data));
    }

}

?>