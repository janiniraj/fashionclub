<?php
	class ControllerModuleSimpleBlog extends Controller {
		public function index() {
			$this->language->load('module/simple_blog');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('setting/setting');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				
				$this->model_setting_setting->editSetting('simple_blog', $this->request->post);		
	
				$this->session->data['success'] = $this->language->get('text_success');
	
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			$this->data['entry_simple_blog_heading'] = $this->language->get('simple_blog_heading');
			$this->data['entry_blog_module_heading'] = $this->language->get('blog_module_heading');
			$this->data['entry_product_related_heading'] = $this->language->get('product_related_heading');
			$this->data['entry_comment_related_heading'] = $this->language->get('comment_related_heading');

			$this->data['text_enabled'] = $this->language->get('text_enabled');
			$this->data['text_disabled'] = $this->language->get('text_disabled');
			$this->data['text_yes'] = $this->language->get('text_yes');
			$this->data['text_no'] = $this->language->get('text_no');
			$this->data['text_set_header'] = $this->language->get('text_set_header');
			$this->data['text_set_footer'] = $this->language->get('text_set_footer');
			$this->data['text_browse'] = $this->language->get('text_browse');
			$this->data['text_clear'] = $this->language->get('text_clear');			
			$this->data['text_image_manager'] = $this->language->get('text_image_manager');
			$this->data['text_content_top'] = $this->language->get('text_content_top');
			$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
			$this->data['text_column_left'] = $this->language->get('text_column_left');
			$this->data['text_column_right'] = $this->language->get('text_column_right');
			$this->data['text_category_label'] = $this->language->get('text_category_label');
			$this->data['text_latest_article'] = $this->language->get('text_latest_article');
			$this->data['text_popular_article'] = $this->language->get('text_popular_article');
			$this->data['text_article_related'] = $this->language->get('text_article_related');
			
			$this->data['entry_status'] = $this->language->get('entry_status');
			$this->data['entry_custom_theme'] = $this->language->get('entry_custom_theme');
			$this->data['entry_set_tagline'] = $this->language->get('entry_set_tagline');
			$this->data['entry_image'] = $this->language->get('entry_image');
			$this->data['entry_display_category'] = $this->language->get('entry_display_category');
			$this->data['entry_comment_approval'] = $this->language->get('entry_comment_approval');
			$this->data['entry_author_information'] = $this->language->get('entry_author_information');			
			$this->data['entry_article_limit'] = $this->language->get('entry_article_limit');
			$this->data['entry_category'] = $this->language->get('entry_category');
			$this->data['entry_layout'] = $this->language->get('entry_layout');
			$this->data['entry_position'] = $this->language->get('entry_position');
			$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$this->data['entry_show_social_site_option'] = $this->language->get('entry_show_social_site_option');
			$this->data['entry_related_article'] = $this->language->get('entry_related_article');
			$this->data['entry_show_author'] = $this->language->get('entry_show_author');
			
			$this->data['button_save'] = $this->language->get('button_save');
			$this->data['button_cancel'] = $this->language->get('button_cancel');
			$this->data['button_add_module'] = $this->language->get('button_add_module');
			$this->data['button_remove'] = $this->language->get('button_remove');
			
			$this->data['token'] = $this->session->data['token'];
			
			if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
			
			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_module'),
				'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			);
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('module/simple_blog', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			);
			
			$this->data['action'] = $this->url->link('module/simple_blog', 'token=' . $this->session->data['token'], 'SSL');

			$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
			
			$this->load->model('tool/image');
			
			$this->data['simple_blog_status'] = '';
			$this->data['simple_blog_custom_theme'] = '';
			$this->data['blog_tagline'] = '';
			$this->data['blog_image'] = '';
			$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			$this->data['blog_display_category'] = '';
			$this->data['blog_footer_heading'] = '';
			$this->data['simple_blog_heading'] = '';
			$this->data['product_related_heading'] = '';
			$this->data['comment_related_heading'] = '';
			$this->data['blog_comment_auto_approval'] = '';
			$this->data['blog_author_information'] = '';
			$this->data['blog_share_social_site'] = '';
			$this->data['blog_related_articles'] = '';
			$this->data['blog_show_authors'] = '';
			
			if (isset($this->request->post['simple_blog_status'])) {
				$this->data['simple_blog_status'] = $this->request->post['simple_blog_status'];
			} else if ($this->config->get('simple_blog_status')) {
				$this->data['simple_blog_status'] = $this->config->get('simple_blog_status');
			}
			
			if (isset($this->request->post['simple_blog_custom_theme'])) {
				$this->data['simple_blog_custom_theme'] = $this->request->post['simple_blog_custom_theme'];
			} else if ($this->config->get('simple_blog_custom_theme')) {
				$this->data['simple_blog_custom_theme'] = $this->config->get('simple_blog_custom_theme');
			}
			
			if (isset($this->request->post['blog_tagline'])) {
				$this->data['blog_tagline'] = $this->request->post['blog_tagline'];
			} else if ($this->config->get('blog_tagline')) {
				$this->data['blog_tagline'] = $this->config->get('blog_tagline');
			}
			
			if (isset($this->request->post['blog_image'])) {
				$this->data['blog_image'] = $this->request->post['blog_image'];
			} else {
				$this->data['blog_image'] = $this->config->get('blog_image');			
			}
	
			if ($this->config->get('blog_image') && file_exists(DIR_IMAGE . $this->config->get('blog_image')) && is_file(DIR_IMAGE . $this->config->get('blog_image'))) {
				$this->data['thumb'] = $this->model_tool_image->resize($this->config->get('blog_image'), 100, 100);		
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
			
			if (isset($this->request->post['blog_display_category'])) {
				$this->data['blog_display_category'] = $this->request->post['blog_display_category'];
			} else if ($this->config->get('blog_display_category')) {
				$this->data['blog_display_category'] = $this->config->get('blog_display_category');
			}
			
			if (isset($this->request->post['blog_footer_heading'])) {
				$this->data['blog_footer_heading'] = $this->request->post['blog_footer_heading'];
			} else if ($this->config->get('blog_footer_heading')) {
				$this->data['blog_footer_heading'] = $this->config->get('blog_footer_heading');
			}
			
			if (isset($this->request->post['simple_blog_heading'])) {
				$this->data['simple_blog_heading'] = $this->request->post['simple_blog_heading'];
			} else if ($this->config->get('simple_blog_heading')) {
				$this->data['simple_blog_heading'] = $this->config->get('simple_blog_heading');
			}
			
			if (isset($this->request->post['product_related_heading'])) {
				$this->data['product_related_heading'] = $this->request->post['product_related_heading'];
			} else if ($this->config->get('product_related_heading')) {
				$this->data['product_related_heading'] = $this->config->get('product_related_heading');
			}
			
			if (isset($this->request->post['comment_related_heading'])) {
				$this->data['comment_related_heading'] = $this->request->post['comment_related_heading'];
			} else if ($this->config->get('comment_related_heading')) {
				$this->data['comment_related_heading'] = $this->config->get('comment_related_heading');
			}
			
			if (isset($this->request->post['blog_comment_auto_approval'])) {
				$this->data['blog_comment_auto_approval'] = $this->request->post['blog_comment_auto_approval'];
			} else if ($this->config->get('blog_comment_auto_approval')) {
				$this->data['blog_comment_auto_approval'] = $this->config->get('blog_comment_auto_approval');
			}

			if (isset($this->request->post['blog_author_information'])) {
				$this->data['blog_author_information'] = $this->request->post['blog_author_information'];
			} else if ($this->config->get('blog_author_information')) {
				$this->data['blog_author_information'] = $this->config->get('blog_author_information');
			}

			if (isset($this->request->post['blog_share_social_site'])) {
				$this->data['blog_share_social_site'] = $this->request->post['blog_share_social_site'];
			} else if ($this->config->get('blog_share_social_site')) {
				$this->data['blog_share_social_site'] = $this->config->get('blog_share_social_site');
			}

			if (isset($this->request->post['blog_related_articles'])) {
				$this->data['blog_related_articles'] = $this->request->post['blog_related_articles'];
			} else if ($this->config->get('blog_related_articles')) {
				$this->data['blog_related_articles'] = $this->config->get('blog_related_articles');
			}
			
			if (isset($this->request->post['blog_show_authors'])) {
				$this->data['blog_show_authors'] = $this->request->post['blog_show_authors'];
			} else if ($this->config->get('blog_show_authors')) {
				$this->data['blog_show_authors'] = $this->config->get('blog_show_authors');
			}
			
			$this->load->model('simple_blog/category');
			
			$this->data['categories'] = $this->model_simple_blog_category->getCategories(0);
			
			$this->data['modules'] = array();
			
			if (isset($this->request->post['simple_blog_module'])) {
				$this->data['modules'] = $this->request->post['simple_blog_module'];
			} elseif ($this->config->get('simple_blog_module')) { 
				$this->data['modules'] = $this->config->get('simple_blog_module');
			}	
			
			$this->load->model('design/layout');

			$this->data['layouts'] = $this->model_design_layout->getLayouts();			
			
			$this->template = 'module/simple_blog.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
	
			$this->response->setOutput($this->render());		
		}

		protected function validate() {
			if (!$this->user->hasPermission('modify', 'module/simple_blog')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
	
			if (!$this->error) {
				return true;
			} else {
				return false;
			}	
		}
	}
?>