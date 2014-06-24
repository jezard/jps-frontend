<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload'); 
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$this->upload->initialize(array(
			'upload_path' => './uploads/',
			'allowed_types' => '*',
			'max_size'	=> 5000,
			'remove_spaces' => TRUE,
			'overwrite' => TRUE
		));


		if ($this->upload->do_multi_upload("powerfiles")) { // use same as you did in the input field
       		$return = $this->upload->get_multi_upload_data();
       		/*$this->load->view('upload_success', $data);*/
       	}

		else
		{
			$this->load->view('upload_form', $error);
		}
	
	}
}
?>
