<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ControllerModuleHdwplayerGallery extends Controller {

    private $error = array();
   

    public function index() {
       $this->load->language('module/hdwplayer_gallery');
       $this->document->setTitle = $this->language->get('heading_title');
       $this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->model_setting_setting->editSetting('hdwplayer_gallery', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getModule();		
		
	}
	
        public function getModule(){
                $this->data['heading_title'] = $this->language->get('heading_title');
                
                $this->data['text_show'] = $this->language->get('text_show');
                $this->data['text_hide'] = $this->language->get('text_hide');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_left'] = $this->language->get('text_left');
		$this->data['text_right'] = $this->language->get('text_right');
                $this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
                $this->data['entry_title'] = $this->language->get('entry_title');
                $this->data['entry_show'] = $this->language->get('entry_show');
		$this->data['entry_video'] = $this->language->get('entry_video');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_help'] = $this->language->get('entry_help');
		$this->data['entry_version_status'] = $this->language->get('entry_version_status');
                $this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_author'] = $this->language->get('entry_author');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
                $this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
                $this->data['entry_width'] = $this->language->get('entry_width');
                $this->data['entry_height'] = $this->language->get('entry_height');
                $this->data['entry_licence_key'] = $this->language->get('entry_licence_key');
                $this->data['entry_logo'] = $this->language->get('entry_logo');
                $this->data['entry_logo_position'] = $this->language->get('entry_logo_position');
                $this->data['entry_logo_alpha'] = $this->language->get('entry_logo_alpha');
                $this->data['entry_logo_target'] = $this->language->get('entry_logo_target');
                $this->data['entry_skin_mode'] = $this->language->get('entry_skin_mode');
                $this->data['entry_stretch_type'] = $this->language->get('entry_stretch_type');
                $this->data['entry_buffer_time'] = $this->language->get('entry_buffer_time');
                $this->data['entry_volume_level'] = $this->language->get('entry_volume_level');
                $this->data['entry_autoplay'] = $this->language->get('entry_autoplay');
                $this->data['entry_playlist_autoplay'] = $this->language->get('entry_playlist_autoplay');
                $this->data['entry_playlist_open'] = $this->language->get('entry_playlist_open');
                $this->data['entry_random_playlist'] = $this->language->get('entry_random_playlist');
                $this->data['entry_control_bar'] = $this->language->get('entry_control_bar');
                $this->data['entry_play_pause'] = $this->language->get('entry_play_pause');
                $this->data['entry_progress_bar'] = $this->language->get('entry_progress_bar');
                $this->data['entry_timer'] = $this->language->get('entry_timer');
                $this->data['entry_share'] = $this->language->get('entry_share');
                $this->data['entry_volume'] = $this->language->get('entry_volume');
                $this->data['entry_full_screen'] = $this->language->get('entry_full_screen');
                $this->data['entry_play_dock'] = $this->language->get('entry_play_dock');
                $this->data['entry_play_list'] = $this->language->get('entry_play_list');
                $this->data['entry_player_settings'] = $this->language->get('entry_player_settings');
                $this->data['entry_skin_settings'] = $this->language->get('entry_skin_settings');
                $this->load->model('catalog/hdwplayer');
        
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['sort_order'])) {
			$this->data['error_sort_order'] = $this->error['sort_order'];
		} else {
			$this->data['error_sort_order'] = '';
		}
		
                $this->data['breadcrumbs'] = array();
   		
   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=extension/module&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=module/hdwplayer_gallery&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/hdwplayer_gallery', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();
		
		if (isset($this->request->post['hdwplayer_gallery_module'])) {
			$this->data['modules'] = $this->request->post['hdwplayer_gallery_module'];
		} elseif ($this->config->get('hdwplayer_gallery_module')) { 
			$this->data['modules'] = $this->config->get('hdwplayer_gallery_module');
		}
                $cats = $this->model_catalog_hdwplayer->getCategories();
                $this->data['categories'] = array();
                foreach($cats as $cat){
                    $this->data['categories'][] = $cat['category_id'];
                }
                $this->data['categories'][] = '';
        if (isset($this->request->post['hgwidth'])) {
            $this->data['hgwidth'] = $this->request->post['hgwidth'];
        } elseif ($this->config->get('hgwidth')) {
            $this->data['hgwidth'] = $this->config->get('hgwidth');
        } else {
            $this->data['hgwidth'] = '630';
        }
        
        $this->data['token'] = $this->session->data['token'];
        
        if (isset($this->request->post['hgheight'])) {
            $this->data['hgheight'] = $this->request->post['hgheight'];
        } elseif ($this->config->get('hgheight')) {
            $this->data['hgheight'] = $this->config->get('hgheight');
        } else {
            $this->data['hgheight'] = '360';
        }
        if (isset($this->request->post['hgskin_mode'])) {
            $this->data['hgskin_mode'] = $this->request->post['hgskin_mode'];
        } elseif ($this->config->get('hgskin_mode')) {
            $this->data['hgskin_mode'] = $this->config->get('hgskin_mode');
        } else {
            $this->data['hgskin_mode'] = 'static';
        }
        if (isset($this->request->post['hgstretch_type'])) {
            $this->data['hgstretch_type'] = $this->request->post['hgstretch_type'];
        } elseif ($this->config->get('hgstretch_type')) {
            $this->data['hgstretch_type'] = $this->config->get('hgstretch_type');
        } else {
            $this->data['hgstretch_type'] = 'fill';
        }
        if (isset($this->request->post['hgbuffer_time'])) {
            $this->data['hgbuffer_time'] = $this->request->post['hgbuffer_time'];
        } elseif ($this->config->get('hgbuffer_time')) {
            $this->data['hgbuffer_time'] = $this->config->get('hgbuffer_time');
        } else {
            $this->data['hgbuffer_time'] = 3;
        }
        if (isset($this->request->post['hgvolume_level'])) {
            $this->data['hgvolume_level'] = $this->request->post['hgvolume_level'];
        } elseif ($this->config->get('hgvolume_level')) {
            $this->data['hgvolume_level'] = $this->config->get('hgvolume_level');
        } else {
            $this->data['hgvolume_level'] = 30;
        }
        if (isset($this->request->post['hgautoplay'])) {
            $this->data['hgautoplay'] = $this->request->post['hgautoplay'];
        } elseif ($this->config->get('hgautoplay')) {
            $this->data['hgautoplay'] = $this->config->get('hgautoplay');
        } else {
            $this->data['hgautoplay'] = '';
        }
        if (isset($this->request->post['hgplaylist_autoplay'])) {
            $this->data['hgplaylist_autoplay'] = $this->request->post['hgplaylist_autoplay'];
        } elseif ($this->config->get('hgplaylist_autoplay')) {
            $this->data['hgplaylist_autoplay'] = $this->config->get('hgplaylist_autoplay');
        } else {
            $this->data['hgplaylist_autoplay'] = '';
        }
        if (isset($this->request->post['hgplaylist_open'])) {
            $this->data['hgplaylist_open'] = $this->request->post['hgplaylist_open'];
        } elseif ($this->config->get('hgplaylist_open')) {
            $this->data['hgplaylist_open'] = $this->config->get('hgplaylist_open');
        } else {
            $this->data['hgplaylist_open'] = '';
        }
        if (isset($this->request->post['hgrandom_playlist'])) {
            $this->data['hgrandom_playlist'] = $this->request->post['hgrandom_playlist'];
        } elseif ($this->config->get('hgrandom_playlist')) {
            $this->data['hgrandom_playlist'] = $this->config->get('hgrandom_playlist');
        } else {
            $this->data['hgrandom_playlist'] = '';
        }
        if (isset($this->request->post['hgcontrol_bar'])) {
            $this->data['hgcontrol_bar'] = $this->request->post['hgcontrol_bar'];
        } elseif ($this->config->get('hgcontrol_bar')) {
            $this->data['hgcontrol_bar'] = $this->config->get('hgcontrol_bar');
        } else {
            $this->data['hgcontrol_bar'] = '';
        }
        if (isset($this->request->post['hgplay_pause'])) {
            $this->data['hgplay_pause'] = $this->request->post['hgplay_pause'];
        } elseif ($this->config->get('hgplay_pause')) {
            $this->data['hgplay_pause'] = $this->config->get('hgplay_pause');
        } else {
            $this->data['hgplay_pause'] = '';
        }
        if (isset($this->request->post['hgprogress_bar'])) {
            $this->data['hgprogress_bar'] = $this->request->post['hgprogress_bar'];
        } elseif ($this->config->get('hgprogress_bar')) {
            $this->data['hgprogress_bar'] = $this->config->get('hgprogress_bar');
        } else {
            $this->data['hgprogress_bar'] = '';
        }
        if (isset($this->request->post['hgtimer'])) {
            $this->data['hgtimer'] = $this->request->post['hgtimer'];
        } elseif ($this->config->get('hgtimer')) {
            $this->data['hgtimer'] = $this->config->get('hgtimer');
        } else {
            $this->data['hgtimer'] = '';
        }
        if (isset($this->request->post['hgshare'])) {
            $this->data['hgshare'] = $this->request->post['hgshare'];
        } elseif ($this->config->get('hgshare')) {
            $this->data['hgshare'] = $this->config->get('hgshare');
        } else {
            $this->data['hgshare'] = '';
        }
        if (isset($this->request->post['hgvolume'])) {
            $this->data['hgvolume'] = $this->request->post['hgvolume'];
        } elseif ($this->config->get('hgvolume')) {
            $this->data['hgvolume'] = $this->config->get('hgvolume');
        } else {
            $this->data['hgvolume'] = '';
        }
        if (isset($this->request->post['hgfull_screen'])) {
            $this->data['hgfull_screen'] = $this->request->post['hgfull_screen'];
        } elseif ($this->config->get('hgfull_screen')) {
            $this->data['hgfull_screen'] = $this->config->get('hgfull_screen');
        } else {
            $this->data['hgfull_screen'] = '';
        }
        if (isset($this->request->post['hgplay_dock'])) {
            $this->data['hgplay_dock'] = $this->request->post['hgplay_dock'];
        } elseif ($this->config->get('hgplay_dock')) {
            $this->data['hgplay_dock'] = $this->config->get('hgplay_dock');
        } else {
            $this->data['hgplay_dock'] = '';
        }
        if (isset($this->request->post['hgplay_list'])) {
            $this->data['hgplay_list'] = $this->request->post['hgplay_list'];
        } elseif ($this->config->get('hgplay_list')) {
            $this->data['hgplay_list'] = $this->config->get('hgplay_list');
        } else {
            $this->data['hgplay_list'] = '';
        }
                $this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
				
		$this->template = 'module/hdwplayer_gallery.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
        $this->response->setOutput($this->render());
        }
        private function validate() {

		if (!$this->user->hasPermission('modify', 'module/hdwplayer_gallery')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
        public function autocomplete() {
            $json = array();
            
              
           if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/hdwplayer');
                        $data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
                        $json = array();
			$results = $this->model_catalog_hdwplayer->getVideoCategory($data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id'    => $result['category_id'],
					'name'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
           }
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}
}

?>
