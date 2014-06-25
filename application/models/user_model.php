<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
    }
    

    function add(){
    	$this->username = $this->input->post('username');
    	$password = $this->input->post('password');
    	$this->password = do_hash('powerpeakjoulepersecond1973'.$password);
    	$this->email = $this->input->post('email');

    	$this->db->insert('user', $this);
    	return $this->db->insert_id();
    }
    function validate(){

    }
}
?>