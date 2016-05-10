<?php
/*
 * Shoputils
 *
 * ПРИМЕЧАНИЕ К ЛИЦЕНЗИОННОМУ СОГЛАШЕНИЮ
 *
 * Этот файл связан лицензионным соглашением, которое можно найти в архиве,
 * вместе с этим файлом. Файл лицензии называется: LICENSE.1.5.x.RUS.txt
 * Так же лицензионное соглашение можно найти по адресу:
 * http://opencart.shoputils.ru/LICENSE.1.5.x.RUS.txt
 * 
 * =================================================================
 * OPENCART 1.5.x ПРИМЕЧАНИЕ ПО ИСПОЛЬЗОВАНИЮ
 * =================================================================
 *  Этот файл предназначен для Opencart 1.5.x. Shoputils не
 *  гарантирует правильную работу этого расширения на любой другой 
 *  версии Opencart, кроме Opencart 1.5.x. 
 *  Shoputils не поддерживает программное обеспечение для других 
 *  версий Opencart.
 * =================================================================
*/

class ControllerLocalisationShoputilsMailOrderStatus extends Controller {
    private $error = array();
    private $version = '2.3b.03';
    const FILE_NAME_LIC = 'shoputils_mailorder.lic';
    const SIMPLE_PATH   = 'model/module/simplecustom.php';
    const SIMPLE_MODEL  = 'module/simplecustom';
    const SIMPLE_OBJECT = 'model_module_simplecustom';
    const SIMPLE_METHOD = 'getCustomFields';
    const NEW_ORDER     = 'new_order';
    const UPDATE_ORDER  = 'update_order';

    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language('localisation/shoputils_mail_order_status');
        $this->load->model('localisation/language');
        $this->load->model('localisation/order_status');
        $this->document->setTitle($this->language->get('heading_title'));
    }

    public function menu_mail_order_status() {
        $this->data['menu_mail_order_status'] = $this->language->get('menu_mail_order_status');
        $this->data['menu_mail_order_status_href'] = $this->makeUrl('localisation/shoputils_mail_order_status/settings');

        $this->template = 'shoputils/shoputils_mail_order_status/shoputils_mail_order_status_menu.tpl';
        $this->render();
    }

    public function settings() {
        if (!file_exists(DIR_APPLICATION . self::FILE_NAME_LIC)) {
            $this->redirect($this->url->link('localisation/shoputils_mail_order_status/lic', '&token=' . $this->session->data['token'], 'SSL'));
        }
        register_shutdown_function(array($this, 'licShutdownHandler'));
        $this->load->model('shoputils/mail_order_status');
        $this->load->model('localisation/shoputils_mail_order_status');
        $this->document->addStyle('view/stylesheet/shoputils_mail_order_status.css');
        $this->document->addStyle('view/javascript/tooltip/jquery.qtip.css');
        $this->document->addScript('view/javascript/tooltip/jquery.qtip.js');
        $this->document->addScript('view/javascript/tooltip/tooltip.js');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_shoputils_mail_order_status->setSetting();
            $this->redirect($this->makeUrl('localisation/shoputils_mail_order_status/settings'));
        }

        $this->_setData(array(
            'heading_title',
            'button_save',
            'button_cancel',
            'button_default',
            'tab_new_order',
            'tab_order_statuses',
            'tab_settings_ft',
            'text_confirm',
            'text_enabled',
            'text_disabled',
            'text_yes',
            'text_no',
            'entry_current_order_status',
            'entry_admin_current_order_status',
            'entry_status',
            'entry_admin_status',
            'entry_chkbox_notify',
            'entry_subject',
            'entry_content',
            'entry_new_order',
            'entry_admin_new_order',
            'entry_products_ft',
            'entry_products_header_ft',
            'entry_products_footer_ft',
            'entry_totals_ft',
            'entry_totals_header_ft',
            'entry_totals_footer_ft',
            'entry_product_first_ft',
            'entry_product_last_ft',
            'help_status',
            'help_admin_status',
            'help_chkbox_notify',
            'help_subject',
            'help_content',
            'help_new_status',
            'help_admin_new_status',
            'help_new_chkbox_notify',
            'help_new_subject',
            'help_new_content',
            'help_on_ckeditor',
            'help_products_ft',
            'help_products_header_ft',
            'help_products_footer_ft',
            'help_totals_ft',
            'help_totals_header_ft',
            'help_totals_footer_ft',
            'help_product_first_ft',
            'help_product_last_ft',
            'help_list_helper',
            'help_button_default',
            'text_info'                   => sprintf($this->language->get('text_info'), $this->makeUrl('localisation/order_status')),
            'text_copyright'              => sprintf($this->language->get('text_copyright'), $this->language->get('heading_title'), date('Y', time())),
            'entry_chkbox_notify'         => sprintf($this->language->get('entry_chkbox_notify'), $this->makeUrl('sale/order')),
            'action'                      => $this->makeUrl('localisation/shoputils_mail_order_status/settings'),
            'cancel'                      => $this->makeUrl('common/home'),
            'token'                       => isset($this->session->data['token']) ? $this->session->data['token'] : '',
            'error_warning'               => isset($this->error['warning']) ? $this->error['warning'] : '',
            'list_helper_new_order'       => $this->getListHelper(),
            'list_helper_update_order'    => $this->getListHelper(self::UPDATE_ORDER),
            'new_subject_default'         => $this->language->get('text_new_subject_default'),
            'new_content_default'         => $this->getNewContentDefault(),
            'products_helper'             => $this->getProductsHelper(),
            'products_ft_default'         => $this->getProductsFT(),
            'products_header_ft_default'  => $this->getProductsHeaderFT(),
            'products_footer_ft_default'  => $this->getProductsFooterFT(),
            'totals_helper'               => $this->getTotalsHelper(),
            'totals_ft_default'           => $this->getTotalsFT(),
            'totals_header_ft_default'    => $this->getTotalsHeaderFT(),
            'totals_footer_ft_default'    => $this->getTotalsFooterFT(),
            'product_first_ft_default'    => $this->getProductFirstFT(),
            'product_last_ft_default'     => $this->getProductLastFT(),
            'order_statuses'              => $this->model_localisation_order_status->getOrderStatuses(),
            'oc_languages'                => $this->model_localisation_language->getLanguages()
        ));

        $this->_setErrors(
            array(
                'error_subject',
                'error_content',
                'error_admin_subject',
                'error_admin_content'
            ), $this->data['order_statuses']
        );

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'href' => $this->makeUrl('common/home'),
            'text' => $this->language->get('text_home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->makeUrl('localisation/shoputils_mail_order_status/settings'),
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        );

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->_updateData(
            array(
                 'shoputils_mail_order_status_new_status',
                 'shoputils_mail_order_status_new_subject',
                 'shoputils_mail_order_status_new_content',
                 'shoputils_mail_order_status_admin_new_status',
                 'shoputils_mail_order_status_admin_new_subject',
                 'shoputils_mail_order_status_admin_new_content',
                 'shoputils_mail_order_status_products_ft',
                 'shoputils_mail_order_status_products_header_ft',
                 'shoputils_mail_order_status_products_footer_ft',
                 'shoputils_mail_order_status_totals_ft',
                 'shoputils_mail_order_status_totals_header_ft',
                 'shoputils_mail_order_status_totals_footer_ft',
                 'shoputils_mail_order_status_product_first_ft',
                 'shoputils_mail_order_status_product_last_ft'
            )//, $this->data['order_statuses']
        );

        $this->_updateDataStatuses(
            array(
                 'shoputils_mail_order_status_status',
                 'shoputils_mail_order_status_notify',
                 'shoputils_mail_order_status_subject',
                 'shoputils_mail_order_status_content',
                 'shoputils_mail_order_status_admin_status',
                 'shoputils_mail_order_status_admin_subject',
                 'shoputils_mail_order_status_admin_content'
            ), $this->data['order_statuses']
        );

        $this->template = 'localisation/shoputils_mail_order_status.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }

    public function lic() {
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!$this->user->hasPermission('modify', 'localisation/shoputils_mail_order_status')) {
                $this->session->data['warning'] = sprintf($this->language->get('error_permission'), $this->language->get('heading_title'));
            } elseif (!empty($this->request->post['lic_data'])) {
                $perms = fileperms(DIR_APPLICATION);
                if (!is_writable(DIR_APPLICATION)) {
                    chmod(DIR_APPLICATION, 0755);
                }
                
                $lic = '------ LICENSE FILE DATA -------' . "\n";
                $lic .= trim($this->request->post['lic_data']) . "\n";
                $lic .= '--------------------------------' . "\n";
                $file = DIR_APPLICATION . self::FILE_NAME_LIC;
                $handle = @fopen($file, 'w'); 
                fwrite($handle, $lic);
                fclose($handle); 
                chmod(DIR_APPLICATION, $perms);

                if (!file_exists($file)) {
                    $this->session->data['warning'] = sprintf($this->language->get('error_dir_perm'), DIR_APPLICATION);
                    $this->redirect($this->makeUrl('localisation/shoputils_mail_order_status/lic'));
                }

                register_shutdown_function(array($this, 'licShutdownHandler'));
                $this->load->model('shoputils/mail_order_status');

                $this->redirect($this->makeUrl('localisation/shoputils_mail_order_status/settings'));
            }
        }

        $domain = str_replace('http://', '', HTTP_SERVER);
        $domain = explode('/', str_replace('https://', '', $domain));
        $this->_setData(array(
            'heading_title',
            'button_save',
            'button_cancel',
            'entry_key',
            'error_loader',
            'error_key',
            'text_get_key'  => sprintf($this->language->get('text_get_key'), $domain[0]),
            'action'        => $this->makeUrl('localisation/shoputils_mail_order_status/lic'),
            'cancel'        => $this->makeUrl('common/home'),
            'loader'        => extension_loaded('ionCube Loader')
        ));
        
        if (isset($this->session->data['warning'])) {
          $this->data['error_warning'] = $this->session->data['warning'];
          unset($this->session->data['warning']);
          if (file_exists(DIR_APPLICATION . self::FILE_NAME_LIC)) {
              @unlink(DIR_APPLICATION . self::FILE_NAME_LIC);
          }
        } else {
          $this->data['error_warning'] = '';
        }

        $this->template = 'shoputils/admin/mail_order_status.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }

    protected function getListHelper($type = self::NEW_ORDER) {
        $this->_setData(array(
                             'entry_general_ft',
                             'text_order_id_ft',
                             'text_store_name_ft',
                             'text_logo_ft',
                             'text_order_status_ft',
                             'text_order_link_ft',
                             'text_comment_ft',
                             'text_admin_comment_ft',
                             'text_ip_ft',
                             'text_date_added_ft',
                             'text_date_modified_ft',
                             'text_firstname_ft',
                             'text_lastname_ft',
                             'text_group_ft',
                             'text_email_ft',
                             'text_telephone_ft',
                             'text_products_ft',
                             'text_totals_ft',
                             'text_total_ft',
                             'text_shipping_total_ft',
                             'text_product_first_ft',
                             'text_product_last_ft',

                             'entry_payment_ft',
                             'text_payment_firstname_ft',
                             'text_payment_lastname_ft',
                             'text_payment_company_ft',
                             'text_payment_address_1_ft',
                             'text_payment_address_2_ft',
                             'text_payment_city_ft',
                             'text_payment_postcode_ft',
                             'text_payment_country_ft',
                             'text_payment_zone_ft',
                             'text_payment_method_ft',

                             'entry_shipping_ft',
                             'text_shipping_firstname_ft',
                             'text_shipping_lastname_ft',
                             'text_shipping_company_ft',
                             'text_shipping_address_1_ft',
                             'text_shipping_address_2_ft',
                             'text_shipping_city_ft',
                             'text_shipping_postcode_ft',
                             'text_shipping_country_ft',
                             'text_shipping_zone_ft',
                             'text_shipping_method_ft',

                             'entry_simple_fields_ft',
                             'simple_fields'  => $this->getSimpleFields(),

                             'entry_others_ft',
                             'text_trackcode_ft',
                             'text_trackcode_link_ft',
                             'text_trackcode_link2_ft',
                             
                             'type' => $type
                        ));

        $this->template = 'shoputils/shoputils_mail_order_status/shoputils_mail_order_status_list_helper.tpl';
        return $this->render();
    }

    protected function getProductsHelper() {
        $this->_setData(array(
                             'text_products_header',
                             'text_products_image',
                             'text_products_name',
                             'text_products_href',
                             'text_products_model',
                             'text_products_sku',
                             'text_products_upc',
                             'text_products_ean',
                             'text_products_jan',
                             'text_products_isbn',
                             'text_products_mpn',
                             'text_products_manufacturer',
                             'text_products_quantity',
                             'text_products_price',
                             'text_products_total',
                             'text_products_reward',
                             'text_products_footer',
                             'text_products_warning'
                        ));

        $this->template = 'shoputils/shoputils_mail_order_status/shoputils_mail_order_status_products_helper.tpl';
        return $this->render();
    }

    protected function getProductsFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/products.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getProductsHeaderFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/products_header.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getProductsFooterFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/products_footer.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getTotalsHelper() {
        $this->_setData(array(
                             'text_totals_title',
                             'text_totals_text'
                        ));

        $this->template = 'shoputils/shoputils_mail_order_status/shoputils_mail_order_status_totals_helper.tpl';
        return $this->render();
    }

    protected function getTotalsFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/totals.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getTotalsHeaderFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/totals_header.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getTotalsFooterFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/totals_footer.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getProductFirstFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/product_first.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getProductLastFT() {
        $this->template = 'shoputils/shoputils_mail_order_status/product_last.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getNewContentDefault() {
        $this->template = 'shoputils/shoputils_mail_order_status/new.tpl';
        return htmlentities($this->render(), ENT_QUOTES, 'UTF-8');
    }

    protected function getSimpleFields() {
        $this->load->model('localisation/shoputils_mail_order_status');
        if ($this->model_localisation_shoputils_mail_order_status->isSimpleExists()) {
            $this->load->model(self::SIMPLE_MODEL);
            $fields = array();

            //if Simple v4.x
            $simple_fields_info = $this->model_localisation_shoputils_mail_order_status->getSimpleData();

            foreach($simple_fields_info as $id => $value) {
                if (strpos($id, 'shipping_') === 0) {
                    $id = str_replace('shipping_', '', $id);
                    $fields['{simple_' . $id . '}'] = $this->{self::SIMPLE_OBJECT}->getFieldLabel($id);
                } elseif (strpos($id, 'payment_') === false) {
                    $fields['{simple_' . $id . '}'] = $this->{self::SIMPLE_OBJECT}->getFieldLabel($id);
                }
            }
            return $fields;
        } else {
            //if Simple v3.x
            $this->load->model('setting/setting');
            $simple_old_data = $this->model_setting_setting->getSetting('simple');
            if (empty($simple_old_data) || !isset($simple_old_data['simple_fields_custom'])) {
                //Simple not Installed
                return array();
            }

            foreach ($simple_old_data['simple_fields_custom'] as $old_data) {
                $fields['{simple_' . $old_data['id'] . '}'] = $old_data['label'][$this->config->get('config_language')];
            }
            return $fields;
        }
    }

    protected function validate() {
        if (!$this->model_shoputils_mail_order_status->validatePermission()) {
            $this->error['warning'] = $this->language->get('error_permission');
        } else {
        
            $order_stasuses = $this->model_localisation_order_status->getOrderStatuses();
            foreach ($this->model_localisation_language->getLanguages() as $language) {
              foreach ($order_stasuses as $order_status) {
                if (($this->request->post['shoputils_mail_order_status_status' . $order_status['order_status_id']]) && ((!isset($this->request->post['shoputils_mail_order_status_subject' . $order_status['order_status_id']][$language['language_id']]) || !trim($this->request->post['shoputils_mail_order_status_subject' . $order_status['order_status_id']][$language['language_id']])))) {
                    $this->error['warning'] = $this->error['error_subject' . $order_status['order_status_id']] = sprintf($this->language->get('error_form'),
                                                                                                            $this->language->get('entry_subject'),
                                                                                                            $order_status['name']);
                }
                if (($this->request->post['shoputils_mail_order_status_status' . $order_status['order_status_id']]) && ((!isset($this->request->post['shoputils_mail_order_status_content' . $order_status['order_status_id']][$language['language_id']]) || !trim($this->request->post['shoputils_mail_order_status_content' . $order_status['order_status_id']][$language['language_id']])))) {
                    $this->error['warning'] = $this->error['error_content' . $order_status['order_status_id']] = sprintf($this->language->get('error_form'),
                                                                                                            $this->language->get('entry_content'),
                                                                                                            $order_status['name']);
                }

                if (($this->request->post['shoputils_mail_order_status_admin_status' . $order_status['order_status_id']]) && ((!isset($this->request->post['shoputils_mail_order_status_admin_subject' . $order_status['order_status_id']][$language['language_id']]) || !trim($this->request->post['shoputils_mail_order_status_admin_subject' . $order_status['order_status_id']][$language['language_id']])))) {
                    $this->error['warning'] = $this->error['error_admin_subject' . $order_status['order_status_id']] = sprintf($this->language->get('error_form'),
                                                                                                            $this->language->get('entry_subject'),
                                                                                                            $order_status['name']);
                }

                if (($this->request->post['shoputils_mail_order_status_admin_status' . $order_status['order_status_id']]) && ((!isset($this->request->post['shoputils_mail_order_status_admin_content' . $order_status['order_status_id']][$language['language_id']]) || !trim($this->request->post['shoputils_mail_order_status_admin_content' . $order_status['order_status_id']][$language['language_id']])))) {
                    $this->error['warning'] = $this->error['error_admin_content' . $order_status['order_status_id']] = sprintf($this->language->get('error_form'),
                                                                                                            $this->language->get('entry_content'),
                                                                                                            $order_status['name']);
                }
              }
            }
        
        }
        return !$this->error;
    }

    function licShutdownHandler() {
        if (@is_array($e = @error_get_last())) {
            $code = isset($e['type']) ? $e['type'] : 0;
            $msg = isset($e['message']) ? $e['message'] : '';
            if(($code > 0) && strpos($msg, 'requires a license file')) {
                $this->session->data['warning'] = $this->language->get('error_key');
                $this->redirect($this->makeUrl('localisation/shoputils_mail_order_status/lic'));
            }
        }
    }

    protected function _setData($values) {
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->data[$value] = $this->language->get($value);
            } else {
                $this->data[$key] = $value;
            }
        }
    }

    protected function _updateData($keys, $info = array()) {
        foreach ($keys as $key) {
            if (isset($this->request->post[$key])) {
                $this->data[$key] = $this->request->post[$key];
            } elseif ($this->config->get($key)) {
                $this->data[$key] = $this->config->get($key);
            } elseif (isset($info[$key])) {
                $this->data[$key] = $info[$key];
            } else {
                $this->data[$key] = null;
            }
        }
    }

    protected function _updateDataStatuses($keys, $order_statuses) {
        foreach ($keys as $key) {
            $values = array();
            foreach ($order_statuses as $order_status) {
                if (isset($this->request->post[$key . $order_status['order_status_id']])) {
                    $values[$order_status['order_status_id']] = $this->request->post[$key . $order_status['order_status_id']];
                } else {
                    $values[$order_status['order_status_id']] = $this->config->get($key . $order_status['order_status_id']);
                }
            }
            $this->data[$key] = $values;
        }
    }

    protected function _setErrors($keys, $order_statuses) {
        foreach ($keys as $key) {
            $values = array();
            foreach ($order_statuses as $order_status) {
                $values[$order_status['order_status_id']] = isset($this->error[$key . $order_status['order_status_id']])
                                                                        ? $this->error[$key . $order_status['order_status_id']] : '';
            }
            $this->data[$key] = $values;
        }
    }

    protected function makeUrl($route, $url = '') {
        if (isset($this->session->data['token'])){
            return str_replace('&amp;', '&', $this->url->link($route, $url.'&token=' . $this->session->data['token'], 'SSL'));
        } else {
            return str_replace('&amp;', '&', $this->url->link($route, $url, 'SSL'));
        }
    }
}