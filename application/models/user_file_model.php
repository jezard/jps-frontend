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
		$jobs = array();
		$query = $this->db->query("SELECT DISTINCT filename, filetype FROM user_file WHERE email = '$email'");
		foreach($query->result_array() as $row){
			//array_push($jobs, $row['filename']);
			array_push($jobs, array('filename'=> $row['filename'], 'filetype' => $row['filetype']));
		}
		return $jobs;
	}

	function add_activity($uid, $date, $email, $type, $filename){
		//add the record
		$format = "Y-m-dTH:i:sZ";
		$timestamp = strtotime($date);
		$timestamp = date("Y-m-d H:i:s", $timestamp);
		$query = $this->db->query("INSERT IGNORE INTO user_activity (activity_id, activity_date, email, activity_type, filename) VALUES ('$uid', '$timestamp','$email', '$type', '$filename')");
		if($query)
		{
			return true;
		}
		return false;
	}

	function delete_activity_by_id($id){
		$this->db->query("DELETE * FROM user_activity WHERE activity_id = '$id' LIMIT 1");
	}
	function delete_activity_by_filename($id){
		$this->db->query("DELETE * FROM user_activity WHERE filename = '$id' LIMIT 1");
	}

	function get_recent_activities($email){
		$activities = array();
		$query = $this->db->query("SELECT * FROM user_activity WHERE email = '$email'  ORDER BY activity_date DESC");
		foreach($query->result_array() as $row){
			array_push($activities, array('activity_id'=> $row['activity_id'], 'activity_date' => $row['activity_date'], 'activity_name' => $row['activity_name'], 'activity_type' => $row['activity_type']));
		}
		return $activities;
	}

	function get_activity_basic($id){
		$query = $this->db->query("SELECT * FROM user_activity WHERE activity_id = '$id'");
		foreach($query->result_array() as $row){
			$activity_title = $row['activity_name'];
			$activity_notes = $row['activity_notes'];
			$activity_date = $row['activity_date'];
		}
		echo $activity_title.'^'.$activity_notes.'^'.$activity_date;
	}

	function update_basic($id, $name, $notes){
		$query = $this->db->query("UPDATE user_activity SET activity_name = ".$this->db->escape($name).", activity_notes = ".$this->db->escape($notes)."  WHERE activity_id = '$id'");
	}

	//delete intermediate record
	function _deleteIntRec($filename){
		$this->db->where('filename', $filename);
        return $this->db->delete('user_file');//true one success or false on fail
	}

}