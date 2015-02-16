<?php

error_reporting(E_ERROR);
require($_SERVER['DOCUMENT_ROOT']."/MagicParser.php");
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

	function failed(){
		$filename = $this->input->post('filename');
		$this->user_file->delete_activity_by_filename($filename);
	}

	
	// ajaxhttp://joulepersecond.com/index.php/process/parse
	function parse()
	{

		$debug = '';

		//get the filename for the current job item
		$filename = $this->input->post('filename');
		$filetype = $this->input->post('filetype');
		$email = $this->email;

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
			/////////////////!!!!KEEP CLEAR!!!!\\\\\\\\\\\\\\\\\\
			//reset lap counter
			$mp_lapcount = 0;
			//remove the period
			$_SESSION['ActivityID'] = '';
			$_SESSION['ActivityKey'] = '';
			$_SESSION['joulepersecdata'] = '';
			$_SESSION['UserKey'] = $email;
			$_SESSION['filename'] = $filename;


			/*********************************************************************************************************
			*
			* Fanfare please...! Function call to myRecordHandler and recursive function myRecordHandler
			*
			*********************************************************************************************************/
			function myRecordHandler($record)
			{
				//print_r($record);exit;

			    global $mp_count;
			    global $mp_lapcount;
			    global $lapstart;

			    //get higher level non repeating nodes
			    $activityID = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/ID"];
				$sport = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY-SPORT"];

				//increment lap number if new lap timestamp
				$lastLap = $lapstart;
				$lapstart = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP-STARTTIME"];
				if($lastLap != $lapstart){
					$lapnumber = $mp_lapcount;
					$mp_lapcount++;
				}
				else
				{
					$lapnumber = $mp_lapcount;
				}


			    $tpTimestamp = $record["TIME"];

			    //clean up missing records
			    if($record["HEARTRATEBPM/VALUE"])
		    	{
		    		$tpHeartRate = $record["HEARTRATEBPM/VALUE"];
		    	}
			    else 
			    {
			    	$tpHeartRate = '0';//no null/empty valls
			    }

			    if($record["CADENCE"])
		    	{
		    		$tpCadence = $record["CADENCE"];
		    	}
			    else 
			    {
			    	$tpCadence = '0';//no null/empty valls
			    }

			    if($record["EXTENSIONS/TPX/WATTS"])
		    	{
		    		$tpWatts = $record["EXTENSIONS/TPX/WATTS"];
		    	}
			    else 
			    {
			    	$tpWatts = '0';//no null/empty valls
			    }


			    //if this is the first loop record this info...
			    if($mp_count == 0){
			    	/**
			    	* We use sessions to store data extracted from this recursive function
			    	*/
					$_SESSION['ActivityID']=$activityID;
					$_SESSION['ActivityKey'] = md5($_SESSION['ActivityID'].$_SESSION['UserKey']);//concatenate user and activity IDs to ensure uniqueness of user activity
					$_SESSION['sport']=$sport;
				}
				$mp_count++;

				$PK = $_SESSION['ActivityKey'];

				//convert to Cassandra acceptable timestamp...
				$lapstartCassa = strtotime($lapstart)*1000;
				$tpTimestampCassa = strtotime($tpTimestamp)*1000;

				//cql 
				//Again we use a session to store this row which represents 1 sample point 
				$_SESSION['joulepersecdata'] .= "INSERT INTO joulepersecond.activity_data (activity_id, tp_cadence, tp_heartrate, tp_timestamp, tp_watts, lap_start, lap_number) VALUES ( '$PK', $tpCadence, $tpHeartRate, $tpTimestampCassa, $tpWatts, $lapstartCassa, $lapnumber);".PHP_EOL;

			}
			$result = MagicParser_parse($this->config->item('base_url').'uploads/'.$filename,"myRecordHandler","xml|TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP/TRACK/TRACKPOINT/");
			/*********************************************************************************************************
			*
			* End of recursive section
			*
			*********************************************************************************************************/
			

			//add the activity to the db
			if($this->user_file->add_activity($_SESSION['ActivityKey'], $_SESSION['ActivityID'], $_SESSION['UserKey'], $_SESSION['sport'], $_SESSION['filename']))
			{
				//echo 'Record added to mysql database.<br>';
			}

			$insert_data = $_SESSION['joulepersecdata'];

			//output
			//detect os for dev mainly
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			    //create the CQL filepath
				$CQLfilename = 'C:/Users/Administrator/git-projects/jps-frontend/temp/'.$_SESSION['ActivityKey'].'.cql';	
			} else {
			    //set paths
				$CQLfilename = '/var/www/jps-frontend/temp/'.$_SESSION['ActivityKey'].'.cql';
			}

			//add the CQL insert statements to the .cql file
			file_put_contents($CQLfilename, $insert_data);

			//make url acceptable
			$CQLfilenamePiped = str_replace("/", "|", $CQLfilename);
			//execute the insert at Golang app
			$ch = curl_init("http://joulepersecond.com:8080/process/file/".$CQLfilenamePiped);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);

			curl_close($ch);
			unlink($CQLfilename);

			echo $_SESSION['ActivityKey'];

			//Log
			$logfile = $this->config->item('log_file');
			$message = '[CASSANDRA CQL]'.date("Y-m-d H:i:s").' User: '.$this->email.' Message: '.$cassa_return.PHP_EOL;
			file_put_contents($logfile, $message, FILE_APPEND);

			

			//unset the session vars
			unset($_SESSION['activity_id']);
			unset($_SESSION['sport']);
			unset($_SESSION['ActivityID']);
			unset($_SESSION['ActivityKey']);
			unset($_SESSION['joulepersecdata']);
			unset($_SESSION['filename']);

			if (!$result)
			{ 
				print MagicParser_getErrorMessage();
			}

			//delete the record of our file if all done...
			$this->user_file->_deleteIntRec($filename);

		}
		else
		{
			echo 'File ['.substr($filename,34).'] could not be converted. We do not currently support files with extension '.$filetype.'. Skipping this file.<br>';
			//delete record of this file from intermediate table else we're going to keep trying to load a file that ain't there...
			$this->user_file->_deleteIntRec($filename);
		}
		echo $debug;

		
	}
}

?>