<?php
	class ControllerModuleSimpleBlogCategory extends Controller {
		public function index() {
			$this->language->load('module/simple_blog_category');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('setting/setting');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				
				$this->model_setting_setting->editSetting('simple_blog_category', $this->request->post);		
	
				$this->session->data['success'] = $this->language->get('text_success');
	
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			
			$this->data['text_enabled'] = $this->language->get('text_enabled');
			$this->data['text_disabled'] = $this->language->get('text_disabled');
			$this->data['text_yes'] = $this->language->get('text_yes');
			$this->data['text_no'] = $this->language->get('text_no');
			$this->data['text_content_top'] = $this->language->get('text_content_top');
			$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
			$this->data['text_column_left'] = $this->language->get('text_column_left');
			$this->data['text_column_right'] = $this->language->get('text_column_right');
			$this->data['text_category_related'] = $this->language->get('text_category_related');
			
			$this->data['entry_search_article'] = $this->language->get('entry_search_article');
			$this->data['entry_layout'] = $this->language->get('entry_layout');
			$this->data['entry_position'] = $this->language->get('entry_position');
			$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$this->data['entry_status'] = $this->language->get('entry_status');
			
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
				'href'      => $this->url->link('module/blog_category', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			);
			
			$this->data['action'] = $this->url->link('module/simple_blog_category', 'token=' . $this->session->data['token'], 'SSL');

			$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
			
			
			$this->data['simple_blog_search_article'] = '';
			
			if (isset($this->request->post['simple_blog_search_article'])) {
				$this->data['simple_blog_search_article'] = $this->request->post['simple_blog_search_article'];
			} elseif ($this->config->get('simple_blog_search_article')) { 
				$this->data['simple_blog_search_article'] = $this->config->get('simple_blog_search_article');
			}	
			
			$this->data['modules'] = array();
			
			if (isset($this->request->post['simple_blog_category_module'])) {
				$this->data['modules'] = $this->request->post['simple_blog_category_module'];
			} elseif ($this->config->get('simple_blog_category_module')) { 
				$this->data['modules'] = $this->config->get('simple_blog_category_module');
			}	
			
			$this->load->model('design/layout');

			$this->data['layouts'] = $this->model_design_layout->getLayouts();			
			
			$this->template = 'module/simple_blog_category.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
	
			$this->response->setOutput($this->render());			
		}

		protected function validate() {
			if (!$this->user->hasPermission('modify', 'module/simple_blog_category')) {
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