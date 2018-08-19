<?php 
	/**
	* 
	*/
	class M_profil extends CI_Model
	{
		
		public function get_profil(){
			return $this->db->get('profil_lazis')->row_array();
		}

		public function update_profil($params){
			
			return $this->db->update('profil_lazis', $params);
			// // $this->db->query($sql);
			// // $this->db->set($params);
		 // // 	$this->db->where($where);
			// $this->db->join('preferences', 'preferences.id = profil_lazis.id_email', 'left');
			// // $this->db->set($params);
			// $this->db->where($where);
			// $this->db->update('profil_lazis');
		}
	}
 ?>