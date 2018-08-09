<?php
class ControllerMediaVideo extends Controller {
   private $error = array();
      
     public function index() {
       $this->document->setTitle("Media"); //Optional. Set the title of your web page.

         $this->data['breadcrumbs'] = array();

         $this->data['breadcrumbs'][] = array(
           'text'      => $this->language->get('text_home'),
         'href'      => $this->url->link('common/home'),           
           'separator' => false
         );

         $this->data['breadcrumbs'][] = array(
           'text'      => $this->language->get('heading_title'),
         'href'      => $this->url->link('media/video'),
           'separator' => $this->language->get('text_separator')
         );   
         
       $this->data['heading_title'] = "Media"; //Get "heading title" from language file.

      if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/media/video.tpl')) { //if file exists in your current template folder
         $this->template = $this->config->get('config_template') . '/template/media/video.tpl'; //get it
      } else {
         $this->template = 'default/template/media/video.tpl'; //or get the file from the default folder
      }
      
      $this->children = array( //Required. The children files for the page.
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