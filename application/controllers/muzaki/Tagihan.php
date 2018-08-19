<?php 
/**
* 
*/
class Tagihan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('muzaki/m_tagihan');
		$this->load->model('muzaki/m_muzaki');
		$this->load->model('muzaki/m_harta');
		$this->load->model('m_preference');
		$this->load->library('convert');
		$this->load->library('Hitung_zakat');
		if (!$this->session->userdata('login_muzaki')) {
				# code...
				redirect('muzaki/auth/login');
			}
	}

	public function index(){
		$where = $this->session->userdata('login_muzaki');
		$id_muzaki = array('harta.id_muzaki' => $where['id_muzaki']);
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		//$data['tagihan'] = $this->m_harta->get_kewajiban($where['id_muzaki'],  $bulannow['month']);
		$data['jumlah'] = $this->m_harta->get_jumlah($where['id_muzaki'],  $bulannow['month']);
		$data['list_tagihan'] = $this->m_tagihan->get_tagihan($where['id_muzaki'],  $bulannow['month']);
		$data['list_keranjang'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
		//$sql=$this->db->last_query($data['list_tagihan']);
		$data['zakat_tagihan'] = $this->hitung_zakat->hitung($data['list_tagihan']);
		// print_r($this->db->last_query($data['list_tagihan']));
		//echo "<pre>";
		// jadi, struktur list_tagihan kan array
		// [0] =>  isi data , [1] => isi data
		// nah disetiap datanya ditambahkan index detail
		// [0]['detail'] => data detail
		// [1] => [ 'detail' => data detail ]
		// print_r($data['list_tagihan']);
		// echo "<br>====================================";
		$i = 0;
		foreach ($data['list_tagihan'] as $t) {
			$data['list_tagihan'][$i]['detail'] = $this->m_tagihan->get_detail($t['id_tagihan']); 
			// print_r($t);
			// print_r($value);
			$i++;
		}
		// print_r($data['list_tagihan']);
		// exit();
		$this->load->view('muzaki/transaksi/tagihan', $data);			
	} 

	public function insert_tagihan(){
		$where = $this->session->userdata('login_muzaki');
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulan = date('Y-m-d');
		$jangka_waktu = strtotime('+10 days',strtotime($bulan));
		$exp = date("Y-m-d", $jangka_waktu);
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$tambah_zakat = $this->session->userdata('tambah_zakat');
		// print_r($tambah_zakat);
		// exit();
		$params = array('tgl_tagihan' => $bulan,
						'jangka_waktu' => $exp,
						'status' => "yes"			
		);
		$tagihan = $this->m_tagihan->insert_tagihan($params);
		//menampilkan detail tagihan
		$detail_tagihan = $this->m_harta->get_checkout($where['id_muzaki'], $bulannow['month']);
		//id harta
		$cheked = $this->input->post('cek[]');
		$i = 1;
		foreach ($cheked as $c) {
		//menampilkan harta berdasarkan id_harta
		$harta = $this->m_harta->get_harta($c);
		//hitung zakat
		$bayar_zakat = $this->hitung_zakat->hitung($harta);
		// print_r($harta);
		//print_r($bayar_zakat[$i]['bayar']);
			$params = array(
 			'id_tagihan' => $tagihan,
			'id_harta' => $c,
			'bayar_zakat'	=> $bayar_zakat[$i]['bayar']		
			);
			$this->m_tagihan->insert_detail_tagihan($params);
		}
		// //$i=0;
		// foreach($detail_tagihan as $T) {
		// 	$params = array(
		// 			'id_tagihan' => $tagihan,
		// 			'id_harta' => $T['id_harta'],			
		// 		 );
		// 	print_r($params);
			
		// 	$coba = $this->m_tagihan->insert_detail_tagihan($params);
		// 	$this->db->last_query($coba);
		// }
		
		$id_tagihan = array('tagihan.id_tagihan' => $tagihan);
		//print_r($id_tagihan);
		$list_tagihan = $this->m_tagihan->get_detail_tagihan($id_tagihan);
		// $data = $this->hitung_zakat->hitung($list_tagihan);
			$i = 0;
			$total =0;
			foreach ($list_tagihan as $tagihan) {
				$total += $tagihan['bayar_zakat'];
			}
		$total_tagihan = array('total_tagihan' => $total );
		$this->m_tagihan->update_tagihan($total_tagihan, $id_tagihan);
		$rekening = $this->m_tagihan->get_rek();
		$muzaki  = $this->m_muzaki->get_all_detail($where) ;
		$kirim_tagihan = $this->m_tagihan->get($id_tagihan);
		// print_r($kirim_tagihan);
		// exit();
		/*
		KIRIM EMAIL
		*/
		//email setting
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
			$this->email->subject('informasi LAZIS SYUHADA');
			$message ="
				<h2>#testing WEB, mohon maaf jika terkirim... pesan ini hanya spam. <br>
				Assalammu'alaikum Warahmatullahi Wabarakatu</h2>
				saudara/saudari $muzaki[nama_muzaki], 
				<p>Tagihan Zakat</p>
				<h3>Silakan Transfer kesalah satu rekening dibawah ini</h3>
					<table><tr>
						<th style='width:150px'>Bank</th>
						<th style='width:150px'>No Rek</th>
						<th style='width:200px'>Atas nama</th>
					</tr>";
					foreach($rekening as $b){
				$message .=	"
					<tr>
						<td style='width:150px'>$b[no_rek]</td>						
						<td style='width:150px'>$b[nama_bank]</td>	
						<td style='width:200px'>$b[nama_rek]</td>		
					</tr></table>";
					}
				$message .= "
						<h4>No Konfirmasi : $kirim_tagihan[id_tagihan]</h4>
						<h4>Total Tagihan : <strong>Rp. ".number_format($kirim_tagihan['total_tagihan'], 2,',','.')."</strong></h4>		
						<p>sudah melakukan pembayaran zakat(transfer)?</p>
							<p><a href='".site_url('muzaki/confirm/')."' style='color: #fff;
							 background-color: #33b35a;
					    border-color: #33b35a; font-weight: normal;
					    border: 1px solid transparent;
					    padding: 0.5rem 0.75rem;
					    font-size: 1rem;
					    line-height: 1.25;
					    border-radius: 0;
					    -webkit-transition: all 0.15s ease-in-out;
					    transition: all 0.15s ease-in-out;'>Konfirmasi pembayaran</a></p>
	";
			// echo $message;exit();
			$this->email->message($message);
			if ($this->email->send()) {
					echo "<script type='text/javascript'>alert('Pesan Terkirim');window.location.href='".site_url('muzaki/tagihan')."'</script>";
				} 
			else {
				echo $this->email->print_debugger();
				echo "gagal";
			}
		$this->session->unset_userdata('tambah_zakat');
		$this->session->unset_userdata('jenis_zakat');
		$this->session->unset_userdata('id_tagihan');
		$this->session->unset_userdata('total_tagihan');
		redirect('muzaki/tagihan');
	}

	public function rekening($id_tagihan){
		$this->session->unset_userdata('id_tagihan');
		$this->session->unset_userdata('total_tagihan');
		$where = array('id_tagihan' => $id_tagihan );
		//keranjang zakat
		$muzaki = $this->session->userdata('login_muzaki');
		$id_muzaki = array('id_muzaki' => $muzaki['id_muzaki'] );
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$data['jumlah'] = $this->m_harta->get_jumlah($id_muzaki['id_muzaki'],  $bulannow['month']);
		$data['list_keranjang'] = $this->m_harta->get_checkout($id_muzaki['id_muzaki'],  $bulannow['month']);
		//tampilkan tagihan

		$data['rekening'] = $this->m_tagihan->get_rek();
		$data['tagihan'] = $this->m_tagihan->get($where);
		$this->load->view('muzaki/transaksi/rekening',$data);
	}
	// public function kirim_tagihan(){
	// 	$where = $this->session->userdata('login_muzaki');
	// 	$params = $this->m_tagihan->get_tagihan($where['id_muzaki']);
	// 	if ($this->m_tagihan->insert($params)) {
	// 		//kirim Email
	// 		//setting email
	// 		$mail_setting = $this->m_preference->get_mail_setting();
	// 		//load library email
	// 		$config['protocol'] = 'smtp';
	// 		$config['smtp_host'] = $mail_setting['smtp_host'];
	// 		$config['smtp_user'] = $mail_setting['smtp_user'];
	// 		$config['smtp_pass'] = $mail_setting['smtp_pass'];
	// 		$config['smtp_port'] = $mail_setting['smtp_port'];
	// 		$config['mailtype'] = 'html';
	// 		$config['charset'] = 'utf-8';
	// 		//initialize
	// 		$this->email->initialize($config);
	// 		$this->email->set_newline("\r\n");
	// 		$this->email->from($config['smtp_user']);
	// 		$this->email->to($params['user_email']);
	// 		$this->email->subject('informasi LAZIS MASJID SYUHADA');
	// 		$message = "
	// 			<h1>Assalammu'alaikum Warahmatullahi Wabarakatu</h1>
	// 			<p>Tagihan Zakat</p>
	// 			<h3>NO Rek. BRI 5192039108399100 </h3>
	// 			<table>
	// 				<tr>
	// 					<th>Jenis Zakat</th>
	// 					<th>Bayar Zakat</th>
	// 				<tr>
	// 				foreach($params as $zakat){
	// 					<tr>
	// 						<td>$zakat['jenis_zakat']</td>
	// 						<td>$zakat['Bayar Zakat']</td>
	// 					</tr>	
	// 				}
	// 					<tr>
	// 						<td>total : </td>
	// 						<td>$zakat['total']</td>
	// 					</tr>
	// 			</table>
	// 		"
	// 	}
	// }

}
 ?>