<?php 
/**
* 
*/
class M_laporan extends CI_Model
{
	
	public function get_masuk($bulan, $tahun, $jenis){
		$this->db->select('a.id_trans, a.tgl_trans, d.bayar_zakat, f.jenis_zakat, a.nama_bank, a.trans_pembayaran');
		$this->db->join('tagihan c', 'a.id_tagihan = c.id_tagihan');
		$this->db->join('detail_tagihan d', 'c.id_tagihan = d.id_tagihan');
		$this->db->join('harta e', 'd.id_harta = e.id_harta');
		$this->db->join('ketentuan_zakat f', 'e.id_ket = f.id_ket');
		$this->db->like('DATE_FORMAT(tgl_trans, "%m")', $bulan);
		$this->db->like('DATE_FORMAT(tgl_trans, "%Y")', $tahun);
		$this->db->like('f.id_ket', $jenis);
		$this->db->where('a.status = "done"');		
		return $this->db->get('transaksi a')->result_array();
	}

	public function get_real($bulan, $tahun){
		$this->db->select('SUM(a.trans_pembayaran) as jumlah');
		$this->db->like('DATE_FORMAT(tgl_trans, "%m")', $bulan);
		$this->db->like('DATE_FORMAT(tgl_trans, "%Y")', $tahun);
		$this->db->where('a.status = "done"');		
		return $this->db->get('transaksi a')->row_array();
	}


	public function get_keluar($bulan, $tahun){
		$this->db->select('a.id_trans_umum, a.tgl_trans_umum, b.nama_amil, a.ambil, a.jenis_transaksi, a.keterangan, a.jumlah');
		$this->db->join('amil b', 'a.id_amil = b.id_amil');
		$this->db->like('DATE_FORMAT(tgl_trans_umum, "%m")', $bulan);	
		$this->db->like('DATE_FORMAT(tgl_trans_umum, "%Y")', $tahun);	
		return $this->db->get('transaksi_umum a')->result_array();
	}

	public function get_detail_keluar($where){
		return $this->db->get_where('transaksi_umum', $where)->row_array();
	}
}
 ?>