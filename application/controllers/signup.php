<?php

class Signup extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Signup - JoulePerSecond'));
			$this->load->view('signup_form');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->load->view('templates/header', array('title' => 'Signup - JoulePerSecond'));
			$this->load->view('signup_success');
			$this->load->view('templates/footer');
		}
	}
}
?>