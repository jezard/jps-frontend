<?php
/*
 * RC4 symmetric cipher encryption/decryption
 *
 * @license Public Domain
 * @param string key - secret key for encryption/decryption
 * @param string str - string to be encrypted/decrypted
 * @return string
 */
	function rc4($key, $str) {
		$s = array();
		for ($i = 0; $i < 256; $i++) {
			$s[$i] = $i;
		}
		$j = 0;
		for ($i = 0; $i < 256; $i++) {
			$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
		}
		$i = 0;
		$j = 0;
		$res = '';
		for ($y = 0; $y < strlen($str); $y++) {
			$i = ($i + 1) % 256;
			$j = ($j + $s[$i]) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
			$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
		}
		return $res;
	}

	function get_user(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$email = $CI->session->userdata('email');
		if($email != ""){
			return $email;
		}else{
			return "";
		}
	}
	function set_user($email){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->set_userdata(array('email'=>$email));
	}
	function unset_user(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->unset_userdata('email');
	}
	function remember_user($choice = 0){
		$CI =& get_instance();
		$CI->load->library('session'); // load library 
     	$CI->session->set_userdata(array('remember'=>$choice));
     	if($choice == 0){
     		return $CI->session->userdata('remember');
     	}
	}
?>
