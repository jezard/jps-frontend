<?php 
class Paypal_ipn_model extends CI_Model{
	function store($data){
		//insert record to database
		$this->user_id = $data['user_id'];
    	$this->item_name = $data['item_name'];
    	$this->item_number = $data['item_number'];
    	$this->payment_status = $data['payment_status'];
    	$this->payment_amount = $data['payment_amount'];
    	$this->payment_currency = $data['payment_currency'];
    	$this->payer_email = $data['payer_email'];
    	$this->txn_type = $data['txn_type'];
    	$this->txn_id = $data['txn_id'];

    	$this->db->insert('paypal_ipn', $this);
	}
}