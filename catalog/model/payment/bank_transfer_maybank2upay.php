<?php 
class ModelPaymentBankTransferMaybank2upay extends Model {
  	public function getMethod($address, $total) {
		$this->language->load('payment/bank_transfer_maybank2upay');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('bank_transfer_maybank2upay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if ($this->config->get('bank_transfer_maybank2upay_total') > 0 && $this->config->get('bank_transfer_maybank2upay_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('bank_transfer_maybank2upay_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'bank_transfer_maybank2upay',
        		'title'      => $this->language->get('text_title'),
        		'icon_payment'=> $this->language->get('icon_payment'),
				'sort_order' => $this->config->get('bank_transfer_maybank2upay_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>