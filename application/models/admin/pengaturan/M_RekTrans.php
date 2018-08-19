<?php 
	/**
	* 
	*/
	class M_RekTrans extends CI_Model
	{
		
		public function get_Rek(){
			return $this->db->get('no_rek')->result_array();
		}
		public function get_detail_rek($where){
			return $this->db->get_where('no_rek', $where)->row_array();
		}
		public function insert($params)
		{
			return $this->db->insert('no_rek', $params);
		}

		public function update_rek($params, $where){	
			return $this->db->update('no_rek', $params, $where);
		}

		public function delete($params){
			return $this->db->delete('no_rek', $params);
		}
	}
 ?>