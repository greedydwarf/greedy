<?php
class ControllerModuleBlogComment extends Controller {
	
	private $error = array();
	private $limit = 10;	

	public function index($settings) {

		$this->load->language('module/blog_comment');

		$this->load->helper('blog');
		$this->load->library('simple_html_dom');

		$this->load->model('blog/post');
		$this->load->model('blog/comment');
		$this->load->model('tool/image');

		// Module settings
		foreach ($settings as $key => $setting) {
			$data[$key] = $setting;
		}
		
		// Form Field Label
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_comment'] = $this->language->get('entry_comment');

		$data['title_commentlist'] = $settings['title_list'] ? $settings['title_list'] : $this->language->get('title_commentlist');
		$data['title_commentbox'] = $settings['title_comment'] ? $settings['title_comment'] : $this->language->get('title_commentbox');

		$data['button_submit'] = $this->language->get('button_submit');
		$data['button_reset'] = $this->language->get('button_reset');

		$data['not_found'] = $this->language->get('not_found');

		$pid = isset($this->request->get['pid']) ? $this->request->get['pid'] : '';

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$limit = $settings['limit'] ? (int)$settings['limit'] : $this->limit;

		$comments = $this->model_blog_comment->comments(array("bc.comment_post_ID"=>"='".$pid."'", "bc.comment_approve"=>"='publish'"), "bc.comment_ID DESC", ($page - 1) * $limit, $limit);
		$totla_comment = $this->model_blog_comment->total_comment(array("comment_post_ID" => "='".$pid."'"));

		$data['comments'] = array();

		if($comments) {

			$author_photo_size = explode('x', $settings['author_photo_size']);
			$photo_width  = isset($author_photo_size[0]) ? $author_photo_size[0] : 50;
			$photo_height  = isset($author_photo_size[1]) ? $author_photo_size[1] : 70;

			foreach ($comments as $comment) {

				$image = author($comment['comment_author_id'],'image');
				if ($image && is_file(DIR_IMAGE . $image)) {
					$author_image = $this->model_tool_image->resize($image, $photo_width, $photo_height);
				} else {
					$author_image = $this->model_tool_image->resize('no_image.png', $photo_width, $photo_height);
				}

				$data['comments'][] = array(
					'comment_id' => $comment['comment_ID'],
					'comment_author' => $comment['comment_author'],
					'author_email' => $comment['author_email'],
					'author_image' => $author_image,
					'comment_date' => $comment['comment_date'],
					'comment_content' => $comment['comment_content'],
				);
			}
		}
		
		$post_info = $this->model_blog_post->getPost(array("ID"=>"='".$pid."'"));

		$data['comment_status'] = '';
		if(isset($post_info['comment_status'])) {
			$data['comment_status'] = $post_info['comment_status'];
		}
		
		// Pagination
		$pagination = new Pagination();
		$pagination->total = $totla_comment;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('blog/single&pid='.$pid,'&page={page}#blog-comment');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($totla_comment) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($totla_comment - $limit)) ? $totla_comment : ((($page - 1) * $limit) + $limit), $totla_comment, ceil($totla_comment / $limit));

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/blog_comment.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/blog_comment.tpl', $data);
		} else {
			return $this->load->view('default/template/module/blog_comment.tpl', $this->data);
		}
	}

	public function submit() {

		if(!isset($this->request->get['pid'])) {
			$this->response->redirect($this->url->link('blog/home'));
		}

		$pid = $this->request->get['pid'] ? $this->request->get['pid'] : '';

		$this->load->language('module/blog_comment');
		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->helper('blog');
		$this->load->model('blog/setting');
		$blog_setting = $this->model_blog_setting->settings();
		$config = setting($blog_setting);

		$this->registry->set('form_validation', new Form_validation($this->registry));

		$json = array();
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			if(!getId()) {
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			}

			$this->form_validation->set_rules('comment', 'Comment', 'trim|strip_tags|required|min_length[10]');
			if ($this->form_validation->run() == FALSE)
			{

				$data['form_error']['name'] 	= $this->form_validation->error('name','<span>','</span>');
				$data['form_error']['email'] 	= $this->form_validation->error('email','<span>','</span>');
				$data['form_error']['comment'] 	= $this->form_validation->error('comment', '<span>', '</span>');

				foreach ($data['form_error'] as $key => $value) {
				if (empty($data['form_error'][$key])) {
						unset($data['form_error'][$key]);
					}
				}
				if($this->request->post['ajax']) {
					$json['form_error'] = $data['form_error'];
				} else {
					$this->session->data['form_error'] = $data['form_error'];
				}
			} else {
				$this->load->model('module/blog_comment');
				$this->model_module_blog_comment->addComment($pid, $this->request->post,$config);
				if($this->request->post['ajax']) {
					$json['success'] = "Your Comment is successfully submitted It may or may not need to admin moderation";
				} else {
					$this->session->data['form_msg']['msg1'] = "Your Comment is successfully submitted It may or may not need to admin moderation";
				}
				$this->model_module_blog_comment->increaseComment($pid);	
			}	

			if($this->request->post['ajax']) {
				$this->response->addHeader('Content-Type: application/json');
				$this->response->setOutput(json_encode($json));
			} else {
				$this->response->redirect($this->url->link('blog/single&pid='.$this->request->get['pid'].'#commentAlert'));
			}
		} // $_POST
	}
}