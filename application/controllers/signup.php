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
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//add to the database
			if($this->user->add())
			{
    			//send out validation email
    			$this->load->library('email');

		        $email = $this->input->post('email');
		        $username = $this->input->post('username');
		        $this->email->from('no-reply@joulepersecond.com', 'Jeremy');
		        $this->email->to($email); 
		        $this->email->subject('Validate your email - JoulePerSecond.com');
		        $this->email->message('Hi '.$username.'. Please use this link to valiate your email. http://joulepersecond.com/index.php/validate?vl='.do_hash('powerpeakjoulepersecond1973'.$email));  
		        $this->email->send();
		        echo $this->email->print_debugger();

				$this->load->view('templates/header', array('title' => 'Verification sent! - JoulePerSecond'));
				$this->load->view('verification_sent', array('email' => $email));
				$this->load->view('templates/footer');
			}
			//on database error
			else
			{
				$this->load->view('templates/header', array('title' => 'Database error - JoulePerSecond'));
				$this->load->view('signup_form');
				$this->load->view('templates/footer');
			}	
		}
	}
}
?>