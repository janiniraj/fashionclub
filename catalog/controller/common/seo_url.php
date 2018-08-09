<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}
		
		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);
			
			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
				
				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);
					
					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}
					
					//Begin:Simple blog
					if($url[0] == 'simple_blog_article_id') {					
					$this->request->get['simple_blog_article_id'] = $url[1];
					}
					
					if($url[0] == 'simple_blog_author_id') {
						$this->request->get['simple_blog_author_id'] = $url[1];
					}
					
					if ($url[0] == 'simple_blog_category_id') {
						if (!isset($this->request->get['simple_blog_category_id'])) {
							$this->request->get['simple_blog_category_id'] = $url[1];
						} else {
							$this->request->get['simple_blog_category_id'] .= '_' . $url[1];
						}
					}
					//End:Simple blog
					
					
					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}	
					
					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}
					
					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}	
				} else {
					$this->request->get['route'] = 'error/not_found';	
				}
			}
			
			if (isset($this->request->get['product_id'])) {
				$this->request->get['route'] = 'product/product';
			} elseif (isset($this->request->get['path'])) {
				$this->request->get['route'] = 'product/category';
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$this->request->get['route'] = 'product/manufacturer/info';
			} elseif (isset($this->request->get['information_id'])) {
				//$this->request->get['route'] = 'information/information';
				$this->request->get['route'] = 'information/information';
				} else if (isset($this->request->get['simple_blog_article_id'])) {
					$this->request->get['route'] = 'simple_blog/article/view';
				} else if (isset($this->request->get['simple_blog_author_id'])) {
					$this->request->get['route'] = 'simple_blog/author';
				} else if (isset($this->request->get['simple_blog_category_id'])) {
					$this->request->get['route'] = 'simple_blog/category';
				} else if ($this->request->get['_route_'] ==  'simple-blog') {
					$this->request->get['route'] = 'simple_blog/article';
			}
			
			if (isset($this->request->get['route'])) {
				return $this->forward($this->request->get['route']);
			}
		}
	}
	
	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));
	
		$url = ''; 
		
		$data = array();
		
		parse_str($url_info['query'], $data);
		
		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
				
					if ($query->num_rows) {
						$url .= '/' . $query->row['keyword'];
						
						unset($data[$key]);
					}					
				//} elseif ($key == 'path') {
				//begin:simple blog
				} else if($data['route'] == 'simple_blog/article/view' && $key == 'simple_blog_article_id') {
					
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
					
					if ($query->num_rows) {
						$url .= '/' . $query->row['keyword'];
						unset($data[$key]);
					} else {
						$url .= '/simple-blog/' . (int)$value;	
						unset($data[$key]);
					}
					
				} else if($data['route'] == 'simple_blog/author' && $key == 'simple_blog_author_id') {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
					
					if ($query->num_rows) {
						$url .= '/' . $query->row['keyword'];
						unset($data[$key]);
					} else {
						$url .= '/simple-blog/' . (int)$value;	
						unset($data[$key]);
					}
				} else if($data['route'] == 'simple_blog/category' && $key == 'simple_blog_category_id') {
				
					$blog_categories = explode("_", $value);
					
					foreach ($blog_categories as $blog_category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'simple_blog_category_id=" . (int)$blog_category . "'");
						
						if ($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url .= '/simple-category' . $blog_category;
						}
					}
					unset($data[$key]);
										
				} else if($data['route'] == 'simple_blog/search') {
					//echo $data['route'];
					if(isset($key) && ($key == 'blog_search')) {
						$url .= '/search&blog_search=' . $value;
					} else {
						$url .= '/search';
					}		
					//echo $url; 
				} else if(isset($data['route']) && $data['route'] == 'simple_blog/article' && $key != 'simple_blog_article_id' && $key != 'simple_blog_author_id' && $key != 'simple_blog_category_id' && $key != 'page') {
					$url .=  '/simple-blog';
				} elseif ($key == 'path') {
				//end:simple blog
            	$categories = explode('_', $value);
					
					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
				
						if ($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
						}							
					}
					
					unset($data[$key]);
				}
			}
		}
	
		if ($url) {
			unset($data['route']);
		
			$query = '';
		
			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . $key . '=' . $value;
				}
				
				if ($query) {
					$query = '?' . trim($query, '&');
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}	
}
?>