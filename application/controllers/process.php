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


		//let's write that data HERE!
		/**/

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
					$_SESSION['activity_id']=$activityID;
					$_SESSION['sport']=$sport;
				}
				$mp_count++;


				//convert to Cassandra acceptable timestamp...
				$lapstartCassa = strtotime($lapstart)*1000;
				$tpTimestampCassa = strtotime($tpTimestamp)*1000;

				$theUID = $_SESSION['autoActivityID'];



				//create a unique key
				$PK = md5($theUID.$tpTimestampCassa);

				//cql 
				$_SESSION['joulepersecdata'] .= "INSERT INTO activity_data (key, activity_id, lap_number, lap_start, tp_cadence, tp_heartrate, tp_timestamp, tp_watts ) VALUES ('$PK', $theUID, $lapnumber, $lapstartCassa, $tpCadence, $tpHeartRate, $tpTimestampCassa, $tpWatts);".PHP_EOL;

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
			$_SESSION['autoActivityID'] = $autoActivityID;
			$_SESSION['joulepersecdata'] = '';
			/*********************
			*
			* Fanfare please...!
			*
			*********************/
			$result = MagicParser_parse($this->config->item('base_url').'uploads/'.$filename,"myRecordHandler","xml|TRAININGCENTERDATABASE/ACTIVITIES/ACTIVITY/LAP/TRACK/TRACKPOINT/");
			// stand at ease.



			//echo $_SESSION['activity_id'].' '.$_SESSION['sport'].' '.$autoActivityID.' '.$this->email.'...</br>';

			//add the activity to the db
			if($this->user_file->add_activity($autoActivityID, $_SESSION['activity_id'], $this->email, $_SESSION['sport']))
			{
				//echo 'Record added to mysql database.<br>';
			}

			//output
			echo $_SESSION['joulepersecdata']; 

			//unset the session vars
			unset($_SESSION['activity_id']);
			unset($_SESSION['sport']);
			unset($_SESSION['autoActivityID']);
			unset($_SESSION['joulepersecdata']);

	
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