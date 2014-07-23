<?php 
class User_file_model extends CI_Model{
	
	/*associate an uploaded file with its user as a database record*/
	function linkuser($email, $data){
		foreach($data as $fileinfo)
		{
			$filename =  $fileinfo['raw_name'];
			$ext = $fileinfo['file_ext'];
			//swap converted file extensions
			if($ext == '.fit')
			{
				$ext = '.tcx';
			}
			$filename = $filename.$ext;

			//add record of file to database
			$this->email = $email;
			$this->filename = $filename;
			$this->filetype = $ext;
			$this->db->insert('user_file', $this);
		}
	}

	function getjobs($email){
		$jobs = [];
		$query = $this->db->query("SELECT DISTINCT filename, filetype FROM user_file WHERE email = '$email'");
		foreach($query->result_array() as $row){
			//array_push($jobs, $row['filename']);
			array_push($jobs, array('filename'=> $row['filename'], 'filetype' => $row['filetype']));
		}
		return $jobs;
	}

	function add_activity($uid, $date, $email, $type){
		//add the record
		$format = "Y-m-dTh:i:sZ";
		$timestamp = strtotime($date);
		$timestamp = date("Y-m-d h:i:s", $timestamp);
		$query = $this->db->query("INSERT IGNORE INTO user_activity (activity_id, activity_date, email, activity_type) VALUES ('$uid', '$timestamp','$email', '$type')");
		if($query)
		{
			return true;
		}
		return false;


	}

	//delete intermediate record
	function _deleteIntRec($filename){
		$this->db->where('filename', $filename);
        return $this->db->delete('user_file');//true one success or false on fail
	}

	//add a activity lap
	function addLap($activityID, $lapnumber, $timestamp, $duration){
		$format = "Y-m-dTh:i:sZ";
		$timestamp = strtotime($timestamp);
		$this->timestamp = date("Y-m-d h:i:s", $timestamp);
		$this->lap_number = $lapnumber;
		$this->lap_duration = $duration;
		$this->activity_id = $activityID;

		if($this->db->insert('lap', $this))
		{
			//return the lap id
			return $this->db->insert_id();
		}
		return false;
	}

	function writeToDb($lapID, $snapshotTime, $heartRate, $power, $cadence, $speed, $distance ){
		$this->lap_id = $lapID;
		$format = "Y-m-dTh:i:sZ";
		$snapshotTime = strtotime($snapshotTime);
		$this->snapshot_timestamp = date("Y-m-d h:i:s", $snapshotTime);
		$this->heart_rate = $heartrate;
		$this->power = $power;
		$this->cadence = $cadence;
		$this->speed = $speed;
		$this->distance = $distance;

		$this->db->insert('snapshot');
	}
}