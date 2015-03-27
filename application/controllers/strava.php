<?php

class Strava extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->model('user_model', 'user', TRUE);
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
	function authorise(){
		$code = trim($this->input->get('code'));
		$state = trim($this->input->get('state'));

		$url = "https://www.strava.com/oauth/token?";
		$fields = array(
				'client_id' => '4992',
				'client_secret' => '23d7ed5e568e57db69e88271218c8ae959489e75',
				'code' => $code
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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);


		//close connection
		curl_close($ch);

		//$user_data contains all our user's strava data
		$user_data = json_decode(trim($result), true);

		//var_dump($user_data);
		$access_token = $user_data['access_token'];

		//set strava access token
		$this->user->set_strava_access_token($this->email, $access_token);

		
		switch ($state){
			case "connect":
				redirect('/myaccount', 'refresh');
				break;
			case "authorise":
				redirect('/activity', 'refresh');
				break;
			case "upload":
				//do upload stuff
				break;
		}

	}

	function upload(){
		$name = trim($this->input->post('name'));
		$description = trim($this->input->post('description'));
		$filename = trim('uploads/'.$this->input->post('file'));
		$actual_file = realpath($filename);

		//direct a user back to the account page if they don't have the strava connection
		$user_settings = $this->user->getSettings($this->email);
		if(!isset($user_settings['strava_access_token']) || $user_settings['strava_access_token'] == ''){
			redirect('/myaccount', 'refresh');
		}else{

			$url = "https://www.strava.com/api/v3/uploads?";
			$fields = array(
					'activity_type' => 'ride',
					'name' => $name,
					'description' => $description,
					'data_type' => 'tcx',
					"file" => '@' . $actual_file . ";type=application/xml"
				);
			
			//open connection
			$ch = curl_init();

			$headers = array('Authorization: Bearer ' . $user_settings['strava_access_token']);

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			//execute post
			$result = curl_exec($ch);

			//close connection
			curl_close($ch);

			$upload_status = json_decode(trim($result), true);

			if(isset($upload_status['id'])){
				echo $upload_status['id'];
			}else{
				echo 'error';
			}
		}
	}
}