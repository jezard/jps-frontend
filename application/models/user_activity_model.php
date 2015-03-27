<?php 
class User_activity_model extends CI_Model{
	

	function get_spent_num($email){
		$query = $this->db->query("SELECT activity_id FROM user_activity WHERE activity_date >= DATE_SUB(NOW(), INTERVAL 29 DAY) AND email = '$email'");

		$data['activity_cap'] = 10;
		$data['num_this_month'] = count($query->result_array());
		$data['balance'] = $data['activity_cap'] - $data['num_this_month'];

		return $data;
	}

	//TODO
	function delete($id){
		$result = $this->db->query("DELETE FROM user_activity WHERE activity_id = '$id' LIMIT 1");
		if($result){
			//also need to send a delete signal to go and create delete functionality there too.
			$ch = curl_init("http://joulepersecond.com:8080/delete/activity/".$id);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);

			curl_close($ch);
		}
	}

	function set_strava_upload_id($activity_id, $upload_id){
		$query = $this->db->query("UPDATE user_activity 
										SET strava_upload_id = '$upload_id' 
										WHERE activity_id = '$activity_id'");
	}

	function get_strava_upload_id($activity_id){
		$query = $this->db->query("SELECT strava_upload_id FROM user_activity WHERE activity_id = '$activity_id' LIMIT 1");
		foreach($query->result_array() as $row){
			$strava_upload_id = $row['strava_upload_id'];
		}
		return $strava_upload_id;
	}

	function set_strava_activity_id($activity_id, $activity_id){
		$query = $this->db->query("UPDATE user_activity 
										SET strava_activity_id = '$activity_id', strava_upload_id = 'NULL' 
										WHERE activity_id = '$activity_id'");
	}
}