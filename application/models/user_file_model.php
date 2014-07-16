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
		$query = $this->db->query("SELECT DISTINCT filename FROM user_file WHERE email = '$email'");
		foreach($query->result_array() as $row){
			array_push($jobs, $row['filename']);
		}
		return $jobs;
	}
}