<?php 	 
	/**
	* 
	*/
	class M_amil extends CI_Model
	{
		
		public function get_all_amil($where){
			$this->db->like('nama_amil', $where);
			$this->db->or_like('username_amil', $where);
			$this->db->or_like('alamat_amil', $where);
			$this->db->or_like('no_hp_amil', $where);
			$this->db->join('admin', 'amil.id_admin = admin.id_admin');
			return $this->db->get('amil')->result_array();
		}

		public function get_jumlah(){
			$this->db->select('count(*) as jumlah');
			return $this->db->get('amil')->row_array();
		}

		public function get_detail_amil($where){
			return $this->db->get_where('amil', $where)->row_array();
		}

		public function insert($params){
			$this->db->insert('amil', $params);
			return $this->db->insert_id();
		}

		public function delete($params){
			return $this->db->delete('amil', $params);
		}

		public function search($keyword){
			$this->db->like('nama_amil', $keyword);
			return $this->db->get('amil')->result();
		}

		public function update_status($params, $where){
			$this->db->where($where);
			return $this->db->update('amil', $params);
		}
	}
?>