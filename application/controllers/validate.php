<?php

class Validate extends CI_Controller {

	function index()
	{
		//get the user's validation link from their email
		$this->load->helper(array('form', 'url'));
		$validationLink = $this->input->get('vl');

		//load the user model
		$this->load->model('user_model', 'user', TRUE);

		//add to the database
		$email = $this->user->verify($validationLink);

		if($email)
		{
			$this->load->view('templates/header', array('title' => 'Verification successful - '.$this->config->item('site_name')));
			$this->load->view('signup_success', array('email' => $email));
			$this->load->view('templates/footer');
		}
		else
		{
			$this->load->view('templates/header', array('title' => 'Verification not successful - '.$this->config->item('site_name')));
			$this->load->view('verification_error');
			$this->load->view('templates/footer');
		}
	}
}
?>