<?php 
class User_file_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		//load the model
		$this->load->helper('cookie');
	}

	/*associate an uploaded file with its user as a database record*/
	function linkuser($filename, $filetype){
		
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
			$this->filename = $filename;
			$this->filetype = $filetype;

			$this->db->insert('user_file', $this);

			//return id
    		return $this->db->insert_id();
		}
	}
}