<?php

class Login extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Login - '.$this->config->item('site_name')));
			$this->load->view('login_form');
			$this->load->view('templates/footer');
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//get the user's details
			$details = $this->user->validate();


			if($details)
			{
				$expire = (10 * 365 * 24 * 60 * 60);
				if(isset($_POST['remember'])){
					$cookie = array(
						'name'   => 'remember',
					    'value'  => 'Yes',
					    'expire' => $expire,
					    'domain' => $this->config->item('site_name'),
					    'prefix' => '',
					    'secure' => false
				    );
				    $this->input->set_cookie($cookie);
				    remember_user(true);
				}else{
					$expire = -100;
					remember_user(false);
				}
			
				/*secured user cookie - used mainly for go operations*/
				$cookie = array(
				    'name'   => 's_valid_user',
				    'value'  => rc4($this->config->item('rc4_cypher'), $details[2]),
				    'expire' => $expire,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);
				//set the session var
				$is_social = false;
				set_user($details[2], $is_social);

				$cookie = array(
				    'name'   => 'social_user',
				    'value'  => 'no',
				    'expire' => $expire,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				//create the settings cookies
				$settings = $this->user->getsettings($details[2]);

				$cookie = array(
				    'name'   => 'paid_account',
				    'value'  => $settings['paid_account'],
				    'expire' => $expire,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				
				//go to the uploads page
				redirect('/upload', 'refresh');

			}
			else
			{
				$this->load->view('templates/header', array('message' => 'Incorrect login', 'title' => 'Login Incorrect - '.$this->config->item('site_name')));
				$this->load->view('login_form');
				$this->load->view('templates/footer');
			}
		}
	}
}

?>