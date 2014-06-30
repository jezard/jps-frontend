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
    function verify($validationLink){
        //check the password against the database

        $query = $this->db->query("SELECT email,id,verified FROM user");

        foreach ($query->result_array() as $row)
        {
           $email = $row['email'];
           $id = $row['id'];
           $verified = $row['verified'];

           //if the hashed email equals the hashed validation email
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
}
?>