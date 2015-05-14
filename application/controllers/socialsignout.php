<?php

class Socialsignout extends CI_Controller {

	function index()
	{
		$this->load->helper(array('cookie','url'));

		delete_cookie('valid_user', $this->config->item('site_name'),'/', '');
		delete_cookie('s_valid_user', $this->config->item('site_name'),'/', '');
		delete_cookie('social_user', $this->config->item('site_name'),'/', '');
		delete_cookie('paid_account', $this->config->item('site_name'),'/', '');

		$this->load->view('templates/header', array('title' => 'Log out of social - '.$this->config->item('site_name')));
		$this->load->view('social_signout');
		$this->load->view('templates/footer');

		//bit stubborn so refresh if cookie not deleted!
		if($this->input->cookie('valid_user'))
			redirect('socialsignout', 'refresh');
	}
}
?>