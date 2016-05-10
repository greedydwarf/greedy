<?php
class ModelAccountCustomer extends Model {
	public function quickRegisterFromHome($register_info){
		$query = $this->db->query("SELECT email FROM " . DB_PREFIX . "customer WHERE email = '" . $register_info['login-register'] . "' ");
		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET 
				customer_group_id = 1,
				email = '" . $register_info['login-register'] . "',
				password = '" . sha1($register_info['pass-register']) . "',
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
				status = 1,
				approved = 1,
				date_added = NOW()");
			$customer_id = $this->db->getLastId();
			
			return $customer_id;
		} else{
			return 0;
		}
	}
	public function socialAuthFromHome($social_info){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE social_id = '" . $social_info['social-id'] . "'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET 
				firstname = '" . $social_info['social-first-name'] . "',
				lastname = '" . $social_info['social-last-name'] . "',
				social = '" . $social_info['social'] . "', 
				social_id = '" . $social_info['social-id'] . "', 
				date_added = NOW()");

			$customer_id = $this->db->getLastId();
		
		return $customer_id;

		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET
			firstname = '" . $social_info['social-first-name'] . "',
			lastname = '" . $social_info['social-last-name'] . "',
			social = '" . $social_info['social'] . "', 
			social_id = '" . $social_info['social-id'] . "'
			WHERE social_id = '" . $social_info['social-id'] . "'");


			$query = $this->db->query("SELECT customer_id FROM `" . DB_PREFIX . "customer` WHERE
		 	social_id = '" . $social_info['social-id'] . "' ");
			return $query->row['customer_id'];
		}
		
	}
	public function quickloginFromHome($login_info){
		$query = $this->db->query("SELECT customer_id FROM `" . DB_PREFIX . "customer` WHERE
		 email = '".$login_info['login-login']."' 
		 AND password = '" . sha1($login_info['pass-login']) ."' ");
		return $query->row['customer_id'];
	}
	public function customerNumPocessedOrders($customer_id){
		$email  = $this->db->query("SELECT email FROM " . DB_PREFIX . "customer WHERE
		 customer_id = '" . $customer_id . "' ");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE
		 customer_id = '" . $customer_id . "'  
		 AND order_status_id = 5 OR 
		 email = '" . $email->row['email'] . "'
		 AND order_status_id = 5");
		
		return $query->num_rows;
	
	}
	public function customerTotalBuy($customer_id){
		$email  = $this->db->query("SELECT email,fax FROM " . DB_PREFIX . "customer WHERE
		 customer_id = '" . $customer_id . "' ");

		$query = $this->db->query("SELECT total FROM " . DB_PREFIX . "order WHERE
		 customer_id = '" . $customer_id . "' 
		 AND order_status_id = 5  OR 
		 email = '" . $email->row['email'] . "'
		 AND order_status_id = 5");

		$total_sales = $this->db->query("SELECT o.total,o.total_usd,
		(SELECT c.fax FROM " . DB_PREFIX . "customer c WHERE c.customer_id = '" . $customer_id . "') AS sale
		 FROM " . DB_PREFIX . "order o WHERE
		 o.customer_id = '" . $customer_id . "' 
		 AND o.order_status_id = 5  OR 
		 o.email = '" . $email->row['email'] . "'
		 AND o.order_status_id = 5");
		$total = 0;
		$total_usd = 0;
		foreach ($total_sales->rows as $total_sale){
			
			$total += $total_sale['total'];
			$total_usd += $total_sale['total_usd'];
			$sale = $total_sale['sale'];
		}

		switch (TRUE) {
			
		    case ($total >= 2000 && $total <= 4999):
		        $cumulative = 1;
		        break;
		    case ($total >= 5000 && $total <= 9999):
		        $cumulative = 2;
		        break;
		    case ($total >= 10000 && $total <= 29999):
		        $cumulative = 3;
		        break;
		    case ($total >= 30000 && $total <= 59999):
		        $cumulative = 4;
		        break;
		    case ($total >= 60000):
		        $cumulative = 5;
		        break;
		    default:
       			$cumulative = 0;
       			break;
		}
		
		switch (TRUE) {
			
		    case ($total_usd >= 30 && $total_usd <= 75):
		        $cumulative_us = 1;
		        break;
		    case ($total_usd >= 76 && $total_usd <= 149):
		        $cumulative_us = 2;
		        break;
		    case ($total_usd >= 150 && $total_usd <= 449):
		        $cumulative_us = 3;
		        break;
		    case ($total_usd >= 450 && $total_usd <= 899):
		        $cumulative_us = 4;
		        break;
		    case ($total_usd >= 900):
		        $cumulative_us = 5;
		        break;
		    default:
       			$cumulative_us = 0;
       			break;
		}
		$cumulative_rub = 0;
		$cumulative_usd = 0;
		$cumulative_rub += $cumulative;
		$cumulative_usd += $cumulative_us;
		if($cumulative_rub < $cumulative_us){
			$cumulative_discount = $cumulative_us;
		} else {
			$cumulative_discount = $cumulative_rub;
		}
		
		if ($cumulative_discount < $email->row['fax']){
			$cumulative_discount = $email->row['fax'];
		}
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET 
			fax = '" . $cumulative_discount . "'  
			WHERE customer_id = '" . $customer_id . "'");
		return $query->rows;
	}
	public function customerTotalBuyUSD($customer_id){
		$email  = $this->db->query("SELECT email FROM " . DB_PREFIX . "customer WHERE
		 customer_id = '" . $customer_id . "' ");

		$query = $this->db->query("SELECT total_usd FROM " . DB_PREFIX . "order WHERE
		 customer_id = '" . $customer_id . "' 
		 AND order_status_id = 5 OR 
		 email = '" . $email->row['email'] . "'
		 AND order_status_id = 5");
		
		return $query->rows;
	}
	public function updateCustomerFromPage($update_info){
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET 
			firstname = '" . $update_info['user-name'] . "', 
			telephone = '" . $update_info['user-phone'] . "', 
			isq = '" . $update_info['user-isq'] . "', 
			skype = '" . $update_info['user-skype'] . "', 
			email = '" . $update_info['user-email'] . "'  
			WHERE customer_id = '" . $update_info['customer_id'] . "'");
		if (isset($update_info['user-new-pass'])){
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET 
			password = '" . sha1($update_info['user-new-pass']) . "' 
			WHERE customer_id = '" . $update_info['customer_id'] . "'");
		}
		
	}
	
	public function addCustomer($data) {
		$this->event->trigger('pre.customer.add', $data);

		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? json_encode($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['address']) ? json_encode($data['custom_field']['address']) : '') . "'");

		$address_id = $this->db->getLastId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		$this->event->trigger('post.customer.add', $customer_id);

		return $customer_id;
	}

	public function editCustomer($data) {
		$this->event->trigger('pre.customer.edit', $data);

		$customer_id = $this->customer->getId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->event->trigger('post.customer.edit', $customer_id);
	}

	public function editPassword($email, $password) {
		$this->event->trigger('pre.customer.edit.password');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		$this->event->trigger('post.customer.edit.password');
	}

	public function editNewsletter($newsletter) {
		$this->event->trigger('pre.customer.edit.newsletter');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		$this->event->trigger('post.customer.edit.newsletter');
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . $customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}

	public function getRewardTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}
}
