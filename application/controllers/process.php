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

			
			function myRecordHandler($record)
			{
				//print_r($record);exit;
				/*print $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/ID"].' Activity ID<br>';
				print $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY-SPORT"].' Sport<br>';

				print $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP-STARTTIME"].' Lap start time<br>';
				print $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP/TOTALTIMESECONDS"].' Lap duration <br>';

			    print $record["TIME"].' Timestamp<br>';;
			    print $record["HEARTRATEBPM/VALUE"].' Heartrate<br>';
			    print $record["CADENCE"].' Cadence <br>';
			    print $record["EXTENSIONS/TPX/WATTS"].' Watts<br>';*/

			    global $mp_count;
			    global $mp_lapcount;
			    global $autoActivityID;
			    global $lapstart;

			    //* <-- item to be inserted into database(s)

			    $activityID = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/ID"];//*
				$sport = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY-SPORT"];//*

				$lastLap = $lapstart;
				$lapstart = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP-STARTTIME"];
				if($lastLap != $lapstart){
					$lapnumber = $mp_lapcount;//*

					$mp_lapcount++;
				}
				$lapduration = $record["./TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP/TOTALTIMESECONDS"];//*

			    $tpTimestamp = $record["TIME"];//*
			    $tpHeartRate = $record["HEARTRATEBPM/VALUE"].' Heartrate<br>';//*
			    $tpCadence = $record["CADENCE"];//*
			    $tpWatts = ["EXTENSIONS/TPX/WATTS"];//*

			    //if this is the first loop
			    if($mp_count == 0){
					$_SESSION['activity_id']=$activityID;
					$_SESSION['sport']=$sport;
				}
				$mp_count++;


				//let's write that data HERE!
				
			}
			/////////////////!!!!KEEP CLEAR!!!!\\\\\\\\\\\\\\\\\\
			//get a unique id
			function exact_time() {
			    $t = explode(' ',microtime());
			    return ($t[0] + $t[1]);
			}
			$autoActivityID = exact_time();//or time() if issues!

			//reset lap counter
			$mp_lapcount = 0;

			//remove the period
			$autoActivityID = str_replace('.', '', $autoActivityID);

			$result = MagicParser_parse($this->config->item('base_url').'uploads/'.$filename,"myRecordHandler","xml|TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP/TRACK/TRACKPOINT/");

			echo $_SESSION['activity_id'].' '.$_SESSION['sport'].' '.$autoActivityID.' '.$this->email.'...</br>';

			//add the activity to the db
			if($this->user_file->add_activity($autoActivityID, $_SESSION['activity_id'], $this->email, $_SESSION['sport']))
			{
				echo 'Record added to mysql database.<br>';
			}

			//unset the session vars
			unset($_SESSION['activity_id']);
			unset($_SESSION['sport']);


			if (!$result)
			{ 
				print MagicParser_getErrorMessage();
			}

			//delete the record of our file if all done...
			$this->user_file->_deleteIntRec($filename);

			/*
			Add the remaining info to the user_ativity database table
			*/
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