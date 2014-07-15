<?php

class Process extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}
	}

	//get user uploaded file references and parse file data to database record, and remove files from uploads dir
	function index()
	{
		//do the processing stuff

		//not sure whether to do a view at this point yet or whether this will all be ajaxed (preferred!)
		$this->load->view('templates/header', array('title' => 'Processing - '.$this->config->item('site_name')));
		$this->load->view('processing_file', array('error' => ' ' ));
		$this->load->view('templates/footer');
	}

	// ajaxhttp://joulepersecond.com/index.php/process/parse
	function parse()
	{
		echo 'do ajax load of data to database';
		return 0;
	}

}
?>