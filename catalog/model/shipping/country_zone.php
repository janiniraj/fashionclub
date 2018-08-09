<?php
class ModelShippingCountryZone extends Model {
	function getQuote($address) {
	    $costs = $this->getCosts( $address['country_id'], $address['zone_id']); 
	    
	    $this->language->load('shipping/country_zone');

		$method_data = array();
	
		if (is_array($costs)) {
		    $items = 0;
		    	
		    foreach ($this->cart->getProducts() as $product) {
		        if ($product['shipping']) $items += $product['quantity'];
		    }
		    
		    $cost = $costs['first'] + $costs['next'] * ($items - 1);
		    
			$quote_data = array();
			
      		$quote_data['country_zone'] = array(
        		'code'         => 'country_zone.country_zone',
        		'title'        => $this->language->get('text_description'),
        		'cost'         => $cost, 
        		'tax_class_id' => $costs['tax_class_id'],
				'text'         => $this->currency->format( $this->tax->calculate($cost, $costs['tax_class_id'], $this->config->get('config_tax')))
      		);

      		$method_data = array(
        		'code'       => 'country_zone',
        		'title'      => $this->language->get('text_title'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('country_zone_sort_order'),
        		'error'      => false
      		);
		}
	
		return $method_data;
	}
	
	protected function getCosts($country_id, $zone_id)
	{
	    $country_zone_cost = $this->config->get('country_zone_cost');
	    foreach($country_zone_cost as $czc)
	    {
	        if ($czc['country_id'] == $country_id && ($czc['zone_id'] == $zone_id || $czc['zone_id'] == 0) )
	        {
	            return $czc;
	        }
	    }
	    return null; 
	}
}
?>