<?php 
class ControllerInformationPaymentnotification extends Controller {
	private $error = array(); 
	    
  	public function index() {
		$this->language->load('information/payment_notification');

    	$this->document->setTitle($this->language->get('heading_title'));  
	 
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
    	 
$email_content = "<strong>".$this->language->get('entry_name')." </strong>".$this->request->post['name'];
$email_content .= "<br><br><strong>".$this->language->get('entry_email')." </strong>"."<a href='mailto:".$this->request->post['email']."' > ".$this->request->post['email']." </a>";
$email_content .= "<br><br><strong>".$this->language->get('entry_tel')." </strong>".$this->request->post['tel'];
$email_content .= "<br><br><strong>".$this->language->get('entry_orderid')." </strong>".$this->request->post['orderid'];
$email_content .= "<br><br><strong>".$this->language->get('entry_amountpaid')." </strong>".$this->request->post['amountpaid'];
$email_content .= "<br><br><strong>".$this->language->get('entry_paymentdate')." </strong>".$this->request->post['paymentdate'];
$email_content .= "<br><br><strong>".$this->language->get('entry_paymentmethod')." </strong>".$this->request->post['paymentmethod'];
$email_content .= "<br><br><strong>".$this->language->get('entry_paymentinfo')." </strong><br>".nl2br($this->request->post['paymentinfo']);


    	 
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email').','.$this->request->post['email']);
	  		$mail->setFrom($this->request->post['email']);
	  		$mail->setSender($this->request->post['name']);
      		$mail->setSubject(sprintf($this->language->get('email_subject'), $this->request->post['name'], $this->request->post['orderid']));
	  		$mail->setHtml(strip_tags(html_entity_decode($email_content, ENT_QUOTES, 'UTF-8'),'<br><strong><a>'));
	  		if (file_exists($_FILES['paymentupload']['tmp_name'])) {               
            $tempdir = (DIR_DOWNLOAD);
            $fileName = $_FILES['paymentupload']['name'];
            $imageTemp = $tempdir.$fileName;
            move_uploaded_file($_FILES['paymentupload']['tmp_name'], $tempdir.$fileName);      
            $mail->addAttachment($tempdir.$fileName);
            }
      		$mail->send();      		
      		
      		if(isset($imageTemp)){
               if (file_exists($imageTemp))
               {
                  unlink($imageTemp);
               }
            }

	  		$this->redirect($this->url->link('information/payment_notification/paymentnotificationsuccess'));
    	}

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/payment_notification'),
        	'separator' => $this->language->get('text_separator')
      	);	
			
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	$this->data['heading_customerinfo'] = $this->language->get('heading_customerinfo');
    	$this->data['heading_paymentdetails'] = $this->language->get('heading_paymentdetails');

    	$this->data['text_message'] = $this->language->get('text_message');
    	$this->data['text_required'] = $this->language->get('text_required');
    	$this->data['text_fileformat'] = $this->language->get('text_fileformat');
    	$this->data['text_maxfilesize'] = $this->language->get('text_maxfilesize');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_tel'] = $this->language->get('entry_tel');
    	$this->data['entry_orderid'] = $this->language->get('entry_orderid');
    	$this->data['entry_amountpaid'] = $this->language->get('entry_amountpaid');
    	$this->data['entry_paymentmethod'] = $this->language->get('entry_paymentmethod');
    	$this->data['entry_paymentdate'] = $this->language->get('entry_paymentdate');
    	$this->data['entry_paymentupload'] = $this->language->get('entry_paymentupload');
    	$this->data['entry_paymentinfo'] = $this->language->get('entry_paymentinfo');
    	$this->data['entry_pleasechoose'] = $this->language->get('entry_pleasechoose');
    	
    	$this->data['button_submit'] = $this->language->get('button_submit');
    	$this->data['email_subject'] = $this->language->get('email_subject');


		if (isset($this->error['name'])) {$this->data['error_name'] = $this->error['name'];} 
		else {$this->data['error_name'] = '';}
		
		if (isset($this->error['email'])) {$this->data['error_email'] = $this->error['email'];} 
		else {$this->data['error_email'] = '';}
		
		if (isset($this->error['tel'])) {$this->data['error_tel'] = $this->error['tel'];} 
		else {$this->data['error_tel'] = '';}
		
		if (isset($this->error['orderid'])) {$this->data['error_orderid'] = $this->error['orderid'];} 
		else {$this->data['error_orderid'] = '';}
		
		if (isset($this->error['amountpaid'])) {$this->data['error_amountpaid'] = $this->error['amountpaid'];} 
		else {$this->data['error_amountpaid'] = '';}
		
		if (isset($this->error['paymentdate'])) {$this->data['error_paymentdate'] = $this->error['paymentdate'];} 
		else {$this->data['error_paymentdate'] = '';}
		
		if (isset($this->error['paymentmethod'])) {$this->data['error_paymentmethod'] = $this->error['paymentmethod'];} 
		else {$this->data['error_paymentmethod'] = '';}
		
		if (isset($this->error['paymentinfo'])) {$this->data['error_paymentinfo'] = $this->error['paymentinfo'];} 
		else {$this->data['error_paymentinfo'] = '';}
		
		if (isset($this->error['paymentupload'])) {$this->data['error_paymentupload'] = $this->error['paymentupload'];} 
		else {$this->data['error_paymentupload'] = '';}
				

    
		$this->data['action'] = $this->url->link('information/payment_notification');
		$this->data['store'] = $this->config->get('config_name');

    	
		if (isset($this->request->post['name'])) {$this->data['name'] = $this->request->post['name'];} 
		else {$this->data['name'] = '';}
		
		if (isset($this->request->post['email'])) {$this->data['email'] = $this->request->post['email'];} 
		else {$this->data['email'] = $this->customer->getEmail();}
		
		if (isset($this->request->post['tel'])) {$this->data['tel'] = $this->request->post['tel'];} 
		else {$this->data['tel'] = '';}
		
		if (isset($this->request->post['orderid'])) {$this->data['orderid'] = $this->request->post['orderid'];} 
		else {$this->data['orderid'] = '';}
		
		if (isset($this->request->post['amountpaid'])) {$this->data['amountpaid'] = $this->request->post['amountpaid'];} 
		else {$this->data['amountpaid'] = '';}
		
		if (isset($this->request->post['paymentdate'])) {$this->data['paymentdate'] = $this->request->post['paymentdate'];} 
		else {$this->data['paymentdate'] = '';}
		
		if (isset($this->request->post['paymentmethod'])) {$this->data['paymentmethod'] = $this->request->post['paymentmethod'];} 
		else {$this->data['paymentmethod'] = '';}
		
		if (isset($this->request->post['paymentinfo'])) {$this->data['paymentinfo'] = $this->request->post['paymentinfo'];} 
		else {$this->data['paymentinfo'] = '';}
		
		
			

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/payment_notification.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/payment_notification.tpl';
		} else {
			$this->template = 'default/template/information/payment_notification.tpl';
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





  	public function paymentnotificationsuccess() {
		$this->language->load('information/payment_notification');

		$this->document->setTitle($this->language->get('heading_title')); 

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/payment_notification'),
        	'separator' => $this->language->get('text_separator')
      	);	
		
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_message'] = $this->language->get('text_message');

    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/paymentnotificationsuccess.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/paymentnotificationsuccess.tpl';
		} else {
			$this->template = 'default/template/common/paymentnotificationsuccess.tpl';
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


	
  	private function validate() {
    	if ((utf8_strlen($this->request->post['name']) < 5) || (utf8_strlen($this->request->post['name']) > 50)) {
      		$this->error['name'] = $this->language->get('error_name');}
      		
      	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      	    $this->error['email'] = $this->language->get('error_email');}
      	    
      	if ((utf8_strlen($this->request->post['tel']) < 7) || (utf8_strlen($this->request->post['tel']) > 15)) {
      		$this->error['tel'] = $this->language->get('error_tel');}
			  
		if ((utf8_strlen($this->request->post['orderid']) < 1) || (utf8_strlen($this->request->post['orderid']) > 10)) {
      		$this->error['orderid'] = $this->language->get('error_orderid');}
			  
		if ((utf8_strlen($this->request->post['amountpaid']) < 1) || (utf8_strlen($this->request->post['amountpaid']) > 20)) {
      		$this->error['amountpaid'] = $this->language->get('error_amountpaid');}	 
			  
		if ((utf8_strlen($this->request->post['paymentdate']) < 5) || (utf8_strlen($this->request->post['paymentdate']) > 20)) {
      		$this->error['paymentdate'] = $this->language->get('error_paymentdate');}
      		
      	if ((($this->request->post['paymentmethod']) == "0") ) {
      		$this->error['paymentmethod']= $this->language->get('error_paymentmethod');}	
			  
		if ((utf8_strlen($this->request->post['paymentinfo']) < 10) || (utf8_strlen($this->request->post['paymentinfo']) > 3000)) {
      		$this->error['paymentinfo'] = $this->language->get('error_paymentinfo');}
      			
      	
      	
      	if (!empty($this->request->files['paymentupload']['name'])) 
        {
            $filename = html_entity_decode($this->request->files['paymentupload']['name'], ENT_QUOTES, 'UTF-8');
            
            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) 
            {
               $this->error['paymentupload']  = $this->language->get('error_filename');
            }        
            
            $allowed = array("doc","docx","pdf","gif","jpg","png","bmp");   
            /*         
            $filetypes = explode(',', $this->config->get('config_upload_allowed'));            
            foreach ($filetypes as $filetype) 
            {
               $allowed[] = trim($filetype);
            }
            */
            if (!in_array(utf8_substr(strrchr($filename, '.'), 1), $allowed)) {
               $this->error['paymentupload']  = $this->language->get('error_filetype');
            }
            
            if($this->request->files['paymentupload']['size']>1111000)
            {
               $this->error['paymentupload']  = $this->language->get('error_filesize');
            }
                     
            if ($this->request->files['paymentupload']['error'] != UPLOAD_ERR_OK) {
               $this->error['paymentupload'] = $this->language->get('error_upload_' . $this->request->files['paymentupload']['error']);
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