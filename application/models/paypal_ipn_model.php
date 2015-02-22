<?php 
class Paypal_ipn_model extends CI_Model{
	function store($data){
		//insert record to database
    	$this->item_name = $data['item_name'];
    	$this->item_number = $data['item_number'];
    	$this->payment_status = $data['payment_status'];
    	$this->payment_currency = $data['payment_currency'];
    	$this->payment_email = $data['payer_email'];
    	$this->txn_type = $data['txn_type'];

    	$this->db->insert('paypal_ipn', $this);
	}
}