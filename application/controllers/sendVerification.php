<?php
/*resend verification option*/


class SendVerification extends CI_Controller {


	function index()
	{
		$this->load->library('email');

		//send out validation email
                $email = $this->input->post('email');
                $this->email->from('no-reply@'.$this->config->item('site_name'), $this->config->item('site_name').' Admin');
                $this->email->to($email); 
                $this->email->subject('Validate your email - '.$this->config->item('site_name'));
                $this->email->message('Hi '.$this->username.'. Please click this link to valiate your email. '.$this->config->item('base_url').'/valdiate?'.do_hash($this->config->item('salt').this->db->insert_id()));  
                $this->email->send();
                //echo $this->email->print_debugger();


        /*no view for this yet*/
	}
}
?>
