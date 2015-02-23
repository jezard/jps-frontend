<?php 
class User_activity_model extends CI_Model{
	

	function get_spent_num($email){
		$query = $this->db->query("SELECT activity_id FROM user_activity WHERE activity_date >= DATE_SUB(NOW(), INTERVAL 29 DAY) AND email = '$email'");

		$data['activity_cap'] = 10;
		$data['num_this_month'] = count($query->result_array());
		$data['balance'] = $data['activity_cap'] - $data['num_this_month'];

		return $data;
	}

}