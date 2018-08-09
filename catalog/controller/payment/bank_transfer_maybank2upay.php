<?php
class ControllerPaymentBankTransferMaybank2upay extends Controller {
	protected function index() {
		$this->language->load('payment/bank_transfer_maybank2upay');
		
		$this->data['text_instruction'] = $this->language->get('text_instruction');
		$this->data['text_description'] = $this->language->get('text_description');
		$this->data['text_payment'] = $this->language->get('text_payment');
		$this->data['text_instructionhistory'] = $this->language->get('text_instructionhistory');
		$this->data['text_orderhistory'] = $this->language->get('text_orderhistory');
		$this->data['icon_payment'] = $this->language->get('icon_payment');
		
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->data['bank'] = nl2br($this->config->get('bank_transfer_maybank2upay_bank'));
		$this->data['bankinfo'] = nl2br($this->config->get('bank_transfer_maybank2upay_bankinfo_' . $this->config->get('config_language_id')));

		$this->data['continue'] = $this->url->link('checkout/success');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bank_transfer_maybank2upay.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/bank_transfer_maybank2upay.tpl';
		} else {
			$this->template = 'default/template/payment/bank_transfer_maybank2upay.tpl';
		}	
		
		$this->render(); 
	}
	
	public function confirm() {
		$this->language->load('payment/bank_transfer_maybank2upay');
		
		$this->load->model('checkout/order');
		
		$comment  = $this->language->get('text_instructionhistory') . "\n\n";
		$comment .= $this->language->get('text_orderhistory') . "\n\n";
		$comment .= $this->language->get('text_payment');
		
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('bank_transfer_maybank2upay_order_status_id'), $comment, true);
	}
}
?>