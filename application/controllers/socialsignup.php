<?php

class Socialsignup extends CI_Controller {


	function index()//via ajax
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			echo "Not enough data supplied";
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//add to the database
			if($this->user->addViaSocialUser())
			{
    			//send out validation email
    			$this->load->library('email');

		        $email = $this->input->post('email');
		        $username = $this->input->post('username');
		        
		        $this->email->from('no-reply@'.$this->config->item('site_name'), $this->config->item('site_name').' Admin');
		        $this->email->to($email, "admin@wizard.technology"); 
		        $this->email->subject('Welcome to '.$this->config->item('site_name'));
		        $this->email->message('Hi '.$username.'. Thank you for signing up with JoulePerSecond.com via your Google account. Many thanks, Jeremy');  
		        $this->email->send();
		        //echo $this->email->print_debugger();//remove for production

				echo "success";
			}
			//on database error
			else
			{
				echo "Database error";
			}	
		}
	}
}
?>