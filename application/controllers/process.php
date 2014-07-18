<?php
error_reporting(E_ERROR);
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
		$debug = '';

		//get the filename for the current job item
		$filename = $this->input->post('filename');
		$filetype = $this->input->post('filetype');

		$fileok = false;
		$readok = false;



		if ($filetype == '.tcx'){
			$xmlDoc = new DOMDocument();

			//try to load file
			$fileloaded = $xmlDoc->load($this->config->item('base_url').'uploads/'.$filename);
			if($fileloaded)
			{
				$fileok = true;
			}
			else{
				echo 'Error: File ['.substr($filename,34).'] could not be loaded. It may be corrupted. Skipping this file.<br>';
				//delete record of this file from intermediate table else we're going to keep trying to load a file that ain't there...
				$this->user_file->_deleteIntRec($filename);
			}
			
			if($fileok){
				//handle error created by a bad file during parsing
				register_shutdown_function( "parseError" );
				//try to read the file

				//get the id from the file
				$tagId = $xmlDoc->getElementsByTagName('Id');
				$activityId = $tagId->item(0)->nodeValue;

				//get the activity type
				$tagActivity = $xmlDoc->getElementsByTagName('Activity');
				$this->sport = $tagActivity->item(0)->getAttribute('Sport');

				$readok = true;
			}

					
			//if basic file reading was ok
			if($readok){
				$activityId = $this->user_file->add_activity($activityId, $this->email, $this->sport);

				//delete record from db
				if($activityId > 0){
					if ($this->user_file->_deleteIntRec($filename).substr($filename,34))
					{
						$debug .= 'File ['.substr($filename,34).'] was sent for processing<br>';
					}
				}


				//do all the other stuff with the file laps, track info etc...

				// we should also make sure we DON'T duplicate activities in the user_activity table - or devise some other functionality to ensure this works!

				/******************************************************************************************
				*                                                                                         *
				*                                                                                         *
				*                                                                                         *
				*                                                                                         *
				*                                                                                         *
				*                                                                                         *
				*                                                                                         *
				******************************************************************************************/
			}

		}
		else
		{
			echo 'File ['.substr($filename,34).'] could not be converted. We do not currently support files with extension '.$filetype.'. Skipping this file.<br>';
			//delete record of this file from intermediate table else we're going to keep trying to load a file that ain't there...
			$this->user_file->_deleteIntRec($filename);
		}
		

		function parseError(){
		    'File: ['.substr($filename,34).'] could not be read. Please ensure it is an activity file, rather than a course file, and try again';
		}
		echo $debug;
	}

}
?>