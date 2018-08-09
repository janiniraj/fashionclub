<?php 
class ControllerCatalogGallimage extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/gallimage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/gallimage');

		$this->getList();
	}

	public function insert() {
		$this->language->load('catalog/gallimage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/gallimage');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_gallimage->addGallimage($this->request->post);

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

			$this->redirect($this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('catalog/gallimage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/gallimage');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_gallimage->editGallimage($this->request->get['gallimage_id'], $this->request->post);

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

			$this->redirect($this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/gallimage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/gallimage');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $gallimage_id) {
				$this->model_catalog_gallimage->deleteGallimage($gallimage_id);
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

			$this->redirect($this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$db_check = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "gallimage_image LIKE 'sort_order'");
		if (!$db_check->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "gallimage_image` ADD  `sort_order` int(3) NOT NULL DEFAULT '0' AFTER `image`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "gallimage_image_description` MODIFY COLUMN `title` varchar(128) NOT NULL ");
		}
			
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href'      => $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('catalog/gallimage/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/gallimage/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['gallimages'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$gallimage_total = $this->model_catalog_gallimage->getTotalGallimages();

		$results = $this->model_catalog_gallimage->getGallimages($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/gallimage/update', 'token=' . $this->session->data['token'] . '&gallimage_id=' . $result['gallimage_id'] . $url, 'SSL')
			);

			$this->data['gallimages'][] = array(
				'gallimage_id' => $result['gallimage_id'],
				'name'      => $result['name'],	
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),				
				'selected'  => isset($this->request->post['selected']) && in_array($result['gallimage_id'], $this->request->post['selected']),				
				'action'    => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_action'] = $this->language->get('column_action');	

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

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

		$this->data['sort_name'] = $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $gallimage_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/gallimage_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');			

		$this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_link'] = $this->language->get('entry_link');
		$this->data['entry_image'] = $this->language->get('entry_image');	
        $this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');	
		$this->data['entry_status'] = $this->language->get('entry_status');
        
        $this->data['entry_size'] = $this->language->get('entry_size');
        $this->data['entry_position'] = $this->language->get('entry_position');
        $this->data['entry_resize'] = $this->language->get('entry_resize');
        $this->data['entry_popstyle'] = $this->language->get('entry_popstyle');
        $this->data['entry_gsize'] = $this->language->get('entry_gsize');
		$this->data['entry_psize'] = $this->language->get('entry_psize');
		$this->data['entry_width'] = $this->language->get('entry_width');
		$this->data['entry_height'] = $this->language->get('entry_height');
        
        $this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_gallery'] = $this->language->get('tab_gallery');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_gallimage'] = $this->language->get('button_add_gallimage');
		$this->data['button_remove'] = $this->language->get('button_remove');

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

		if (isset($this->error['gallimage_image'])) {
			$this->data['error_gallimage_image'] = $this->error['gallimage_image'];
		} else {
			$this->data['error_gallimage_image'] = array();
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
			'href'      => $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['gallimage_id'])) { 
			$this->data['action'] = $this->url->link('catalog/gallimage/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/gallimage/update', 'token=' . $this->session->data['token'] . '&gallimage_id=' . $this->request->get['gallimage_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/gallimage', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['gallimage_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$gallimage_info = $this->model_catalog_gallimage->getGallimage($this->request->get['gallimage_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['gallimage_description'])) {
			$this->data['gallimage_description'] = $this->request->post['gallimage_description'];
		} elseif (isset($this->request->get['gallimage_id'])) {
			$this->data['gallimage_description'] = $this->model_catalog_gallimage->getGallimageDescriptions($this->request->get['gallimage_id']);
		} else {
			$this->data['gallimage_description'] = array();
		}

        
        $this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['gallimage_store'])) {
			$this->data['gallimage_store'] = $this->request->post['gallimage_store'];
		} elseif (isset($this->request->get['gallimage_id'])) {
			$this->data['gallimage_store'] = $this->model_catalog_gallimage->getGallimageStores($this->request->get['gallimage_id']);
		} else {
			$this->data['gallimage_store'] = array(0);
		}			

		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($gallimage_info)) {
			$this->data['keyword'] = $gallimage_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($gallimage_info)) {
			$this->data['image'] = $gallimage_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($gallimage_info) && $gallimage_info['image'] && file_exists(DIR_IMAGE . $gallimage_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($gallimage_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        
        if (isset($this->request->post['awidth'])) {
			$this->data['awidth'] = $this->request->post['awidth'];
		} elseif (!empty($gallimage_info)) {
			$this->data['awidth'] = $gallimage_info['awidth'];
		} else {
			$this->data['awidth'] = '';
		}
        
        if (isset($this->request->post['aheight'])) {
			$this->data['aheight'] = $this->request->post['aheight'];
		} elseif (!empty($gallimage_info)) {
			$this->data['aheight'] = $gallimage_info['aheight'];
		} else {
			$this->data['aheight'] = '';
		}
        
        if (isset($this->request->post['position'])) {
			$this->data['position'] = $this->request->post['position'];
		} elseif (!empty($gallimage_info)) {
			$this->data['position'] = $gallimage_info['position'];
		} else {
			$this->data['position'] = '';
		}
		
		if (isset($this->request->post['gwidth'])) {
			$this->data['gwidth'] = $this->request->post['gwidth'];
		} elseif (!empty($gallimage_info)) {
			$this->data['gwidth'] = $gallimage_info['gwidth'];
		} else {
			$this->data['gwidth'] = '';
		}
		
		if (isset($this->request->post['gheight'])) {
			$this->data['gheight'] = $this->request->post['gheight'];
		} elseif (!empty($gallimage_info)) {
			$this->data['gheight'] = $gallimage_info['gheight'];
		} else {
			$this->data['gheight'] = '';
		}
        
        if (isset($this->request->post['resize'])) {
			$this->data['resize'] = $this->request->post['resize'];
		} elseif (!empty($gallimage_info)) {
			$this->data['resize'] = $gallimage_info['resize'];
		} else {
			$this->data['resize'] = '';
		}
        
        if (isset($this->request->post['pwidth'])) {
			$this->data['pwidth'] = $this->request->post['pwidth'];
		} elseif (!empty($gallimage_info)) {
			$this->data['pwidth'] = $gallimage_info['pwidth'];
		} else {
			$this->data['pwidth'] = '';
		}
		
		if (isset($this->request->post['pheight'])) {
			$this->data['pheight'] = $this->request->post['pheight'];
		} elseif (!empty($gallimage_info)) {
			$this->data['pheight'] = $gallimage_info['pheight'];
		} else {
			$this->data['pheight'] = '';
		}
        
        if (isset($this->request->post['popstyle'])) {
			$this->data['popstyle'] = $this->request->post['popstyle'];
		} elseif (!empty($gallimage_info)) {
			$this->data['popstyle'] = $gallimage_info['popstyle'];
		} else {
			$this->data['popstyle'] = '';
		}
        
        if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($gallimage_info)) {
			$this->data['sort_order'] = $gallimage_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($gallimage_info)) {
			$this->data['status'] = $gallimage_info['status'];
		} else {
			$this->data['status'] = true;
		}

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->load->model('tool/image');

		if (isset($this->request->post['gallimage_image'])) {
			$gallimage_images = $this->request->post['gallimage_image'];
		} elseif (isset($this->request->get['gallimage_id'])) {
			$gallimage_images = $this->model_catalog_gallimage->getGallimageImages($this->request->get['gallimage_id']);	
		} else {
			$gallimage_images = array();
		}

		$this->data['gallimage_images'] = array();

		foreach ($gallimage_images as $gallimage_image) {
			if ($gallimage_image['image'] && file_exists(DIR_IMAGE . $gallimage_image['image'])) {
				$image = $gallimage_image['image'];
			} else {
				$image = 'no_image.jpg';
			}			

			$this->data['gallimage_images'][] = array(
				'gallimage_image_description' => $gallimage_image['gallimage_image_description'],
				'link'                     => $gallimage_image['link'],
				'image'                    => $image,
				'sort_order'               => $gallimage_image['sort_order'],
				'thumb'                    => $this->model_tool_image->resize($image, 100, 100)
			);	
		} 

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);		

		$this->template = 'catalog/gallimage_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/gallimage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['gallimage_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if (isset($this->request->post['gallimage_image'])) {
			foreach ($this->request->post['gallimage_image'] as $gallimage_image_id => $gallimage_image) {
				foreach ($gallimage_image['gallimage_image_description'] as $language_id => $gallimage_image_description) {
				
				}
			}	
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/gallimage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
    
    public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/gallimage');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_gallimage->getGallimages($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'gallimage_id' => $result['gallimage_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

        $this->response->setOutput(json_encode($json));
	}
}
?>