<?php 
/**
* 
*/
class M_harta extends CI_Model
{
	public function get_kewajiban($where, $bulan){

		return $this->db->query("SELECT harta.*, DATE_FORMAT(waktu_zakat,'%d') as day, DATE_FORMAT(waktu_zakat,'%m') as month, ketentuan_zakat.*, harta_peternakan.umur1, harta_peternakan.umur2, harta_peternakan.harga_1, harta_peternakan.harga_2, tagihan.*, transaksi.tgl_trans
			FROM harta 
			INNER JOIN ketentuan_zakat ON harta.id_ket = ketentuan_zakat.id_ket
			LEFT JOIN harta_peternakan on harta.id_harta = harta_peternakan.id_harta
			LEFT JOIN detail_tagihan ON harta.id_harta = detail_tagihan.id_harta 
			LEFT JOIN tagihan ON detail_tagihan.id_tagihan = tagihan.id_tagihan
			LEFT JOIN transaksi ON tagihan.id_tagihan = transaksi.id_tagihan
			WHERE  harta.id_muzaki = '$where' AND status_harta = 'aktif' AND ((IFNULL(MONTH(transaksi.tgl_trans),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND ketentuan_zakat.jenis_zakat = 'zakat profesi') OR (IFNULL(MONTH(transaksi.tgl_trans),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND bulan_Hijriah = '$bulan' AND ketentuan_zakat.jenis_zakat != 'zakat profesi'))")->result_array();
	}

	public function get_jumlah($where, $bulan){
		$sql = "SELECT COUNT(*) as jumlah
			FROM harta 
			INNER JOIN ketentuan_zakat ON harta.id_ket = ketentuan_zakat.id_ket
			LEFT JOIN harta_peternakan on harta.id_harta = harta_peternakan.id_harta
			LEFT JOIN detail_tagihan ON harta.id_harta = detail_tagihan.id_harta 
			LEFT JOIN tagihan ON detail_tagihan.id_tagihan = tagihan.id_tagihan
			LEFT JOIN transaksi ON tagihan.id_tagihan = transaksi.id_tagihan
			WHERE  status_harta = 'aktif' AND ((IFNULL(MONTH(tagihan.tgl_tagihan),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND ketentuan_zakat.jenis_zakat = 'zakat profesi') OR (IFNULL(MONTH(tagihan.tgl_tagihan),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND bulan_Hijriah LIKE '$bulan' AND ketentuan_zakat.jenis_zakat != 'zakat profesi')) AND harta.id_muzaki = '$where'";
		return $this->db->query($sql)->row_array();
	}

	public function get_checkout($where, $bulan){
		$sql = "SELECT harta.*, ketentuan_zakat.*, harta_peternakan.umur1, harta_peternakan.umur2, harta_peternakan.harga_1, harta_peternakan.harga_2, tagihan.*, transaksi.tgl_trans
				FROM harta 
				INNER JOIN ketentuan_zakat ON harta.id_ket = ketentuan_zakat.id_ket
				LEFT JOIN harta_peternakan on harta.id_harta = harta_peternakan.id_harta
				LEFT JOIN detail_tagihan ON harta.id_harta = detail_tagihan.id_harta 
				LEFT JOIN tagihan ON detail_tagihan.id_tagihan = tagihan.id_tagihan
				LEFT JOIN transaksi ON tagihan.id_tagihan = transaksi.id_tagihan
				WHERE status_harta = 'aktif' AND ((IFNULL(MONTH(tagihan.tgl_tagihan),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND ketentuan_zakat.jenis_zakat = 'zakat profesi') 
				OR (IFNULL(MONTH(tagihan.tgl_tagihan),'0000-00-00') NOT IN (MONTH(CURRENT_DATE)) AND bulan_Hijriah = '$bulan' AND ketentuan_zakat.jenis_zakat != 'zakat profesi'))  AND harta.id_muzaki = '$where'";
		return $this->db->query($sql)->result_array();
	}

	public function get_ket_zakat(){
		return $this->db->get('ketentuan_zakat')->result_array();
	}

	public function get_ket_detail($params){
		return $this->db->get_where('ketentuan_zakat', $params)->row_array();
	}

	public function insert_harta($params){
		$this->db->insert('harta', $params);
		return $this->db->insert_id();
	}

	public function update($params, $where){
		$this->db->where($where);
		return $this->db->update('harta', $params);
	}

	public function update_peternakan($params, $where){
		// $this->db->SET('bruto_harta', 'total_harta');
		$this->db->where($where);
		return $this->db->update('harta_peternakan', $params);
	}

	public function get_all_detail($params){
		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket', 'left');
		$this->db->join('harta_peternakan', 'harta.id_harta = harta_peternakan.id_harta', 'left');
		return $this->db->get_where('harta', $params)->row_array();
	}
	
	public function get_detail($params){
		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket', 'left');
		$this->db->join('harta_peternakan', 'harta.id_harta = harta_peternakan.id_harta', 'left');
		return $this->db->get_where('harta', $params)->result_array();
	}

	//menampilkan data harta berdasarkan id harta untuk insert tagihan
	public function get_harta($where){
		$this->db->join('ketentuan_zakat', 'harta.id_ket = ketentuan_zakat.id_ket', 'left');
		$this->db->join('harta_peternakan', 'harta.id_harta = harta_peternakan.id_harta', 'left');
		$this->db->or_where('harta.id_harta', $where);
		return $this->db->get('harta')->result_array();
	}

	/*public function get_all_harta($params){
		$this->db->join('ketentuan_zakat', 'ketentuan_zakat.id_ket = harta.id_ket', 'left');		
		return $this->db->get_where('harta', $params)->result_array();
	}*/

	public function get_all_harta($params){
		$this->db->select('harta.*, DATE_FORMAT(waktu_zakat,"%d") as day, DATE_FORMAT(waktu_zakat,"%m") as month, ketentuan_zakat.*, harta_peternakan.umur1, harta_peternakan.umur2, harta_peternakan.harga_1, harta_peternakan.harga_2');
		$this->db->join('harta_peternakan', 'harta_peternakan.id_harta = harta.id_harta', 'left' );
		$this->db->join('ketentuan_zakat', 'ketentuan_zakat.id_ket = harta.id_ket', 'left');	
		return $this->db->get_where('harta', $params)->result_array();
	} 

	public function insert_peternakan($params){
		$this->db->insert('harta_peternakan', $params);
		return $this->db->insert_id();
	}

	public function update_status($params, $where){
			$this->db->where($where);
			return $this->db->update('harta', $params);
		}

	
}
 ?>