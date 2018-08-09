<?php  
class ControllerModuleCarousel extends Controller {
	protected function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->document->addScript('catalog/view/javascript/jquery/jquery.jcarousel.min.js');

		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/carousel.css');
		}

		$this->data['limit'] = $setting['limit'];
		$this->data['scroll'] = $setting['scroll'];

		$this->data['banners'] = array();

		//$results = $this->model_design_banner->getBanner($setting['banner_id']);
		
		$data = array( 'catid' => 93,  'sort'  => 'p.date_added', 'order' => 'DESC', 'start' => 0, 'limit' => 15 );  // 93 is the category id of New Arrival Products
		$results = $this->model_catalog_product->getProducts($data);



		
		foreach ($results as $result) {


			$imagesResults = $this->model_catalog_product->getProductImages($result['product_id']);

			$flipImg = '';

			foreach ($imagesResults as $imagesResult) {

				if( $flipImg =='' ){
				
				$flipImg =$imagesResult['image'];	

				}				
			}	


			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['banners'][] = array(
					//'title' => $result['title'],
					'title' => $result['name'],
					//'link'  => $result['link'],
					'link'  => '/index.php?route=product/product&product_id=' . $result['product_id'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']),
					'bannerImg' =>  $this->model_tool_image->resize($flipImg, '228', '288'),
				);
			}
		}

		$this->data['module'] = $module++; 

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/carousel.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/carousel.tpl';
		} else {
			$this->template = 'default/template/module/carousel.tpl';
		}

		$this->render(); 
	}
}
?>