<?php
	class ControllerModuleSimpleBlog extends Controller {
		protected function index($setting) {
			$this->language->load('module/simple_blog');
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			
			$this->data['articles'] = array();
			
			$this->document->addStyle('catalog/view/theme/default/stylesheet/blog-custom.css');
			
			if ($setting['category_id'] == 'all') {
		    	$this->data['heading_title'] = $this->language->get('text_latest_all');
				$this->data['article_link'] = $this->url->link('simple_blog/article');
			} elseif($setting['category_id'] == 'popular') {
				$this->data['heading_title'] = $this->language->get('text_popular_all');
				$this->data['article_link'] = $this->url->link('simple_blog/article');
			} else {
				$category_info = $this->model_simple_blog_article->getCategory($setting['category_id']);
				$this->data['heading_title'] = $category_info['name'];
				$this->data['article_link'] = $this->url->link('simple_blog/simple_category', 'simple_blog_category_id=' . $setting['category_id']);
			}
			
			if ($setting['category_id'] == 'all') {	
				$data = array(
					'start'           => 0,
					'limit'           => $setting['article_limit'] 
				);
				
				$results = $this->model_simple_blog_article->getArticleModuleWise($data);	
				
			} else if($setting['category_id'] == 'popular') { 
				$data = array(
					'start'           => 0,
					'limit'           => $setting['article_limit'] 
				);
				
				$results = $this->model_simple_blog_article->getPopularArticlesModuleWise($data);
				
			} else {	
				$data = array(
					'filter_category_id' => $setting['category_id'],
					'start'           => 0,
					'limit'           => $setting['article_limit']
				);
			
				$results = $this->model_simple_blog_article->getArticleModuleWise($data);	
			}

			foreach($results as $result) {
				
				$description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '...';
				
				if($result['featured_image']) {
					$image = $this->model_tool_image->resize($result['featured_image'], 100, 100);
				} else if($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], 100, 100);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				}
				
				// get total comments
				$total_comments = $this->model_simple_blog_article->getTotalComments($result['simple_blog_article_id']);
				
				if($total_comments != 1) {
					$total_comments .= $this->language->get('text_comments');
				} else {
					$total_comments .= $this->language->get('text_comment');
				}
				
				$this->data['articles'][] = array(
					'simple_blog_article_id'	=> $result['simple_blog_article_id'],
					'article_title'		=> $result['article_title'],
					'author_name'		=> $result['author_name'],
					'image'				=> $image,
					'featured_found'	=> '', // $featured_found
					'date_added'		=> date($this->language->get('text_date_format'), strtotime($result['date_modified'])),
					'description'		=> $description,
					'allow_comment'		=> $result['allow_comment'],
					'total_comment'		=> $total_comments,
					'href'				=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'], 'SSL'),
					'author_href'		=> $this->url->link('simple_blog/author', 'simple_blog_author_id=' . $result['simple_blog_author_id'], 'SSL'),
					'comment_href'		=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'] . '#comment-section', 'SSL')
				);
			}		
			
			$this->data['text_no_found'] = $this->language->get('text_no_result');
			
			if ($setting['position'] == 'column_left' || $setting['position'] == 'column_right') {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/simple_blog_side.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/module/simple_blog_side.tpl';
				} else {
					$this->template = 'default/template/module/simple_blog_side.tpl';
				}
			} else {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/simple_blog.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/module/simple_blog.tpl';
				} else {
					$this->template = 'default/template/module/simple_blog.tpl';
				}
			}
			
			$this->render();
		}
	}
?>