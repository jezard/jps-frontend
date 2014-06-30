<?php
/*resend verification option*/


class SendVerification extends CI_Controller {


	function index()
	{
		$this->load->library('email');

		//send out validation email
        $email = $this->input->post('email');
        $this->email->from('no-reply@joulepersecond.com', 'Jeremy');
        $this->email->to($email); 
        $this->email->subject('Validate your email - JoulePerSecond.com');
        $this->email->message('Hi '.$this->username.'. Please click this link to valiate your email. http://joulepersecond.com/valdiate?'.do_hash('powerpeakjoulepersecond1973'.$this->db->insert_id()));  
        $this->email->send();
        echo $this->email->print_debugger();


        /*no view for this yet*/
	}
}
?>
