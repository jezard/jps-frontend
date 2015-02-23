<?php
class Getstatus extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->model('user_model', 'user', TRUE);

		//get post request from analysis.go
		$this->email = urldecode($this->input->post('email'));

		$settings = $this->user->getsettings($this->email);
		if($settings['paid_account'] == 1 && $settings['verified'] == 1){
			//send back a salted hashed email if the user is subscribed and verified
			echo md5('and the email is: '.urlencode($this->email));
		}else{
			echo 'Not subscribed';
		}
	}
}