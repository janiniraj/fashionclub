<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ControllerCatalogHdwplayer extends Controller {

	private $error = array();
	private $upload = array();

	public function index() {
		$this->load->language('catalog/hdwplayer');

		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('setting/setting');

		$this->install();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateSetting())) {
			$this->load->model('catalog/hdwplayer');
			$this->getList();
			$this->model_catalog_hdwplayer->editPlayer($this->data,"1");
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		if(isset($this->request->get['page'])){
			$this->session->data['page'] = $this->request->get['page'];
			$this->session->data['view'] = 'vid';
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			 
		}
		$this->getList();
	}

	public function insert_video() {
		$this->load->language('catalog/hdwplayer');

		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('catalog/hdwplayer');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateVideo())) {
			$this->getVideoForm();
			$this->model_catalog_hdwplayer->addVideo($this->data);

			$this->session->data['success'] = $this->language->get('text_success_video');
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		if(($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($this->request->post['title'])){
			 
			$size = ini_get('post_max_size');
			$this->session->data['warning'] = "Post content length exceeds the limits of ".$size;
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->session->data['view'] = 'vid';
		$this->getVideoForm();
	}
	public function insert_category() {
		$this->load->language('catalog/hdwplayer');

		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('catalog/hdwplayer');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateCategory())) {
			$this->getCategoryForm();
			$this->model_catalog_hdwplayer->addCategory($this->data);
			$this->session->data['success'] = $this->language->get('text_success_category');
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getCategoryForm();
	}

	public function update_video() {
		$this->load->language('catalog/hdwplayer');

		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('catalog/hdwplayer');
		$this->session->data['view'] = 'vid';
		if(isset($this->request->post['edit'])){
			if (($this->request->post['edit'] == "delete") && ($this->validateV())) {
				$this->delete_video();
				$this->session->data['success'] = $this->language->get('text_success_video');
			} elseif ($this->request->post['edit'] == "publish" && ($this->validate())) {
				$this->model_catalog_hdwplayer->publishVideo($this->request->post['value']);
				$this->session->data['success'] = $this->language->get('text_success_video');
				 
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			} elseif ($this->request->post['edit'] == "publish_selected" && ($this->validateV())) {
				if (isset($this->request->post['selectedv']))
				{
					$this->session->data['success'] = $this->language->get('text_success_video');
					foreach ($this->request->post['selectedv'] as $video_id)
					{
						$this->model_catalog_hdwplayer->publishVideo($video_id);
					}
				}
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			} elseif($this->request->post['edit'] == "unpublish" && ($this->validate()))
			{
				$this->model_catalog_hdwplayer->unpublishVideo($this->request->post['value']);
				$this->session->data['success'] = $this->language->get('text_success_video');

				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif($this->request->post['edit'] == "unpublish_selected" && ($this->validateV())){
				if (isset($this->request->post['selectedv']))
				{
					$this->session->data['success'] = $this->language->get('text_success_video');
					foreach ($this->request->post['selectedv'] as $video_id)
					{
						$this->model_catalog_hdwplayer->unpublishVideo($video_id);
					}
				}
				 
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif($this->request->post['edit'] == "filter" && ($this->validate())){
				$this->session->data['search'] = $this->request->post['search'];
				 
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif($this->request->post['edit'] == "reset" && ($this->validate())){
				unset($this->session->data['search']);
				unset($this->session->data['page']);

				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}elseif (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['video']) && ($this->validateVideo())) {
			$this->getVideoForm();
			$this->model_catalog_hdwplayer->editVideo($this->request->get['video_id'], $this->data);

			$this->session->data['success'] = $this->language->get('text_success_video');
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		if(($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($this->request->post['title'])){
			 
			$size = ini_get('post_max_size');
			$this->session->data['warning'] = "Post content length exceeds the limits of ".$size;
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getVideoForm();
	}

	public function update_category() {
		$this->load->language('catalog/hdwplayer');
		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('catalog/hdwplayer');
		$this->session->data['view'] = 'cat';
		if(isset($this->request->post['edit'])){
			if (($this->request->post['edit'] == "delete") && ($this->validateC())) {
				$this->delete_category();
			}elseif ($this->request->post['edit'] == "publish" && ($this->validate())) {
				$this->model_catalog_hdwplayer->publishCategory($this->request->post['value']);
				$this->session->data['success'] = $this->language->get('text_success_category');
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif ($this->request->post['edit'] == "unpublish" && ($this->validate())){

				$this->model_catalog_hdwplayer->unpublishCategory($this->request->post['value']);
				$this->session->data['success'] = $this->language->get('text_success_category');
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif ($this->request->post['edit'] == "publish_selected" && ($this->validateC())){
				if (isset($this->request->post['selectedc']))
				{
					$this->session->data['success'] = $this->language->get('text_success_category');
					foreach ($this->request->post['selectedc'] as $category_id)
					{
						$this->model_catalog_hdwplayer->publishCategory($category_id);
					}
				}
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif ($this->request->post['edit'] == "unpublish_selected" && ($this->validateC())){
				if (isset($this->request->post['selectedc']))
				{
					$this->session->data['success'] = $this->language->get('text_success_category');
					foreach ($this->request->post['selectedc'] as $category_id)
					{
						$this->model_catalog_hdwplayer->unpublishCategory($category_id);
					}
				}
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif($this->request->post['edit'] == "filter" && ($this->validate())){
				$this->session->data['searchc'] = $this->request->post['search'];
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}elseif($this->request->post['edit'] == "reset" && ($this->validate())){
				$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
			}
		} elseif (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateCategory())) {
			$this->model_catalog_hdwplayer->editCategory($this->request->get['category_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_category');
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		if(isset($this->request->post['edit'])){
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getCategoryForm();
	}

	public function delete_video() {
		$this->load->language('catalog/hdwplayer');
		$this->document->setTitle = $this->language->get('heading_title');
		$this->load->model('catalog/hdwplayer');

		if (isset($this->request->post['selectedv'])) {
			foreach ($this->request->post['selectedv'] as $video_id) {
				$this->model_catalog_hdwplayer->deleteVideo($video_id);
			}
			$this->session->data['success'] = $this->language->get('text_success_video');
			$this->session->data['view'] = 'vid';
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}else{
			$this->error['warning'] = "You should select at least one";
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function delete_category() {
		$this->load->language('catalog/hdwplayer');
		$this->document->setTitle = $this->language->get('heading_title');
		$this->load->model('catalog/hdwplayer');

		if (isset($this->request->post['selectedc'])) {
			foreach ($this->request->post['selectedc'] as $category_id) {
				$this->model_catalog_hdwplayer->deleteCategory($category_id);
			}
			$this->session->data['success'] = $this->language->get('text_success_category');
			$this->session->data['view'] = 'cat';
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}else{
			$this->redirect($this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function getList() {

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_publish'] = $this->language->get('button_publish');
		$this->data['button_unpublish'] = $this->language->get('button_unpublish');
		$this->data['button_delete'] = $this->language->get('button_delete');


		$this->data['tab_settings'] = $this->language->get('tab_settings');
		$this->data['tab_videos'] = $this->language->get('tab_videos');
		$this->data['tab_category'] = $this->language->get('tab_category');


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
		$this->data['entry_ffmpeg'] = $this->language->get('entry_ffmpeg');
		$this->data['entry_flvtool2'] = $this->language->get('entry_flvtool2');
		$this->data['entry_control_bar'] = $this->language->get('entry_control_bar');
		$this->data['entry_play_pause'] = $this->language->get('entry_play_pause');
		$this->data['entry_progress_bar'] = $this->language->get('entry_progress_bar');
		$this->data['entry_timer'] = $this->language->get('entry_timer');
		$this->data['entry_share'] = $this->language->get('entry_share');
		$this->data['entry_volume'] = $this->language->get('entry_volume');
		$this->data['entry_full_screen'] = $this->language->get('entry_full_screen');
		$this->data['entry_play_dock'] = $this->language->get('entry_play_dock');
		$this->data['entry_play_list'] = $this->language->get('entry_play_list');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_hash'] = $this->language->get('entry_hash');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_video'] = $this->language->get('entry_video');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_type'] = $this->language->get('entry_type');
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_featured'] = $this->language->get('entry_featured');
		$this->data['entry_views'] = $this->language->get('entry_views');
		$this->data['entry_published'] = $this->language->get('entry_published');
		$this->data['entry_display'] = $this->language->get('entry_display');
		$this->data['entry_category_name'] = $this->language->get('entry_category_name');
		$this->data['entry_category_images'] = $this->language->get('entry_category_images');
		$this->data['entry_state'] = $this->language->get('entry_state');
		$this->data['entry_settings'] = $this->language->get('entry_settings');
		$this->data['entry_skin'] = $this->language->get('entry_skin');
		$this->data['entry_videos'] = $this->language->get('entry_videos');
		$this->data['entry_player_settings'] = $this->language->get('entry_player_settings');
		$this->data['entry_server_settings'] = $this->language->get('entry_server_settings');
		$this->data['entry_skin_settings'] = $this->language->get('entry_skin_settings');
		$this->data['entry_go'] = $this->language->get('entry_go');
		$this->data['entry_reset'] = $this->language->get('entry_reset');
		$this->data['text_top_right'] = $this->language->get('text_top_right');
		$this->data['text_top_left'] = $this->language->get('text_top_left');
		$this->data['text_bottom_right'] = $this->language->get('text_bottom_right');
		$this->data['text_bottom_left'] = $this->language->get('text_bottom_left');
		$this->data['text_center'] = $this->language->get('text_center');
		$this->data['text_float'] = $this->language->get('text_float');
		$this->data['text_static'] = $this->language->get('text_static');
		$this->data['text_fill'] = $this->language->get('text_fill');
		$this->data['text_uniform'] = $this->language->get('text_uniform');
		$this->data['text_original'] = $this->language->get('text_original');
		$this->data['text_exact'] = $this->language->get('text_exact');
		$this->data['text_dimention'] = $this->language->get('text_dimention');



		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if($this->data['error_warning'] == ''){
			if(isset($this->session->data['warning'])){
				$this->data['error_warning'] = $this->session->data['warning'];
				unset($this->session->data['warning']);
			}
		}
		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
            'text' => $this->language->get('text_home'),
            'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=catalog/hdwplayer&token=' . $this->session->data['token'],
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
            );

            $this->data['action'] = $this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

            //VIDEO TAG URLS
            $this->data['insert'] = $this->url->link('catalog/hdwplayer/insert_video', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['update'] = $this->url->link('catalog/hdwplayer/update_video', 'token=' . $this->session->data['token'], 'SSL');

            //CATEGORY TAG URLS
            $this->data['insertc'] = $this->url->link('catalog/hdwplayer/insert_category', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['updatec'] = $this->url->link('catalog/hdwplayer/update_category', 'token=' . $this->session->data['token'], 'SSL');
            //Videogallery
            $this->data['actiong'] = $this->url->link('catalog/hdwplayer/update_gallery', 'token=' . $this->session->data['token'], 'SSL');
            $this->load->model('catalog/hdwplayer');
            $result = array();
            if(!$this->request->post){
            	$result = $this->model_catalog_hdwplayer->getPlayer("1");
            }

            $this->data['categories_list'] = array();
            $cats = $this->model_catalog_hdwplayer->getCategories();
            $this->data['category_list'] = array('none');
            foreach($cats as $cat){
            	$this->data['category_list'][] = $cat['category_id'];
            }
            $this->data['category_list'][] = "-";
            $category = $this->model_catalog_hdwplayer->getVideoCategories();
            foreach ($category as $cate){
            	$this->data['categories_list'][] = array(
                    'name' => $cate['name'],
            		'id' => $cate['category_id']
            	);
            }
            if(isset($this->request->post['tab_name'])) {
            	$this->data['tab_name'] = $this->request->post['tab_name'];
            }elseif($this->config->get('tab_name')){
            	$this->data['tab_name'] = $this->config->get('tab_name');
            }else{
            	$this->data['tab_name'] = "Video Gallery";
            }
            if(isset($this->request->post['tab_visible'])) {
            	$this->data['tab_visible'] = $this->request->post['tab_visible'];
            }elseif($this->config->get('tab_visible')){
            	$this->data['tab_visible'] = $this->config->get('tab_visible');
            }else{
            	$this->data['tab_visible'] = "false";
            }
            if(isset($this->request->post['play_height'])) {
            	$this->data['play_height'] = $this->request->post['play_height'];
            }elseif($this->config->get('play_height')){
            	$this->data['play_height'] = $this->config->get('play_height');
            }else{
            	$this->data['play_height'] = "360";
            }
            if(isset($this->request->post['play_width'])) {
            	$this->data['play_width'] = $this->request->post['play_width'];
            }elseif($this->config->get('play_width')){
            	$this->data['play_width'] = $this->config->get('play_width');
            }else{
            	$this->data['play_width'] = "676";
            }
            if(isset($this->request->post['img_height'])) {
            	$this->data['img_height'] = $this->request->post['img_height'];
            }elseif($this->config->get('img_height')){
            	$this->data['img_height'] = $this->config->get('img_height');
            }else{
            	$this->data['img_height'] = "80";
            }
            if(isset($this->request->post['video_title'])) {
            	$this->data['video_title'] = $this->request->post['video_title'];
            }elseif($this->config->get('video_title')){
            	$this->data['video_title'] = $this->config->get('video_title');
            }else{
            	$this->data['video_title'] = "0";
            }
            if(isset($this->request->post['img_width'])) {
            	$this->data['img_width'] = $this->request->post['img_width'];
            }elseif($this->config->get('img_width')){
            	$this->data['img_width'] = $this->config->get('img_width');
            }else{
            	$this->data['img_width'] = "145";
            }
            if(isset($this->request->post['gallery'])) {
            	$this->data['galleries'] = $this->request->post['gallery'];
            }elseif($this->config->get('gallery')){
            	$this->data['galleries'] = $this->config->get('gallery');
            }else{
            	$this->data['galleries'] = array();
            }
            if (isset($this->request->post['width'])) {
            	$this->data['width'] = $this->request->post['width'];
            } elseif (!empty($result)) {
            	$this->data['width'] = $result['width'];
            } else {
            	$this->data['width'] = '630';
            }
            if (isset($this->request->post['height'])) {
            	$this->data['height'] = $this->request->post['height'];
            } elseif (!empty($result)) {
            	$this->data['height'] = $result['height'];
            } else {
            	$this->data['height'] = '360';
            }

            if (isset($this->request->post['licence_key'])) {
            	$this->data['licence_key'] = $this->request->post['licence_key'];
            } elseif (!empty($result)) {
            	$this->data['licence_key'] = $result['licence_key'];
            } else {
            	$this->data['licence_key'] = 'Your Commercial Key';
            }
            if(isset($this->request->post['logo'])){
            	$this->data['logo'] = $this->request->post['logo'];
            }elseif(!empty ($result)){
            	$this->data['logo'] = $result['logo'];
            }else {
            	$this->data['logo'] = "";
            }
            if(isset($this->session->data['view']))
            {
            	$this->data['view'] = $this->session->data['view'];
            	unset($this->session->data['view']);
            }else{
            	$this->data['view'] = "set";
            }
            if(isset($this->session->data['success'])){
            	$this->data['success'] = $this->session->data['success'];
            	unset($this->session->data['success']);
            }else{
            	$this->data['success'] = '';
            }

            if (isset($this->request->post['logo_position'])) {
            	$this->data['logo_position'] = $this->request->post['logo_position'];
            } elseif (!empty($result)) {
            	$this->data['logo_position'] = $result['logo_position'];
            } else {
            	$this->data['logo_position'] = 'top_right';
            }
            if (isset($this->request->post['logo_alpha'])) {
            	$this->data['logo_alpha'] = $this->request->post['logo_alpha'];
            } elseif (!empty($result)) {
            	$this->data['logo_alpha'] = $result['logo_alpha'];
            } else {
            	$this->data['logo_alpha'] = '';
            }
            if (isset($this->request->post['logo_target'])) {
            	$this->data['logo_target'] = $this->request->post['logo_target'];
            } elseif (!empty($result)) {
            	$this->data['logo_target'] = $result['logo_target'];
            } else {
            	$this->data['logo_target'] = 'http://';
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
            if (isset($this->request->post['ffmpeg'])) {
            	$this->data['ffmpeg'] = $this->request->post['ffmpeg'];
            } elseif (!empty($result)) {
            	$this->data['ffmpeg'] = $result['ffmpeg'];
            } else {
            	$this->data['ffmpeg'] = '';
            }
            if (isset($this->request->post['flvtool2'])) {
            	$this->data['flvtool2'] = $this->request->post['flvtool2'];
            } elseif (!empty($result)) {
            	$this->data['flvtool2'] = $result['flvtool2'];
            } else {
            	$this->data['flvtool2'] = '';
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
            if(isset($this->session->data['search'])){
            	$search = $this->session->data['search'];
            }else {
            	$search = "";
            }
            if(isset($this->session->data['page'])){
            	$page = $this->session->data['page'];
            }else{
            	$page = 1;
            }
            $data = array(
        'search' 		=> $search,
        'start' 		=> ($page - 1) * $this->config->get('config_admin_limit'),
        'limit'         => $this->config->get('config_admin_limit')
            );
            $videos = $this->model_catalog_hdwplayer->getVideos($data);
            $this->data['videos'] = array();
            foreach ($videos as $video) {
            	$action = array();
            	$action[] = array(
                'text' => $video['title'],
                'href' => $this->url->link('catalog/hdwplayer/update_video', 'token=' . $this->session->data['token'] . '&video_id=' . $video['video_id'], 'SSL')
            	);
            	$this->data['videos'][] = array(
                'video_id' => $video['video_id'],
                'category' => $this->model_catalog_hdwplayer->getCategoryName($video['category']),
                'video' => $video['video'],
                'video_type' => $video['video_type'],
                'token' => $video['token'],
                'published' => $video['publish'],
                'action' => $action,
                'selected' => isset($this->request->post['selected']) && in_array($video['video_id'], $this->request->post['selected'])
            	);
            }
            $video_total = $this->model_catalog_hdwplayer->getTotalVideo($data);
            $pagination = new Pagination();
            $pagination->total = $video_total;
            $pagination->page = $page;
            $pagination->limit = $this->config->get('config_admin_limit');
            $pagination->text = $this->language->get('text_pagination');
            $pagination->url = $this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');
            $this->data['pagination'] = $pagination->render();
            $this->data['categories'] = array();
            if(isset($this->session->data['searchc'])){
            	$categories = $this->model_catalog_hdwplayer->viewFilterCategory($this->session->data['searchc']);
            	unset($this->session->data['searchc']);
            }else{
            	$categories = $this->model_catalog_hdwplayer->getCategories();
            }
            foreach ($categories as $category) {
            	$action = array();
            	$action[] = array(
                'text' => $category['name'],
                'href' => $this->url->link('catalog/hdwplayer/update_category', 'token=' . $this->session->data['token'] . '&category_id=' . $category['category_id'], 'SSL')
            	);
            	$this->data['categories'][] = array(
                'category_id' => $category['category_id'],
                'image' => $category['image'],
                'publish' => $category['publish'],
                'selected' => isset($this->request->post['selected']) && in_array($category['category_id'], $this->request->post['selected']),
                'action' => $action
            	);
            }
            $this->load->model('catalog/hdwplayer');

            $this->load->model('design/layout');

            $this->data['layouts'] = $this->model_design_layout->getLayouts();

            $this->template = 'catalog/hdwplayer.tpl';
            $this->children = array(
            'common/header',
            'common/footer'
            );

            $this->response->setOutput($this->render());
	}

	protected function getVideoForm() {
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_video_type'] = $this->language->get('entry_video_type');
		$this->data['entry_upload_video'] = $this->language->get('entry_upload_video');
		$this->data['entry_upload_hd'] = $this->language->get('entry_upload_hd');
		$this->data['entry_upload_preview'] = $this->language->get('entry_upload_preview');
		$this->data['entry_upload_thump'] = $this->language->get('entry_upload_thump');
		$this->data['entry_video'] = $this->language->get('entry_video');
		$this->data['entry_hd_video'] = $this->language->get('entry_hd_video');
		$this->data['entry_preview'] = $this->language->get('entry_preview');
		$this->data['entry_thumb'] = $this->language->get('entry_thumb');
		$this->data['entry_streamer'] = $this->language->get('entry_streamer');
		$this->data['entry_security'] = $this->language->get('entry_security');
		$this->data['entry_dvr'] = $this->language->get('entry_dvr');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_featured'] = $this->language->get('entry_featured');
		$this->data['entry_publish'] = $this->language->get('entry_publish');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keywords'] = $this->language->get('entry_meta_keywords');
		$this->data['entry_seo_settings'] = $this->language->get('entry_seo_settings');
		$this->data['entry_add_video'] = $this->language->get('entry_add_video');
		$this->data['text_general_video'] = $this->language->get('text_general_video');
		$this->data['text_ffmpeg_upload'] = $this->language->get('text_ffmpeg_upload');
		$this->data['text_direct_url'] = $this->language->get('text_direct_url');
		$this->data['text_youtube'] = $this->language->get('text_youtube');
		$this->data['text_dailymotion'] = $this->language->get('text_dailymotion');
		$this->data['text_rtmp'] = $this->language->get('text_rtmp');
		$this->data['text_smil'] = $this->language->get('text_smil');
		$this->data['text_lighttpd'] = $this->language->get('text_lighttpd');
		$this->data['text_bitgravity'] = $this->language->get('text_bitgravity');
		$this->data['text_uncategorised'] = $this->language->get('text_uncategorised');


		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if(isset($this->session->data['warning']) && !isset($this->error['warning'])){
			$this->data['error_warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}
		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
            'text' => $this->language->get('text_home'),
            'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=catalog/hdwplayer&token=' . $this->session->data['token'],
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
            );
            if (!isset($this->request->get['video_id'])) {
            	$this->data['action'] = $this->url->link('catalog/hdwplayer/insert_video', 'token=' . $this->session->data['token'], 'SSL');
            } else {
            	$this->data['action'] = $this->url->link('catalog/hdwplayer/update_video', 'token=' . $this->session->data['token'] . '&video_id=' . $this->request->get['video_id'], 'SSL');
            }

            $this->data['cancel'] = $this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL');


            $video = array();
            if (isset($this->request->get['video_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            	$video = $this->model_catalog_hdwplayer->getVideo($this->request->get['video_id']);
            }

            if (isset($this->request->post['title'])) {
            	$this->data['title'] = $this->request->post['title'];
            } elseif (!empty($video)) {
            	$this->data['title'] = $video['title'];
            } else {
            	$this->data['title'] = '';
            }
            if (isset($this->request->post['video_type'])) {
            	$this->data['video_type'] = $this->request->post['video_type'];
            } elseif (!empty($video)) {
            	$this->data['video_type'] = $video['video_type'];
            } else {
            	$this->data['video_type'] = '';
            }
            if (isset($this->request->post['streamer'])) {
            	$this->data['streamer'] = $this->request->post['streamer'];
            } elseif (!empty($video)) {
            	$this->data['streamer'] = $video['streamer'];
            } else {
            	$this->data['streamer'] = '';
            }
            if (isset($this->request->post['dvr'])) {
            	$this->data['dvr'] = $this->request->post['dvr'];
            } elseif (!empty($video)) {
            	$this->data['dvr'] = $video['dvr'];
            } else {
            	$this->data['dvr'] = '';
            }
            if(isset($this->upload['hd_video'])){
            	$this->data['hd_video'] = $this->upload['hd_video'];
            }elseif (!empty($video)) {
            	$this->data['hd_video'] = $video['hd_video'];
            } else {
            	$this->data['hd_video'] = '';
            }
            if(isset($this->upload['video'])){
            	$this->data['video'] = $this->upload['video'];
            }elseif (!empty($video)){
            	$this->data['video'] = $video['video'];
            }  else {
            	$this->data['video'] = '';
            }
            if(isset($this->upload['preview_image'])){
            	$this->data['preview_image'] = $this->upload['preview_image'];
            } elseif (!empty($video)) {
            	$this->data['preview_image'] = $video['preview_image'];
            } else {
            	$this->data['preview_image'] = '';
            }
            if(isset($this->upload['thumb_image'])){
            	$this->data['thumb_image'] = $this->upload['thumb_image'];
            } elseif (!empty($video)) {
            	$this->data['thumb_image'] = $video['thumb_image'];
            } else {
            	$this->data['thumb_image'] = '';
            }
            if (isset($this->request->post['category'])) {
            	$this->data['category'] = $this->request->post['category'];
            } elseif (!empty($video)) {
            	$this->data['category'] = $video['category'];
            } else {
            	$this->data['category'] = '';
            }
            if (isset($this->request->post['token'])) {
            	$this->data['token'] = $this->request->post['token'];
            } elseif (!empty($video)) {
            	$this->data['token'] = $video['token'];
            } else {
            	$this->data['token'] = '';
            }

            if (isset($this->request->post['publish'])) {
            	$this->data['publish'] = $this->request->post['publish'];
            } elseif (!empty($video)) {
            	$this->data['publish'] = $video['publish'];
            } else {
            	$this->data['publish'] = '';
            }
            if (isset($this->request->post['meta_description'])) {
            	$this->data['meta_description'] = $this->request->post['meta_description'];
            } elseif (!empty($video)) {
            	$this->data['meta_description'] = $video['meta_description'];
            } else {
            	$this->data['meta_description'] = '';
            }
            if (isset($this->request->post['keywords'])) {
            	$this->data['keywords'] = $this->request->post['keywords'];
            } elseif (!empty($video)) {
            	$this->data['keywords'] = $video['keywords'];
            } else {
            	$this->data['keywords'] = '';
            }
            $this->data['categories'] = array();
            $category = $this->model_catalog_hdwplayer->getVideoCategories();
            foreach ($category as $cate){
            	$this->data['categories'][] = array(
                    'name' => $cate['name'],
            		'id' => $cate['category_id']
            	);
            }

            $this->load->model('design/layout');

            $this->data['layouts'] = $this->model_design_layout->getLayouts();

            $this->template = 'catalog/hdwplayer_form.tpl';
            $this->children = array(
            'common/header',
            'common/footer'
            );
            $this->response->setOutput($this->render());
	}

	protected function getCategoryForm() {
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_category_image'] = $this->language->get('entry_category_image');
		$this->data['text_root'] = $this->language->get('text_root');
		$this->data['text_upload'] = $this->language->get('text_upload');
		$this->data['text_url'] = $this->language->get('text_url');
		$this->data['entry_category_name'] = $this->language->get('entry_category_name');
		$this->data['entry_seo_settings'] = $this->language->get('entry_seo_settings');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keywords'] = $this->language->get('entry_meta_keywords');
		$this->data['entry_published'] = $this->language->get('entry_published');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}


		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
            'text' => $this->language->get('text_home'),
            'separator' => FALSE
		);


		$this->data['breadcrumbs'][] = array(
            'href' => HTTPS_SERVER . 'index.php?route=catalog/hdwplayer&token=' . $this->session->data['token'],
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
            );
            if (!isset($this->request->get['category_id'])) {
            	$this->data['action'] = $this->url->link('catalog/hdwplayer/insert_category', 'token=' . $this->session->data['token'], 'SSL');
            } else {
            	$this->data['action'] = $this->url->link('catalog/hdwplayer/update_category', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'], 'SSL');
            }

            $this->data['cancel'] = $this->url->link('catalog/hdwplayer', 'token=' . $this->session->data['token'], 'SSL');



            if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            	$category = $this->model_catalog_hdwplayer->getCategory($this->request->get['category_id']);
            }
            if (isset($this->request->post['name'])) {
            	$this->data['name'] = $this->request->post['name'];
            } elseif (!empty($category)) {
            	$this->data['name'] = $category['name'];
            } else {
            	$this->data['name'] = '';
            }
            if (isset($this->upload['image'])) {
            	$this->data['image'] = $this->upload['image'];
            } elseif (!empty($category)) {
            	$this->data['image'] = $category['image'];
            } else {
            	$this->data['image'] = '';
            }
            if (isset($this->request->post['image_type'])) {
            	$this->data['image_type'] = $this->request->post['image_type'];
            } elseif (!empty($category)) {
            	$this->data['image_type'] = $category['image_type'];
            } else {
            	$this->data['image_type'] = '';
            }
            if (isset($this->request->post['publish'])) {
            	$this->data['publish'] = $this->request->post['publish'];
            } elseif (!empty($category)) {
            	$this->data['publish'] = $category['publish'];
            } else {
            	$this->data['publish'] = '';
            }
            if (isset($this->request->post['description'])) {
            	$this->data['description'] = $this->request->post['description'];
            } elseif (!empty($category)) {
            	$this->data['description'] = $category['description'];
            } else {
            	$this->data['description'] = '';
            }
            if (isset($this->request->post['keywords'])) {
            	$this->data['keywords'] = $this->request->post['keywords'];
            } elseif (!empty($category)) {
            	$this->data['keywords'] = $category['keywords'];
            } else {
            	$this->data['keywords'] = '';
            }

            $this->load->model('design/layout');

            $this->data['layouts'] = $this->model_design_layout->getLayouts();

            $this->template = 'catalog/hdwplayer_category.tpl';
            $this->children = array(
            'common/header',
            'common/footer'
            );
            $this->response->setOutput($this->render());
	}

	public function install() {
		$this->load->model('catalog/hdwplayer');
		$this->model_catalog_hdwplayer->createTable();
	}

	protected function validate() {

		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function validateSetting() {

		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if($this->request->post['width'] == ''){
			$this->error['name']['width'] = "You must be enter the width.!";
		}
		if($this->request->post['height'] == ''){
			$this->error['name']['height'] = "You must be enter the height.!";
		}
		if($this->request->post['logo'] != '')
		{
			if(filter_var($this->request->post['logo'], FILTER_VALIDATE_URL) === FALSE){
				$this->error['name']['logo'] = "You must be enter valid image url";
			}else{
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$ext = explode('.',$this->request->post['logo']);
				$ext =  end($ext);
				//echo $this->request->post['logo'];
				if(!in_array($ext, $allowedExts)){
					$this->error['name']['logo'] = strtoupper($ext)." image format is not allowed";
				}
				if($this->request->post['licence_key'] == ""){
					$this->error['name']['licence_key'] = "You need licence key..!";
				}
				if($this->request->post['logo_alpha'] == "" || $this->request->post['logo_alpha'] < 1 || $this->request->post['logo_alpha'] > 100){
					$this->error['name']['logo_alpha'] = "You must be enter logo alpha between 1 to 100.";
				}
			}
		}
		if($this->error && !isset($this->error['warning']))
		{
			$this->error['warning'] = $this->language->get('error_warning');
		}
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function validateVideo() {

		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if ((utf8_strlen($this->request->post['title']) < 1) || (utf8_strlen($this->request->post['title']) > 255)) {
			$this->error['name']['title'] = $this->language->get('error_title');
		}
		try{
			if($this->request->post['video_type'] == "General Upload" || $this->request->post['video_type'] == "FFMPEG Upload"){
				if($this->request->post['video_type'] == "FFMPEG Upload"){
					if($_FILES['video'] != null && $this->request->post['video'] == ""){
						if($_FILES['video']['name'] != null){
							$var = $this->flvvideoUpload($_FILES['video']);
							if($var != ""){
								$this->error['name']['video'] = $var;
							}
						}else {
							$this->error['name']['video'] = $this->language->get('error_video_upload');
						}
					} else {
						$this->upload['video'] = $this->request->post['video'];
					}
				}else{
					if($_FILES['video'] != null && $this->request->post['video'] == ""){
						if($_FILES['video']['name'] != null){
							$var = $this->videoUpload($_FILES['video']);
							if($var != ""){
								$this->error['name']['video'] = $var;
							}  else {
								$this->upload['video'] = "image/hdwplayer/".$_FILES['video']['name'];
							}
						}  else {
							$this->error['name']['video'] = $this->language->get('error_video_upload');
						}
						if(isset($_FILES['hd_video']) && $_FILES['hd_video']['name'] != null){
							$var = $this->videoUpload($_FILES['hd_video']);
							if($var != ""){
								$this->error['name']['hd_video'] = $var;
							}  else {
								$this->upload['hd_video'] = "image/hdwplayer/".$_FILES['hd_video']['name'];
							}
						}  else {
							$this->upload['hd_video'] = $this->request->post['hd_video'];
						}
						if(isset($_FILES['preview_image']) && $_FILES['preview_image']['name'] != null){
							$var = $this->imageUpload($_FILES['preview_image']);
							if($var != ""){
								$this->error['name']['preview_image'] = $var;
							}  else {
								$this->upload['preview_image'] = "image/hdwplayer/".$_FILES['preview_image']['name'];
							}
						}  else {
							$this->upload['preview_image'] = $this->request->post['preview_image'];
						}
						if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != null){
							$var = $this->imageUpload($_FILES['thumb_image']);
							if($var != ""){
								$this->error['name']['thumb_image'] = $var;
							}  else {
								$this->upload['thumb_image'] = "image/hdwplayer/".$_FILES['thumb_image']['name'];
							}
						}  else {
							$this->upload['thumb_image'] = $this->request->post['thumb_image'];
						}
					}  else {
						$this->upload['video'] = $this->request->post['video'];
						$this->upload['hd_video'] = $this->request->post['hd_video'];
						if(isset($_FILES['preview_image']) && $_FILES['preview_image']['name'] != null){
							$var = $this->imageUpload($_FILES['preview_image']);
							if($var != ""){
								$this->error['name']['preview_image'] = $var;
							}  else {
								$this->upload['preview_image'] = "image/hdwplayer/".$_FILES['preview_image']['name'];
							}
						}  else {
							$this->upload['preview_image'] = $this->request->post['preview_image'];
						}
						if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != null){
							$var = $this->imageUpload($_FILES['thumb_image']);
							if($var != ""){
								$this->error['name']['thumb_image'] = $var;
							}  else {
								$this->upload['thumb_image'] = "image/hdwplayer/".$_FILES['thumb_image']['name'];
							}
						}  else {
							$this->upload['thumb_image'] = $this->request->post['thumb_image'];
						}
					}
				}
			}  else {
				if($this->request->post['video_type'] == "Youtube Videos")
				{

					if (preg_match('/http\:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})/',$this->request->post['video'])) {
						$this->upload['video'] = $this->request->post['video'];
						$var = explode('=',$this->request->post['video']);
						$this->upload['preview_image'] = 'http://img.youtube.com/vi/'.$var[1].'/0.jpg';
						$this->upload['thumb_image'] = 'http://img.youtube.com/vi/'.$var[1].'/default.jpg';
					}
					else{

						$this->error['name']['video'] = $this->language->get('error_url');
					}
				} else if($this->request->post['video_type'] == "Dailymotion Videos"){
					$this->upload['video'] = $this->request->post['video'];
					$this->upload['thumb_image'] = $this->request->post['thumb_image'];
					$this->upload['preview_image'] = $this->request->post['preview_image'];
						
				} else {
					if (filter_var($this->request->post['video'], FILTER_VALIDATE_URL) === FALSE) {

						$this->error['name']['video'] = $this->language->get('error_url');
					}
					else{
						if($this->request->post['video_type'] != "RTMP"){
							$allowedExts = array("flv","mp4","3g2","3gp","aac","f4b","f4p","f4v","m4a","m4v","sdp","vp6","smil");
							 
							$ext = explode('.',$this->request->post['video']);
							$ext =  end($ext);
							if(!in_array($ext, $allowedExts)){
								$this->error['name']['video'] = strtoupper($ext)." video is not allowed";
							}
						}
						$this->upload['video'] = $this->request->post['video'];
					}
					if (filter_var($this->request->post['hd_video'], FILTER_VALIDATE_URL) === FALSE && $this->request->post['hd_video'] != "") {
						$this->error['name']['hd_video'] = $this->language->get('hd_video');
					}  else {
						if($this->request->post['hd_video'] != '' && $this->request->post['video_type'] != "RTMP"){
							$allowedExts = array("flv","mp4","3g2","3gp","aac","f4b","f4p","f4v","m4a","m4v","sdp","vp6","smil");
							$ext = explode('.',$this->request->post['hd_video']);
							$ext =  end($ext);
							if(!in_array($ext, $allowedExts)){
								$this->error['name']['hd_video'] = strtoupper($ext)." video is not allowed";
							}
						}
						$this->upload['hd_video'] = $this->request->post['hd_video'];
					}
					if (filter_var($this->request->post['preview_image'], FILTER_VALIDATE_URL) === FALSE && $this->request->post['preview_image'] != "") {
						$this->error['name']['preview_image'] = $this->language->get('error_url');
					}  else {
						if($this->request->post['preview_image'] != ''){
							$allowedExts = array("gif", "jpeg", "jpg", "png");
							$ext = explode('.',$this->request->post['preview_image']);
							$ext =  end($ext);
							if(!in_array($ext, $allowedExts) && filter_var($this->request->post['preview_image'], FILTER_VALIDATE_URL)){
								$this->error['name']['preview_image'] = "Pleae enter valid image url";
							}else{
								$this->upload['preview_image'] = $this->request->post['preview_image'];
							}
						}
					}
					if (filter_var($this->request->post['thumb_image'], FILTER_VALIDATE_URL) === FALSE && $this->request->post['thumb_image'] != "") {
						$this->error['name']['thumb_image'] = $this->language->get('error_url');
					}  else {
						if($this->request->post['thumb_image'] != ''){
							$allowedExts = array("gif", "jpeg", "jpg", "png");
							$ext = explode('.',$this->request->post['thumb_image']);
							$ext =  end($ext);
							if(!in_array($ext, $allowedExts) && filter_var($this->request->post['thumb_image'], FILTER_VALIDATE_URL)){
								$this->error['name']['thumb_image'] = "Pleae enter valid image url";
							}else{
								$this->upload['thumb_image'] = $this->request->post['thumb_image'];
							}
						}
					}
				}
			}
		}  catch (Exception $e){
			if(!isset($this->error['warning'])){
				$this->error['warning'] = "You have error on edit video";
			}
		}
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function validateCategory() {

		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name']['name'] = $this->language->get('error_name');
		}
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if($this->request->post['image'] != ''){
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$ext = explode('.',$this->request->post['image']);
			$ext =  end($ext);
			if(!in_array($ext, $allowedExts) && filter_var($this->request->post['image'], FILTER_VALIDATE_URL)){
				$this->error['name']['image'] = "Pleae enter valid image url";
			}else{
				$this->upload['image'] = $this->request->post['image'];
			}
		}
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function validateV() {
		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(!isset($this->request->post['selectedv'])){
			$this->error['name']['selected'] = "You should select any one.";
		}
		if(!isset($this->error['warning']) && $this->error){
			$this->session->data['warning'] = $this->error['name']['selected'];
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateC() {
		if (!$this->user->hasPermission('modify', 'catalog/hdwplayer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(!isset($this->request->post['selectedc'])){
			$this->error['name']['selected'] = "You should select any one.";
		}
		if(!isset($this->error['warning']) && $this->error){
			$this->session->data['warning'] = $this->error['name']['selected'];
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	protected function imageUpload($image){
		$path = DIR_IMAGE."/hdwplayer/";
		$path = $path.$image["name"];
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = pathinfo($image["name"], PATHINFO_EXTENSION);
		if ((($image["type"] == "image/gif")
		|| ($image["type"] == "image/jpeg")
		|| ($image["type"] == "image/jpg")
		|| ($image["type"] == "image/png"))
		&& ($image["size"] < 350000) && in_array($extension, $allowedExts)){
			if ($image["error"] > 0){
				return "You have an error on uploading";
			}else{
				if (file_exists($path)){
					return "";
				}else{
					move_uploaded_file($image["tmp_name"],$path);
					return "";
				}
			}
		}else{
			return "Invalid file";
		}
	}

	protected function videoUpload($video){
		$path = DIR_IMAGE."/hdwplayer/";
		$path = $path.$video["name"];
		$allowedExts = array("flv","mp4","3g2","3gp","aac","f4b","f4p","f4v","m4a","m4v","sdp","vp6");
		$extension = pathinfo($video["name"], PATHINFO_EXTENSION);
		if (in_array($extension, $allowedExts)){
			if ($video["error"] > 0){
				return "You have an error on uploading";
			}else{
				if (file_exists($path)){
					return "";
				}else{

					move_uploaded_file($video["tmp_name"],$path);
					return "";
				}
			}
		}else{
			return "Invalid file";
		}
	}

	protected function flvvideoUpload($video){
		 
		$path = DIR_IMAGE."/hdwplayer/";
		$input = $path.$video["name"];
		$allowedExts = array("flv","mp4","mpg","wma","avi","qt","rm","mov","wmv");
		$extension = pathinfo($video["name"], PATHINFO_EXTENSION);
		$var = $this->getFfmpeg();
		$ffmpeg = $var['ffmpeg'];
		$flvtool2 = $var['flvtool2'];
		$file = explode('.',$video["name"]);
		$outputFile = $path.$file[0].'.flv';
		$outputThumb = $path.$file[0].'_thumb.jpg';
		$outputPreview = $path.$file[0].'_preview.jpg';
		if (in_array($extension, $allowedExts)){
			if ($video["error"] > 0){
				return "You have an error on uploading";
			}else{
				if (file_exists($input)){
					$this->upload['video'] = 'image/hdwplayer/'.$file[0].'.flv';
					$this->upload['thumb_image'] = 'image/hdwplayer/'.$file[0].'_thumb.jpg';
					$this->upload['preview_image'] = 'image/hdwplayer/'.$file[0].'_preview.jpg';
					return "";
				}else{
					if(move_uploaded_file($video["tmp_name"],$input))
					{
						if($extension != 'flv'){
							$cmd = $ffmpeg." -i ".$input." -sameq -ar 44100 ".$outputFile;
							exec($cmd);
						}
						$cmd      = $flvtool2 . " -U " . $outputFile;
						exec($cmd);
							
						$cmd      = $ffmpeg." -ss 3 -i ".$outputFile." -f image2 -vframes 1 -s 114x74 ".$outputThumb;
						exec($cmd);
							
						$cmd      = $ffmpeg." -ss 3 -i ".$outputFile." -f image2 -vframes 1 -s 320x240 ".$outputPreview;
						exec($cmd);
						if(file_exists($path.$file[0].'.flv')){
							$this->upload['video'] = 'image/hdwplayer/'.$file[0].'.flv';
							$this->upload['thumb_image'] = 'image/hdwplayer/'.$file[0].'_thumb.jpg';
							$this->upload['preview_image'] = 'image/hdwplayer/'.$file[0].'_preview.jpg';
						}
					}
					return "";
				}
			}
		}else{
			return "Invalid file";
		}
	}

	public function getFfmpeg(){
		$query = $this->db->query("SELECT ffmpeg, flvtool2 FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id=1");
		return $query->row;
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
			$results = $this->model_catalog_hdwplayer->getProductVideos($data);

			foreach ($results as $result) {
				$json[] = array(
					'video_id'    => $result['video_id'],
					'title'      => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['title'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}
}

?>
