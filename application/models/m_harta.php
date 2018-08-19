<?php 
/**
* 
*/
class m_harta extends CI_Model
{
	public function get_ket_zakat(){
		return $this->db->get('ketentuan_zakat')->result_array();
	}

	public function insert_harta($params){
		$this->db->insert('harta', $params);
		return $this->db->insert_id();
	}

	public function get_all_detail($params){
		//$this->db->order_by('id_ket);
		return $this->db->get_where('harta', $params)->row_array();
	}
	
	public function get_zakat($params){
		$this->db->join('ketentuan_zakat', 'ketentuan_zakat.id_ket = harta.id_ket' 'left');
		$this->db->join('harta_pertanian', 'harta_pertanian.id_harta = harta.id_harta' 'left');
		$this->db->join('harta', 'harta.id_muzaki = muzaki.id_muzaki', 'right');	
		$this->db->group_by('harta.id_muzaki');
		return $this->db->get_where('muzaki', $params)->result_array();
	} 
}
 ?>