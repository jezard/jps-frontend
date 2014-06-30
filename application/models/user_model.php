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
    	$this->password = do_hash('powerpeakjoulepersecond1973'.$password);
    	$this->email = $this->input->post('email');
    	$this->db->insert('user', $this);

        //return id
    	return $this->db->insert_id();

    }
    function validate(){
    	$password = $this->input->post('password');
    	$email = $this->input->post('email');
    	$password = do_hash('powerpeakjoulepersecond1973'.$password);

    	$this->db->where(array('password' => $password, 'email'=> $email));
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

    //check that a user account exists
    function accountexists(){
        $this->email = $this->input->post('email');

        $query = $this->db->query("SELECT email FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];

           //if their is a match
           if($email == $this->email)
           {
                return true;
           }
        }
        return false;
    }


    function verify($validationLink){
        //check the password against the database
        $query = $this->db->query("SELECT email,id,verified FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];
           $id = $row['id'];
           $verified = $row['verified'];

           //if the hashed email equals the hashed validation email and not already verified
           if(do_hash('powerpeakjoulepersecond1973'.$email) == $validationLink && $verified == 0)
           {
                //set the verified flag to true
                $this->db->where('id',$id);
                $this->db->update('user', array('verified' => 1));
                return $email;
           }
        }
        return false;
    }

    function exists($validationLink){
        //check the password against the database
        $query = $this->db->query("SELECT email,id FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];
           $id = $row['id'];

           //if the hashed email equals the hashed validation email and not already verified
           if(do_hash('powerpeakjoulepersecond1973'.$email) == $validationLink)
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
        if($this->db->update('user', array('password' => do_hash('powerpeakjoulepersecond1973'.$this->password))))
        {
          return true;
        }

        return false;
    }
}
?>