<?php 
	/**
	* 
	*/
	class M_profil extends CI_Model{
		
		public function get_profil(){
			return $this->db->get('profil_lazis')->row_array();
		}
	}
 ?>