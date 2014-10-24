<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
    }
    

    function add(){
        //insert record to database
    	$this->username = $this->input->post('username');
    	$password = $this->input->post('password');
    	$this->password = do_hash($this->config->item('salt').$password);
    	$this->email = $this->input->post('email');
    	$this->db->insert('user', $this);

        //return id
    	return $this->db->insert_id();

    }
	   //check that a user's credentials are valid, and that they have verified their email address
    function validate(){
    	$password = $this->input->post('password');
    	$email = $this->input->post('email');
    	$password = do_hash($this->config->item('salt').$password);

    	$this->db->where(array('password' => $password, 'email'=> $email, 'verified' => 1));
    	$this->db->from('user'); 
    	$this->db->limit(1);
    	$query = $this->db->get();

    	$validuser = array();

    	foreach ($query->result() as $row)
  		{
  		   	array_push($validuser, $row->id);
  		  	array_push($validuser, $row->username);
  		   	array_push($validuser, $row->email);
  		}
    	return $validuser;
    }

    
    function accountexists(){
	//check that a user account exists
        $this->email = $this->input->post('email');

        $query = $this->db->query("SELECT email FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];

           //if there is a match
           if($email == $this->email)
           {
                return true;
           }
        }
        return false;
    }


    function verify($validationLink){
        //check the password against the database
        $query = $this->db->query("SELECT email,user_id,verified FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];
           $id = $row['user_id'];
           $verified = $row['verified'];
		   

           //if the hashed email equals the hashed validation email and not already verified
           if((do_hash($this->config->item('salt').$email) == $validationLink) && $verified == 0)
           {
                //set the verified flag to true
                $this->db->where('user_id',$id);
                $this->db->update('user', array('verified' => 1));
                return $email;
           }
        }
        return false;
    }

    function exists($validationLink){
        //check the password against the database
        $query = $this->db->query("SELECT email,user_id FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];
           $id = $row['user_id'];

           //if the hashed email equals the hashed validation email and not already verified
           if(do_hash($this->config->item('salt').$email) == $validationLink)
           {
                //return email address
                return $email;
           }
        }
        return false;
    }

    function updatepassword(){
        //get form values (email from a hidden field)
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');

        //set the verified flag to true
        $this->db->where('email', $this->email);
        if($this->db->update('user', array('password' => do_hash($this->config->item('salt').$this->password))))
        {
          return true;
        }

        return false;
    }

    function updatesettings($email){
      //get values from form
      $this->set_autofill = $this->input->post('set_autofill');
      $this->set_data_cutoff = $this->input->post('set_data_cutoff');

      $this->db->where('email', $email);
      if($this->db->update('user', array('set_autofill' => $this->set_autofill, 'set_data_cutoff' => $this->set_data_cutoff)))
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    function getsettings($email){
      $query = $this->db->query("SELECT set_autofill, set_data_cutoff FROM user WHERE email = '$email'");
      $vals = $query->row();
      $settings = array('set_autofill'=> $vals->set_autofill, 'set_data_cutoff' => $vals->set_data_cutoff);
      return $settings;
    }

}
?>