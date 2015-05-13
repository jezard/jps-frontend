<?php 
class User_activity_model extends CI_Model{
	

	function get_spent_num($email){
		$query = $this->db->query("SELECT activity_id FROM user_activity WHERE activity_date >= DATE_SUB(NOW(), INTERVAL 29 DAY) AND email = '$email'");

		$data['activity_cap'] = 20;
		$data['num_this_month'] = count($query->result_array());
		$data['balance'] = $data['activity_cap'] - $data['num_this_month'];

		return $data;
	}

	//TODO
	function delete($id, $email){
		$uid = $this->rc4($this->config->item('rc4_cypher'), $email);
		$result = $this->db->query("DELETE FROM user_activity WHERE activity_id = '$id' LIMIT 1");
		if($result){
			//also need to send a delete signal to go and create delete functionality there too.
			$ch = curl_init("http://joulepersecond.com:8080/delete/activity/".$id."/".$uid);
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

	function set_strava_activity_id($activity_id, $strava_activity_id){
		$query = $this->db->query("UPDATE user_activity 
										SET strava_activity_id = '$strava_activity_id', strava_upload_id = NULL 
										WHERE activity_id = '$activity_id'");
	}

	function get_activity($id){
		$query = $this->db->query("SELECT * FROM user_activity WHERE activity_id = '$id'");
		foreach($query->result_array() as $row){
			$data['activity_name'] = $row['activity_name'];
			$data['activity_notes'] = $row['activity_notes'];
			$data['activity_date'] = $row['activity_date'];
			$data['filename'] = $row['filename'];
			$data['strava_activity_id'] = $row['strava_activity_id'];
		}
		return $data;
	}




	/*
	 * RC4 symmetric cipher encryption/decryption
	 *
	 * @license Public Domain
	 * @param string key - secret key for encryption/decryption
	 * @param string str - string to be encrypted/decrypted
	 * @return string
	 */
	function rc4($key, $str) {
		$s = array();
		for ($i = 0; $i < 256; $i++) {
			$s[$i] = $i;
		}
		$j = 0;
		for ($i = 0; $i < 256; $i++) {
			$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
		}
		$i = 0;
		$j = 0;
		$res = '';
		for ($y = 0; $y < strlen($str); $y++) {
			$i = ($i + 1) % 256;
			$j = ($j + $s[$i]) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
			$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
		}
		return $res;
	}


}