<?php
	class ControllerSimpleBlogArticle extends Controller {
		public function index() {
			$this->language->load('simple_blog/article');
			
			if($this->config->get('simple_blog_heading')) {
				$this->document->setTitle($this->config->get('simple_blog_heading'));
			} else {
				$this->document->setTitle($this->language->get('heading_title'));
			}
			
			$this->load->model('simple_blog/article');
			
			$this->load->model('tool/image');
			
			//$this->document->addStyle('catalog/view/theme/default/stylesheet/blog_custom.css');
			$this->document->addStyle('catalog/view/theme/fashion_club/stylesheet/blog_custom.css');
			
			if($this->config->get('simple_blog_heading')) {
				$this->data['heading_title'] = $this->config->get('simple_blog_heading');
			} else {
				$this->data['heading_title'] = $this->language->get('heading_title');
			}
			
			$this->data['articles'] = array();
			
			if (isset($this->request->get['blog_search'])) {
				$blog_search = $this->request->get['blog_search'];
			} else { 
				$blog_search = '';
			}	
			
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else { 
				$page = 1;
			}		
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = $this->config->get('config_catalog_limit');
				//$limit = 2;
			}
			
			$data = array(
				'blog_search'	=> $blog_search,
				'start'	=> ($page - 1) * $limit,
				'limit'	=> $limit
			);
			
			$blog_total = $this->model_simple_blog_article->getTotalArticle($data);
			
			$results = $this->model_simple_blog_article->getArticles($data);
			
			//print "<pre>"; print_r($results); exit;
			
			foreach($results as $result) {
				
				$description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '...';
				
				if($result['featured_image']) {
					$image = HTTP_SERVER . 'image/' . $result['featured_image'];
					$featured_found = 1;
					//$image = $this->model_tool_image->resize($result['featured_image'], 873, 585);
				} else if($result['image']) {
					$image = HTTP_SERVER . 'image/' . $result['image'];
					$featured_found = '';
					//$image = $this->model_tool_image->resize($result['image'], 873, 585);
				} else {
					$image = '';
					$featured_found = '';
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
					'featured_found'	=> $featured_found,
					'date_added'		=> date($this->language->get('text_date_format'), strtotime($result['date_modified'])),
					'description'		=> $description,
					'allow_comment'		=> $result['allow_comment'],
					'total_comment'		=> $total_comments,
					'href'				=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'], 'SSL'),
					'author_href'		=> $this->url->link('simple_blog/author', 'simple_blog_author_id=' . $result['simple_blog_author_id'], 'SSL'),
					'comment_href'		=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'], 'SSL')
				);
			}			
			
			//print "<pre>"; print_r($this->data['articles']); exit;
			
			$this->data['button_continue_reading'] = $this->language->get('button_continue_reading');
			$this->data['text_no_found'] = $this->language->get('text_no_found');
			
			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home'),
				'separator' => false
			);
	
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('simple_blog/article'),       		
				'separator' => ' :: '
			);
			
			$pagination = new Pagination();
			$pagination->total = $blog_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/article', '&page={page}');

			$this->data['pagination'] = $pagination->render();
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/simple_blog/article.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/simple_blog/article.tpl';
			} else {
				$this->template = 'default/template/simple_blog/article.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				//'simple_blog/blog_header',
				//'simple_blog/blog_footer',
				'common/footer',
				'common/header'
			);

			$this->response->setOutput($this->render());	
		}

		public function view() {
			$this->language->load('simple_blog/article');
			
			//$this->document->setTitle($this->language->get('heading_title'));
			if($this->config->get('simple_blog_heading')) {
				$this->document->setTitle($this->config->get('simple_blog_heading'));
			} else {
				$this->document->setTitle($this->language->get('heading_title'));
			}
			
			$this->load->model('simple_blog/article');
			
			$this->load->model('tool/image');
			
			$this->load->model('catalog/product');
			
			//$this->document->addStyle('catalog/view/theme/default/stylesheet/blog_custom.css');
			$this->document->addStyle('catalog/view/theme/fashion_club/stylesheet/blog_custom.css');
			
			if(isset($this->request->get['simple_blog_article_id'])) {
				$simple_blog_article_id = $this->request->get['simple_blog_article_id'];
			} else {
				$simple_blog_article_id = 0;
			}
			
			if($simple_blog_article_id) {
				
				$this->data['simple_blog_article_id'] = $simple_blog_article_id;
				
				if($this->config->get('product_related_heading')) {
					$this->data['text_related_product'] = $this->config->get('product_related_heading');
				} else {
					$this->data['text_related_product'] = $this->language->get('text_related_product');
				}
				
				//$this->data['button_cart'] = $this->language->get('button_cart');
				
				if($this->config->get('comment_related_heading')) {
					$this->data['text_related_comment'] = $this->config->get('comment_related_heading');
				} else {
					$this->data['text_related_comment'] = $this->language->get('text_related_comment');
				}
				
				$this->data['text_author_information'] = $this->language->get('text_author_information');
				
				$this->data['text_write_comment'] = $this->language->get('text_write_comment');
				
				$this->data['text_note'] = $this->language->get('text_note');
				$this->data['text_wait'] = $this->language->get('text_wait');
				
				$this->data['entry_name'] = $this->language->get('entry_name');
				$this->data['entry_captcha'] = $this->language->get('entry_captcha');
				$this->data['entry_review'] = $this->language->get('entry_review');		
				
				$this->data['button_submit'] = $this->language->get('button_submit');	
				
				$this->data['text_no_found'] = $this->language->get('text_no_found');
							
				$article_info = $this->model_simple_blog_article->getArticle($simple_blog_article_id);
				
				if($article_info) {
					
					$this->document->setTitle($article_info['article_title']);
					$this->document->setDescription($article_info['meta_description']);
					$this->document->setKeywords($article_info['meta_keyword']);
					
					//print "<pre>"; print_r($article_info); exit;
					$this->data['article_info_found'] = $article_info;
					
					// here comes means customer or other viewer can see the blog so need to increment the view counter
					$this->model_simple_blog_article->addBlogView($article_info['simple_blog_article_id']);
					
					if($article_info['featured_image']) {
						$this->data['featured_found'] = 1;
						$this->data['image'] = HTTP_SERVER . 'image/' . $article_info['featured_image'];
						//$image = $this->model_tool_image->resize($result['featured_image'], 873, 585);
					} else if($article_info['image']) {
						$this->data['image'] = HTTP_SERVER . 'image/' . $article_info['image'];
						$featured_found = '';
						//$image = $this->model_tool_image->resize($result['image'], 873, 585);
					} else {
						$this->data['image'] = '';
						$featured_found = '';
					}
					
					// author url
					$this->data['author_url'] = $this->url->link('simple_blog/author', 'simple_blog_author_id=' . $article_info['simple_blog_author_id'], 'SSL');
					
					// get total comments
					$total_comments = $this->model_simple_blog_article->getTotalComments($simple_blog_article_id);
					
					if($total_comments != 1) {
						$this->data['total_comment'] = $total_comments . " " . $this->language->get('text_comments');
					} else {
						$this->data['total_comment'] = $total_comments . " " . $this->language->get('text_comment');
					}
					
					$this->data['article_info'] = $article_info;
					
					$this->data['article_date_modified'] = date($this->language->get('text_date_format'), strtotime($article_info['date_modified']));
					
					$this->data['article_additional_description'] = $this->model_simple_blog_article->getArticleAdditionalDescription($simple_blog_article_id);
					
					$related_product = $this->model_simple_blog_article->getArticleProductRelated($simple_blog_article_id);
					
					$this->data['products'] = array();
					
					foreach($related_product as $product) {
						
						$product_info = $this->model_catalog_product->getProduct($product['product_id']);
						
						$image = ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height')) : false;
						
						$price = (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) ? $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'))) : false;	
						
						$special = ((float)$product_info['special']) ? $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'))) : false;
						
						$rating = ($this->config->get('config_review_status')) ? (int)$product_info['rating'] : false;
						
						$this->data['products'][] = array(
							'product_id' => $product_info['product_id'],
							'thumb'   	 => $image,
							'name'    	 => $product_info['name'],
							'price'   	 => $price,
							'special' 	 => $special,
							'rating'     => $rating,
							'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
							'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						);
					}		
				
					// author related information
					$author_info = $this->model_simple_blog_article->getAuthorInformation($article_info['simple_blog_author_id']);
					
					//print "<pre>"; print_r($author_info); exit;
					
					if($author_info) {
						
						$this->data['author_name'] = $author_info['name'];
						
						if($author_info['image']) {
							$this->data['author_image'] = $this->model_tool_image->resize($author_info['image'], 100, 100);
						} else {
							$this->data['author_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
						}
						
						$this->data['author_description'] = html_entity_decode($author_info['description'], ENT_QUOTES, 'UTF-8');
					}	
					
					// related article information
					$this->data['text_related_article'] = $this->language->get('text_related_article');
					$this->data['text_posted_by'] = $this->language->get('text_posted_by');
					$this->data['text_on'] = $this->language->get('text_on');
					$this->data['text_updated'] = $this->language->get('text_updated');
					$this->data['text_comment_on_article'] = $this->language->get('text_comment_on_article');
					$this->data['text_view_comment'] = $this->language->get('text_view_comment');
					$this->data['button_continue_reading'] = $this->language->get('button_continue_reading');
										
					$related_articles = $this->model_simple_blog_article->getRelatedArticles($article_info['simple_blog_article_id']);
					
					$this->data['related_articles'] = $related_articles;	
				}	

				$this->data['breadcrumbs'] = array();
	
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_home'),
					'href'      => $this->url->link('common/home'),
					'separator' => false
				);
		
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('heading_title'),
					'href'      => $this->url->link('simple_blog/article'),       		
					'separator' => ' :: '
				);
				
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/simple_blog/article_info.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/simple_blog/article_info.tpl';
				} else {
					$this->template = 'default/template/simple_blog/article_info.tpl';
				}
	
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					//'simple_blog/blog_header',
					//'simple_blog/blog_footer',
					'common/footer',
					'common/header'
				);
	
				$this->response->setOutput($this->render());
					
			} else {
				
				$url = '';

				if (isset($this->request->get['article_id'])) {
					$url .= '&article_id=' . $this->request->get['article_id'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
				
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_home'),
					'href'      => $this->url->link('common/home'),
					'separator' => false
				);
				
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('heading_title'),
					'href'      => $this->url->link('simple_blog/article'),
					'separator' => $this->language->get('text_separator')
				);
				
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_category_error'),
					'href'      => $this->url->link('blog/author', $url),
					'separator' => $this->language->get('text_separator')
				);
	
				$this->document->setTitle($this->language->get('text_article_error'));
	
				$this->data['heading_title'] = $this->language->get('text_article_error');
	
				$this->data['text_error'] = $this->language->get('text_article_error');
	
				$this->data['button_continue'] = $this->language->get('button_continue');
	
				$this->data['continue'] = $this->url->link('common/home');
	
				$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');
	
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
				} else {
					$this->template = 'default/template/error/not_found.tpl';
				}
	
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
	
				$this->response->setOutput($this->render());
			}			
		}
		
		public function comment() {
			$this->language->load('simple_blog/article');
	
			$this->load->model('simple_blog/article');
	
			$this->data['text_on'] = $this->language->get('text_on');
			$this->data['text_said'] = $this->language->get('text_said');
			$this->data['text_no_blog'] = $this->language->get('text_no_blog');
	
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			$this->data['text_reply_comment'] = $this->language->get('text_reply_comment');
			
			$this->data['comments'] = array();
	
			$comment_total = $this->model_simple_blog_article->getTotalCommentsByArticleId($this->request->get['simple_blog_article_id']);
	
			$results = $this->model_simple_blog_article->getCommentsByArticle($this->request->get['simple_blog_article_id'],($page - 1) * 10, 10, 0);
			
			//print "<pre>"; print_r($results); exit;
			
			foreach ($results as $result) {
				
				$comment_reply = '';
				
				$comment_reply = $this->model_simple_blog_article->getCommentsByArticle($this->request->get['simple_blog_article_id'], 0, 1000, $result['simple_blog_comment_id']);
				
				$this->data['comments'][] = array(
					'simple_blog_article_id' 	=> $result['simple_blog_article_id'],
					'simple_blog_comment_id' 	=> $result['simple_blog_comment_id'],
					'comment_reply'		=> $comment_reply,
					'author'     		=> ucwords($result['author']),
					'comment'       	=> $result['comment'],
					'date_added' 		=> date($this->language->get('text_date_format_long'), strtotime($result['date_added']))
				);
			}

			//print "<pre>"; print_r($this->data['comments']); exit;
	
			$pagination = new Pagination();
			$pagination->total = $comment_total;
			$pagination->page = $page;
			$pagination->limit = 5;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('simple_blog/article/comment', 'simple_blog_article_id=' . $this->request->get['simple_blog_article_id'] . '&page={page}');
	
			$this->data['pagination'] = $pagination->render();
	
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/simple_blog/article_comment.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/simple_blog/article_comment.tpl';
			} else {
				$this->template = 'default/template/simple_blog/article_comment.tpl';
			}
	
			$this->response->setOutput($this->render());
		}
		
		public function writeComment() {
			
			$this->load->model('simple_blog/article');
			
			$this->language->load('simple_blog/article');
			
			$json = array();
			
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				
				if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
					$json['error'] = $this->language->get('error_name');
				}
	
				if ((utf8_strlen($this->request->post['text']) < 3) || (utf8_strlen($this->request->post['text']) > 1000)) {
					$json['error'] = $this->language->get('error_text');
				}
	
				if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
					$json['error'] = $this->language->get('error_captcha');
				}
				
				if (!isset($json['error'])) {
					//print_r($this->request->post); exit;
					$this->model_simple_blog_article->addArticleComment($this->request->get['simple_blog_article_id'], $this->request->post);
					
					if($this->config->get('blog_comment_auto_approval')) {
						$json['success'] = $this->language->get('text_success');	
					} else {
						$json['success'] = $this->language->get('text_success_approval');	
					}				

				}				
			}
			
			$this->response->setOutput(json_encode($json));
		}
	}
?>