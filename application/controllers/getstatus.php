<?php
//a more secure way of determining whether a user has paid and much more difficult to hack
class Getstatus extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->model('user_model', 'user', TRUE);

		//read posted email address from analysis.go
		$this->email = urldecode($this->input->post('email'));

		$settings = $this->user->getsettings($this->email);

		//if user is paid and verified...
		if($settings['paid_account'] == 1 && $settings['verified'] == 1){
			//send back a salted hashed email if the user is subscribed and verified
			echo md5('and the email is: '.urlencode($this->email));
		}else{
			echo 'Not subscribed';
		}
	}
}