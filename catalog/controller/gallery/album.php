<?php 
class ControllerGalleryAlbum extends Controller {
  public function index() {

    $this->load->language('gallery/gallery');
	
	$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
            'separator' => false
		);
		
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_gallery'),
			'href' => $this->url->link('gallery/album'),
            'separator' => $this->language->get('text_separator')
		);
     

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/gallery/album.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/gallery/album.tpl';
			} else {
				$this->template = 'default/template/gallery/album.tpl';
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
?>