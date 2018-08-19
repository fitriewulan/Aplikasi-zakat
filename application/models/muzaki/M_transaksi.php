<?php 

/**
 * 
 */
 class M_transaksi extends CI_Model
 {
 	public function insert_trans($params){
		$this->db->insert('transaksi', $params);
		return $this->db->insert_id();
	}

	public function update_transaksi($params, $where){
		return $this->db->update('transaksi', $params, $where);
	}
 	
 	public function get_transaksi($where, $cari_bulan){
 		$this->db->select('transaksi.tgl_trans, transaksi.nama_rek, ketentuan_zakat.jenis_zakat, bayar_zakat, transaksi.status as status');
 		$this->db->join('tagihan', 'transaksi.id_tagihan = tagihan.id_tagihan', 'left');
 		$this->db->join('detail_tagihan', 'tagihan.id_tagihan = detail_tagihan.id_tagihan', 'left');
 		$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta', 'left');
 		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket', 'left');
 		$this->db->like('DATE_FORMAT(tgl_trans, "%m")',$cari_bulan);
 		$this->db->where($where);
 		$this->db->from('transaksi');
 		// $this->db->group_by('transaksi.id_trans');
 		// $this->db->get()->result_array();
 		// echo $this->db->last_query();exit();
 		return $this->db->get()->result_array();
 	}

 	public function get_all_transaksi($where){
 		$this->db->join('tagihan', 'transaksi.id_tagihan = tagihan.id_tagihan', 'left');
 		$this->db->join('detail_tagihan', 'tagihan.id_tagihan = detail_tagihan.id_tagihan', 'left');
 		$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta', 'left');
 		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket', 'left');
 		return $this->db->get_where('transaksi', $where)->result_array();
 	}

 	public function get_all_tahun() {
		$sql = "SELECT DISTINCT(tahun) AS tahun
				FROM (
					SELECT YEAR(tgl_trans) AS tahun
					FROM transaksi
					UNION ALL
					SELECT YEAR(CURRENT_DATE) AS tahun
				) AS tahun_trans
				ORDER BY tahun DESC";
		return $this->db->query($sql)->result_array();
	}

 } 
 	
 ?>