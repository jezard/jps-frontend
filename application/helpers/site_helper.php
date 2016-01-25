<?php


	function get_user(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
     	//$CI->load->model('user_model', 'user', TRUE);
		$email = $CI->session->userdata('email');
		if($email != ""){
			return $email;
		}else{
			return "";
		}
	}
	function get_token(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$access_token = $CI->session->userdata('access_token');
		return $access_token;
	}
	function is_social(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
     	return $CI->session->userdata('is_social');
	}
	function set_user($email, $is_social, $access_token){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->set_userdata(array('email'=>$email, 'is_social'=>$is_social, 'access_token'=>$access_token));
	}
	function unset_user(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->unset_userdata('email');
		$CI->session->unset_userdata('is_social');
		$CI->session->unset_userdata('remember');
		$CI->session->unset_userdata('access_token');
	}
	function remember_user($choice = false){
 		$CI =& get_instance();
 		$CI->load->library('session'); // load library 
      	$CI->session->set_userdata(array('remember'=>$choice));
 	}

?>
