<?php  
/**
* 
*/
	class M_ket_zakat extends CI_Model
	{
		
		public function get_ket(){
			return $this->db->get('ketentuan_zakat')->result_array();
		}
		public function update_ket($where, $params){
			$this->db->where($where);
			return $this->db->update('ketentuan_zakat', $params);
		}
	}
?>
