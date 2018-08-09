<?php
	class ControllerSimpleBlogArticle extends Controller {
		private $error = array();
		
		public function index() {
			$this->language->load('simple_blog/article');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/article');
	
			$this->getList();		
		}
		
		public function insert() {
			$this->language->load('simple_blog/article');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/article');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_article->addArticle($this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				$this->redirect($this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL'));				
			}
			
			$this->getForm();
		}
	
		public function update() {
			$this->language->load('simple_blog/article');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/article');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_article->editArticle($this->request->get['simple_blog_article_id'], $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				$this->redirect($this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
	
		public function delete() {
			$this->language->load('simple_blog/article');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/article');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				foreach ($this->request->post['selected'] as $simple_blog_article_id) {
					$this->model_simple_blog_article->deleteArticle($simple_blog_article_id);
				}
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				$this->redirect($this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getList();
		}
		
		public function getList() {
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'ba.date_added';
			}
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}	
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['breadcrumbs'] = array();

	   		$this->data['breadcrumbs'][] = array(
	       		'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	      		'separator' => false
	   		);
	
	   		$this->data['breadcrumbs'][] = array(
	       		'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL'),
	      		'separator' => ' :: '
	   		);
			
			$this->data['insert'] = $this->url->link('simple_blog/article/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$this->data['delete'] = $this->url->link('simple_blog/article/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$this->data['articles'] = array();
			
			$data = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
			);
			
			$article_limit = $this->model_simple_blog_article->getTotalArticle($data);
			
			$results = $this->model_simple_blog_article->getArticles($data);
			
			foreach($results as $result) {
				$action = array();

				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('simple_blog/article/update', 'token=' . $this->session->data['token'] . '&simple_blog_article_id=' . $result['simple_blog_article_id'] . $url, 'SSL')
				);	
				
				$this->data['articles'][] = array(
					'simple_blog_article_id' 	=> $result['simple_blog_article_id'],
					'article_title'		=> $result['article_title'],
					'author_name'       => $result['author_name'],
					'sort_order'		=> $result['sort_order'],
					'status'      		=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'date_added'		=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'selected'        	=> isset($this->request->post['selected']) && in_array($result['simple_blog_article_id'], $this->request->post['selected']),
					'action'          	=> $action
				);		
			}
			
			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_no_results'] = $this->language->get('text_no_results');
			
			$this->data['column_article_title'] = $this->language->get('column_article_title');
			$this->data['column_author_name'] = $this->language->get('column_author_name');
			$this->data['column_sort_order'] = $this->language->get('column_sort_order');
			$this->data['column_status'] = $this->language->get('column_status');
			$this->data['column_date_added'] = $this->language->get('column_date_added');
			$this->data['column_action'] = $this->language->get('column_action');	
	
			$this->data['button_insert'] = $this->language->get('button_insert');
			$this->data['button_delete'] = $this->language->get('button_delete');
			
			$this->data['token'] = $this->session->data['token'];
			
			if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
	
			if (isset($this->session->data['success'])) {
				$this->data['success'] = $this->session->data['success'];
	
				unset($this->session->data['success']);
			} else {
				$this->data['success'] = '';
			}
			
			$url = '';

			if ($order == 'ASC') {
				$url .= '&order=DESC';
			} else {
				$url .= '&order=ASC';
			}
	
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
	
			$this->data['sort_article_title'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . '&sort=sbad.article_title' . $url, 'SSL');
			$this->data['sort_author_name'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . '&sort=sbau.name' . $url, 'SSL');
			$this->data['sort_sortorder'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . '&sort=sba.sort_order' . $url, 'SSL');
			$this->data['sort_status'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . '&sort=sba.status' . $url, 'SSL');
			$this->data['sort_date_added'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . '&sort=sba.date_added' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			$pagination = new Pagination();
			$pagination->total = $article_limit;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_admin_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
			$this->data['pagination'] = $pagination->render();
			
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
	
			$this->template = 'simple_blog/article_list.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
	
			$this->response->setOutput($this->render());			
		}		

		public function getForm() {
			$this->data['heading_title'] = $this->language->get('heading_title');
			
	    	$this->data['text_enabled'] = $this->language->get('text_enabled');
	    	$this->data['text_disabled'] = $this->language->get('text_disabled');
			$this->data['text_image_manager'] = $this->language->get('text_image_manager');
			$this->data['text_browse'] = $this->language->get('text_browse');
			$this->data['text_clear'] = $this->language->get('text_clear');	
			$this->data['text_yes'] = $this->language->get('text_yes');
			$this->data['text_no'] = $this->language->get('text_no');	
			$this->data['text_default'] = $this->language->get('text_default');	
			$this->data['text_select_all'] = $this->language->get('text_select_all');
			$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
			
			
			$this->data['button_save'] = $this->language->get('button_save');
			$this->data['button_cancel'] = $this->language->get('button_cancel');
			$this->data['button_add_description'] = $this->language->get('button_add_description');
			$this->data['button_add_articles'] = $this->language->get('button_add_articles');
			$this->data['button_remove'] = $this->language->get('button_remove');
			
			$this->data['entry_title'] = $this->language->get('entry_title');
			$this->data['entry_description'] = $this->language->get('entry_description');
			$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
			$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
			$this->data['entry_allow_comment'] = $this->language->get('entry_allow_comment');
			$this->data['entry_keyword'] = $this->language->get('entry_keyword');
			$this->data['entry_author_name'] = $this->language->get('entry_author_name');
			$this->data['entry_image'] = $this->language->get('entry_image');
			$this->data['entry_featured_image'] = $this->language->get('entry_featured_image');
			$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$this->data['entry_status'] = $this->language->get('entry_status');
			$this->data['entry_category'] = $this->language->get('entry_category');
			$this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
			$this->data['entry_product'] = $this->language->get('entry_product');
			$this->data['entry_productwise'] = $this->language->get('entry_productwise');
			$this->data['entry_store'] = $this->language->get('entry_store');
			$this->data['entry_layout'] = $this->language->get('entry_layout');
			$this->data['entry_additional_description'] = $this->language->get('entry_additional_description');
			$this->data['entry_article_related_method'] = $this->language->get('entry_article_related_method');
			$this->data['entry_category_wise'] = $this->language->get('entry_category_wise');
			$this->data['entry_manufacturer_wise'] = $this->language->get('entry_manufacturer_wise');
			$this->data['entry_product_wise'] = $this->language->get('entry_product_wise');
			$this->data['entry_blog_related_articles'] = $this->language->get('entry_blog_related_articles');
			$this->data['entry_related_article_name'] = $this->language->get('entry_related_article_name');
			
			$this->data['tab_general'] = $this->language->get('tab_general');
			$this->data['tab_option'] = $this->language->get('tab_option');
			$this->data['tab_data'] = $this->language->get('tab_data');
			$this->data['tab_related'] = $this->language->get('tab_related');
			$this->data['tab_design'] = $this->language->get('tab_design');
			
			$this->data['token'] = $this->session->data['token'];
			
			if (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['simple_blog_article_id'] = $this->request->get['simple_blog_article_id'];
			} else {
				$this->data['simple_blog_article_id'] = 0;
			}
			
			if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
	
	 		if (isset($this->error['article_title'])) {
				$this->data['error_article_title'] = $this->error['article_title'];
			} else {
				$this->data['error_article_title'] = array();
			}
			
		 	if (isset($this->error['description'])) {
				$this->data['error_description'] = $this->error['description'];
			} else {
				$this->data['error_description'] = array();
			}
			
			if (isset($this->error['author_name'])) {
				$this->data['error_author_name'] = $this->error['author_name'];
			} else {
				$this->data['error_author_name'] = '';
			}
			
			if (isset($this->error['seo_keyword'])) {
				$this->data['error_seo_keyword'] = $this->error['seo_keyword'];
			} else {
				$this->data['error_seo_keyword'] = '';
			}
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['breadcrumbs'] = array();

	   		$this->data['breadcrumbs'][] = array(
	       		'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	      		'separator' => false
	   		);
	
	   		$this->data['breadcrumbs'][] = array(
	       		'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL'),
	      		'separator' => ' :: '
	   		);
			
			if (!isset($this->request->get['simple_blog_article_id'])) {
				$this->data['action'] = $this->url->link('simple_blog/article/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$this->data['action'] = $this->url->link('simple_blog/article/update', 'token=' . $this->session->data['token'] . '&simple_blog_article_id=' . $this->request->get['simple_blog_article_id'] . $url, 'SSL');
			}

			$this->data['cancel'] = $this->url->link('simple_blog/article', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
			if ((isset($this->request->get['simple_blog_article_id'])) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$article_info = $this->model_simple_blog_article->getArticle($this->request->get['simple_blog_article_id']);
			}
			
			$this->load->model('simple_blog/author');
			$this->data['authors'] = array();
			$this->data['authors'] = $this->model_simple_blog_author->getAuthors();

			$this->load->model('localisation/language');		
			$this->data['languages'] = $this->model_localisation_language->getLanguages();
			
			if (isset($this->request->post['article_description'])) {
				$this->data['article_description'] = $this->request->post['article_description'];
			} elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['article_description'] = $this->model_simple_blog_article->getArticleDescriptions($this->request->get['simple_blog_article_id']);
			} else {
				$this->data['article_description'] = array();
			}
			
			if (isset($this->request->post['article_addition_description'])) {
				$this->data['article_addition_description'] = $this->request->post['article_addition_description'];
			} elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['article_addition_description'] = $this->model_simple_blog_article->getArticleAdditionalDescriptions($this->request->get['simple_blog_article_id']);
			} else {
				$this->data['article_addition_description'] = array();
			}
			
			//print "<pre>"; print_r($this->data['article_addition_description']); exit;
			
			if (isset($this->request->post['keyword'])) {
				$this->data['keyword'] = $this->request->post['keyword'];
			} elseif (isset($article_info)) {
				$this->data['keyword'] = $article_info['keyword'];
			} else {
				$this->data['keyword'] = '';
			}

			if (isset($this->request->post['allow_comment'])) {
				$this->data['allow_comment'] = $this->request->post['allow_comment'];
			} elseif (isset($article_info)) {
				$this->data['allow_comment'] = $article_info['allow_comment'];
			} else {
				$this->data['allow_comment'] = 0;
			}
			
			if (isset($this->request->post['simple_blog_author_id'])) {
				$this->data['author_name'] = $this->request->post['author_name'];
				$this->data['simple_blog_author_id'] = $this->request->post['simple_blog_author_id'];
			} elseif (isset($article_info)) {
				$this->data['simple_blog_author_id'] = $article_info['simple_blog_author_id'];
				$this->data['author_name'] = $this->model_simple_blog_author->getAuthorName($article_info['simple_blog_author_id']);
			} else {
				$this->data['author_name'] = '';
				$this->data['simple_blog_author_id'] = '';
			}
			
			if (isset($this->request->post['sort_order'])) {
	      		$this->data['sort_order'] = $this->request->post['sort_order'];
	    	} elseif (isset($article_info)) {
	      		$this->data['sort_order'] = $article_info['sort_order'];
	    	} else {
				$this->data['sort_order'] = '';
			}
			
			if (isset($this->request->post['image'])) {
				$this->data['image'] = $this->request->post['image'];
			} elseif (!empty($article_info)) {
				$this->data['image'] = $article_info['image'];
			} else {
				$this->data['image'] = '';
			}
			
			if (isset($this->request->post['featured_image'])) {
				$this->data['featured_image'] = $this->request->post['featured_image'];
			} elseif (!empty($article_info)) {
				$this->data['featured_image'] = $article_info['featured_image'];
			} else {
				$this->data['featured_image'] = '';
			}
			
			$this->load->model('tool/image');
			
			$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			
			if (!empty($article_info) && $article_info['image'] && file_exists(DIR_IMAGE . $article_info['image'])) {
				$this->data['thumb'] = $this->model_tool_image->resize($article_info['image'], 100, 100);
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
			
			if (!empty($article_info) && $article_info['featured_image'] && file_exists(DIR_IMAGE . $article_info['featured_image'])) {
				$this->data['thumb2'] = $this->model_tool_image->resize($article_info['featured_image'], 100, 100);
			} else {
				$this->data['thumb2'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
			
			$this->load->model('setting/store');
		
			$this->data['stores'] = $this->model_setting_store->getStores();
			
			if (isset($this->request->post['article_store'])) {
				$this->data['article_store'] = $this->request->post['article_store'];
			} elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['article_store'] = $this->model_simple_blog_article->getArticleStore($this->request->get['simple_blog_article_id']);
			} else {
				$this->data['article_store'] = array(0);
			}	
			
			$this->data['categories'] = array();
			
			$this->load->model('simple_blog/category');
					
			$this->data['categories'] = $this->model_simple_blog_category->getCategories(0);
			
			if (isset($this->request->post['article_category'])) {
				$this->data['article_category'] = $this->request->post['article_category'];
			} elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['article_category'] = $this->model_simple_blog_article->getArticleCategories($this->request->get['simple_blog_article_id']);
			} else {
				$this->data['article_category'] = array();
			}
			
			// skip here for the related product & related article portion, complete after.
			
			$this->load->model('catalog/category');
			$this->data['default_categories'] = $this->model_catalog_category->getCategories(0);
			
			$this->load->model('catalog/manufacturer');
			$this->data['default_manufacturers'] = $this->model_catalog_manufacturer->getManufacturers(0);
			
			$this->load->model('catalog/product');
						
			if (isset($this->request->post['related_article'])) {
				$this->data['related_article'] = $this->request->post['related_article'];
				
				if(isset($this->request->post['category_wise'])) {
					$this->data['category_ids'] = $this->request->post['category_wise'];
				} else if(isset($this->request->post['manufacturer_wise'])) {
					$this->data['manufacturer_ids'] = $this->request->post['manufacturer_wise'];
				} else {
					if(isset($this->request->post['product_wise'])) {
						$this->data['products'] = array();
						
						foreach($this->request->post['product_wise'] as $product_id) {
							$product_info = $this->model_catalog_product->getProduct($product_id);
							
							$this->data['products'][] = array(
								'product_id' => $product_info['product_id'],
								'name'		=> $product_info['name']
							);								
						}									
					}
				}					
			} elseif (isset($article_info)) {
				if($article_info['article_related_method']) {
					$this->data['related_article'] = $article_info['article_related_method'];
					//echo $this->data['related_article']; exit;
					$options = unserialize($article_info['article_related_option']);
					
					if($this->data['related_article'] == 'category_wise' && $options) {
						foreach($options['category_wise'] as $option) {
							$this->data['category_ids'][] = $option;
						}
					} else if($this->data['related_article'] == 'manufacturer_wise' && $options) {
						foreach($options['manufacturer_wise'] as $option) {
							$this->data['manufacturer_ids'][] = $option;
						}						
					} else {
						$products = $this->model_simple_blog_article->getArticleProduct($this->request->get['simple_blog_article_id']);
						
						foreach($products as $product) {
							$product_info = $this->model_catalog_product->getProduct($product['product_id']);
							
							$this->data['products'][] = array(
								'product_id' => $product_info['product_id'],
								'name'		=> $product_info['name']
							);
						}				
					}					
				} else {
					$this->data['related_article'] = 'product_wise';
				}				
			} else {
				$this->data['related_article'] = 'product_wise';
			}
			
			if (isset($this->request->post['blog_related_articles'])) {
				$this->data['blog_related_articles'] = $this->request->post['blog_related_articles'];
			}  elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['blog_related_articles'] = $this->model_simple_blog_article->getRelatedArticles($this->request->get['simple_blog_article_id']);
			} else {
	      		$this->data['blog_related_articles'] = array();
	    	}
			
			if (isset($this->request->post['status'])) {
				$this->data['status'] = $this->request->post['status'];
			}  elseif (isset($article_info)) {
				$this->data['status'] = $article_info['status'];
			} else {
	      		$this->data['status'] = 0;
	    	}
			
			if (isset($this->request->post['article_layout'])) {
				$this->data['article_layout'] = $this->request->post['article_layout'];
			} elseif (isset($this->request->get['simple_blog_article_id'])) {
				$this->data['article_layout'] = $this->model_simple_blog_article->getArticleLayouts($this->request->get['simple_blog_article_id']);
			} else {
				$this->data['article_layout'] = array();
			}
			
			$this->load->model('design/layout');		
			$this->data['layouts'] = $this->model_design_layout->getLayouts();
			
			$this->template = 'simple_blog/article_form.tpl';
		
			$this->children = array(
				'common/header',	
				'common/footer'	
			);
			
	 		$this->response->setOutput($this->render());			
		}
		
		public function autocomplete() {
			$json = array();
			
			if (isset($this->request->get['article_name'])) {
				
				if (isset($this->request->get['article_name'])) {
					$article_name = $this->request->get['article_name'];
				} else {
					$article_name = '';
				}
				
				$this->load->model('simple_blog/article');
				$data = array('filter_article' => $article_name);
				$results = $this->model_simple_blog_article->getArticles($data);
				
				foreach ($results as $result) {
										
					$json[] = array(
						'simple_blog_article_id' 	=> $result['simple_blog_article_id'],
						'name'       		=> strip_tags(html_entity_decode($result['article_title'], ENT_QUOTES, 'UTF-8'))	
					);	
				}						
			}
	
			$this->response->setOutput(json_encode($json));
		}
		
		private function validateForm() {
			if (!$this->user->hasPermission('modify', 'simple_blog/article')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			foreach ($this->request->post['article_description'] as $language_id => $value) {
				if ((strlen($value['article_title']) < 3) || (strlen($value['article_title']) > 100)) {
					$this->error['article_title'][$language_id] = $this->language->get('error_title');
				} else {
					if(!isset($this->request->get['simple_blog_article_id'])) {
						$found = $this->model_simple_blog_article->checkArticleName($language_id, $value['article_title'], 0);
						
						if($found) {
							$this->error['warning'] = $this->language->get('error_title_found');
							$this->error['article_title'][$language_id] = $this->language->get('error_title_found');	
						}						
					} else {
						$found = $this->model_simple_blog_article->checkArticleName($language_id, $value['article_title'], $this->request->get['simple_blog_article_id']);
						if($found) {
							$this->error['warning'] = $this->language->get('error_title_found');	
							$this->error['article_title'][$language_id] = $this->language->get('error_title_found');
						}	
					}
				}
				
				if (strlen($value['description']) < 3) {
					$this->error['description'][$language_id] = $this->language->get('error_description');
				}
			}
			
			if(!$this->request->post['author_name']) {
				$this->error['author_name'] = $this->language->get('error_author_name');
			} else {
				if($this->request->post['simple_blog_author_id']) {
					$found = $this->model_simple_blog_article->checkAuthorName($this->request->post['author_name']);
				
					if(!$found) {
						$this->error['author_name'] = $this->language->get('error_author_not_found_list');
						$this->error['warning'] = $this->language->get('error_author_not_found');
					}
				} else {
					$this->error['author_name'] = $this->language->get('error_author_not_found_list');
					$this->error['warning'] = $this->language->get('error_author_not_found');
				}				
			}
			
			if ((utf8_strlen($this->request->post['keyword']) < 3) || (utf8_strlen($this->request->post['keyword']) > 64)) {
				$this->error['seo_keyword'] = $this->language->get('error_seo_not_found');
			}
			
			if($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
			
			if (!$this->error) {
				return true;
			} else {
				return false;
			}
		}
		
		private function validateDelete() {
			if (!$this->user->hasPermission('modify', 'simple_blog/article')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			foreach ($this->request->post['selected'] as $simple_blog_article_id) {
				$found = $this->model_simple_blog_article->checkDeleteArticle($simple_blog_article_id);
				
				if($found) {
					$this->error['warning'] = sprintf($this->language->get('error_article_related'), $found);
					break;
				}
			}
			
			if (!$this->error) {
				return true;
			} else {
				return false;
			}
		}	

		public function autocomplete_article() {
			$json = array();
			
			if(isset($this->request->get['simple_blog_article_id'])) {
				
				$this->load->model('simple_blog/article');
				
				if(isset($this->request->get['filter_name'])) {
					$filter_name = $this->request->get['filter_name'];
				} else {
					$filter_name = '';
				}
				
				$data = array(
					'filter_name'	=> $filter_name
				);
				
				$results = $this->model_simple_blog_article->getArticlesRelated($data, $this->request->get['simple_blog_article_id']);
				
				foreach ($results as $result) {				
					$json[] = array(
						'simple_blog_article_id' 	=> $result['simple_blog_article_id'],
						'article_title' 	=> strip_tags(html_entity_decode($result['article_title'], ENT_QUOTES, 'UTF-8'))
					);	
				}				
			}
			
			$this->response->setOutput(json_encode($json));
		}
	
	}
?>