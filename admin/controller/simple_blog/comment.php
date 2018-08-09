<?php
    class ControllerSimpleBlogComment extends Controller {
    	private $error = array();
		
    	public function index() {
			$this->language->load('simple_blog/comment');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/comment');
	
			$this->getList();		
		}
		
		public function insert() {
			$this->language->load('simple_blog/comment');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/comment');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_comment->addArticleComment($this->request->post);
				
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
				
				$this->redirect($this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));				
			}
			
			$this->getForm();
		}
		
		public function update() {
			$this->language->load('simple_blog/comment');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/comment');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
				//print "<pre>"; print_r($this->request->post); exit;
				$this->model_simple_blog_comment->editArticleComment($this->request->get['simple_blog_comment_id'], $this->request->post);
				
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

				$this->redirect($this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
	
		public function delete() {
			$this->language->load('simple_blog/comment');

			$this->document->setTitle($this->language->get('heading_title'));
	
			$this->load->model('simple_blog/comment');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				foreach ($this->request->post['selected'] as $blog_comment_id) {
					$this->model_simple_blog_comment->deleteArticleComment($blog_comment_id);
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
				
				$this->redirect($this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
				$sort = 'bc.date_added';
			}
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'DESC';
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
				'href'      => $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL'),
	      		'separator' => ' :: '
	   		);
			
			$this->data['insert'] = $this->url->link('simple_blog/comment/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$this->data['delete'] = $this->url->link('simple_blog/comment/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$this->data['comments'] = array();
			
			$data = array(
				'sort'  => $sort,
				'order' => $order,
				'simple_blog_article_reply_id'	=> 0,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
			);
			
			$comment_total = $this->model_simple_blog_comment->getTotalArticleComment($data);
			
			$results = $this->model_simple_blog_comment->getArticleComments($data);
			
			foreach($results as $result) {
				$action = array();

				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('simple_blog/comment/update', 'token=' . $this->session->data['token'] . '&simple_blog_comment_id=' . $result['simple_blog_comment_id'] . $url, 'SSL')
				);	
				
				$this->data['comments'][] = array(
					'simple_blog_comment_id'	=> $result['simple_blog_comment_id'],
					'simple_blog_article_id' 	=> $result['simple_blog_article_id'],
					'article_title'		=> $result['article_title'],
					'author_name'       => $result['author'],					
					'status'      		=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'date_added'		=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'selected'        	=> isset($this->request->post['selected']) && in_array($result['simple_blog_comment_id'], $this->request->post['selected']),
					'action'          	=> $action
				);		
			}
			
			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_no_results'] = $this->language->get('text_no_results');
			
			$this->data['column_article_title'] = $this->language->get('column_article_title');
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
	
			$this->data['sort_article_title'] = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . '&sort=sbad.article_title' . $url, 'SSL');
			$this->data['sort_author_name'] = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . '&sort=sbc.name' . $url, 'SSL');
			$this->data['sort_status'] = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . '&sort=sbc.status' . $url, 'SSL');
			$this->data['sort_date_added'] = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . '&sort=sbc.date_added' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			$pagination = new Pagination();
			$pagination->total = $comment_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_admin_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
			$this->data['pagination'] = $pagination->render();
			
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
	
			$this->template = 'simple_blog/comment_list.tpl';
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
			
			$this->data['entry_author'] = $this->language->get('entry_author');
			$this->data['entry_article'] = $this->language->get('entry_article');
			$this->data['entry_status'] = $this->language->get('entry_status');
			$this->data['entry_comment'] = $this->language->get('entry_comment');
			$this->data['entry_reply_comment'] = $this->language->get('entry_reply_comment');
			
			$this->data['button_save'] = $this->language->get('button_save');
			$this->data['button_cancel'] = $this->language->get('button_cancel');
			$this->data['button_add_reply'] = $this->language->get('button_add_reply');
			$this->data['button_remove'] = $this->language->get('button_remove');
			
			$this->data['token'] = $this->session->data['token'];
			
			$this->data['tab_general'] = $this->language->get('tab_general');
			$this->data['tab_comment'] = $this->language->get('tab_comment');
			
			if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
	
	 		if (isset($this->error['article_title'])) {
				$this->data['error_article_title'] = $this->error['article_title'];
			} else {
				$this->data['error_article_title'] = '';
			}
			
			if (isset($this->error['author'])) {
				$this->data['error_author'] = $this->error['author'];
			} else {
				$this->data['error_author'] = '';
			}
			
		 	if (isset($this->error['comment'])) {
				$this->data['error_comment'] = $this->error['comment'];
			} else {
				$this->data['error_comment'] = '';
			}
			
			if (isset($this->error['reply_author'])) {
				$this->data['error_reply_author'] = $this->error['reply_author'];
			} else {
				$this->data['error_reply_author'] = array();
			}
			
			if (isset($this->error['reply_comment'])) {
				$this->data['error_reply_comment'] = $this->error['reply_comment'];
			} else {
				$this->data['error_reply_comment'] = array();
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
				'href'      => $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL'),
	      		'separator' => ' :: '
	   		);
			
			if (!isset($this->request->get['simple_blog_comment_id'])) {
				$this->data['action'] = $this->url->link('simple_blog/comment/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$this->data['action'] = $this->url->link('simple_blog/comment/update', 'token=' . $this->session->data['token'] . '&simple_blog_comment_id=' . $this->request->get['simple_blog_comment_id'] . $url, 'SSL');
			}
			
			$this->data['cancel'] = $this->url->link('simple_blog/comment', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
			if ((isset($this->request->get['simple_blog_comment_id'])) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$comment_info = $this->model_simple_blog_comment->getArticleComment($this->request->get['simple_blog_comment_id']);
			}
			
			if (isset($this->request->post['article_title'])) {
				$this->data['article_title'] = $this->request->post['article_title'];
			} elseif (isset($comment_info)) {
				$this->data['article_title'] = $comment_info['article_title'];
			} else {
				$this->data['article_title'] = '';
			}
			
			if (isset($this->request->post['author_name'])) {
				$this->data['author_name'] = $this->request->post['author_name'];
			} elseif (isset($comment_info)) {
				$this->data['author_name'] = $comment_info['author'];
			} else {
				$this->data['author_name'] = '';
			}
			
			if (isset($this->request->post['status'])) {
				$this->data['status'] = $this->request->post['status'];
			} elseif (isset($comment_info)) {
				$this->data['status'] = $comment_info['status'];
			} else {
				$this->data['status'] = 1;
			}
			
			if (isset($this->request->post['comment'])) {
				$this->data['comment'] = $this->request->post['comment'];
			} elseif (isset($comment_info)) {
				$this->data['comment'] = $comment_info['comment'];
			} else {
				$this->data['comment'] = '';
			}
			
			if (isset($this->request->post['comment_reply'])) {
				$this->data['comment_reply'] = $this->request->post['comment_reply'];
			} elseif (isset($this->request->get['simple_blog_comment_id'])) {
				$this->data['comment_reply'] = $this->model_simple_blog_comment->getCommentReply($this->request->get['simple_blog_comment_id']);
					
			} else {
				$this->data['comment_reply'] = array();
			}
			
			$this->template = 'simple_blog/comment_form.tpl';
		
			$this->children = array(
				'common/header',	
				'common/footer'	
			);
			
	 		$this->response->setOutput($this->render());			
		}

		public function validateForm() {
			
			if (!$this->user->hasPermission('modify', 'simple_blog/comment')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if(utf8_strlen($this->request->post['author_name']) < 3 || utf8_strlen($this->request->post['author_name']) > 64) {
				$this->error['author'] = $this->language->get('error_author');
			}

			if($this->request->post['article_title'] == '') {
				$this->error['article_title'] = $this->language->get('error_article_title');
			} else {
				$found = $this->model_simple_blog_comment->checkArticleTitle($this->request->post['article_title']);
				
				if(!$found) {
					$this->error['article_title'] = $this->language->get('error_article_title_not_found');
				}				
			}
			
			if(utf8_strlen($this->request->post['comment']) < 3 || utf8_strlen($this->request->post['comment']) > 1000) {
				$this->error['comment'] = $this->language->get('error_comment');
			}
			
			if(isset($this->request->post['comment_reply'])) {
				foreach($this->request->post['comment_reply'] as $key => $value) {
					if(utf8_strlen($value['author']) < 3 || utf8_strlen($value['author']) > 64) {
						$this->error['reply_author'][$key] = $this->language->get('error_author');
					}
					
					if(utf8_strlen($value['comment']) < 3 || utf8_strlen($value['comment']) > 1000) {
						$this->error['reply_comment'][$key] = $this->language->get('error_comment');
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

		private function validateDelete() {
			if (!$this->user->hasPermission('modify', 'simple_blog/comment')) {
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