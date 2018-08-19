<?php 	

/**
 * 
 */
 class Confirm extends CI_Controller
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
		$this->load->library('Hitung_zakat');
	}

	public function index(){
		$data['list_rek'] = $this->m_tagihan->get_rek();
		$this->load->view('muzaki/transaksi/confirm', $data);
	}

	public function langsung($id_harta =""){
		$bulan = date('Y-m-d');
		$jangka_waktu = strtotime('+10 days',strtotime($bulan));
		$exp = date("Y-m-d", $jangka_waktu);
		$where = array('harta.id_harta' => $id_harta );
		$harta = $this->m_harta->get_detail($where);
		$bayar_zakat = $this->hitung_zakat->hitung($harta);
		print_r($bayar_zakat);
		$params_tagihan = array('tgl_tagihan' => $bulan,
						'jangka_waktu' => $exp,
						'status' => "yes",
						'total_tagihan' => $bayar_zakat[1]['bayar']);
		// insert tagihan
		$tagihan = $this->m_tagihan->insert_tagihan($params_tagihan);
		
		$params_detail = array('id_harta' => $id_harta,
								'id_tagihan' => $tagihan,
								'bayar_zakat' =>$bayar_zakat[1]['bayar']				
								);
		$this->m_tagihan->insert_detail_tagihan($params_detail);
		$id_tagihan = array('id_tagihan' => $tagihan );
		$data = $this->m_tagihan->get($id_tagihan);
		// print_r($data);
		// print_r($data['id_tagihan']);
		// print_r($data['total_tagihan']);
		// print_r($this->db->last_query($data));
		// exit();
		$this->session->set_userdata('id_tagihan', $data['id_tagihan']);	
		$this->session->set_userdata('total_tagihan', $data['total_tagihan']);	
		redirect('muzaki/confirm');
	}	

	public function confirm_process() {
		$this->session->unset_userdata('id_tagihan');	
		$this->session->unset_userdata('total_tagihan');
		$this->session->unset_userdata('no_trans');
		$this->session->unset_userdata('pemabayaran');

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
 } ?>