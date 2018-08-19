<?php 
/**
* 
*/
class M_ket extends CI_Model
{
	public function get_ket($where){
		return $this->db->get_where('ketentuan_zakat', $where)->row_array();
	}
}
 ?>