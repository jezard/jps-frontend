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

	function add_activity($date, $email, $type){
		//add the record
		$format = "Y-m-dTh:i:sZ";
		$timestamp = strtotime($date);
		$this->activity_date = date("Y-m-d h:i:s", $timestamp);
		$this->email = $email;
		$this->activity_type = $type;
		$query = $this->db->query("INSERT IGNORE INTO user_activity (activity_date, email, activity_type) VALUES ('$this->activity_date','$this->email', '$this->activity_type')");
		if($query)
		{
			//return the activity id
			return TRUE;
		}
		
	}

	function _deleteIntRec($filename){
		$this->db->where('filename', $filename);
        return $this->db->delete('user_file');//true one success or false on fail
	}


}