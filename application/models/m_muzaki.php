<?php 
	/**
	* 
	*/
	class m_muzaki extends CI_Model
	{
		public function insert($params) {
			$this->db->insert('muzaki', $params);
			return $this->db->insert_id();
		}

		public function get_all_detail($params){
			return $this->db->get_where('muzaki', $params)->row_array();
		}

	}
 ?>