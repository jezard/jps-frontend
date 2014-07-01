<?php

class Replacepassword extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password','Password','trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Password reset - JoulePerSecond'));
			$this->load->view('new_password_form');
			$this->load->view('templates/footer');
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//add to the database
			if($this->user->updatepassword())
			{
				$this->load->view('templates/header', array('title' => 'Home - JoulePerSecond'));
				$this->load->view('front_page');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->load->view('templates/header', array('title' => 'Password reset - JoulePerSecond'));
				$this->load->view('new_password_form');
				$this->load->view('templates/footer');
			}
		}	
	}
}
?>