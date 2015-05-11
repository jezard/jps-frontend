<?php

class Theme extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->return_url = $this->input->get('ret');
		if ($this->input->cookie('theme'))
		{
			$this->theme = $this->input->cookie('theme', false);
			if($this->theme == 'green'){
				$cookie = array(
				    'name'   => 'theme',
				    'value'  => 'gray',
				    'expire' => time() + (10 * 365 * 24 * 60 * 60),
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

			}else{
				$cookie = array(
				    'name'   => 'theme',
				    'value'  => 'green',
				    'expire' => time() + (10 * 365 * 24 * 60 * 60),
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);
			}
		}
		else
		{
			$cookie = array(
			    'name'   => 'theme',
			    'value'  => 'green',
			    'expire' => time() + (10 * 365 * 24 * 60 * 60),
			    'domain' => $this->config->item('site_name'),
			    'prefix' => '',
			    'secure' => false
			);
			$this->input->set_cookie($cookie);
			
		}
		
		
	}

	function index(){
		redirect($this->config->item('base_url').$this->return_url, 'refresh');
	}

}
?>