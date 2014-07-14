<?php 
class User_file_model extends CI_Model{
	
	/*associate an uploaded file with its user as a database record*/
	function linkuser($email, $data){
		print_r($data);
		foreach($data as $fileinfo)
		{
			$filename =  $fileinfo['file_name'];

		}

	}
}