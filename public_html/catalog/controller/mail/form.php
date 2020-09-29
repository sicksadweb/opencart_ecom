<?php
class ControllerMailForm extends Controller {
	public function index() {



		if ($this->request->post['key'] == $this->config->get('config_bot_key') ) {

			$data['name'] = $this->request->post['name'];
			$data['phone'] = $this->request->post['phone'];
			$data['comment'] = $this->request->post['comment'];
			$data['email'] = $this->request->post['email'];
			$data['question'] = $this->request->post['question'];
			$data['key'] = $this->request->post['key'];

			$mail = new Mail($this->config->get('config_mail_engine'));
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
	/*
			$mail->setTo($order_info['email']);
			$mail->setFrom($from);
			$mail->setSender(html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf($language->get('text_subject'), $order_info['store_name'], $order_info['order_id']), ENT_QUOTES, 'UTF-8'));
			$mail->setText($this->load->view('mail/form', $data));
			$mail->send();
	*/	
echo "111111111111111";
			$mail->setText($this->load->view('mail/form', $data));

		} else {

			$data['name'] = $this->request->post['name'];
			$data['phone'] = $this->request->post['phone'];
			$data['comment'] = $this->request->post['comment'];
			$data['email'] = $this->request->post['email'];
			$data['question'] = $this->request->post['question'];
			$data['key'] = $this->request->post['key'];

			$mail = new Mail($this->config->get('config_mail_engine'));
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
	
			$mail->setTo($order_info['email']);
			$mail->setFrom($from);
			$mail->setSender(html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf($language->get('text_subject'), $order_info['store_name'], $order_info['order_id']), ENT_QUOTES, 'UTF-8'));
			$mail->setText($this->load->view('mail/form', $data));
			$mail->send();

		}
		

						
	







	}
		

	

	


}
