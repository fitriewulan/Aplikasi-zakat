<?php 
/**
* 
*/
class Transaksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('amil/m_transaksi');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		if (!$this->session->userdata('login_amil')) {
				# code...
			redirect('amil/auth/login');
		}
	}

	public function index() {
		$config['base_url'] = site_url('amil/transaksi/index');
		$config['per_page'] = 15;
		//posisi link setelah index.php
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'page-link');
		$config['total_rows'] = $this->m_transaksi->get_total_data();
		// wrap entire pagination
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		// number page
		$config['num_tag_open'] = '<li  class="page-item">';
		$config['num_tag_close'] = '</li>';
		// next page
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		// previous page
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		// current page
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
 		$start = $this->uri->segment(4);

		$this->pagination->initialize($config);
		$where = $this->session->userdata('cari_trans');
		$data['list_transaksi'] = $this->m_transaksi->get_all_tagihan($start, $config['per_page'], $where);
		$this->session->unset_userdata('cari_trans');
		// load view
		$this->load->view('amil/transaksi/index', $data);
	}

	public function search(){

		$keyword = $this->input->post('keyword');
		// simpan ke dalam session
		$this->session->set_userdata('cari_trans', $keyword);
		redirect('amil/Transaksi/');
	}

	public function verify($id_trans) {
		// params
		$params = array(
			'transaksi.status' => 'done'
		);
		$where = array(
			'id_trans' => $id_trans
		);
		// update
		$status = $this->m_transaksi->update_transaksi($params, $where);
		// print_r($this->db->last_query($status));
		// exit();
		redirect('amil/transaksi/');
	}



	public function expired($id_tagihan) {
		$params = array(
			'tagihan.status' => 'yes'
		);
		$where = array(
			'id_tagihan' => $id_tagihan
		);
		$this->m_transaksi->update_tagihan($params, $where);
		redirect('amil/transaksi/transaksi');
	}

	public function edit($id_trans=""){
		$where = array('id_trans' => $id_trans);
		$data['transaksi'] = $this->m_transaksi->get_detail($where);
		$data['bank'] = $this->m_transaksi->get_rek();
		$this->load->view('amil/transaksi/edit', $data);
	}

	public function update($id_trans=""){
		$this->form_validation->set_rules('nama_rek', 'Nama Rekening', 'required');
		$this->form_validation->set_rules('trans_pembayaran', 'Total Zakat', 'required');
		$this->form_validation->set_rules('tgl_trans', 'Tanggal', 'required');
		// run validasi
		if ($this->form_validation->run() !== FALSE) {
			// insert
			$where = array('id_trans' => $id_trans);
			$params = array(
				'nama_rek' => $this->input->post('nama_rek'),
				'nama_bank' => $this->input->post('kebank'),
				'trans_pembayaran' => preg_replace("/[^\d]/", "", $this->input->post('trans_pembayaran')),
				'tgl_trans' => $this->input->post('tgl_trans')
			);
			// update
			$this->m_transaksi->update_transaksi($params, $where);
		}
		redirect('amil/Transaksi');
	}
	// public function filter_process() {
	// 	$bulan = $this->input->post('bulan');
	// 	// simpan ke dalam session
	// 	$this->session->set_userdata('cari', ['bulan' => $bulan]);
	// 	redirect('amil/transaksi');
 // 	}

}
 ?>