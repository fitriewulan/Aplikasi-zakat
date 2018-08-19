<?php 
/**
* 
*/
class M_bayar extends CI_Model
{
	public function get_where_bayar($params){
		$this->db->join('ketentuan_zakat', 'ketentuan_zakat.id_ket = harta.id_ket', 'left');
		$this->db->join('muzaki', 'muzaki.id_muzaki = harta.id_muzaki', 'left');
		// $params = $this->db->where('muzaki.id_muzaki');
		return $this->db->get_where('harta', $params)->row_array();

	}	
	public function get_detail_bayar($params){
		return $this->db->get_where('harta', $params)->row_array();

	}	

}
 ?>