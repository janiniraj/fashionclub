<?php
	class ControllerSimpleBlogAuthor extends Controller {		
		private $error = array();
				
		public function index() {
			$this->language->load('simple_blog/author');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/author');
	
			$this->getList();	
		}
		
		public function insert() {
			$this->language->load('simple_blog/author');
	
			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/author');
	
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_author->addAuthor($this->request->post);
	
				$this->session->data['success'] = $this->language->get('text_success');
	
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
	
				$this->redirect($this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
	
			$this->getForm();
		}
		
		public function update() {
			$this->language->load('simple_blog/author');
	
			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/author');
	
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_author->editAuthor($this->request->get['simple_blog_author_id'], $this->request->post);
	
				$this->session->data['success'] = $this->language->get('text_success');
	
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
	
				$this->redirect($this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
	
			$this->getForm();
		}
		
		public function delete() {
			$this->language->load('simple_blog/author');
	
			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/author');
	
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $simple_blog_author_id) {
					$this->model_simple_blog_author->deleteAuthor($simple_blog_author_id);
				}
	
				$this->session->data['success'] = $this->language->get('text_success');
	
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
	
				$this->redirect($this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
	
			$this->getList();
		}
		
		public function getList() {
			
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'sba.name';
			}
	
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
	
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
	
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
	
			$this->data['breadcrumbs'] = array();
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
			);
			
			$this->data['insert'] = $this->url->link('simple_blog/author/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$this->data['delete'] = $this->url->link('simple_blog/author/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
			$this->data['authors'] = array();
	
			$data = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
			);
			
			$author_total = $this->model_simple_blog_author->getTotalAuthors($data);
			
			$results = $this->model_simple_blog_author->getAuthors($data);
			
			foreach($results as $result) {
				$action = array();

				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('simple_blog/author/update', 'token=' . $this->session->data['token'] . '&simple_blog_author_id=' . $result['simple_blog_author_id'] . $url, 'SSL')
				);	
				
				$this->data['authors'][] = array(
					'simple_blog_author_id' 	=> $result['simple_blog_author_id'],
					'name'            	=> $result['name'],
					'status'      		=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'date_added'		=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'selected'        	=> isset($this->request->post['selected']) && in_array($result['simple_blog_author_id'], $this->request->post['selected']),
					'action'          	=> $action
				);				
			}		
			
			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_no_results'] = $this->language->get('text_no_results');
	
			$this->data['column_author_name'] = $this->language->get('column_author_name');
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
	
			$this->data['sort_name'] = $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . '&sort=sba.name' . $url, 'SSL');
			$this->data['sort_status'] = $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . '&sort=sba.status' . $url, 'SSL');
			$this->data['sort_date_added'] = $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . '&sort=sba.date_added' . $url, 'SSL');
	
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			$pagination = new Pagination();
			$pagination->total = $author_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_admin_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
			$this->data['pagination'] = $pagination->render();
			
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
	
			$this->template = 'simple_blog/author_list.tpl';
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
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_keyword'] = $this->language->get('entry_keyword');
			$this->data['entry_image'] = $this->language->get('entry_image');
			$this->data['entry_adminid'] = $this->language->get('entry_adminid');
			$this->data['entry_ctitle'] = $this->language->get('entry_ctitle');
			$this->data['entry_description'] = $this->language->get('entry_description');
			$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
			$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
			$this->data['entry_status'] = $this->language->get('entry_status');
	
			$this->data['button_save'] = $this->language->get('button_save');
			$this->data['button_cancel'] = $this->language->get('button_cancel');
			
			$this->data['token'] = $this->session->data['token'];
			
			if (isset($this->request->get['simple_blog_author_id'])) {
				$this->data['simple_blog_author_id'] = $this->request->get['simple_blog_author_id'];
			} else {
				$this->data['simple_blog_author_id'] = 0;
			}
			
			if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
			
			if (isset($this->error['name'])) {
				$this->data['error_name'] = $this->error['name'];
			} else {
				$this->data['error_name'] = '';
			}
			
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
			
			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
			);
			
			if (!isset($this->request->get['simple_blog_author_id'])) {
				$this->data['action'] = $this->url->link('simple_blog/author/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$this->data['action'] = $this->url->link('simple_blog/author/update', 'token=' . $this->session->data['token'] . '&simple_blog_author_id=' . $this->request->get['simple_blog_author_id'] . $url, 'SSL');
			}
			
			$this->data['cancel'] = $this->url->link('simple_blog/author', 'token=' . $this->session->data['token'] . $url, 'SSL');

			if (isset($this->request->get['simple_blog_author_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$author_info = $this->model_simple_blog_author->getAuthor($this->request->get['simple_blog_author_id']);
			}
			
			$this->load->model('localisation/language');
		
			$this->data['languages'] = $this->model_localisation_language->getLanguages();
			
			if (isset($this->request->post['author_description'])) {
				$this->data['author_description'] = $this->request->post['author_description'];
			} elseif (isset($this->request->get['simple_blog_author_id'])) {
				$this->data['author_description'] = $this->model_simple_blog_author->getAuthorDescriptions($this->request->get['simple_blog_author_id']);
			} else {
				$this->data['author_description'] = array();
			}

			if (isset($this->request->post['name'])) {
				$this->data['name'] = $this->request->post['name'];
			} elseif (!empty($author_info)) {
				$this->data['name'] = $author_info['name'];
			} else {	
				$this->data['name'] = '';
			}
			
			if (isset($this->request->post['keyword'])) {
				$this->data['keyword'] = $this->request->post['keyword'];
			} elseif (!empty($author_info)) {
				$this->data['keyword'] = $author_info['keyword'];
			} else {
				$this->data['keyword'] = '';
			}
	
			if (isset($this->request->post['image'])) {
				$this->data['image'] = $this->request->post['image'];
			} elseif (!empty($author_info)) {
				$this->data['image'] = $author_info['image'];
			} else {
				$this->data['image'] = '';
			}
			
			$this->load->model('tool/image');

			if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
				$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
			} elseif (!empty($author_info) && $author_info['image'] && file_exists(DIR_IMAGE . $author_info['image'])) {
				$this->data['thumb'] = $this->model_tool_image->resize($author_info['image'], 100, 100);
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
	
			$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			
			if (isset($this->request->post['status'])) {
				$this->data['status'] = $this->request->post['status'];
			} elseif (!empty($author_info)) {
				$this->data['status'] = $author_info['status'];
			} else {
				$this->data['status'] = 0;
			}
			
			$this->template = 'simple_blog/author_form.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
	
			$this->response->setOutput($this->render());			
		}

		protected function validateForm() {
			if (!$this->user->hasPermission('modify', 'simple_blog/author')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
	
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 255)) {
				$this->error['name'] = $this->language->get('error_name');
			} else {
				// check here whether duplicate name occur or not?
				if(!isset($this->request->get['simple_blog_author_id'])) {
					$found = $this->model_simple_blog_author->checkAuthorName($this->request->post['name'], 0);
					
					if($found) {
						$this->error['warning'] = $this->language->get('error_author_found');
						$this->error['name'] = $this->language->get('error_author_found');
					}
				} else {
					$found = $this->model_simple_blog_author->checkAuthorName($this->request->post['name'], $this->request->get['simple_blog_author_id']);
					
					if($found) {
						$this->error['warning'] = $this->language->get('error_author_found');
						$this->error['name'] = $this->language->get('error_author_found');
					}
				}
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
		
		protected function validateDelete() {
			if (!$this->user->hasPermission('modify', 'simple_blog/author')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
	
			$this->load->model('simple_blog/author');
	
			foreach ($this->request->post['selected'] as $blog_author_id) {
				$article_total = $this->model_simple_blog_author->getTotalArticleByAuthorId($blog_author_id);
	
				if ($article_total) {
					$this->error['warning'] = sprintf($this->language->get('error_article'), $article_total);
				}	
			}
	
			if (!$this->error) {
				return true;
			} else {
				return false;
			}  
		}
		
		public function autocomplete() {
			$json = array();
			
			if (isset($this->request->get['author_name'])) {
				if (isset($this->request->get['author_name'])) {
					$author_name = $this->request->get['author_name'];
				} else {
					$author_name = '';
				}
	
				$this->load->model('simple_blog/author');
				$data = array('filter_author' => $author_name);
				$results = $this->model_simple_blog_author->getAuthors($data);
				
				foreach ($results as $result) {
										
					$json[] = array(
						'simple_blog_author_id' 	=> $result['simple_blog_author_id'],
						'name'       		=> strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))	
					);	
				}						
			}
	
			$this->response->setOutput(json_encode($json));
		}
		
	}
?>