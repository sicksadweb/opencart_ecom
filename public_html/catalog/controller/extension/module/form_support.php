<?php
class ControllerExtensionModuleFormSupport extends Controller {
	public function index() {

		$this->load->language('extension/module/form');

		$data['text_defult'] = ''; 

		return $this->load->view('extension/module/form_support', $data);
		
	}
}