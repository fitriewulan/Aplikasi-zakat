<?php 	
/**
* 
*/
class ClassName extends AnotherClass
{
	
	public function get_user($where){
		return $this->db->get_where('muzaki',$where);
	}

	public function getUserbyEmail($email){
		return $this->db->get_where('muzaki', $email);
	}

	public function insertToken($user_id)  
   	{    
    	$this->db->insert_string('tokens',$string);  
    	return $token . $user_id;  
    }  
}
 ?>