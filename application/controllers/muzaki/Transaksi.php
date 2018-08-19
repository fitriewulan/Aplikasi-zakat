<?php /**
* 
*/
class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/pengaturan/M_RekTrans');
		$this->load->model('muzaki/m_harta');
		$this->load->model('muzaki/m_tagihan');
		$this->load->model('muzaki/m_transaksi');
		$this->load->library('form_validation');
		$this->load->library('convert');
		if (!$this->session->userdata('login_muzaki')) {
				# code...
				redirect('muzaki/auth/login');
			}
	}
	
	public function index(){
		$id_muzaki = $this->session->userdata('login_muzaki');
		$cari = $this->session->userdata('cari');
		$where = array('id_muzaki' => $id_muzaki['id_muzaki'] ,
						);
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$data['list_tahun'] = $this->m_transaksi->get_all_tahun();
		$data['jumlah'] = $this->m_harta->get_jumlah($id_muzaki['id_muzaki'],  $bulannow['month']);
		$data['list_keranjang'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
		$data['list_trans'] = $this->m_transaksi->get_transaksi($where, $cari['bulan']);
		$data['jenis_trans'] = $this->m_transaksi->get_all_transaksi($where);
		$sql = $this->db->last_query($data['list_trans']);
		// print_r($sql);
		// exit();
		$this->load->view('muzaki/transaksi/index', $data);
	}

	public function filter_process() {
		$bulan = $this->input->post('bulan');
		// simpan ke dalam session
		$this->session->set_userdata('cari', ['bulan' => $bulan]);
		redirect('muzaki/transaksi');
 	}

	public function confirm(){
		$data['list_rek'] = $this->m_tagihan->get_rek();
		$this->load->view('muzaki/transaksi/confirm', $data);
	}

	public function confirm_process() {
		// cek input
		$this->form_validation->set_rules('no_conf', 'No konfirmasi', 'required');
		$this->form_validation->set_rules('nama_pembayaran', 'nama pemabayaran', 'required');
		$this->form_validation->set_rules('to_bank', 'Total Bayar', 'required');
		$this->form_validation->set_rules('total_bayar', 'total bayar', 'required');
		$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'required');
		// run validasi
		if ($this->form_validation->run() !== FALSE) {
			// insert payment
			$params = array(
				'id_tagihan' => $this->input->post('no_conf'),
				'nama_rek' => $this->input->post('nama_pembayaran'),
				'nama_bank' => $this->input->post('to_bank'),
				'trans_pembayaran' => preg_replace("/[^\d]/", "", $this->input->post('total_bayar')),
				'tgl_trans' => $this->input->post('tgl_transaksi')
			);
			// insert
			$id_trans = $this->m_transaksi->insert_trans($params);
			if ($id_trans) {
				$bukti_trans = "default.jpg";
				$config['upload_path'] = 'resource/images/payments/';
				$config['allowed_types'] = 'jpg|png|pdf';
				$config['file_name'] = $this->input->post('no_conf');
				// load library upload & menggunakan config yg dibuat
				$this->load->library('upload', $config);
				// proses upload
				// attachment adalah id transaksi
				if ($this->upload->do_upload('foto_trans')) {
					// ambil nama file yg baru diupload & masukkan ke variable payment_attachment
					$bukti_trans = $this->upload->data('file_name');
				}
				$params = array(
					'bukti_trans' =>  $bukti_trans
				);
				$where = array(
					'id_trans' => $id_trans
				);
				// update payment
				if ($this->m_transaksi->update_transaksi($params, $where)) {
					// sukses
					echo "<script type='text/javascript'>alert('konfirmasi berhasil disimpan. harap ditunggu beberapa menit, data akan dicek terlebih dahulu');window.location.href='".site_url('muzaki/transaksi')."'</script>";
				}
				else{
					echo "error";
				}
			}
		}
	}
	// public function save_transaksi(){
	// 	$id_muzaki = $this->session->userdata('login_muzaki');
	// }

	// public function save_detail_transaksi(){
	// 	$id_muzaki = $this->session->userdata('login_muzaki');
	// }
}

 ?>