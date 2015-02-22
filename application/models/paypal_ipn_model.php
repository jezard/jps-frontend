<?php 
class Paypal_ipn_model extends CI_Model{
	function store(){
		//insert record to database
    	$this->item_name = $this->input->post('item_name');
    	$this->item_number = $this->input->post('item_number');
    	$this->payment_status = $this->input->post('payment_status');
    	$this->payment_currency = $this->input->post('payment_currency');
    	$this->payment_email = $this->input->post('payment_email');
    	$this->txn_type = $this->input->post('txn_type');

    	$this->db->insert('paypal_ipn', $this);
	}
}