<?php

class Process extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'cookie'));
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}
		$this->load->model('user_file_model', 'user_file', TRUE);
	}

	//get user uploaded file references and parse file data to database record, and remove files from uploads dir
	function index()
	{
		$this->load->view('templates/header', array('title' => 'Processing - '.$this->config->item('site_name')));
		$this->load->view('processing_file', array('error' => ' ' ));
		$this->load->view('templates/footer');
	}

	// ajaxhttp://joulepersecond.com/index.php/process/joblist
	//get a list of jobs to process (any entries in intermediate table), and display results back to user
	function joblist(){
		//get a list of filenames
		$jobs = $this->user_file->getjobs($this->email);
		echo json_encode($jobs);
	}

	// ajaxhttp://joulepersecond.com/index.php/process/parse
	function parse()
	{
		//get the filename for the current job item
		$filename = $this->input->post('filename');
		$filetype = $this->input->post('filetype');

		if ($filetype == '.tcx'){
			$xmlDoc = new DOMDocument();
			$xmlDoc->load($this->config->item('base_url').'uploads/'.$filename);

			//get the id from the file
			$tagId = $xmlDoc->getElementsByTagName('Id');
			$activityId = $tagId->item(0)->nodeValue;

			//get the activity type
			$tagActivity = $xmlDoc->getElementsByTagName('Activity');
			$this->sport = $tagActivity->item(0)->getAttribute('Sport');

			$activityId = $this->user_file->add_activity($activityId, $this->email, $this->sport);

			if($activityId > 0){
				echo $this->user_file->_deleteIntRec($filename);
			}


			//do all the other stuff with the file laps, track info etc...


			//delete record from db


			/*$activities = $xmlDoc->getElementsByTagName('Activity');
			foreach($activities as $activity){
				//echo $activity->nodeValue, PHP_EOL;
				$this->sport = $activity->getAttribute('Sport');
			}*/



		}
	}

}
?>