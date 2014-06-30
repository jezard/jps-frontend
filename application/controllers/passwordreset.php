<?php

class Passwordreset extends CI_Controller {

	function index()
	{
		//get the user's validation link from their email
		$this->load->helper(array('form', 'url'));
		$validationLink = $this->input->get('vl');	

		//load the user model
		$this->load->model('user_model', 'user', TRUE);

		//add to the database
		$email = $this->user->exists($validationLink);

		if($email)
		{
			$this->load->view('templates/header', array('title' => 'Verification successful - JoulePerSecond'));
			$this->load->view('new_password_form', array('email' => $email));
			$this->load->view('templates/footer');
		}
		else
		{
			$this->load->view('templates/header', array('title' => 'Verification not successful - JoulePerSecond'));
			$this->load->view('passworderror');
			$this->load->view('templates/footer');
		}
	}
}
?>