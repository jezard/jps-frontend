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
	function is_social(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
     	return $CI->session->userdata('is_social');
	}
	function set_user($email, $is_social){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->set_userdata(array('email'=>$email, 'is_social'=>$is_social));
	}
	function unset_user(){
		$CI =& get_instance();
     	$CI->load->library('session'); // load library 
		$CI->session->unset_userdata('email');
		$CI->session->unset_userdata('is_social');
		$CI->session->unset_userdata('remember');
	}
	function remember_user($choice = false){
 		$CI =& get_instance();
 		$CI->load->library('session'); // load library 
      	$CI->session->set_userdata(array('remember'=>$choice));
 	}

	function loadUser($id){
		$CI =& get_instance();
		$CI->load->library('session'); // load library 
		$CI->load->helper('cookie');
		//load the user model
		$CI->load->model('user_model', 'user', TRUE);

		//reset the remember cookie
		if($CI->session->userdata('remember')){
			$expire = (10 * 365 * 24 * 60 * 60);
			$cookie = array(
				'name'   => 'remember',
				'value'  => 'Yes',
				'expire' => (10 * 365 * 24 * 60 * 60),
				'domain' => $CI->config->item('site_name'),
				'prefix' => '',
				'secure' => false
			);
			$CI->input->set_cookie($cookie);	
		}else{
			$expire = -100;
		}
	
		/*secured user cookie - used mainly for go operations*/
		$cookie = array(
		    'name'   => 's_valid_user',
		    'value'  => rc4($CI->config->item('rc4_cypher'), $id),
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);
		//set the session var
		$is_social = false;
		set_user($id, $is_social);

		$cookie = array(
		    'name'   => 'social_user',
		    'value'  => 'no',
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		//create the settings cookies
		$settings = $CI->user->getsettings($id);

		$cookie = array(
		    'name'   => 'paid_account',
		    'value'  => $settings['paid_account'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'set_autofill',
		    'value'  => $settings['set_autofill'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'set_ncp_rolloff',
		    'value'  => $settings['set_ncp_rolloff'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_gender',
		    'value'  => $settings['my_gender'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'set_data_cutoff',
		    'value'  => $settings['set_data_cutoff'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_mhr',
		    'value'  => $settings['my_mhr'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_rhr',
		    'value'  => $settings['my_rhr'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_vo2',
		    'value'  => $settings['my_vo2'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_weight',
		    'value'  => $settings['my_weight'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_thr',
		    'value'  => $settings['my_thr'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_ftp',
		    'value'  => $settings['my_ftp'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);

		$cookie = array(
		    'name'   => 'my_age',
		    'value'  => $settings['my_age'],
		    'expire' => $expire,
		    'domain' => $CI->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$CI->input->set_cookie($cookie);
	}
?>
