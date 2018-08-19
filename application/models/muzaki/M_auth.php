<?php 
/**
* 
*/
class M_auth extends CI_Model
{
	
	public function get_muzaki($params){
		return $this->db->get_where('muzaki', $params)->row_array();
	}
}