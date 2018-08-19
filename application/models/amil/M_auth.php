<?php 
/**
* 
*/
class M_auth extends CI_Model
{
	public function get_amil($where){
		return $this->db->get_where('amil', $where)->row_array();
	}
}
 ?>