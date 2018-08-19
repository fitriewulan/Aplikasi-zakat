<?php 
/**
* 
*/
class Bayar extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model('muzaki/m_harta');
		$this->load->model('muzaki/zakat/m_ket');
		$this->load->model('muzaki/m_tagihan');
		$this->load->model('muzaki/m_muzaki');
		$this->load->model('m_preference');
		$this->load->library('form_validation');
		$this->load->library('convert');
		$this->load->library('Hitung_zakat');
		$this->load->model('muzaki/zakat/m_bayar');
		if (!$this->session->userdata('login_muzaki')) {
				# code...
				redirect('muzaki/auth/login');
			}
	}

	public function index(){
		$where = $this->session->userdata('login_muzaki');
		$id_muzaki = array('id_muzaki' => $where['id_muzaki'] );
		$list_harta = $this->m_harta->get_all_harta($id_muzaki);
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$data['jumlah'] = $this->m_harta->get_jumlah($where['id_muzaki'],  $bulannow['month']);
		$data['list_tagihan'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
		// print_r($data['list_tagihan']);
		// print_r($this->db->last_query($data['list_tagihan']));
		// exit();
		$data['zakat_tagihan'] = $this->hitung_zakat->hitung($data['list_tagihan']);
		$this->load->view('muzaki/zakat/checkout', $data);
		
	}

	public function ajax_tampil_zakat($id_ket){
		header('Content-Type: application/json');
		$id_muzaki = $this->session->userdata('login_muzaki');
		$where = array('harta.id_muzaki' => $id_muzaki['id_muzaki'],
					'ketentuan_zakat.id_ket' => $id_ket
				);
		$data = $this->m_harta->get_all_harta($where);
		// $data = $this->hitung_zakat->hitung($detail);
		// print_r($detail);
		// exit();
		echo json_encode($data);
	}

	public function tambah_zakat(){
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('membayar_zakat', 'membayar_zakat', 'required');
		if ($this->form_validation->run() !== FALSE) {
			$id_ket = array('id_ket' => $this->input->post('id'));
			$bayar = array('membayar_zakat' => $this->input->post('membayar_zakat'));
			$ket = $this->m_ket->get_ket($id_ket);
			if (!empty($bayar)) {
				$this->session->set_userdata('tambah_zakat', $bayar);
				$this->session->set_userdata('jenis_zakat', $ket);
				redirect('muzaki/zakat/bayar');
			}
		}
	}

	public function send_trans(){
		$where = $this->session->userdata('login_muzaki');
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$muzaki  = $this->m_muzaki->get_all_detail($where) ;
		$params = $this->m_tagihan->get_tagihan($where['id_muzaki'],  $bulannow['month']);
			//kirim Email
			//setting email
			$mail_setting = $this->m_preference->get_mail_setting();
			//load library email
			$this->load->library('email');
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $mail_setting['smtp_host'];
			$config['smtp_user'] = $mail_setting['smtp_user'];
			$config['smtp_pass'] = $mail_setting['smtp_pass'];
			$config['smtp_port'] = $mail_setting['smtp_port'];
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			//initialize
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from($config['smtp_user']);
			$this->email->to($muzaki['email_muzaki']);
			$this->email->subject('informasi LAZIS MASJID SYUHADA');
			$message ="
				<h1>#testing WEB, mohon maaf jika terkirim... pesan ini hanya spam. <br>
				Assalammu'alaikum Warahmatullahi Wabarakatu</h1>
				<p>Tagihan Zakat</p>
				<h3>NO Rek. BRI 5192039108399100 </h3>
				<table>
					<tr>
						<th>Jenis Zakat</th>
						<th>Bayar Zakat</th>
					<tr>";
				foreach($params as $tagihan){
					// print_r($tagihan['jenis_zakat']);
					// exit();
					$message .= 
					"<tr>
						<td>$tagihan[jenis_zakat]</td>
						<td>$tagihan[membayar_zakat]</td>
					</tr>";
					$total += str_replace(",","", $tagihan['membayar_zakat']);
					}
					$message .= 
					"<tr> 
						<td>Rp. ".number_format($total, 2, ',','.');
					$message .= 
						"</td>
					</tr>
				</table>
			";
			// echo $message;exit();
			$this->email->message($message);
			if ($this->email->send()) {
					echo "<script type='text/javascript'>alert('Pesan Terkirim');window.location.href='".site_url('muzaki/harta')."'</script>";
				} 
			else {
				echo $this->email->print_debugger();
				echo "gagal";
			}
		// }
	}
}
 ?>