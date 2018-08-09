<?php
class ControllerModuleGallalbum extends Controller {
	private $error = array(); 

	public function index() {   
		$this->language->load('module/gallalbum');

		$this->document->setTitle($this->language->get('heading_title_main'));

		$this->load->model('setting/setting');
		
		$this->document->addScript('view/javascript/jquery/jscolor/jscolor.js');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('gallalbum', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title_main');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['tab_basicset'] = $this->language->get('tab_basicset');
		$this->data['tab_advanceset'] = $this->language->get('tab_advanceset');
		$this->data['tab_popup'] = $this->language->get('tab_popup');
		$this->data['entry_boxgallcol'] = $this->language->get('entry_boxgallcol');
		$this->data['entry_namecol'] = $this->language->get('entry_namecol'); 
		$this->data['entry_namefontsize'] = $this->language->get('entry_namefontsize'); 
		$this->data['entry_namepos'] = $this->language->get('entry_namepos'); 
		$this->data['entry_bordergall'] = $this->language->get('entry_bordergall');
		$this->data['entry_borderthick'] = $this->language->get('entry_borderthick');
		$this->data['entry_popupstyle'] = $this->language->get('entry_popupstyle');
		$this->data['entry_popupsize'] = $this->language->get('entry_popupsize');

		$this->data['entry_gallalbum'] = $this->language->get('entry_gallalbum');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension'); 
		$this->data['entry_box_margin'] = $this->language->get('entry_box_margin');
		$this->data['entry_headtitle'] = $this->language->get('entry_headtitle');
		$this->data['text_pleaseselect'] = $this->language->get('text_pleaseselect');	
		$this->data['text_style1'] = $this->language->get('text_style1');
		$this->data['text_style2'] = $this->language->get('text_style2');
		$this->data['entry_shortdesc'] = $this->language->get('entry_shortdesc');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['text_gallimage_placeholder'] = $this->language->get('text_gallimage_placeholder');
        $this->data['entry_gallimage'] = $this->language->get('entry_gallimage');
        $this->data['entry_product'] = $this->language->get('entry_product');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['dimension'])) {
			$this->data['error_dimension'] = $this->error['dimension'];
		} else {
			$this->data['error_dimension'] = array();
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
			'text'      => $this->language->get('heading_title_main'),
			'href'      => $this->url->link('module/gallalbum', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/gallalbum', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['gallalbum_boxgallcol'])) {
			$this->data['gallalbum_boxgallcol'] = $this->request->post['gallalbum_boxgallcol'];
		} else {
			$this->data['gallalbum_boxgallcol'] = $this->config->get('gallalbum_boxgallcol');
		}
		
		if (isset($this->request->post['gallalbum_namecol'])) {
			$this->data['gallalbum_namecol'] = $this->request->post['gallalbum_namecol'];
		} else {
			$this->data['gallalbum_namecol'] = $this->config->get('gallalbum_namecol');
		}
		
		if (isset($this->request->post['gallalbum_namefontsize'])) {
			$this->data['gallalbum_namefontsize'] = $this->request->post['gallalbum_namefontsize'];
		} else {
			$this->data['gallalbum_namefontsize'] = $this->config->get('gallalbum_namefontsize');
		}
		
		if (isset($this->request->post['gallalbum_namepos'])) {
			$this->data['gallalbum_namepos'] = $this->request->post['gallalbum_namepos'];
		} else {
			$this->data['gallalbum_namepos'] = $this->config->get('gallalbum_namepos');
		}
		
		if (isset($this->request->post['gallalbum_bordercol'])) {
			$this->data['gallalbum_bordercol'] = $this->request->post['gallalbum_bordercol'];
		} else {
			$this->data['gallalbum_bordercol'] = $this->config->get('gallalbum_bordercol');
		}
		
		if (isset($this->request->post['gallalbum_borderthick'])) {
			$this->data['gallalbum_borderthick'] = $this->request->post['gallalbum_borderthick'];
		} else {
			$this->data['gallalbum_borderthick'] = $this->config->get('gallalbum_borderthick');
		}
       
        $this->data['token'] = $this->session->data['token'];
        
		$this->data['modules'] = array();

		if (isset($this->request->post['gallalbum_module'])) {
			$this->data['modules'] = $this->request->post['gallalbum_module'];
		} elseif ($this->config->get('gallalbum_module')) { 
			$this->data['modules'] = $this->config->get('gallalbum_module');
		}	
        
        $this->load->model('catalog/gallimage');

		for($i=0; $i<count($this->data['modules']); $i++) {
			$this->data['modules'][$i]['gallalbums_list'] = array();
			if ($this->data['modules'][$i]['gallalbums']) {
				foreach(explode(",",$this->data['modules'][$i]['gallalbums']) as $gid) {
					$g = $this->model_catalog_gallimage->getGallimage($gid);
					if ($g)
						$this->data['modules'][$i]['gallalbums_list'][] = $g; 
				}
			}
		}

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/gallalbum.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}
	
	public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "gallimage` (`gallimage_id` int(11) NOT NULL AUTO_INCREMENT, `image` varchar(255) DEFAULT NULL, `sort_order` int(3) NOT NULL DEFAULT '0', `status` tinyint(1) NOT NULL, `gwidth` int(11) DEFAULT NULL, `gheight` int(11) DEFAULT NULL, `pwidth` int(11) DEFAULT NULL, `pheight` int(11) DEFAULT NULL, `awidth` int(11) DEFAULT NULL, `aheight` int(11) DEFAULT NULL, `position` varchar(11) NOT NULL, `resize` tinyint(1) NOT NULL, `popstyle` varchar(11) NOT NULL, `date_added` datetime NOT NULL, `date_modified` datetime NOT NULL, PRIMARY KEY (`gallimage_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");	
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "gallimage_description` (`gallimage_id` int(11) NOT NULL, `language_id` int(11) NOT NULL, `name` varchar(255) NOT NULL, `description` text NOT NULL, `meta_description` varchar(255) NOT NULL, `meta_keyword` varchar(255) NOT NULL, PRIMARY KEY (`gallimage_id`,`language_id`), KEY `name` (`name`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "gallimage_to_store` (`gallimage_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY (`gallimage_id`,`store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");		
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "gallimage_image` (`gallimage_image_id` int(11) NOT NULL AUTO_INCREMENT, `gallimage_id` int(11) NOT NULL, `link` varchar(255) NOT NULL, `image` varchar(255) NOT NULL, `sort_order` int(3) NOT NULL DEFAULT '0', PRIMARY KEY (`gallimage_image_id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "gallimage_image_description` (`gallimage_image_id` int(11) NOT NULL, `language_id` int(11) NOT NULL, `gallimage_id` int(11) NOT NULL, `title` varchar(128) NOT NULL, PRIMARY KEY (`gallimage_image_id`,`language_id`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    }
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "gallimage");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "gallimage_description");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "gallimage_to_store");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "gallimage_image");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "gallimage_image_description");
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/gallalbum')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['gallalbum_module'])) {
			foreach ($this->request->post['gallalbum_module'] as $key => $value) {
				if (!$value['image_width'] || !$value['image_height']) {
					$this->error['dimension'][$key] = $this->language->get('error_dimension');
				}			
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>