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
      $this->my_firstname = $this->input->post('my_firstname');
      $this->my_lastname = $this->input->post('my_lastname');
      $this->my_age = $this->input->post('my_age');
      $this->my_weight = $this->input->post('my_weight');
      $this->my_gender = $this->input->post('my_gender');
      $this->my_mhr = $this->input->post('my_mhr');
      $this->my_thr = $this->input->post('my_thr');
      $this->my_rhr = $this->input->post('my_rhr');
      $this->my_ftp = $this->input->post('my_ftp');
      $this->my_vo2 = $this->input->post('my_vo2');

      $this->db->where('email', $email);
      if($this->db->update('user', array(
        'set_autofill' => $this->set_autofill, 
        'set_data_cutoff' => $this->set_data_cutoff,
        'my_firstname' => $this->my_firstname,
        'my_lastname' => $this->my_lastname,
        'my_age' => $this->my_age,
        'my_weight' => $this->my_weight,
        'my_gender' => $this->my_gender,
        'my_mhr' => $this->my_mhr,
        'my_thr' => $this->my_thr,
        'my_rhr' => $this->my_rhr,
        'my_ftp' => $this->my_ftp,
        'my_vo2' => $this->my_vo2
        )))
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    function getsettings($email){
      $query = $this->db->query("SELECT * FROM user WHERE email = '$email'");
      $vals = $query->row();
      $settings = array('set_autofill'=> $vals->set_autofill, 
                        'set_data_cutoff' => $vals->set_data_cutoff,
                        'my_firstname' => $vals->my_firstname,
                        'my_lastname' => $vals->my_lastname,
                        'my_age' => $vals->my_age,
                        'my_weight' => $vals->my_weight,
                        'my_gender' => $vals->my_gender,
                        'my_mhr' => $vals->my_mhr,
                        'my_thr' => $vals->my_thr,
                        'my_rhr' => $vals->my_rhr,
                        'my_ftp' => $vals->my_ftp,
                        'my_vo2' => $vals->my_vo2
      );
      return $settings;
    }

}
?>