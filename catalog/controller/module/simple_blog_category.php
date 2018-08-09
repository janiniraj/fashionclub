<?php
	class ControllerModuleSimpleBlogCategory extends Controller {
		public function index($setting) {
			$this->language->load('module/simple_blog_category');
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			
			$this->data['text_search_article'] = $this->language->get('text_search_article');
			$this->data['button_search'] = $this->language->get('button_search');
			
			if (isset($this->request->get['simple_blog_category_id'])) {
				$parts = explode('_', (string)$this->request->get['simple_blog_category_id']);
			} else {
				$parts = array();
			}
			
			if (isset($parts[0])) {
				$this->data['category_id'] = $parts[0];
			} else {
				$this->data['category_id'] = 0;
			}
			
			if (isset($parts[1])) {
				$this->data['child_id'] = $parts[1];
			} else {
				$this->data['child_id'] = 0;
			}
			
			$this->load->model('simple_blog/article');
			
			$this->data['categories'] = array();
			
			$categories = $this->model_simple_blog_article->getCategories(0);
			
			foreach ($categories as $category) {
				
				$children_data = array();
	
				$children = $this->model_simple_blog_article->getCategories($category['simple_blog_category_id']);
				
				foreach ($children as $child) {
					
					$article_total = $this->model_simple_blog_article->getTotalArticles($child['simple_blog_category_id']);
			
					$children_data[] = array(
						'category_id' => $child['simple_blog_category_id'],
						'name'  => $child['name'],
						'href'  => $this->url->link('simple_blog/category', 'simple_blog_category_id=' . $category['simple_blog_category_id'] . '_' . $child['simple_blog_category_id'])
					);		
				}
	
				$this->data['categories'][] = array(
					'simple_blog_category_id' => $category['simple_blog_category_id'],
					'name'     => $category['name'],
					'children' => $children_data,
					'href'     => $this->url->link('simple_blog/category', 'simple_blog_category_id=' . $category['simple_blog_category_id'])
				);
			}
			
			//print "<pre>"; print_r($this->data['categories']); exit;
			if (isset($this->request->get['blog_search'])) {
				$this->data['blog_search'] = $this->request->get['blog_search'];
			} else {
				$this->data['blog_search'] = '';
			}
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/simple_blog_category.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/simple_blog_category.tpl';
			} else {
				$this->template = 'default/template/module/simple_blog_category.tpl';
			}
	
			$this->render();
			
		}
	}
?>