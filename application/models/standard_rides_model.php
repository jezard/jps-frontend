<?php 
class Standard_rides_model extends CI_Model{
	
	function set($email, $data){
		//delete
		$this->db->query("DELETE FROM standard_rides WHERE email = '$email' LIMIT 1");
		//add
		$count = Count($data['ride_label']);
		for($i=0;$i<$count;$i++){
			$this->db->query("INSERT INTO standard_rides ( ride_label, in_or_out, race_or_train, email ) VALUES (".$this->db->escape($data['ride_label'][$i]).",'".$data['in_or_out'][$i]."','".$data['race_or_train'][$i]."','$email')");
		}
	}
}