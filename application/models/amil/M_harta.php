<?php 
	/**
	* 
	*/
	class M_harta extends CI_Model
	{
		public function get_harta($where){
		$this->db->join('muzaki', 'muzaki.id_muzaki = harta.id_muzaki');
		$this->db->join('ketentuan_zakat', 'ketentuan_zakat.id_ket = harta.id_ket');
		$this->db->group_by('harta.id_ket');
		$this->db->order_by('jenis_zakat', 'desc');
		return $this->db->get_where('harta', $where)->result_array();
		}

		public function get_reminder($where){
			$sql = "SELECT h.id_harta, m.nama_muzaki, m.email_muzaki, k.nisab, k.harga_satuan, k.jenis_zakat, h.id_ket, pt.umur1, pt.umur2, pt.harga_1, pt.harga_2, h.total_harta, t.tgl_tagihan, r.tgl_trans FROM harta h 
			LEFT JOIN harta_peternakan pt ON h.id_harta = pt.id_harta
			LEFT JOIN muzaki m ON h.id_muzaki = m.id_muzaki 
			LEFT JOIN ketentuan_zakat k ON h.id_ket = k.id_ket 
			LEFT JOIN detail_tagihan d ON h.id_harta = d.id_harta 
			LEFT JOIN tagihan t ON d.id_tagihan = t.id_tagihan 
			LEFT JOIN transaksi r ON t.id_tagihan = r.id_tagihan 
			WHERE status_harta = 'aktif' AND (k.jenis_zakat = 'zakat profesi' AND (DATE_FORMAT(waktu_zakat, '%d') = DATE_FORMAT(NOW(), '%d'))) OR (K.jenis_zakat != 'zakat profesi' AND K.jenis_zakat != 'zakat fitrah' AND (DATE_FORMAT(waktu_zakat, '%d-%m') = DATE_FORMAT(NOW(), '%d-%m'))) OR (K.jenis_zakat = 'zakat fitrah' AND (DATE_FORMAT(waktu_zakat, '%d-%m') = '$where'))";
			return $this->db->query($sql)->result_array();
			// $this->db->where()
			// $this->db->get('harta')->result_array()
		}

		public function get_jumlah(){
			$this->db->select('count(*) as jumlah');
			$this->db->where('DATE_FORMAT(tgl_trans, "%m-%y") = DATE_FORMAT(NOW(), "%m-%y")');
			return $this->db->get('transaksi')->row_array();
		}

		public function get_confirm(){
			$this->db->select('count(*) as jumlah');
			$this->db->where('DATE_FORMAT(tgl_trans, "%m-%y") = DATE_FORMAT(NOW(), "%m-%y")');
			$this->db->where( 'status = "waiting"');
			return $this->db->get('transaksi')->row_array();
		}

		public function get_chart($where){
			// $sql = "SELECT count(*) as jumlah FROM `transaksi` WHERE `status` = 'done' GROUP BY DATE_FORMAT(tgl_trans, '%m')";
			$this->db->select('SUM(trans_pembayaran) as jumlah, monthname(tgl_trans) as bulan');
			$this->db->where('status = "done"');
			$this->db->like('DATE_FORMAT(tgl_trans, "%Y")', $where);
			$this->db->group_by('DATE_FORMAT(tgl_trans, "%m")');
			return $this->db->get('transaksi')->result_array();
		}

		// public function get_chart_jenis(){
		// 	// $sql = "SELECT count(*) as jumlah FROM `transaksi` WHERE `status` = 'done' GROUP BY DATE_FORMAT(tgl_trans, '%m')";
		// 	$this->db->select('count(*) as jumlah, e.jenis_zakat');
		// 	$this->db->join('tagihan b', 'a.id_tagihan = b.id_tagihan');
		// 	$this->db->join('detail_tagihan c', 'b.id_tagihan = c.id_tagihan');
		// 	$this->db->join('harta d', 'c.id_harta = d.id_harta', 'left');
		// 	$this->db->join('ketentuan_zakat e', 'd.id_ket = e.id_ket', 'left');
		// 	$this->db->where('a.status = "done"');
		// 	$this->db->group_by('e.jenis_zakat');
		// 	return $this->db->get('transaksi a')->result_array();

		// }
		public function get_chart_jenis($where){
			// $sql = "SELECT count(*) as jumlah FROM `transaksi` WHERE `status` = 'done' GROUP BY DATE_FORMAT(tgl_trans, '%m')";
			$this->db->select('count(*) as jumlah, a.jenis_zakat');
			$this->db->join('harta b', 'b.id_ket = a.id_ket');
			$this->db->join('detail_tagihan c', 'b.id_harta = c.id_harta');
			$this->db->join('tagihan d', 'c.id_tagihan = d.id_tagihan');			
			$this->db->join('transaksi e', 'd.id_tagihan = e.id_tagihan');
			$this->db->where('e.status = "done"');
			$this->db->like('DATE_FORMAT(tgl_trans, "%Y")', $where);
			$this->db->group_by('jenis_zakat');
			$this->db->order_by('jenis_zakat','desc');
			return $this->db->get('ketentuan_zakat a')->result_array();

		}
		
	}
 ?>