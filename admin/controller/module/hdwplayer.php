<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ControllerModuleHdwplayer extends Controller {

    private $error = array();
   

    public function index() {
       $this->load->language('module/hdwplayer');
       $this->document->setTitle = $this->language->get('heading_title');
       $this->load->model('setting/setting');
       $this->load->model('catalog/hdwplayer');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->model_setting_setting->editSetting('hdwplayer', $this->request->post);
                        $this->getModule();
                    $this->model_catalog_hdwplayer->editPlayer($this->data,"2");

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
        $result = array();
        if(!$this->request->post)
        {
        $result = $this->model_catalog_hdwplayer->getPlayer("2");
        }
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
       		'href'      => HTTPS_SERVER .'index.php?route=module/hdwplayer&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/hdwplayer', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();
		
		if (isset($this->request->post['hdwplayer_module'])) {
			$this->data['modules'] = $this->request->post['hdwplayer_module'];
		} elseif ($this->config->get('hdwplayer_module')) { 
			$this->data['modules'] = $this->config->get('hdwplayer_module');
		}
                $cats = $this->model_catalog_hdwplayer->getCategories();
                $this->data['categories'] = array();
                foreach($cats as $cat){
                    $this->data['categories'][] = $cat['category_id'];
                }
                $this->data['categories'][] = '';
        if (isset($this->request->post['width'])) {
            $this->data['width'] = $this->request->post['width'];
        } elseif (!empty($result)) {
            $this->data['width'] = $result['width'];
        } else {
            $this->data['width'] = '630';
        }
        $this->data['token'] = $this->session->data['token'];
        if (isset($this->request->post['height'])) {
            $this->data['height'] = $this->request->post['height'];
        } elseif (!empty($result)) {
            $this->data['height'] = $result['height'];
        } else {
            $this->data['height'] = '360';
        }
        if (isset($this->request->post['skin_mode'])) {
            $this->data['skin_mode'] = $this->request->post['skin_mode'];
        } elseif (!empty($result)) {
            $this->data['skin_mode'] = $result['skin_mode'];
        } else {
            $this->data['skin_mode'] = 'static';
        }
        if (isset($this->request->post['stretch_type'])) {
            $this->data['stretch_type'] = $this->request->post['stretch_type'];
        } elseif (!empty($result)) {
            $this->data['stretch_type'] = $result['stretch_type'];
        } else {
            $this->data['stretch_type'] = 'fill';
        }
        if (isset($this->request->post['buffer_time'])) {
            $this->data['buffer_time'] = $this->request->post['buffer_time'];
        } elseif (!empty($result)) {
            $this->data['buffer_time'] = $result['buffer_time'];
        } else {
            $this->data['buffer_time'] = 3;
        }
        if (isset($this->request->post['volume_level'])) {
            $this->data['volume_level'] = $this->request->post['volume_level'];
        } elseif (!empty($result)) {
            $this->data['volume_level'] = $result['volume_level'];
        } else {
            $this->data['volume_level'] = 30;
        }
        if (isset($this->request->post['autoplay'])) {
            $this->data['autoplay'] = $this->request->post['autoplay'];
        } elseif (!empty($result)) {
            $this->data['autoplay'] = $result['autoplay'];
        } else {
            $this->data['autoplay'] = '';
        }
        if (isset($this->request->post['playlist_autoplay'])) {
            $this->data['playlist_autoplay'] = $this->request->post['playlist_autoplay'];
        } elseif (!empty($result)) {
            $this->data['playlist_autoplay'] = $result['playlist_autoplay'];
        } else {
            $this->data['playlist_autoplay'] = '';
        }
        if (isset($this->request->post['playlist_open'])) {
            $this->data['playlist_open'] = $this->request->post['playlist_open'];
        } elseif (!empty($result)) {
            $this->data['playlist_open'] = $result['playlist_open'];
        } else {
            $this->data['playlist_open'] = '';
        }
        if (isset($this->request->post['random_playlist'])) {
            $this->data['random_playlist'] = $this->request->post['random_playlist'];
        } elseif (!empty($result)) {
            $this->data['random_playlist'] = $result['random_playlist'];
        } else {
            $this->data['random_playlist'] = '';
        }
        if (isset($this->request->post['control_bar'])) {
            $this->data['control_bar'] = $this->request->post['control_bar'];
        } elseif (!empty($result)) {
            $this->data['control_bar'] = $result['control_bar'];
        } else {
            $this->data['control_bar'] = '';
        }
        if (isset($this->request->post['play_pause'])) {
            $this->data['play_pause'] = $this->request->post['play_pause'];
        } elseif (!empty($result)) {
            $this->data['play_pause'] = $result['play_pause'];
        } else {
            $this->data['play_pause'] = '';
        }
        if (isset($this->request->post['progress_bar'])) {
            $this->data['progress_bar'] = $this->request->post['progress_bar'];
        } elseif (!empty($result)) {
            $this->data['progress_bar'] = $result['progress_bar'];
        } else {
            $this->data['progress_bar'] = '';
        }
        if (isset($this->request->post['timer'])) {
            $this->data['timer'] = $this->request->post['timer'];
        } elseif (!empty($result)) {
            $this->data['timer'] = $result['timer'];
        } else {
            $this->data['timer'] = '';
        }
        if (isset($this->request->post['share'])) {
            $this->data['share'] = $this->request->post['share'];
        } elseif (!empty($result)) {
            $this->data['share'] = $result['share'];
        } else {
            $this->data['share'] = '';
        }
        if (isset($this->request->post['volume'])) {
            $this->data['volume'] = $this->request->post['volume'];
        } elseif (!empty($result)) {
            $this->data['volume'] = $result['volume'];
        } else {
            $this->data['volume'] = '';
        }
        if (isset($this->request->post['full_screen'])) {
            $this->data['full_screen'] = $this->request->post['full_screen'];
        } elseif (!empty($result)) {
            $this->data['full_screen'] = $result['full_screen'];
        } else {
            $this->data['full_screen'] = '';
        }
        if (isset($this->request->post['play_dock'])) {
            $this->data['play_dock'] = $this->request->post['play_dock'];
        } elseif (!empty($result)) {
            $this->data['play_dock'] = $result['play_dock'];
        } else {
            $this->data['play_dock'] = '';
        }
        if (isset($this->request->post['play_list'])) {
            $this->data['play_list'] = $this->request->post['play_list'];
        } elseif (!empty($result)) {
            $this->data['play_list'] = $result['play_list'];
        } else {
            $this->data['play_list'] = '';
        }
                $this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
				
		$this->template = 'module/hdwplayer.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
        $this->response->setOutput($this->render());
        }
        private function validate() {

		if (!$this->user->hasPermission('modify', 'module/hdwplayer')) {
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
