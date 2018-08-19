<?php 
/**
* 
*/
class M_transaksi extends CI_model
{
	
	public function get_all_tagihan($start, $end, $where){
		$this->db->select('muzaki.nama_muzaki, tagihan.*, harta.*,ketentuan_zakat.*, transaksi.id_trans, transaksi.trans_pembayaran, transaksi.nama_rek, transaksi.tgl_trans, nama_bank, transaksi.bukti_trans, transaksi.status');
		$this->db->from('tagihan');
		$this->db->join('transaksi', 'tagihan.id_tagihan = transaksi.id_tagihan');
		$this->db->join('detail_tagihan', 'detail_tagihan.id_tagihan = tagihan.id_tagihan');
		$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta');
		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket');
		$this->db->join('Muzaki', 'harta.id_muzaki = muzaki.id_muzaki');
		$this->db->or_like('tgl_trans', $where);
		$this->db->or_like('nama_muzaki', $where);
		$this->db->or_like('nama_rek', $where);
		$this->db->or_like('trans_pembayaran', $where);
		$this->db->or_like('nama_bank', $where);
		$this->db->group_by('tagihan.id_tagihan');
		$this->db->limit($end, $start);
		$this->db->order_by('transaksi.status', 'asc');
		return $this->db->get()->result_array();

	}

	public function get_detail($where){
		$this->db->select('muzaki.nama_muzaki, tagihan.*, harta.*,ketentuan_zakat.*, transaksi.id_trans, transaksi.trans_pembayaran, transaksi.nama_rek, transaksi.tgl_trans, nama_bank, transaksi.bukti_trans, transaksi.status');
		$this->db->join('tagihan', 'transaksi.id_tagihan = tagihan.id_tagihan');
		$this->db->join('detail_tagihan', 'detail_tagihan.id_tagihan = tagihan.id_tagihan');
		$this->db->join('harta', 'detail_tagihan.id_harta = harta.id_harta');
		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket');
		$this->db->join('Muzaki', 'harta.id_muzaki = muzaki.id_muzaki');
		return $this->db->get_where('transaksi', $where)->row_array();

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

	public function get_all_tahun_pengeluaran() {
		$sql = "SELECT DISTINCT(tahun) AS tahun
				FROM (
					SELECT YEAR(tgl_trans_umum) AS tahun
					FROM transaksi_umum
					UNION ALL
					SELECT YEAR(CURRENT_DATE) AS tahun
				) AS tahun_trans
				ORDER BY tahun DESC";
		return $this->db->query($sql)->result_array();
	}

	public function get_total_data(){
		$this->db->select('COUNT(*) as total');
		$data = $this->db->get('tagihan')->row_array();
		return $data['total'];
	}

	public function update_transaksi($params, $where) {
		return $this->db->update('transaksi', $params, $where);
	}

	public function update_tagihan($params, $where) {
		return $this->db->update('tagihan', $params, $where);
	}

	public function insert_pengeluaran($params){
		$this->db->insert('transaksi_umum', $params);
		return $this->db->insert_id();
	}

	public function update_pengeluaran($params, $where) {
		return $this->db->update('transaksi_umum', $params, $where);
	}

	public function get_expired(){
			$this->db->where('DATE(CURRENT_DATE) > DATE(jangka_waktu)');
			$this->db->where('tagihan.status = "yes"');
			return $this->db->get('tagihan')->result_array();
		}

	public function delete_pengeluaran($where){
		return $this->db->delete('transaksi_umum', $where);
	}

	public function get_rek(){
		return $this->db->get('no_rek')->result_array();
	}
}
 ?>