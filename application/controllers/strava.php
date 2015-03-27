<?php

class Strava extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->model('user_model', 'user', TRUE);
		$this->load->model('user_activity_model', 'user_activity', TRUE);
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
		$activity_id = trim($this->input->post('activity_id'));
		$activity = $this->user_activity->get_activity($activity_id);

		$name = trim($this->input->post('name'));
		$description = trim($this->input->post('description'));
		$filename = trim('uploads/'.$activity['filename']);
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
				$this->user_activity->set_strava_upload_id($activity_id, $upload_status['id']);
				echo 'uploading';
			}else{
				echo 'error';
			}
		}
	}

	function upload_status(){
		$activity_id = trim($this->input->post('activity_id'));
		$strava_upload_id = trim($this->user_activity->get_strava_upload_id($activity_id));
		$user_settings = $this->user->getSettings($this->email);

		if(isset($strava_upload_id) && $strava_upload_id != ''){
			$url = "https://www.strava.com/api/v3/uploads/".$strava_upload_id;

			//open connection
			$ch = curl_init();

			$headers = array('Authorization: Bearer ' . $user_settings['strava_access_token']);

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			//execute post
			$result = curl_exec($ch);

			//close connection
			curl_close($ch);

			$upload_status = json_decode(trim($result), true);

			if(isset($upload_status['activity_id'])){
				$this->user_activity->set_strava_activity_id($activity_id, $upload_status['activity_id']);
				echo $upload_status['status'].' View it on <a href="https://www.strava.com/activities/'.$upload_status['activity_id'].'"><span style="color:#FB4B02; font-weight:bold; letter-spacing: -1px" target="_blank">STRAVA</span></a>'.'^success';
			}elseif(isset($upload_status['error'])){
				echo '<span style="color:#FB4B02; font-weight:bold; letter-spacing: -1px" target="_blank">STRAVA</span> message: '.$upload_status['status'].': '.$upload_status['error'].'^failed';
			}else{
				echo '<span style="color:#FB4B02; font-weight:bold; letter-spacing: -1px" target="_blank">STRAVA</span> message: '.$upload_status['status'].'^polling';
			}
		}

	}
}