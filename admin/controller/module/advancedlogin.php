<?php
class ControllerModuleadvancedlogin extends Controller {
	private $error = array(); 
	
	public function index() {   
	
	$this->load->language('sale/customer');
	

	$data['entry_telephone'] = $this->language->get('entry_telephone');
	$data['entry_fax'] = $this->language->get('entry_fax');
	$data['entry_company'] = $this->language->get('entry_company');
	
	$data['entry_city'] = $this->language->get('entry_city');
	$data['entry_postcode'] = $this->language->get('entry_postcode');
	$data['entry_country'] = $this->language->get('entry_country');
	$data['entry_zone'] = $this->language->get('entry_zone');

		$this->load->language('module/advancedlogin');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title2'] = $this->language->get('heading_title2');
		$data['title'] = $this->language->get('heading_title');
		

		$this->document->setTitle($this->language->get('title'));
			$this->init();		
		$this->load->model('setting/setting');
		$this->load->model('extension/module');
		$opencartversion = (int)VERSION.'.'.str_replace('.',"",substr(VERSION,2));

	
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('advancedlogin', $this->request->post['modulearray']);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post['modulearray']);
			}
			$abc = $this->request->post;
			
			unset($abc['modulearray']);
			
			$this->model_setting_setting->editSetting('advancedlogin', $abc);
			

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();
		$data['languages'] = $languages;
				
		
		$data['button_module_add'] = $this->language->get('button_module_add');
		$data['heading_title2'] = $this->language->get('heading_title2');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_redirect_advurl'] = $this->language->get('entry_redirect_advurl');
		$data['entry_showonce'] = $this->language->get('entry_showonce');
		$data['entry_once'] = $this->language->get('entry_once');
		$data['entry_company_id'] = $this->language->get('entry_company_id');
		
		$data['entry_always'] = $this->language->get('entry_always');
		

		
			
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		$data['entry_success_register'] = $this->language->get('entry_success_register');
		$data['entry_success_login'] = $this->language->get('entry_success_login');
		
		$data['entry_creator'] = $this->language->get('entry_creator');
$data['entry_enablelocal'] = $this->language->get('entry_enablelocal');
$data['entry_enablefb'] = $this->language->get('entry_enablefb');
$data['entry_enablegoogle'] = $this->language->get('entry_enablegoogle');
		$data['entry_version'] = $this->language->get('entry_version');
		$data['entry_updated'] = $this->language->get('entry_updated');
		$data['entry_licence'] = $this->language->get('entry_licence');
$data['entry_type'] = $this->language->get('entry_type');
$data['tab_fields'] = $this->language->get('tab_fields');
$data['entry_customer_group'] = $this->language->get('entry_customer_group');
$data['entry_customer_required'] = $this->language->get('entry_customer_required');
$data['text_yes'] = $this->language->get('text_yes');
$data['text_no'] = $this->language->get('text_no');
$data['entry_slidelabel'] = $this->language->get('entry_slidelabel');
$data['entry_fieldpopup'] = $this->language->get('entry_fieldpopup');
$data['entry_autoemail_subject'] = $this->language->get('entry_autoemail_subject');
$data['entry_autoemail_body'] = $this->language->get('entry_autoemail_body');
$data['entry_email_body'] = $this->language->get('entry_email_body');
$data['entry_email_subject'] = $this->language->get('entry_email_subject');

$data['entry_enableemail'] = $this->language->get('entry_enableemail');
$data['entry_autocoupon'] = $this->language->get('entry_autocoupon');
$data['tab_email'] = $this->language->get('tab_email');
$data['tab_autocoupon'] = $this->language->get('tab_autocoupon');

$data['entry_coupon_name'] = $this->language->get('entry_coupon_name');
$data['entry_coupon_prefix'] = $this->language->get('entry_coupon_prefix');
$data['entry_coupon_type'] = $this->language->get('entry_coupon_type');
$data['entry_coupon_discount'] = $this->language->get('entry_coupon_discount');
$data['entry_coupon_total'] = $this->language->get('entry_coupon_total');
$data['entry_coupon_login'] = $this->language->get('entry_coupon_login');
$data['entry__coupon_shipping'] = $this->language->get('entry__coupon_shipping');
$data['entry_coupon_weeks'] = $this->language->get('entry_coupon_weeks');
$data['entry_coupon_uses'] = $this->language->get('entry_coupon_uses');
$data['text_percentage'] = $this->language->get('text_percentage');
$data['text_fixedamount'] = $this->language->get('text_fixedamount');

		$data['entry_apikey'] = $this->language->get('entry_apikey');
	$data['column_name'] = $this->language->get('column_name');
	$data['entry_modulename'] = $this->language->get('entry_modulename');
	$data['entry_fbmessgetop'] = $this->language->get('entry_fbmessgetop');
	$data['entry_fbmessgebottom'] = $this->language->get('entry_fbmessgebottom');
	$data['entry_logmessgetop'] = $this->language->get('entry_logmessgetop');
	$data['entry_logmessgebottom'] = $this->language->get('entry_logmessgebottom');
	$data['entry_logheading'] = $this->language->get('entry_logheading');
	$data['entry_fbheading'] = $this->language->get('entry_fbheading');
	$data['entry_popupheaderimage'] = $this->language->get('entry_popupheaderimage');
	$data['entry_force'] = $this->language->get('entry_force');
	$data['entry_popupdelay'] = $this->language->get('entry_popdelay');
$data['entry_yes'] = $this->language->get('entry_yes');
$data['entry_no'] = $this->language->get('entry_no');
$data['tab_fb'] = $this->language->get('tab_fb');
$data['tab_local'] = $this->language->get('tab_local');
$data['tab_google'] = $this->language->get('tab_google');
$data['tab_popup'] = $this->language->get('tab_popup');
$data['tab_support'] = $this->language->get('tab_support');
$data['tab_modulesetting'] = $this->language->get('tab_modulesetting');
$data['tab_language'] = $this->language->get('tab_language');
$data['text_info'] = $this->language->get('text_info');


$data['entry_emailaddress'] = $this->language->get('entry_emailaddress');
$data['entry_password'] = $this->language->get('entry_password');
$data['entry_welcomeid'] = $this->language->get('entry_welcomeid');
$data['entry_forgotten'] = $this->language->get('entry_forgotten');
$data['entry_register'] = $this->language->get('entry_register');
$data['entry_invalid_password'] = $this->language->get('entry_invalid_password');
$data['entry_wrong_match'] = $this->language->get('entry_wrong_match');
$data['entry_invalid_email'] = $this->language->get('entry_invalid_email');
$data['entry_already_exist'] = $this->language->get('entry_already_exist');

$data['entry_login'] = $this->language->get('entry_login');
$data['entry_logout'] = $this->language->get('entry_logout');
$data['entry_field_enable'] = $this->language->get('entry_field_enable');


   

$data['entry_gencryp'] = $this->language->get('entry_gencryp');
$data['entry_gapi'] = $this->language->get('entry_gapi');
$data['entry_gclientid'] = $this->language->get('entry_gclientid');
$data['entry_gredirect'] = $this->language->get('entry_gredirect');
$data['entry_thickboxbutton'] = $this->language->get('entry_thickboxbutton');
	$data['dpastecustom'] = $this->language->get('dpastecustom');
			$data['entry_customcss'] = $this->language->get('entry_customcss');


		$data['error_name'] = $this->language->get('error_name');

		
		$data['entry_apisecret'] = $this->language->get('entry_apisecret');
		$data['entry_pwdsecret'] = $this->language->get('entry_pwdsecret');
		$data['entry_pwdsecret_desc'] = $this->language->get('entry_pwdsecret_desc');
		$data['entry_fbutton'] = $this->language->get('entry_fbutton');
		$data['entry_gbutton'] = $this->language->get('entry_gbutton');
	
		
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
	
	
	$data['token']=$this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		
  		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/advancedlogin', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/advancedlogin', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}
   		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/advancedlogin', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/advancedlogin', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		
	
		$this->load->model('sale/customer_group');
		
    	$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		
		
		  	if (isset($this->request->post['advancedlogin_customer_group'])) {
      		$data['advancedlogin_customer_group'] = $this->request->post['advancedlogin_customer_group'];
    	} else {
		if ($this->config->get('advancedlogin_customer_group')){
			$data['advancedlogin_customer_group'] = $this->config->get('advancedlogin_customer_group');
		}
		else {
		$data['advancedlogin_customer_group']='1';
		}			
		}

		
					if (isset($this->request->post['advancedlogin_popupdelay'])) {
			$data['advancedlogin_popupdelay'] = $this->request->post['advancedlogin_popupdelay'];
		} else {
		if ($this->config->get('advancedlogin_popupdelay')){
			$data['advancedlogin_popupdelay'] = $this->config->get('advancedlogin_popupdelay');
		}
		else {
		$data['advancedlogin_popupdelay']='1';
		}			
		}
		
							if (isset($this->request->post['advancedlogin_coupon_name'])) {
			$data['advancedlogin_coupon_name'] = $this->request->post['advancedlogin_coupon_name'];
		} else {
		if ($this->config->get('advancedlogin_coupon_name')){
			$data['advancedlogin_coupon_name'] = $this->config->get('advancedlogin_coupon_name');
		}
		else {
		$data['advancedlogin_coupon_name']='Register-Coupon';
		}			
		}
		
							if (isset($this->request->post['advancedlogin_coupon_prefix'])) {
			$data['advancedlogin_coupon_prefix'] = $this->request->post['advancedlogin_coupon_prefix'];
		} else {
		if ($this->config->get('advancedlogin_coupon_prefix')){
			$data['advancedlogin_coupon_prefix'] = $this->config->get('advancedlogin_coupon_prefix');
		}
		else {
		$data['advancedlogin_coupon_prefix']='WLCM';
		}			
		}
		
			if (isset($this->request->post['advancedlogin_coupon_type'])) {
			$data['advancedlogin_coupon_type'] = $this->request->post['advancedlogin_coupon_type'];
		} else {
		if ($this->config->get('advancedlogin_coupon_type')){
			$data['advancedlogin_coupon_type'] = $this->config->get('advancedlogin_coupon_type');
		}
		else {
		$data['advancedlogin_coupon_type']='1';
		}			
		}
		
			if (isset($this->request->post['advancedlogin_coupon_login'])) {
			$data['advancedlogin_coupon_login'] = $this->request->post['advancedlogin_coupon_login'];
		} else {
		if ($this->config->get('advancedlogin_coupon_login')){
			$data['advancedlogin_coupon_login'] = $this->config->get('advancedlogin_coupon_login');
		}
		else {
		$data['advancedlogin_coupon_login']='0';
		}			
		}

		
		
		if (isset($this->request->post['advancedlogin_customer_require_enable'])) {
			$data['advancedlogin_customer_require_enable'] = $this->request->post['advancedlogin_customer_require_enable'];
		} else {
			$data['advancedlogin_customer_require_enable'] = $this->config->get('advancedlogin_customer_require_enable');
		}
		
		
		
			if (isset($this->request->post['advancedlogin_coupon_shipping'])) {
			$data['advancedlogin_coupon_shipping'] = $this->request->post['advancedlogin_coupon_shipping'];
		} else {
		if ($this->config->get('advancedlogin_coupon_shipping')){
			$data['advancedlogin_coupon_shipping'] = $this->config->get('advancedlogin_coupon_shipping');
		}
		else {
		$data['advancedlogin_coupon_shipping']='0';
		}			
		}
		
			if (isset($this->request->post['advancedlogin_coupon_weeks'])) {
			$data['advancedlogin_coupon_weeks'] = $this->request->post['advancedlogin_coupon_weeks'];
		} else {
		if ($this->config->get('advancedlogin_coupon_weeks')){
			$data['advancedlogin_coupon_weeks'] = $this->config->get('advancedlogin_coupon_weeks');
		}
		else {
		$data['advancedlogin_coupon_weeks']='2';
		}			
		}
		
			if (isset($this->request->post['advancedlogin_coupon_uses'])) {
			$data['advancedlogin_coupon_uses'] = $this->request->post['advancedlogin_coupon_uses'];
		} else {
		if ($this->config->get('advancedlogin_coupon_uses')){
			$data['advancedlogin_coupon_uses'] = $this->config->get('advancedlogin_coupon_uses');
		}
		else {
		$data['advancedlogin_coupon_uses']='1';
		}			
		}
		
			if (isset($this->request->post['advancedlogin_coupon_total'])) {
			$data['advancedlogin_coupon_total'] = $this->request->post['advancedlogin_coupon_total'];
		} else {
		if ($this->config->get('advancedlogin_coupon_total')){
			$data['advancedlogin_coupon_total'] = $this->config->get('advancedlogin_coupon_total');
		}
		else {
		$data['advancedlogin_coupon_total']='10';
		}			
		}
		
									if (isset($this->request->post['advancedlogin_coupon_discount'])) {
			$data['advancedlogin_coupon_discount'] = $this->request->post['advancedlogin_coupon_discount'];
		} else {
		if ($this->config->get('advancedlogin_coupon_discount')){
			$data['advancedlogin_coupon_discount'] = $this->config->get('advancedlogin_coupon_discount');
		}
		else {
		$data['advancedlogin_coupon_discount']='5';
		}			
		}
		
				if (isset($this->request->post['advancedlogin_enableemail'])) {
			$data['advancedlogin_enableemail'] = $this->request->post['advancedlogin_enableemail'];
		} else {
			$data['advancedlogin_enableemail'] = $this->config->get('advancedlogin_enableemail');
		}
		
						if (isset($this->request->post['advancedlogin_autocoupon'])) {
			$data['advancedlogin_autocoupon'] = $this->request->post['advancedlogin_autocoupon'];
		} else {
			$data['advancedlogin_autocoupon'] = $this->config->get('advancedlogin_autocoupon');
		}
		
		if (isset($this->request->post['advancedlogin_redirect_advurl'])) {
			$data['advancedlogin_redirect_advurl'] = $this->request->post['advancedlogin_redirect_advurl'];
		} else {
			$data['advancedlogin_redirect_advurl'] = $this->config->get('advancedlogin_redirect_advurl');
		}
		
			if (isset($this->request->post['advancedlogin_showonce'])) {
			$data['advancedlogin_showonce'] = $this->request->post['advancedlogin_showonce'];
		} else {
			$data['advancedlogin_showonce'] = $this->config->get('advancedlogin_showonce');
		}
		
		if (isset($this->request->post['advancedlogin_transaction_id'])) {
			$data['advancedlogin_transaction_id'] = $this->request->post['advancedlogin_transaction_id'];
		} else {
			$data['advancedlogin_transaction_id'] = $this->config->get('advancedlogin_transaction_id');
		}
	
if (isset($this->request->post['advancedlogin_force'])) {
			$data['advancedlogin_force'] = $this->request->post['advancedlogin_force'];
		} else {
			$data['advancedlogin_force'] = $this->config->get('advancedlogin_force');
		}
if (isset($this->request->post['advancedlogin_enablegoogle'])) {
			$data['advancedlogin_enablegoogle'] = $this->request->post['advancedlogin_enablegoogle'];
		} else {
			$data['advancedlogin_enablegoogle'] = $this->config->get('advancedlogin_enablegoogle');
		}
if (isset($this->request->post['advancedlogin_enablefb'])) {
			$data['advancedlogin_enablefb'] = $this->request->post['advancedlogin_enablefb'];
		} else {
			$data['advancedlogin_enablefb'] = $this->config->get('advancedlogin_enablefb');
		}
if (isset($this->request->post['advancedlogin_enablelocal'])) {
			$data['advancedlogin_enablelocal'] = $this->request->post['advancedlogin_enablelocal'];
		} else {
			$data['advancedlogin_enablelocal'] = $this->config->get('advancedlogin_enablelocal');
		}

if (isset($this->request->post['advancedlogin_address'])) {
			$data['advancedlogin_address'] = $this->request->post['advancedlogin_address'];
		} else {
			$data['advancedlogin_address'] = $this->config->get('advancedlogin_address');
		}


		

		
				if (isset($this->request->post['advancedlogin_telephone'])) {
			$data['advancedlogin_telephone'] = $this->request->post['advancedlogin_telephone'];
		} else {
			$data['advancedlogin_telephone'] = $this->config->get('advancedlogin_telephone');
		}
		
				if (isset($this->request->post['advancedlogin_fax'])) {
			$data['advancedlogin_fax'] = $this->request->post['advancedlogin_fax'];
		} else {
			$data['advancedlogin_fax'] = $this->config->get('advancedlogin_fax');
		}
		
				if (isset($this->request->post['advancedlogin_company'])) {
			$data['advancedlogin_company'] = $this->request->post['advancedlogin_company'];
		} else {
			$data['advancedlogin_company'] = $this->config->get('advancedlogin_company');
		}
		
	
		
			
		
				if (isset($this->request->post['advancedlogin_city'])) {
			$data['advancedlogin_city'] = $this->request->post['advancedlogin_city'];
		} else {
			$data['advancedlogin_city'] = $this->config->get('advancedlogin_city');
		}
		
				if (isset($this->request->post['advancedlogin_postcode'])) {
			$data['advancedlogin_postcode'] = $this->request->post['advancedlogin_postcode'];
		} else {
			$data['advancedlogin_postcode'] = $this->config->get('advancedlogin_postcode');
		}
		
				if (isset($this->request->post['advancedlogin_country'])) {
			$data['advancedlogin_country'] = $this->request->post['advancedlogin_country'];
		} else {
			$data['advancedlogin_country'] = $this->config->get('advancedlogin_country');
		}

			if (isset($this->request->post['advancedlogin_zone'])) {
			$data['advancedlogin_zone'] = $this->request->post['advancedlogin_zone'];
		} else {
			$data['advancedlogin_zone'] = $this->config->get('advancedlogin_zone');
		}


		if (isset($this->request->post['advancedlogin_pwdsecret'])) {
			$data['advancedlogin_pwdsecret'] = $this->request->post['advancedlogin_pwdsecret'];
		} elseif ($this->config->get('advancedlogin_pwdsecret')) { 
			$data['advancedlogin_pwdsecret'] = $this->config->get('advancedlogin_pwdsecret');
		} else $data['advancedlogin_pwdsecret'] = 'w7x4';
		
		foreach ($languages as $language) {
		
		
						if (isset($this->request->post['advancedlogin_logmessgetop_' . $language['language_id']])) {
				$data['advancedlogin_logmessgetop_' . $language['language_id']] = $this->request->post['advancedlogin_logmessgetop_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_logmessgetop_' . $language['language_id'])) { 
				$data['advancedlogin_logmessgetop_' . $language['language_id']] = $this->config->get('advancedlogin_logmessgetop_' . $language['language_id']);
			} else $data['advancedlogin_logmessgetop_' . $language['language_id']] = 'Already a member?';


			if (isset($this->request->post['advancedlogin_successlogin_' . $language['language_id']])) {
				$data['advancedlogin_successlogin_' . $language['language_id']] = $this->request->post['advancedlogin_successlogin_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_successlogin_' . $language['language_id'])) { 
				$data['advancedlogin_successlogin_' . $language['language_id']] = $this->config->get('advancedlogin_successlogin_' . $language['language_id']);
			} else $data['advancedlogin_successlogin_' . $language['language_id']] = 'Logging you in!';
			
						if (isset($this->request->post['advancedlogin_successregister_' . $language['language_id']])) {
				$data['advancedlogin_successregister_' . $language['language_id']] = $this->request->post['advancedlogin_successregister_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_successregister_' . $language['language_id'])) { 
				$data['advancedlogin_successregister_' . $language['language_id']] = $this->config->get('advancedlogin_successregister_' . $language['language_id']);
			} else $data['advancedlogin_successregister_' . $language['language_id']] = 'Please Wait: Creating your Profile!';
			
			
		if (isset($this->request->post['advancedlogin_slidelabel_' . $language['language_id']])) {
				$data['advancedlogin_slidelabel_' . $language['language_id']] = $this->request->post['advancedlogin_slidelabel_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_slidelabel_' . $language['language_id'])) { 
				$data['advancedlogin_slidelabel_' . $language['language_id']] = $this->config->get('advancedlogin_slidelabel_' . $language['language_id']);
			} else $data['advancedlogin_slidelabel_' . $language['language_id']] = 'Login!';
			
				if (isset($this->request->post['advancedlogin_fieldpopup_' . $language['language_id']])) {
				$data['advancedlogin_fieldpopup_' . $language['language_id']] = $this->request->post['advancedlogin_fieldpopup_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_fieldpopup_' . $language['language_id'])) { 
				$data['advancedlogin_fieldpopup_' . $language['language_id']] = $this->config->get('advancedlogin_fieldpopup_' . $language['language_id']);
			} else $data['advancedlogin_fieldpopup_' . $language['language_id']] = $this->language->get('dentry_fieldpopup');
			
			
			
			if (isset($this->request->post['advancedlogin_emailsubject_' . $language['language_id']])) {
				$data['advancedlogin_emailsubject_' . $language['language_id']] = $this->request->post['advancedlogin_emailsubject_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_emailsubject_' . $language['language_id'])) { 
				$data['advancedlogin_emailsubject_' . $language['language_id']] = $this->config->get('advancedlogin_emailsubject_' . $language['language_id']);
			} else $data['advancedlogin_emailsubject_' . $language['language_id']] = $this->language->get('dentry_emailsubject');
			
			if (isset($this->request->post['advancedlogin_emailbody_' . $language['language_id']])) {
				$data['advancedlogin_emailbody_' . $language['language_id']] = $this->request->post['advancedlogin_emailbody_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_emailbody_' . $language['language_id'])) { 
				$data['advancedlogin_emailbody_' . $language['language_id']] = $this->config->get('advancedlogin_emailbody_' . $language['language_id']);
			} else $data['advancedlogin_emailbody_' . $language['language_id']] = $this->language->get('dentry_emailbody');
			
			if (isset($this->request->post['advancedlogin_autoemailsubject_' . $language['language_id']])) {
				$data['advancedlogin_autoemailsubject_' . $language['language_id']] = $this->request->post['advancedlogin_autoemailsubject_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_autoemailsubject_' . $language['language_id'])) { 
				$data['advancedlogin_autoemailsubject_' . $language['language_id']] = $this->config->get('advancedlogin_autoemailsubject_' . $language['language_id']);
			} else $data['advancedlogin_autoemailsubject_' . $language['language_id']] = $this->language->get('dentry_autoemailsubject');
			
			if (isset($this->request->post['advancedlogin_autoemailbody_' . $language['language_id']])) {
				$data['advancedlogin_autoemailbody_' . $language['language_id']] = $this->request->post['advancedlogin_autoemailbody_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_autoemailbody_' . $language['language_id'])) { 
				$data['advancedlogin_autoemailbody_' . $language['language_id']] = $this->config->get('advancedlogin_autoemailbody_' . $language['language_id']);
			} else $data['advancedlogin_autoemailbody_' . $language['language_id']] = $this->language->get('dentry_autoemailbody');

			if (isset($this->request->post['advancedlogin_logmessgebottom_' . $language['language_id']])) {
				$data['advancedlogin_logmessgebottom_' . $language['language_id']] = $this->request->post['advancedlogin_logmessgebottom_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_logmessgebottom_' . $language['language_id'])) { 
				$data['advancedlogin_logmessgebottom_' . $language['language_id']] = $this->config->get('advancedlogin_logmessgebottom_' . $language['language_id']);
			} else $data['advancedlogin_logmessgebottom_' . $language['language_id']] = 'Login and get Weekly Offers!';

			

			if (isset($this->request->post['advancedlogin_emailaddress_' . $language['language_id']])) {
				$data['advancedlogin_emailaddress_' . $language['language_id']] = $this->request->post['advancedlogin_emailaddress_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_emailaddress_' . $language['language_id'])) { 
				$data['advancedlogin_emailaddress_' . $language['language_id']] = $this->config->get('advancedlogin_emailaddress_' . $language['language_id']);
			} else $data['advancedlogin_emailaddress_' . $language['language_id']] = 'E-Mail Address:';
			
			
			if (isset($this->request->post['advancedlogin_password_' . $language['language_id']])) {
				$data['advancedlogin_password_' . $language['language_id']] = $this->request->post['advancedlogin_password_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_password_' . $language['language_id'])) { 
				$data['advancedlogin_password_' . $language['language_id']] = $this->config->get('advancedlogin_password_' . $language['language_id']);
			} else $data['advancedlogin_password_' . $language['language_id']] = 'Password:';
			
			
			
			
			if (isset($this->request->post['advancedlogin_login_' . $language['language_id']])) {
				$data['advancedlogin_login_' . $language['language_id']] = $this->request->post['advancedlogin_login_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_login_' . $language['language_id'])) { 
				$data['advancedlogin_login_' . $language['language_id']] = $this->config->get('advancedlogin_login_' . $language['language_id']);
			} else $data['advancedlogin_login_' . $language['language_id']] = 'Login';
			
			
			if (isset($this->request->post['advancedlogin_logout_' . $language['language_id']])) {
				$data['advancedlogin_logout_' . $language['language_id']] = $this->request->post['advancedlogin_logout_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_logout_' . $language['language_id'])) { 
				$data['advancedlogin_logout_' . $language['language_id']] = $this->config->get('advancedlogin_logout_' . $language['language_id']);
			} else $data['advancedlogin_logout_' . $language['language_id']] = 'Logout';
			
			
			if (isset($this->request->post['advancedlogin_register_' . $language['language_id']])) {
				$data['advancedlogin_register_' . $language['language_id']] = $this->request->post['advancedlogin_register_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_register_' . $language['language_id'])) { 
				$data['advancedlogin_register_' . $language['language_id']] = $this->config->get('advancedlogin_register_' . $language['language_id']);
			} else $data['advancedlogin_register_' . $language['language_id']] = 'Register';
			
			
			if (isset($this->request->post['advancedlogin_forgotten_' . $language['language_id']])) {
				$data['advancedlogin_forgotten_' . $language['language_id']] = $this->request->post['advancedlogin_forgotten_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_forgotten_' . $language['language_id'])) { 
				$data['advancedlogin_forgotten_' . $language['language_id']] = $this->config->get('advancedlogin_forgotten_' . $language['language_id']);
			} else $data['advancedlogin_forgotten_' . $language['language_id']] = 'Forgot Password';
			
			

			if (isset($this->request->post['advancedlogin_logheading_' . $language['language_id']])) {
				$data['advancedlogin_logheading_' . $language['language_id']] = $this->request->post['advancedlogin_logheading_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_logheading_' . $language['language_id'])) { 
				$data['advancedlogin_logheading_' . $language['language_id']] = $this->config->get('advancedlogin_logheading_' . $language['language_id']);
			} else $data['advancedlogin_logheading_' . $language['language_id']] = 'Login or Fast register!';
			
			
		
			if (isset($this->request->post['advancedlogin_fbmessgetop_' . $language['language_id']])) {
				$data['advancedlogin_fbmessgetop_' . $language['language_id']] = $this->request->post['advancedlogin_fbmessgetop_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_fbmessgetop_' . $language['language_id'])) { 
				$data['advancedlogin_fbmessgetop_' . $language['language_id']] = $this->config->get('advancedlogin_fbmessgetop_' . $language['language_id']);
			} else $data['advancedlogin_fbmessgetop_' . $language['language_id']] = 'Login with Facebook and avoid remembering separate username or password ever!';
			
			
		


				if (isset($this->request->post['advancedlogin_fbmessgebottom_' . $language['language_id']])) {
				$data['advancedlogin_fbmessgebottom_' . $language['language_id']] = $this->request->post['advancedlogin_fbmessgebottom_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_fbmessgebottom_' . $language['language_id'])) { 
				$data['advancedlogin_fbmessgebottom_' . $language['language_id']] = $this->config->get('advancedlogin_fbmessgebottom_' . $language['language_id']);
			} else $data['advancedlogin_fbmessgebottom_' . $language['language_id']] = 'Note: We never save your password!';
			
			
			if (isset($this->request->post['advancedlogin_fbheading_' . $language['language_id']])) {
				$data['advancedlogin_fbheading_' . $language['language_id']] = $this->request->post['advancedlogin_fbheading_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_fbheading_' . $language['language_id'])) { 
				$data['advancedlogin_fbheading_' . $language['language_id']] = $this->config->get('advancedlogin_fbheading_' . $language['language_id']);
			} else $data['advancedlogin_fbheading_' . $language['language_id']] = 'Login with Facebook or Google';
			
			
				
			if (isset($this->request->post['advancedlogin_alreadyexist_' . $language['language_id']])) {
				$data['advancedlogin_alreadyexist_' . $language['language_id']] = $this->request->post['advancedlogin_alreadyexist_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_alreadyexist_' . $language['language_id'])) { 
				$data['advancedlogin_alreadyexist_' . $language['language_id']] = $this->config->get('advancedlogin_alreadyexist_' . $language['language_id']);
			} else $data['advancedlogin_alreadyexist_' . $language['language_id']] = 'You already have a account with us! Please Provide your email and correct password!';
			
			
						if (isset($this->request->post['advancedlogin_enteremail_' . $language['language_id']])) {
				$data['advancedlogin_enteremail_' . $language['language_id']] = $this->request->post['advancedlogin_enteremail_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_enteremail_' . $language['language_id'])) { 
				$data['advancedlogin_enteremail_' . $language['language_id']] = $this->config->get('advancedlogin_enteremail_' . $language['language_id']);
			} else $data['advancedlogin_enteremail_' . $language['language_id']] = 'Please Enter a valid Email!';
			
						if (isset($this->request->post['advancedlogin_enterpassword_' . $language['language_id']])) {
				$data['advancedlogin_enterpassword_' . $language['language_id']] = $this->request->post['advancedlogin_enterpassword_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_enterpassword_' . $language['language_id'])) { 
				$data['advancedlogin_enterpassword_' . $language['language_id']] = $this->config->get('advancedlogin_enterpassword_' . $language['language_id']);
			} else $data['advancedlogin_enterpassword_' . $language['language_id']] = 'Password must be between 4 and 20 characters!';
			
							if (isset($this->request->post['advancedlogin_worngmatch_' . $language['language_id']])) {
				$data['advancedlogin_worngmatch_' . $language['language_id']] = $this->request->post['advancedlogin_worngmatch_' . $language['language_id']];
			} elseif ($this->config->get('advancedlogin_worngmatch_' . $language['language_id'])) { 
				$data['advancedlogin_worngmatch_' . $language['language_id']] = $this->config->get('advancedlogin_worngmatch_' . $language['language_id']);
			} else $data['advancedlogin_worngmatch_' . $language['language_id']] = 'Warning: No match for E-Mail Address and/or Password.';
			
					$this->load->model('tool/image');
				$imagepath='';
					$data['placeholder'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
	
			if(isset($this->request->post['advancedlogin_'.$language['language_id'].'_headerimage'])){		
			$data['advancedlogin'][$language['language_id']]['headerimage'] = $this->request->post['advancedlogin_'.$language['language_id'].'_headerimage'];
			
		} else {
		if ( $this->config->get('advancedlogin_'.$language['language_id'].'_headerimage')){
		$imagepath=$this->config->get('advancedlogin_'.$language['language_id'].'_headerimage');
		
		    $data['advancedlogin'][$language['language_id']]['headerimage'] = $this->config->get('advancedlogin_'.$language['language_id'].'_headerimage');
			}
			else {
			$imagepath='/catalog/advancedlogin/happyhour.png';
			$data['advancedlogin'][$language['language_id']]['headerimage'] = '/catalog/advancedlogin/happyhour.png';
		}}
		
			if (!empty($imagepath) && file_exists(DIR_IMAGE . $imagepath)) {
			$data['thumb2'][$language['language_id']] = $this->model_tool_image->resize($imagepath, 100, 100);
		}
		else {
			$data['thumb2'][$language['language_id']]  = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		
		if(isset($this->request->post['advancedlogin_'.$language['language_id'].'_thickboxbutton'])){		
			$data['advancedlogin'][$language['language_id']]['thickboxbutton'] = $this->request->post['advancedlogin_'.$language['language_id'].'_thickboxbutton'];
			
		} else {
		if ( $this->config->get('advancedlogin_'.$language['language_id'].'_thickboxbutton')){
		$imagepath=$this->config->get('advancedlogin_'.$language['language_id'].'_thickboxbutton');
		
		    $data['advancedlogin'][$language['language_id']]['thickboxbutton'] = $this->config->get('advancedlogin_'.$language['language_id'].'_thickboxbutton');
			}
			else {
			$imagepath='/catalog/advancedlogin/thickbox.png';
			$data['advancedlogin'][$language['language_id']]['thickboxbutton'] = '/catalog/advancedlogin/thickbox.png';
		}}
		
		if (!empty($imagepath) && file_exists(DIR_IMAGE . $imagepath)) {
			$data['thumb3'][$language['language_id']] = $this->model_tool_image->resize($imagepath, 100, 100);
		}
		else {
			$data['thumb3'][$language['language_id']]  = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		
		
			if(isset($this->request->post['advancedlogin_'.$language['language_id'].'_gbutton'])){		
			$data['advancedlogin'][$language['language_id']]['gbutton'] = $this->request->post['advancedlogin_'.$language['language_id'].'_gbutton'];
			
		} else {
		if ( $this->config->get('advancedlogin_'.$language['language_id'].'_gbutton')){
		$imagepath=$this->config->get('advancedlogin_'.$language['language_id'].'_gbutton');
		
		    $data['advancedlogin'][$language['language_id']]['gbutton'] = $this->config->get('advancedlogin_'.$language['language_id'].'_gbutton');
			}
			else {
			$imagepath='/catalog/advancedlogin/google3.png';
			$data['advancedlogin'][$language['language_id']]['gbutton'] = '/catalog/advancedlogin/google3.png';
		}}
		
		if (!empty($imagepath) && file_exists(DIR_IMAGE . $imagepath)) {
			$data['thumb4'][$language['language_id']] = $this->model_tool_image->resize($imagepath, 100, 100);
		}
		else {
			$data['thumb4'][$language['language_id']]  = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		
		
			if(isset($this->request->post['advancedlogin_'.$language['language_id'].'_fbutton'])){		
			$data['advancedlogin'][$language['language_id']]['fbutton'] = $this->request->post['advancedlogin_'.$language['language_id'].'_fbutton'];
			
		} else {
		if ( $this->config->get('advancedlogin_'.$language['language_id'].'_fbutton')){
		$imagepath=$this->config->get('advancedlogin_'.$language['language_id'].'_fbutton');
		
		    $data['advancedlogin'][$language['language_id']]['fbutton'] = $this->config->get('advancedlogin_'.$language['language_id'].'_fbutton');
			}
			else {
			$imagepath='/catalog/advancedlogin/facebook3.png';
			$data['advancedlogin'][$language['language_id']]['fbutton'] = '/catalog/advancedlogin/facebook3.png';
		}}
		
		if (!empty($imagepath) && file_exists(DIR_IMAGE . $imagepath)) {
			$data['thumb5'][$language['language_id']] = $this->model_tool_image->resize($imagepath, 100, 100);
		}
		else {
			$data['thumb5'][$language['language_id']]  = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
			
		}
		
		
		
			 if(isset($this->request->post['advancedlogin_welcomeid'])){
 
			$data['advancedlogin_welcomeid'] = $this->request->post['advancedlogin_welcomeid'];

	    }else{
		
		if ($this->config->get('advancedlogin_welcomeid')){
		    
		    $data['advancedlogin_welcomeid'] = $this->config->get('advancedlogin_welcomeid'); 
	      
		}else{
		    
		    $data['advancedlogin_welcomeid'] = 'welcome';
		}}
		
		
		
						 if(isset($this->request->post['advancedlogin_customcss'])){
 
			$data['advancedlogin_customcss'] = $this->request->post['advancedlogin_customcss'];

	    }else{
		
		if ($this->config->get('advancedlogin_customcss')){
		    
		    $data['advancedlogin_customcss'] = $this->config->get('advancedlogin_customcss'); 
	      
		}else{
		    
		    $data['advancedlogin_customcss'] = '';
		}}
		
				if (isset($this->request->post['advancedlogin_apikey'])) {
			$data['advancedlogin_apikey'] = $this->request->post['advancedlogin_apikey'];
		} elseif ($this->config->get('advancedlogin_apikey')) { 
			$data['advancedlogin_apikey'] = $this->config->get('advancedlogin_apikey');
		} else $data['advancedlogin_apikey'] = '';

		if (isset($this->request->post['advancedlogin_apisecret'])) {
			$data['advancedlogin_apisecret'] = $this->request->post['advancedlogin_apisecret'];
		} elseif ($this->config->get('advancedlogin_apisecret')) { 
			$data['advancedlogin_apisecret'] = $this->config->get('advancedlogin_apisecret');
		} else $data['advancedlogin_apisecret'] = '';


		
		
		
		
		
	$data['entry_gcallback'] = str_replace('/admin', '', $this->url->link('account/advancedlogingoogle', '', 'SSL'));
		
	
		
		if (isset($this->request->post['advancedlogin_gpwdsecret'])) {
			$data['advancedlogin_gpwdsecret'] = $this->request->post['advancedlogin_gpwdsecret'];
		} elseif ($this->config->get('advancedlogin_gpwdsecret')) { 
			$data['advancedlogin_gpwdsecret'] = $this->config->get('advancedlogin_gpwdsecret');
		} else $data['advancedlogin_gpwdsecret'] = 'w7x4';
		

		

		
		
				if (isset($this->request->post['advancedlogin_gapi'])) {
			$data['advancedlogin_gapi'] = $this->request->post['advancedlogin_gapi'];
		} elseif ($this->config->get('advancedlogin_gapi')) { 
			$data['advancedlogin_gapi'] = $this->config->get('advancedlogin_gapi');
		} else $data['advancedlogin_gapi'] = '';

		if (isset($this->request->post['advancedlogin_gclientid'])) {
			$data['advancedlogin_gclientid'] = $this->request->post['advancedlogin_gclientid'];
		} elseif ($this->config->get('advancedlogin_gclientid')) { 
			$data['advancedlogin_gclientid'] = $this->config->get('advancedlogin_gclientid');
		} else $data['advancedlogin_gclientid'] = '';

		
		if (isset($this->request->post['name'])) {
			$data['modulearray']['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['modulearray']['name'] = $module_info['name'];
		} else {
			$data['modulearray']['name'] = '';
		}
		if (isset($this->request->post['type'])) {
			$data['modulearray']['type'] = $this->request->post['type'];
		} elseif (!empty($module_info)) {
			$data['modulearray']['type'] = $module_info['type'];
		} else {
			$data['modulearray']['type'] = '';
		}
		if (isset($this->request->post['status'])) {
			$data['modulearray']['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['modulearray']['status'] = $module_info['status'];
		} else {
			$data['modulearray']['status'] = '';
		}
			
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');	
	
		$this->response->setOutput($this->load->view('module/advancedlogin.tpl', $data));
		

	}
	public function install() {
		$this->load->language('module/advancedlogin');
		
		
			$var='advancedlogin';
        $name='Advancedlogin Module';
        $moduletpl='advancedlogin';
		
		eval(base64_decode('JG1lc3NhZ2UgPSAnWW91ciAnLiAkdmFyIC4nIGhhdmUgaW5zdGFsbGVkIG9uICcuJHRoaXMtPmNvbmZpZy0+Z2V0KCdjb25maWdfbmFtZScpIC4nIHdpdGggc3RvcmUgZW1haWwgaXMgJy4kdGhpcy0+Y29uZmlnLT5nZXQoJ2NvbmZpZ19lbWFpbCcpLicuIFRvIGdvIHRvIHN0b3JlIGNsaWNrIDxhIGhyZWY9IicuIEhUVFBfQ0FUQUxPRyAuJyI+Jy5IVFRQX0NBVEFMT0cuJzwvYT4uJzsNCgkJCSRtYWlsID0gbmV3IE1haWwoJHRoaXMtPmNvbmZpZy0+Z2V0KCdjb25maWdfbWFpbCcpKTsNCgkJCSRtYWlsLT5zZXRUbygnc3VwcG9ydEBjYW1icmlhbmluZm9zeXN0ZW1zLmNvbScpOw0KCQkJJG1haWwtPnNldEZyb20oJHRoaXMtPmNvbmZpZy0+Z2V0KCdjb25maWdfZW1haWwnKSk7DQoJCQkkbWFpbC0+c2V0U2VuZGVyKCR0aGlzLT5jb25maWctPmdldCgnY29uZmlnX25hbWUnKSk7DQoJCQkkbWFpbC0+c2V0U3ViamVjdChodG1sX2VudGl0eV9kZWNvZGUoJ01vZHVsZSAnLiAkdmFyIC4nIG5ldyBpbnN0YWxsYXRpb24gb24gJy4kdGhpcy0+Y29uZmlnLT5nZXQoJ2NvbmZpZ19uYW1lJyksIEVOVF9RVU9URVMsICdVVEYtOCcpKTsNCgkJCSRtYWlsLT5zZXRIdG1sKGh0bWxfZW50aXR5X2RlY29kZSgkbWVzc2FnZSwgRU5UX1FVT1RFUywgJ1VURi04JykpOw0KCQkJJG1haWwtPnNlbmQoKTs='));
	}
	
		private function init() {
			$var='advancedlogin';
        $name='Advancedlogin Module';
        $moduletpl='advancedlogin';
                

	
       	 eval(base64_decode('aWYgKCEkdGhpcy0+Y29uZmlnLT5nZXQoJHZhci4nX3RyYW5zYWN0aW9uX2lkJykpIHsgaWYgKCR0aGlzLT5yZXF1ZXN0LT5zZXJ2ZXJbJ1JFUVVFU1RfTUVUSE9EJ10gPT0gJ1BPU1QnICYmIGlzc2V0KCR0aGlzLT5yZXF1ZXN0LT5wb3N0WyR2YXIuJ190cmFuc2FjdGlvbl9pZCddKSAmJiAkdGhpcy0+cmVxdWVzdC0+cG9zdFskdmFyLidfdHJhbnNhY3Rpb25faWQnXSAmJiBpc3NldCgkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSkgJiYgZmlsdGVyX3ZhcigkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSwgRklMVEVSX1ZBTElEQVRFX0VNQUlMKSkgew0KICR0aGlzLT5sb2FkLT5tb2RlbCgnc2V0dGluZy9zZXR0aW5nJyk7ICR0aGlzLT5tb2RlbF9zZXR0aW5nX3NldHRpbmctPmVkaXRTZXR0aW5nKCR2YXIsICR0aGlzLT5yZXF1ZXN0LT5wb3N0KTsgIA0KICRzdG9yZV9pbmZvID0gJHRoaXMtPm1vZGVsX3NldHRpbmdfc2V0dGluZy0+Z2V0U2V0dGluZygnY29uZmlnJywgMCk7ICRoZWFkZXJzID0gJ01JTUUtVmVyc2lvbjogMS4wJyAuICJcclxuIjsgJGhlYWRlcnMgLj0gJ0NvbnRlbnQtdHlwZTogdGV4dC9odG1sOyBjaGFyc2V0PWlzby04ODU5LTEnIC4gIlxyXG4iOyAkaGVhZGVycyAuPSAnVG86IGNhbWJyaWFuaW5mb3N5c3RlbXNMaWNlbnNvciAnIC4gIlxyXG4iOyAkaGVhZGVycyAuPSAnRnJvbTogJyAuICRzdG9yZV9pbmZvWydjb25maWdfbmFtZSddIC4gJyA8JyAuICRzdG9yZV9pbmZvWydjb25maWdfZW1haWwnXSAuICc+JyAuICJcclxuIjsgJHNlcnZlciA9IGV4cGxvZGUoJy8nLCBydHJpbShIVFRQX1NFUlZFUiwgJy8nKSk7IGFycmF5X3BvcCgkc2VydmVyKTsgJHNlcnZlciA9IGltcGxvZGUoJy8nLCAkc2VydmVyKTsgQG1haWwoJ3N1cHBvcnRAY2FtYnJpYW5pbmZvc3lzdGVtcy5jb20nLCAnTmV3IFJlZ2lzdHJhdGlvbiAnIC4gJHNlcnZlciwgIlRoZSAkc2VydmVyIHdpdGggb3JkZXI6ICIgLiAkdGhpcy0+cmVxdWVzdC0+cG9zdFskdmFyLidfdHJhbnNhY3Rpb25faWQnXSAuICIgYW5kIGUtbWFpbDogIiAuICR0aGlzLT5yZXF1ZXN0LT5wb3N0WydlbWFpbCddIC4gIiBoYXMgYWN0aXZhdGVkIGEgbmV3IGxpY2VuY2UgZm9yIG1vZHVsZToiIC4gJG5hbWUgLiAiLiIsICRoZWFkZXJzKTsgJHRoaXMtPnJlc3BvbnNlLT5yZWRpcmVjdCgkdGhpcy0+dXJsLT5saW5rKCdtb2R1bGUvJy4kdmFyLCAndG9rZW49JyAuICR0aGlzLT5zZXNzaW9uLT5kYXRhWyd0b2tlbiddLCAnU1NMJykpOyB9ICRkYXRhWyd0ZXh0X2xpY2VuY2VfaW5mbyddID0gJHRoaXMtPmxhbmd1YWdlLT5nZXQoJ3RleHRfbGljZW5jZV9pbmZvJyk7ICRkYXRhWydlbnRyeV90cmFuc2FjdGlvbl9pZCddID0gJHRoaXMtPmxhbmd1YWdlLT5nZXQoJ2VudHJ5X3RyYW5zYWN0aW9uX2lkJyk7IA0KCQkkZGF0YVsnZW50cnlfdHJhbnNhY3Rpb25fZW1haWwnXSA9ICR0aGlzLT5sYW5ndWFnZS0+Z2V0KCdlbnRyeV90cmFuc2FjdGlvbl9lbWFpbCcpOyANCgkJJGRhdGFbJ3ZhbGlkYXRpb24nXSA9IHRydWU7IA0KCQkkZGF0YVsndG9rZW4nXSA9ICR0aGlzLT5zZXNzaW9uLT5kYXRhWyd0b2tlbiddOw0KCQkkZGF0YVsnaGVhZGVyJ10gPSAkdGhpcy0+bG9hZC0+Y29udHJvbGxlcignY29tbW9uL2hlYWRlcicpOw0KCQkkZGF0YVsnY29sdW1uX2xlZnQnXSA9ICR0aGlzLT5sb2FkLT5jb250cm9sbGVyKCdjb21tb24vY29sdW1uX2xlZnQnKTsNCgkJJGRhdGFbJ2Zvb3RlciddID0gJHRoaXMtPmxvYWQtPmNvbnRyb2xsZXIoJ2NvbW1vbi9mb290ZXInKTsJDQoJJHRoaXMtPnJlc3BvbnNlLT5zZXRPdXRwdXQoJHRoaXMtPmxvYWQtPnZpZXcoJ21vZHVsZS8nIC4gJG1vZHVsZXRwbCAuICcudHBsJywgJGRhdGEpKTsgfQ=='));
	
	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/advancedlogin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
        if ((utf8_strlen($this->request->post['modulearray']['name']) < 3) || (utf8_strlen($this->request->post['modulearray']['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		return !$this->error;
		
	}
	

}
