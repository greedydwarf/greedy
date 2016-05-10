<?php
class ControllerProductProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('product/product');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($_COOKIE['customer_id'])){
			$this->load->model('account/customer');
			$customer_id = $_COOKIE['customer_id'];
			$data['customer_info'] = $this->model_account_customer->getCustomer($customer_id);
		}
		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if (isset($_COOKIE['currency'])){

			$data['currency_value'] = $this->model_catalog_product->getCurrencyValue($_COOKIE['currency']);

		}

		

		if ($product_info) {
			$url = '';
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

			$data['heading_title'] = $product_info['name'];

			$data['text_select'] = $this->language->get('text_select');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_stock'] = $this->language->get('text_stock');
			$data['text_discount'] = $this->language->get('text_discount');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_option'] = $this->language->get('text_option');
			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_tags'] = $this->language->get('text_tags');
			$data['text_related'] = $this->language->get('text_related');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_qty'] = $this->language->get('entry_qty');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_review'] = $this->language->get('entry_review');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['entry_bad'] = $this->language->get('entry_bad');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['button_continue'] = $this->language->get('button_continue');

			$this->load->model('catalog/review');

			$data['tab_description'] = $this->language->get('tab_description');
			$data['tab_attribute'] = $this->language->get('tab_attribute');
			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}

			$this->load->model('tool/image');

			if ($product_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$data['popup'] = '';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$data['thumb'] = '';
			}


			$data['images'] = array();

			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

			foreach ($results as $result) {
				$data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$data['price'] = false;
			}

			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$data['special'] = false;
			}

			if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
				);
			}

			$data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false));
						} else {
							$price = false;
						}
						$special_data = explode("/", $option_value['name']);
						if (isset($special_data[1])){
							
								$product_option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $special_data[0],
								'jargon'                  => $special_data[1],
								'amount_unit'             => $special_data[2],
								'server_price'            => $special_data[3],
								'max_volume'              => $special_data[4],
								'game_currency'           => $special_data[5],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'quantity'                => $option_value['quantity'],
								'price_prefix'            => $option_value['price_prefix']
								);

						} else{
						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'quantity'                => $option_value['quantity'],
							'price_prefix'            => $option_value['price_prefix']
						);
						}
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}

			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

			$data['products'] = array();

			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . '#calculate' )
				);
			}

			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/product.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/product.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		$data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/review.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/review.tpl', $data));
		}
	}

	public function write() {
		$this->load->language('product/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$json['error'] = $this->language->get('error_rating');
			}

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function addOrderFromProduct() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		$order_data = array();
		
		if (isset($this->request->post['server_id'])) {
			$order_data['server_id'] = $this->request->post['server_id'];
		} else {
			$order_data['server_id'] = 0;
		}

		if (isset($this->request->post['total_volume'])) {
			$order_data['total_volume'] = $this->request->post['total_volume'];
		} else {
			$order_data['total_volume'] = 0;
		}
		
		if (isset($this->request->post['total_price'])) {
					 if (isset($this->request->post['currency']) && $this->request->post['currency'] === 'USD'){
					 $order_data['total_price_usd'] = $this->request->post['total_price'];
					 $order_data['total_price'] = 0; 
				        } else{
				     $order_data['total_price_usd'] = 0;
				     $order_data['total_price'] = $this->request->post['total_price'];     
				        }
		} else {
			$order_data['total_price'] = 0;
			$order_data['total_price_usd'] = 0;
		}
		
		if (isset($this->request->post['nick-name'])) {
			$order_data['nick-name'] = $this->request->post['nick-name'];
		} else {
			$order_data['nick-name'] = 0;
		}
		
		if (isset($this->request->post['emails'])) {
			$order_data['emails'] = $this->request->post['emails'];
		} else {
			$order_data['emails'] = 0;
		}
		
		if (isset($this->request->post['comments'])) {
			$order_data['comments'] = $this->request->post['comments'];
		} else {
			$order_data['comments'] = 0;
		}
		
		if (isset($this->request->post['phone'])) {
			$order_data['phone'] = $this->request->post['phone'];
		} else {
			$order_data['phone'] = 0;
		}

		if (isset($this->request->post['paymentType'])) {
			$order_data['paymentType'] = $this->request->post['paymentType'];
		} else {
			$order_data['paymentType'] = 'способ оплаты не был получен';
		}

		if (isset($this->request->post['product_id'])) {
			$order_data['product_id'] = $this->request->post['product_id'];
		} else {
			$order_data['product_id'] = 0;
		}
		if (isset($this->request->post['order_status_id'])) {
			$order_data['order_status_id'] = $this->request->post['order_status_id'];
		} else {
			$order_data['order_status_id'] = 1;
		}

		if (isset($this->request->post['deliveryType'])) {
			$order_data['deliveryType'] = $this->request->post['deliveryType'];
		} else {
			$order_data['deliveryType'] = 1;
		}

		if (isset($_COOKIE['customer_id'])){
			$order_data['customer_id'] = $_COOKIE['customer_id'];
		} else {
			$order_data['customer_id'] = 0;
		}
		
		$product_data = $this->model_catalog_product->getProduct($order_data['product_id']);
		
		$order_id = $this->model_catalog_product->addOrderToDB($order_data, $product_data);

		

		$json = array();

		setcookie('last_order_id', $order_id, time() + (60 * 60)); // 1 час
				    // Confirm success with the user

		$json['order_id'] = $order_id;

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function updateOrderPayWeb() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		$order_data = array();
		
		
		if (isset($this->request->post['LMI_PAYMENT_NO'])) {
			$order_data['LMI_PAYMENT_NO'] = $this->request->post['LMI_PAYMENT_NO'];
		} else {
			$order_data['LMI_PAYMENT_NO'] = 0;
		}
		echo $order_data['LMI_PAYMENT_NO'];


		if (isset($this->request->post['LMI_PAYEE_PURSE'])) {
			$order_data['LMI_PAYEE_PURSE'] = $this->request->post['LMI_PAYEE_PURSE'];
		} else {
			$order_data['LMI_PAYEE_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_MODE'])) {
			$order_data['LMI_MODE'] = $this->request->post['LMI_MODE'];
		} else {
			$order_data['LMI_MODE'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_INVS_NO'])) {
			$order_data['LMI_SYS_INVS_NO'] = $this->request->post['LMI_SYS_INVS_NO'];
		} else {
			$order_data['LMI_SYS_INVS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_NO'])) {
			$order_data['LMI_SYS_TRANS_NO'] = $this->request->post['LMI_SYS_TRANS_NO'];
		} else {
			$order_data['LMI_SYS_TRANS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_PURSE'])) {
			$order_data['LLMI_PAYER_PURSE'] = $this->request->post['LMI_PAYER_PURSE'];
		} else {
			$order_data['LMI_PAYER_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_WM'])) {
			$order_data['LMI_PAYER_WM'] = $this->request->post['LMI_PAYER_WM'];
		} else {
			$order_data['LMI_PAYER_WM'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_DATE'])) {
			$order_data['LMI_SYS_TRANS_DATE'] = $this->request->post['LMI_SYS_TRANS_DATE'];
		} else {
			$order_data['LMI_SYS_TRANS_DATE'] = 0;
		}

		
		if (isset($this->request->post['LMI_HASH'])) {
			$order_data['LMI_HASH'] = $this->request->post['LMI_HASH'];
		} else {
			$order_data['LMI_HASH'] = 1;
		}

		$order_data['order_status_id'] = 2;
		
		
		$this->model_catalog_product->updateOrderIfPayWM($order_data);
		
		setcookie('last_order_id', $order_id, time() + (60 * 60 * 24 * 30));

		$json = array();



		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function oplataWebmoney() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		$order_data = array();
		
		
		if (isset($this->request->post['LMI_PAYMENT_NO'])) {
			$order_data['LMI_PAYMENT_NO'] = $this->request->post['LMI_PAYMENT_NO'];
		} else {
			$order_data['LMI_PAYMENT_NO'] = 0;
		}

		
		

		
		if (isset($this->request->post['LMI_PAYEE_PURSE'])) {
			$order_data['LMI_PAYEE_PURSE'] = $this->request->post['LMI_PAYEE_PURSE'];
		} else {
			$order_data['LMI_PAYEE_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_MODE'])) {
			$order_data['LMI_MODE'] = $this->request->post['LMI_MODE'];
		} else {
			$order_data['LMI_MODE'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_INVS_NO'])) {
			$order_data['LMI_SYS_INVS_NO'] = $this->request->post['LMI_SYS_INVS_NO'];
		} else {
			$order_data['LMI_SYS_INVS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_NO'])) {
			$order_data['LMI_SYS_TRANS_NO'] = $this->request->post['LMI_SYS_TRANS_NO'];
		} else {
			$order_data['LMI_SYS_TRANS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_PURSE'])) {
			$order_data['LLMI_PAYER_PURSE'] = $this->request->post['LMI_PAYER_PURSE'];
		} else {
			$order_data['LMI_PAYER_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_WM'])) {
			$order_data['LMI_PAYER_WM'] = $this->request->post['LMI_PAYER_WM'];
		} else {
			$order_data['LMI_PAYER_WM'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_DATE'])) {
			$order_data['LMI_SYS_TRANS_DATE'] = $this->request->post['LMI_SYS_TRANS_DATE'];
		} else {
			$order_data['LMI_SYS_TRANS_DATE'] = 0;
		}

		
		if (isset($this->request->post['LMI_HASH'])) {
			$order_data['LMI_HASH'] = $this->request->post['LMI_HASH'];
		} else {
			$order_data['LMI_HASH'] = 1;
		}

		if ($_COOKIE['language'] === 'en'){
			
			echo '<p>Order number:  ' . $order_data['LMI_PAYMENT_NO'] . '</p>';
			echo '<p>Payment number:  ' . $order_data['LMI_SYS_TRANS_NO'] . '</p>';
			echo '<p>Thank you for your order! Expect delivery.</p><br>';
		} else {
			echo '<p>Номер вашего заказа:  ' . $order_data['LMI_PAYMENT_NO'] . '</p>';
			echo '<p>Номер платежа в системе:  ' . $order_data['LMI_SYS_TRANS_NO'] . '</p>';
			echo '<p>Спасибо за заказ!Ожидайте доставки.</p>';
		}
		$order_data['order_status_id'] = 2;
		
		


		$json = array();



	
	
	}
	public function paymetErrorWebmoney() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		$order_data = array();
		
		
		if (isset($this->request->post['LMI_PAYMENT_NO'])) {
			$order_data['LMI_PAYMENT_NO'] = $this->request->post['LMI_PAYMENT_NO'];
		} else {
			$order_data['LMI_PAYMENT_NO'] = 0;
		}

		
		

		
		if (isset($this->request->post['LMI_PAYEE_PURSE'])) {
			$order_data['LMI_PAYEE_PURSE'] = $this->request->post['LMI_PAYEE_PURSE'];
		} else {
			$order_data['LMI_PAYEE_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_MODE'])) {
			$order_data['LMI_MODE'] = $this->request->post['LMI_MODE'];
		} else {
			$order_data['LMI_MODE'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_INVS_NO'])) {
			$order_data['LMI_SYS_INVS_NO'] = $this->request->post['LMI_SYS_INVS_NO'];
		} else {
			$order_data['LMI_SYS_INVS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_NO'])) {
			$order_data['LMI_SYS_TRANS_NO'] = $this->request->post['LMI_SYS_TRANS_NO'];
		} else {
			$order_data['LMI_SYS_TRANS_NO'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_PURSE'])) {
			$order_data['LLMI_PAYER_PURSE'] = $this->request->post['LMI_PAYER_PURSE'];
		} else {
			$order_data['LMI_PAYER_PURSE'] = 0;
		}
		if (isset($this->request->post['LMI_PAYER_WM'])) {
			$order_data['LMI_PAYER_WM'] = $this->request->post['LMI_PAYER_WM'];
		} else {
			$order_data['LMI_PAYER_WM'] = 0;
		}
		if (isset($this->request->post['LMI_SYS_TRANS_DATE'])) {
			$order_data['LMI_SYS_TRANS_DATE'] = $this->request->post['LMI_SYS_TRANS_DATE'];
		} else {
			$order_data['LMI_SYS_TRANS_DATE'] = 0;
		}

		
		if (isset($this->request->post['LMI_HASH'])) {
			$order_data['LMI_HASH'] = $this->request->post['LMI_HASH'];
		} else {
			$order_data['LMI_HASH'] = 1;
		}

		if ($_COOKIE['language'] === 'en'){
			
			echo '<p>Order number:  ' . $order_data['LMI_PAYMENT_NO'] . '</p>';
			echo '<p>Payment number:  ' . $order_data['LMI_SYS_TRANS_NO'] . '</p>';
			echo '<p>Payment error!</p><br>';
		} else {
			echo '<p>Номер вашего заказа:  ' . $order_data['LMI_PAYMENT_NO'] . '</p>';
			echo '<p>Номер платежа в системе:  ' . $order_data['LMI_SYS_TRANS_NO'] . '</p>';
			echo '<p>Ошибка при оплате!</p>';
		}
		$order_data['order_status_id'] = 2;
		
		


		$json = array();

	}
	public function updateOrderFromProduct() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');
			//Проверка оплаты заказа
			$confirm_pay = array();

			if ($this->request->get['method'] == 'pay'){	
			$confirm_pay['order_status_id'] = 2;
			}

			if ($this->request->get['method'] == 'error'){	
			$confirm_pay['order_status_id'] = 7;
			}

			if ($this->request->get['method'] == 'check'){	
			$confirm_pay['order_status_id'] = 1;
			}
				if (isset($this->request->get['account'])) {
					$confirm_pay['order_id'] = $this->request->get['account'];
				} else {
					$confirm_pay['order_id'] = 'Платеж не мобильным';
				}
				
				if (isset($this->request->get['operator'])) {
					$confirm_pay['operator'] = $this->request->get['operator'];
				} else {
					$confirm_pay['operator'] = 'Платеж не мобильным';
				}

				if (isset($this->request->get['paymentType'])) {
					$confirm_pay['paymentType'] = $this->request->get['paymentType'];
				} else {
					$confirm_pay['paymentType'] = 'не определен';
				}

				if (isset($this->request->get['projectId'])) {
					$confirm_pay['projectId'] = $this->request->get['projectId'];
				} else {
					$confirm_pay['projectId'] = 'не определен';
				}

				if (isset($this->request->get['phone'])) {
					$confirm_pay['phone'] = $this->request->get['phone'];
				} else {
					$confirm_pay['phone'] = 'не определен';
				}

				if (isset($this->request->get['sum'])) {
					$confirm_pay['sum'] = $this->request->get['sum'];
				} else {
					$confirm_pay['sum'] = 'не определен';
				}

				if (isset($this->request->get['sign'])) {
					$confirm_pay['sign'] = $this->request->get['sign'];
				} else {
					$confirm_pay['sign'] = 'не определен';
				}

				if (isset($this->request->get['orderSum'])) {
					$confirm_pay['orderSum'] = $this->request->get['orderSum'];
				} else {
					$confirm_pay['orderSum'] = 'не определен';
				}

				if (isset($this->request->get['orderCurrency'])) {
					$confirm_pay['orderCurrency'] = $this->request->get['orderCurrency'];
				} else {
					$confirm_pay['orderCurrency'] = 'не определен';
				}

				if (isset($this->request->get['unitpayId'])) {
					$confirm_pay['unitpayId'] = $this->request->get['unitpayId'];
				} else {
					$confirm_pay['unitpayId'] = 'не определен';
				}

				if (isset($this->request->get['errorMessage'])) {
					$confirm_pay['errorMessage'] = $this->request->get['errorMessage'];
				}

			$this->model_catalog_product->updateOrderIfPay($confirm_pay);

		$json = array();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>
