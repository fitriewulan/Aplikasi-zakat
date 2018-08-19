<?php 
	/**
	* 
	*/
	class M_tagihan extends CI_Model
	{
		public function get($where){
			return $this->db->get_where('tagihan', $where)->row_array();
		}

		public function get_detail($where){
			$this->db->join('harta c', 'b.id_harta = c.id_harta');
			$this->db->join('harta_peternakan d', 'c.id_harta = d.id_harta', 'left');
			$this->db->join('ketentuan_zakat e', 'c.id_ket = e.id_ket', 'left');
			$this->db->where('b.id_tagihan', $where);
			return $this->db->get('detail_tagihan b')->result_array();
		}
		public function get_tagihan($where, $bulan)
		{
			/*$this->db->join('ketentuan_zakat','ketentuan_zakat.id_ket = harta.id_ket');
			$this->db->join('detail_tagihan','detail_tagihan.id_harta = harta.id_harta', 'left');
			$this->db->where(ifnull(MONTH(('detail_tagihan.tgl_zakat'),'0000-00-00')) NOT IN (MONTH('CURRENT_DATE')) AND 'harta.id_muzaki = $id_muzaki');
			$this->db->get('harta')->result_array();*/
			// return $this->db->query("SELECT harta.*, ketentuan_zakat.*, harta_peternakan.umur1, harta_peternakan.umur2, harta_peternakan.harga_1, harta_peternakan.harga_2, tagihan.*, transaksi.tgl_trans
			// 	FROM harta 
			// 	INNER JOIN ketentuan_zakat ON harta.id_ket = ketentuan_zakat.id_ket
			// 	LEFT JOIN harta_peternakan on harta.id_harta = harta_peternakan.id_harta
			// 	LEFT JOIN detail_tagihan ON harta.id_harta = detail_tagihan.id_harta 
			// 	LEFT JOIN tagihan ON detail_tagihan.id_tagihan = tagihan.id_tagihan
			// 	LEFT JOIN transaksi ON tagihan.id_tagihan = transaksi.id_tagihan
			// 	WHERE ((IFNULL(MONTH(transaksi.tgl_trans),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND ketentuan_zakat.jenis_zakat = 'zakat profesi') OR (bulan_Hijriah = '$bulan' AND ketentuan_zakat.jenis_zakat != 'zakat profesi')) AND harta.id_muzaki = '$where' AND transaksi.tgl_trans = Null
			// 	GROUP BY harta.id_harta")->result_array();
			$sql = "SELECT harta.*, ketentuan_zakat.*, harta_peternakan.umur1, harta_peternakan.umur2, harta_peternakan.harga_1,harta_peternakan.harga_2, tagihan.*, transaksi.tgl_trans 
				FROM tagihan 
				LEFT JOIN detail_tagihan ON tagihan.id_tagihan = detail_tagihan.id_tagihan 
				LEFT JOIN harta ON detail_tagihan.id_harta = harta.id_harta 
				INNER JOIN ketentuan_zakat ON harta.id_ket = ketentuan_zakat.id_ket 
				LEFT JOIN harta_peternakan on harta.id_harta = harta_peternakan.id_harta 
				LEFT JOIN transaksi ON tagihan.id_tagihan = transaksi.id_tagihan 
				WHERE ((IFNULL(MONTH(transaksi.tgl_trans),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND ketentuan_zakat.jenis_zakat = 'zakat profesi') 
					OR (IFNULL(MONTH(transaksi.tgl_trans),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND bulan_Hijriah = '$bulan' AND ketentuan_zakat.jenis_zakat != 'zakat profesi')) 
					AND harta.id_muzaki = '$where'
				GROUP BY tagihan.id_tagihan";
			return $this->db->query($sql)->result_array();
		}

		public function insert_tagihan($params){
			$this->db->insert('tagihan', $params);
			return $this->db->insert_id();
		}
		public function get_all_tagihan($where){
			$this->db->join('transaksi', 'tagihan.id_tagihan = transaksi.id_tagihan');
			$this->db->join('detail_tagihan', 'tagihan.id_tagihan = detail_tagihan.id_tagihan');
			$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta');
			$this->db->join('harta_peternakan', 'harta_peternakan.id_harta = harta.id_harta', 'left' );
			$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket');
			$this->db->group_by('tagihan.id_tagihan');
			$this->db->where('transaksi.tgl_trans = "null"');
			return $this->db->get_where('tagihan', $where)->result_array();

		}

		public function get_detail_tagihan($where){
			$this->db->join('tagihan', 'detail_tagihan.id_tagihan = tagihan.id_tagihan');
			$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta');
			$this->db->join('harta_peternakan', 'harta_peternakan.id_harta = harta.id_harta', 'left' );
			$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket');
			return $this->db->get_where('detail_tagihan', $where)->result_array();
		}

		public function insert_detail_tagihan($params){
			$this->db->insert('detail_tagihan', $params);
			return $this->db->insert_id();
		}

		public function update_tagihan($params, $where){
			return $this->db->update('tagihan', $params, $where);
		}

		public function get_expired(){
			$this->db->where('jangka_waktu < MONTH(CURRENT_DATE)');
			return $this->db->get('tagihan')->result_array();
		}

		public function get_rek(){
			return $this->db->get('no_rek')->result_array();
		}
	}
 ?>