<?php

class Forgottenpassword extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Password reset - '.$this->config->item('site_name')));
			$this->load->view('password_reset', array('message' => 'Please check your email for your password reset link'));
			$this->load->view('templates/footer');
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//get the user's details
			$accountexists = $this->user->accountexists();
			if($accountexists)
			{
				//send email
				//send out validation email
    			$this->load->library('email');

		        $email = $this->input->post('email');
		        $this->email->from('no-reply@'.$this->config->item('site_name'), 'Jeremy');
		        $this->email->to($email); 
		        $this->email->subject('Validate your email - '.$this->config->item('site_name'));
		        $this->email->message('Please use this link to validate your email. '.$this->config->item('base_url').'index.php/passwordreset?vl='.do_hash($this->config->item('salt').$email));  
		        $this->email->send();
		        //echo $this->email->print_debugger();//remove for production
			}
			else
			{
				$this->load->view('templates/header', array('title' => 'Account does not exist - '.$this->config->item('site_name')));
				$this->load->view('password_reset', array('message' => 'Account does not exist - Try another email address'));
				$this->load->view('templates/footer');
			}
		}

		
	}
}
?>