<?php 
/**
* 
*/
	class M_muzaki extends CI_Model
	{
		public function get_all_data($start, $end, $where){
			$this->db->order_by('nama_muzaki', 'asc');
			$this->db->select('a.*, sum(e.trans_pembayaran)as total');
			$this->db->join('harta b', 'a.id_muzaki = b.id_muzaki','inner');
			$this->db->join('detail_tagihan c', 'b.id_harta = c.id_harta', 'left');
			$this->db->join('tagihan d', 'c.id_tagihan = d.id_tagihan', 'left');
			$this->db->join('transaksi e', 'd.id_tagihan = e.id_tagihan','left');
			$this->db->like('nama_muzaki', $where);
			$this->db->or_like('alamat_muzaki', $where);
			$this->db->or_like('email_muzaki', $where);
			$this->db->or_like('no_hp_muzaki', $where);
			$this->db->or_like('trans_pembayaran', $where);
			$this->db->limit($end, $start);
			$this->db->group_by('a.id_muzaki');
			return $this->db->get('muzaki a')->result_array();

		}
		public function get_muzaki($where){
			return $this->db->get_where('muzaki', $where)->row_array();
		}

		public function get_total_data(){
		$this->db->select('COUNT(*) as total');
		$data = $this->db->get('muzaki')->row_array();
		return $data['total'];
	}

	}
 ?>