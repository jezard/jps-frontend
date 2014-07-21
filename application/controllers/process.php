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
			
	
			//convert our xml file to json to help retain my sanity
			$ourJSON = $this->ParseXML($this->config->item('base_url').'uploads/'.$filename);
			$ourData = json_decode($ourJSON, true);

			$lapcount = 0;

			//top level loop
			foreach($ourData as $Activities){ 
				//level 2 etc...
				foreach($Activities as $Activity){

				  	$activityId = $Activity['Id'];
				  	$sport = $Activity['@attributes']['sport'];


				  	//add the activity to the db
					$activity = $this->user_file->add_activity($activityId, $this->email, $sport);

					//delete record from db
					if($activity > 0){
						if ($this->user_file->_deleteIntRec($filename).substr($filename,34))
						{
							$debug .= 'File ['.substr($filename,34).'] was sent for processing<br>';
						}

						//get laps for this activity
						$laps = $Activity['Lap'];

						//for each lap within activity
						foreach($laps as $lap){
							$lapnumber = $lapcount++;
							$timestamp = $lap['@attributes']['StartTime'];
							$duration = $lap['TotalTimeSeconds'];
						}
					}		  	
				}
			}

			print_r ($ourData);


		}
		else
		{
			echo 'File ['.substr($filename,34).'] could not be converted. We do not currently support files with extension '.$filetype.'. Skipping this file.<br>';
			//delete record of this file from intermediate table else we're going to keep trying to load a file that ain't there...
			$this->user_file->_deleteIntRec($filename);
		}
		
		

		echo $debug;
	}
	//http://lostechies.com/seanbiefeld/2011/10/21/simple-xml-to-json-with-php/
	protected function ParseXML ($url) {

		$fileContents= file_get_contents($url);

		$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);

		$fileContents = trim(str_replace('"', "'", $fileContents));

		$simpleXml = simplexml_load_string($fileContents);

		$json = json_encode($simpleXml);

		return $json;

	}


}
?>