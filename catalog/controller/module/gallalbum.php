<?php
class ControllerModuleGallalbum extends Controller {
	protected function index($setting) {
        static $module = 0;
        
		$this->language->load('module/gallalbum'); 
        
        $this->document->addStyle('catalog/view/javascript/jquery/gallery-album/gallery.css');
		
		$this->load->model('catalog/gallimage'); 
		$this->load->model('tool/image');
        
        $this->data['headtitle'] 	= $setting['headtitle'];
		$this->data['shortdesc'] 	= $setting['shortdesc'];
		$this->data['shortdesc_limit']	= $setting['shortdesc_limit'];
        
        $this->data['boxgallcol']	= $this->config->get('gallalbum_boxgallcol');
		$this->data['namecol']		= $this->config->get('gallalbum_namecol');
		$this->data['namefontsize']	= $this->config->get('gallalbum_namefontsize');
        $this->data['namepos'] 		= $this->config->get('gallalbum_namepos');
		$this->data['bordercol'] 	= $this->config->get('gallalbum_bordercol');
        $this->data['borderthick']	= $this->config->get('gallalbum_borderthick');
        
        
        $this->data['gallalbums'] = array();
        
        if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		$query = $this->db->query("SELECT g.gallimage_id FROM " . DB_PREFIX . "gallimage g WHERE g.status=1 ORDER BY g.gallimage_id DESC");
		
		foreach( $query->rows as $imgData ){
			
			$setting['gallalbumsID'][] = $imgData['gallimage_id'];
		}		
		
		$gallalbumsID = implode(',', $setting['gallalbumsID']);
		
        $gallalbums = explode(',', $gallalbumsID); 
		
        foreach ($gallalbums as $gallalbum) {
            $gallalbum_info = $this->model_catalog_gallimage->getGallalbum($gallalbum);
			
			if ($gallalbum_info) {
				if ($gallalbum_info['image']) {
					$image = $this->model_tool_image->resize($gallalbum_info['image'], $setting['image_width'], $setting['image_height'],'a');
				} else {
					$image = $this->model_tool_image->resize('no_image.png', $setting['image_width'], $setting['image_height'], 'a');
				}

			$this->data['gallalbums'][] = array(
				'gallimage_id' => $gallalbum_info['gallimage_id'],
				'name'        => $gallalbum_info['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($gallalbum_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->data['shortdesc_limit']) . '..',
				'thumb'   	 => $image,
				'href'        => $this->url->link('gallery/gallery', 'gallimage_id=' . $gallalbum_info['gallimage_id']),
				'date'        => $gallalbum_info['date'],
			);
		  }
            
        }

        $this->data['popimgwidth'] = $this->config->get('gallimage_popupwidth');
		$this->data['popimgheight'] = $this->config->get('gallimage_popupheight');
		$this->data['boxwidth'] = $setting['image_width'];
		$this->data['imgheight'] = $setting['image_height'];
		$this->data['marginh'] = $setting['boxgall_margin'];
		$this->data['marginv'] = $setting['boxgall_margin'] + 3;
        
        $this->data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/gallalbum.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/gallalbum.tpl';
		} else {
			$this->template = 'default/template/module/gallalbum.tpl';
		}

		$this->render();
	}
}
?>