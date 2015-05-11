<?php

class Signup extends CI_Controller {


	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'alpha_dash|max_length[50]|required');
		$this->form_validation->set_rules('password','Password','trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Signup - '.$this->config->item('site_name')));
			$this->load->view('signup_form');
			$this->load->view('templates/footer');
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			$message = "";
			if($this->user->usernameexists())
			{
				$message = "<script>alert('An account with username ".$this->input->post('username')." already exists!');</script>";
				$this->load->view('templates/header', array('title' => 'Signup - '.$this->config->item('site_name')));
				$this->load->view('signup_form', array('message' => $message));
				$this->load->view('templates/footer');
				return;
			}

			if($this->user->accountexists())
			{
				$message = "<script>alert('An account with email ".$this->input->post('email')." already exists!');</script>";
				$this->load->view('templates/header', array('title' => 'Signup - '.$this->config->item('site_name')));
				$this->load->view('signup_form', array('message' => $message));
				$this->load->view('templates/footer');
				return;
			}
			
			//add to the database
			if($this->user->add())
			{
    			//send out validation email
    			$this->load->library('email');

		        $email = $this->input->post('email');
		        $username = $this->input->post('username');
		        $this->email->from('no-reply@'.$this->config->item('site_name'), $this->config->item('site_name').' Admin');
		        $this->email->to($email, "admin@joulepersecond.com"); 
		        $this->email->subject('Please validate your email - '.$this->config->item('site_name'));
		        $this->email->message('Hi '.$username.'. Please use this link to validate your email. '.$this->config->item('base_url').'index.php/validate?vl='.do_hash($this->config->item('salt').$email));  
		        $this->email->send();
		        //echo $this->email->print_debugger();//remove for production

				$this->load->view('templates/header', array('title' => 'Verification sent! - '.$this->config->item('site_name')));
				$this->load->view('verification_sent', array('email' => $email));
				$this->load->view('templates/footer');
			}
			//on database error
			else
			{
				$this->load->view('templates/header', array('title' => 'Database error - '.$this->config->item('site_name')));
				$this->load->view('signup_form');
				$this->load->view('templates/footer');
			}	
		}
	}
}
?>