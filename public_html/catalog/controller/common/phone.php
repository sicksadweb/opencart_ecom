<?php
class ControllerCommonPhone extends Controller {
	public function index() {

		if (!isset($this->request->cookie['phone'])) {
			$phone = explode(";", $this->config->get('config_telephone'));
			$data['phone']= $phone[array_rand($phone, 1)] ; 
			setcookie('phone', $data['phone'], time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
		}	else {
			$data['phone']= $this->request->cookie['phone'];
		}

		return $this->load->view('common/phone', $data);
	}

}