<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ControllerAccountOauth extends Controller {
	public function index() {

		$this->load->language('account/account');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setRobots('noindex,follow');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		} 
		
		$data['edit'] = $this->url->link('account/edit', '', true);
		$data['password'] = $this->url->link('account/password', '', true);
		$data['address'] = $this->url->link('account/address', '', true);
		
		$data['credit_cards'] = array();
		
		$files = glob(DIR_APPLICATION . 'controller/extension/credit_card/*.php');
		
		foreach ($files as $file) {
			$code = basename($file, '.php');
			
			if ($this->config->get('payment_' . $code . '_status') && $this->config->get('payment_' . $code . '_card')) {
				$this->load->language('extension/credit_card/' . $code, 'extension');

				$data['credit_cards'][] = array(
					'name' => $this->language->get('extension')->get('heading_title'),
					'href' => $this->url->link('extension/credit_card/' . $code, '', true)
				);
			}
		}
		
		$data['wishlist'] = $this->url->link('account/wishlist');
		$data['order'] = $this->url->link('account/order', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		
		if ($this->config->get('total_reward_status')) {
			$data['reward'] = $this->url->link('account/reward', '', true);
		} else {
			$data['reward'] = '';
		}		
		
		$data['return'] = $this->url->link('account/return', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);
		$data['recurring'] = $this->url->link('account/recurring', '', true);

		$this->load->model('account/customer');
		
		$affiliate_info = $this->model_account_customer->getAffiliate($this->customer->getId());
		
		if (!$affiliate_info) {	
			$data['affiliate'] = $this->url->link('account/affiliate/add', '', true);
		} else {
			$data['affiliate'] = $this->url->link('account/affiliate/edit', '', true);
		}
		
		if ($affiliate_info) {		
			$data['tracking'] = $this->url->link('account/tracking', '', true);
		} else {
			$data['tracking'] = '';
		}

		$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		$data['firstname'] = $customer_info['firstname'];
		
		$data['confirm'] = $customer_info['confirm'];
		

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		$this->response->setOutput($this->load->view('account/oauth', $data));
	}

	public function yandex() {

		//---- yandex
		
		$client_id = '0f77313fc79c4841baa1512c05611c3b'; // Id приложения login_ya.php
		$client_secret = 'ad56c105b3024ba388ffed0fa08e748b'; // Пароль приложения
		$redirect_uri = 'http://molodegka/index.php?route=account/oauth/yandex/'; // Callback URI
		
		$url = 'https://oauth.yandex.ru/authorize';
		
		$params = array(
			'response_type' => 'code',
			'client_id'     => $client_id,
			'display'       => 'popup'
		);
		

		if (isset($this->request->get['code'])) {

			$result = false;

			$params = array(
				'grant_type'    => 'authorization_code',
				'code'          => $_GET['code'],
				'client_id'     => $client_id,
				'client_secret' => $client_secret
			);
		
			$url = 'https://oauth.yandex.ru/token';
		
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($curl);
			curl_close($curl);
		
			$tokenInfo = json_decode($result, true);
		
			if (isset($tokenInfo['access_token'])) {
				$params = array(
					'format'       => 'json',
					'oauth_token'  => $tokenInfo['access_token']
				);
		
				$userInfo = json_decode(file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params))), true);
				if (isset($userInfo['id'])) {
					$userInfo = $userInfo;
					$result = true;
				}
			}

			if ($result) {
			/*	
				echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
				echo "Имя пользователя: " . $userInfo['real_name'] . '<br />';
				echo "Email: " . $userInfo['default_email'] . '<br />';
				echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
				echo "День Рождения: " . $userInfo['birthday'] . '<br />';
			*/	
				$data = array (
					'firstname' => $userInfo['real_name'],
					'email' => $userInfo['default_email'],
					'password' => $tokenInfo['access_token'],
					'token' => $tokenInfo['access_token'],

				);

			}

            if ($this->validatequick($userInfo['default_email'])== true ) {
                $customer_id = $this->model_account_customer->addCustomerSimple($data);
                // Clear any previous login attempts for unregistered accounts.
                $this->model_account_customer->deleteLoginAttempts($userInfo['default_email']);

                $this->customer->login($userInfo['default_email'], $tokenInfo['access_token']);
            } else {

			//	$this->response->redirect($this->url->link('account/login'));	
				$this->customer->login($userInfo['default_email'], $tokenInfo['access_token']);
				$this->response->redirect($this->url->link('account/account', '', true));
			}
			
			unset($this->session->data['guest']);

			$this->response->redirect($this->url->link('account/success'));
		}
		
		//---- yandex

	 }



	 public function vkcom() {

		$client_id = '7571690'; // ID приложения
		$client_secret = 'XJsfGR8FgpJBpfGYBu36'; // Защищённый ключ
		$redirect_uri = 'http://molodegka/index.php?route=account/oauth/vkcom/'; // Адрес сайта
		

		$url = 'http://oauth.vk.com/authorize';
		
		$params = array(
			'client_id' => $client_id,
			'display' => 'page',
			'redirect_uri' => $redirect_uri,
			'scope' => 'friends',
			'response_type' => 'code',
			'v'=> '5.122'
		);
		
		
		
		echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';
		
		
		
		if (isset($_GET['code'])) {
		
			$result = false;
			$params = array(
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'redirect_uri' => $redirect_uri,
				'code' => $_GET['code'],
			);
		
			$token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
		
			print_r($token);
			if (isset($token['access_token'])) {
		
		
				$params = array(
					'uids'         => $token['user_id'],
		
					'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
					'access_token' => $token['access_token']
				);
		
				$user_id = $token['user_id'];
		//        $user_id = '430040520';       
				
				$request_params = array(
				'user_id' => $user_id,
				'fields' => 'bdate',
				'v' => '5.52',
				'access_token' => $token['access_token']
				);
				$get_params = http_build_query($request_params);
				$result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));
		
		
			//	print_r($result);


			if ($result) {
				/*	
					echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
					echo "Имя пользователя: " . $userInfo['real_name'] . '<br />';
					echo "Email: " . $userInfo['default_email'] . '<br />';
					echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
					echo "День Рождения: " . $userInfo['birthday'] . '<br />';
				*///	 print_r($request_params['access_token']);
					$data = array (
						'firstname' => $result->response[0]->first_name,
						'email' => 'vk_id:'.$result->response[0]->id,
						'password' => $request_params['access_token'],
						'token' => $request_params['access_token'],
	
					);

				}
	
				if ($this->validatequick($userInfo['default_email'])== true ) {
					$customer_id = $this->model_account_customer->addCustomerSimple($data);
					// Clear any previous login attempts for unregistered accounts.
					$this->model_account_customer->deleteLoginAttempts($userInfo['default_email']);
	
					$this->customer->login($userInfo['default_email'], $tokenInfo['access_token']);
				} else {
	
				//	$this->response->redirect($this->url->link('account/login'));	
					$this->customer->login($userInfo['default_email'], $tokenInfo['access_token']);
					$this->response->redirect($this->url->link('account/account', '', true));
				}
				
				unset($this->session->data['guest']);
	
				$this->response->redirect($this->url->link('account/success'));


			}
		
		
		
		}
		
     }


	private function validatequick($email) {
		$this->load->model('account/customer');

		if ($this->model_account_customer->getTotalCustomersByEmail($email)) {
			$this->error['warning'] = $this->language->get('error_exists');
			return false ;
		} else {
			return true ;
		}
	
	//	return !$this->error;
	}
}
