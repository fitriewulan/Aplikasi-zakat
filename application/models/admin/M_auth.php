<?php 
/**
* 
*/
class M_auth extends CI_Model
{
	public function get_admin($where){
		return $this->db->get_where('admin', $where)->row_array();
	}
}
 ?>