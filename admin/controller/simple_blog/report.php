<?php
    class ControllerSimpleBlogReport extends Controller {
    	
		private $error = array();
		
    	public function index() {
    		$this->language->load('simple_blog/report');

			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('simple_blog/report');
			
			if (isset($this->request->get['filter_date_start'])) {
				$filter_date_start = $this->request->get['filter_date_start'];
			} else {
				$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
			}
	
			if (isset($this->request->get['filter_date_end'])) {
				$filter_date_end = $this->request->get['filter_date_end'];
			} else {
				$filter_date_end = date('Y-m-d');
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'bv.view';
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
				'href'      => $this->url->link('simple_blog/report', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
			);
			
			$data = array(
				'filter_date_start' => $filter_date_start,
				'filter_date_end' => $filter_date_end,
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
			);
			
			$blog_viewed_total = $this->model_simple_blog_report->getTotalBlogViewed($data); 
			
			// following query gives the total views of whole blog
			$blog_views_total = $this->model_simple_blog_report->getTotalBlogViews($data); 
			
			$this->data['blog_views'] = array();

			$results = $this->model_simple_blog_report->getBlogViewed($data);
			
			//print "<pre>"; print_r($results); exit;
			
			foreach ($results as $result) {
				if ($result['view']) {
					$percent = round($result['view'] / $blog_views_total * 100, 2);
				} else {
					$percent = 0;
				}
	
				$this->data['blog_views'][] = array(
					'article_title'	=> $result['article_title'],
					'author_name'   => $result['author_name'],
					'viewed'  		=> $result['view'],
					'percent' 		=> $percent . '%'			
				);
			}
			
			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_no_results'] = $this->language->get('text_no_results');
	
			$this->data['column_article_name'] = $this->language->get('column_article_name');
			$this->data['column_author_name'] = $this->language->get('column_author_name');
			$this->data['column_viewed'] = $this->language->get('column_viewed');
			$this->data['column_percent'] = $this->language->get('column_percent');
			
			$this->data['entry_date_start'] = $this->language->get('entry_date_start');
			$this->data['entry_date_end'] = $this->language->get('entry_date_end');
			
			$this->data['button_filter'] = $this->language->get('button_filter');
			$this->data['button_reset'] = $this->language->get('button_reset');
			
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
	
			$this->data['sort_article_title'] = $this->url->link('simple_blog/report', 'token=' . $this->session->data['token'] . '&sort=sbad.article_title' . $url, 'SSL');
			$this->data['sort_author_name'] = $this->url->link('simple_blog/report', 'token=' . $this->session->data['token'] . '&sort=sbau.name' . $url, 'SSL');
			$this->data['sort_view'] = $this->url->link('simple_blog/report', 'token=' . $this->session->data['token'] . '&sort=sbv.view' . $url, 'SSL');			
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$pagination = new Pagination();
			$pagination->total = $blog_viewed_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_admin_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/report', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');
	
			$this->data['pagination'] = $pagination->render();
			
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;	
			$this->data['filter_date_start'] = $filter_date_start;
			$this->data['filter_date_end'] = $filter_date_end;			
	
			$this->template = 'simple_blog/report.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
	
			$this->response->setOutput($this->render());
    	}
    }
?>