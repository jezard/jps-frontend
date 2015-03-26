<?php

class Token_exchange extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
			if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){
				redirect('http://joulepersecond.com/activity', 'refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}

	}
	function index(){
		$access_token = trim($this->input->get('code'));
		$state = trim($this->input->get('state'));

		$url = "https://www.strava.com/oauth/token?";
		$fields = array(
				'client_id' => '4992',
				'client_secret' => '23d7ed5e568e57db69e88271218c8ae959489e75',
				'code' => $access_token
			);

		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { 
			$fields_string .= $key.'='.$value.'&'; 
		}
		$fields_string = rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);

		echo $result;


		//set strava access token
		/*$cookie = array(
		    'name'   => 'strava_token',
		    'value'  => $access_token,
		    'expire' => -100,
		    'domain' => $this->config->item('site_name'),
		    'prefix' => '',
		    'secure' => false
		);
		$this->input->set_cookie($cookie);
		switch ($state){
			case "connect":
				redirect('/myaccount', 'refresh');
				break;
			case "authorise":
				redirect('/activity', 'refresh');
				break;
		}*/

	}
}