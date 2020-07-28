<?php
class ControllerExtensionModuleFormQueryPrice extends Controller {
	public function index() {

		$this->load->language('extension/module/form');

		$data['form_support'] = '';

		return $this->load->view('extension/module/form_query_price', $data);
		
	}
}