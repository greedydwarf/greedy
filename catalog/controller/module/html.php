<?php
class ControllerModuleHTML extends Controller {
	public function index($setting) {
        $this->load->model('account/customer');

		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

			if (isset($_COOKIE['customer_id'])){
			$data['customer_id'] = $_COOKIE['customer_id'];
			//Получаем данные о пользователе через идентификатор
			$data['num_pocessed_orders'] = $this->model_account_customer->customerNumPocessedOrders($data['customer_id']);
			$data['customer_total_buy'] = $this->model_account_customer->customerTotalBuy($data['customer_id']);
			$data['customer_total_buy_usd'] = $this->model_account_customer->customerTotalBuyUSD($data['customer_id']);	
			$data['customer_logged_info'] = $this->model_account_customer->getCustomer($data['customer_id']);
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/html.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/html.tpl', $data);
			} else {
				return $this->load->view('default/template/module/html.tpl', $data);
			}
		}
	}
}