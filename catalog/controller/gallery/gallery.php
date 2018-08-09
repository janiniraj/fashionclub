<?php 
class ControllerGalleryGallery extends Controller {  
	public function index() {
		$this->load->language('gallery/gallery');

		$this->load->model('catalog/gallimage');
		
		$this->load->model('tool/image');
		
		$this->document->addStyle('catalog/view/javascript/jquery/gallery-album/gallery.css');


		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
            'separator' => false
		);

		if (isset($this->request->get['gallimage_id'])) {
			$gallimage_id = (int)$this->request->get['gallimage_id'];
		} else {
			$gallimage_id = 0;
		}
		
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_gallery'),
			'href' => $this->url->link('gallery/album'),
            'separator' => $this->language->get('text_separator')
		);


        $gallimage_info = $this->model_catalog_gallimage->getGallalbum($gallimage_id);

		if ($gallimage_info) {
			$this->document->setTitle($gallimage_info['name']);
			$this->document->setDescription($gallimage_info['meta_description']);
			$this->document->setKeywords($gallimage_info['meta_keyword']);
            
            if ($gallimage_info['popstyle'] == 'lightgall') {
            $this->document->addScript('catalog/view/javascript/jquery/gallery-album/lightbox/js/lightbox.min.js');    
            $this->document->addStyle('catalog/view/javascript/jquery/gallery-album/lightbox/css/lightbox.css');    
            } else if ($gallimage_info['popstyle'] == 'blueimp') {
            $this->document->addScript('catalog/view/javascript/jquery/gallery-album/blueimp/js/jquery.blueimp-gallery.min.js');
            $this->document->addScript('catalog/view/javascript/jquery/gallery-album/blueimp/js/bootstrap-image-gallery.min.js');    
		    $this->document->addStyle('catalog/view/javascript/jquery/gallery-album/blueimp/css/blueimp-gallery.css');    
            $this->document->addStyle('catalog/view/javascript/jquery/gallery-album/blueimp/css/bootstrap-image-gallery.css'); 
            } else {
            $this->document->addScript('catalog/view/javascript/jquery/gallery-album/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/gallery-album/magnific/magnific-popup.css');    
            }

			$this->data['breadcrumbs'][] = array(
				'text' => $gallimage_info['name'],
				'href' => $this->url->link('gallery/gallery', 'gallimage_id=' .  $gallimage_id),
                'separator' => $this->language->get('text_separator')
			);

			$this->data['heading_title'] = $gallimage_info['name'];

			$this->data['button_continue'] = $this->language->get('button_continue');
				
			if ($gallimage_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($gallimage_info['image'], $gallimage_info['awidth'], $gallimage_info['aheight']);
			} else {
				$this->data['thumb'] = '';
			}

			
			$this->data['gallimage_id'] = $gallimage_info['gallimage_id'];
            $this->data['awidth'] 	= $gallimage_info['awidth'];
			$this->data['aheight'] 	= $gallimage_info['aheight'];
            $this->data['position'] 	= $gallimage_info['position'];
            $this->data['resize'] 	= $gallimage_info['resize'];
            $this->data['imgperrow'] 	= '4';//$gallimage_info['imgperrow'];
			$this->data['gwidth'] 	= $gallimage_info['gwidth'];
			$this->data['gheight'] 	= $gallimage_info['gheight'];
			$this->data['pwidth'] 	= $gallimage_info['pwidth'];
			$this->data['pheight'] 	= $gallimage_info['pheight'];
            $this->data['popstyle'] 	= $gallimage_info['popstyle'];


			$this->data['description'] = html_entity_decode($gallimage_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['date'] = html_entity_decode($gallimage_info['date']); //html_entity_decode($gallimage_info['date'], ENT_QUOTES, 'UTF-8');

			
			$this->data['gallimages'] = array();

	
		$results = $this->model_catalog_gallimage->getGallimage($gallimage_info['gallimage_id']);	
		
		if ($results) {

		foreach ($results as $result) {
            if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->data['gwidth'], $this->data['gheight'],'a');                   
					$popupimage = ($gallimage_info['resize'] ? $this->model_tool_image->resize($result['image'], $this->data['pwidth'], $this->data['pheight']) : 'image/' . $result['image']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->data['gwidth'], $this->data['gheight'],'a');
					$popupimage = ($gallimage_info['resize'] ? $this->model_tool_image->resize('placeholder.png', $this->data['pwidth'], $this->data['pheight']) : 'image/placeholder.png');
				}
            
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['gallimages'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $image,
					'popup' => $popupimage
				);
			}
		}
		}

			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/gallery/gallery.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/gallery/gallery.tpl';
			} else {
				$this->template = 'default/template/gallery/gallery.tpl';
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
		} else {            
            $this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('gallery/gallery', 'gallimage_id=' . $gallimage_id),
				'separator' => $this->language->get('text_separator')
			);

			$this->document->setTitle($this->language->get('text_error'));

			$this->data['heading_title'] = $this->language->get('text_error');

			$this->data['text_error'] = $this->language->get('text_error');

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
}
?>