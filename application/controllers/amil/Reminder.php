<?php

 class Reminder extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('amil/m_muzaki');
 		$this->load->model('muzaki/m_tagihan');
		$this->load->model('amil/m_harta');
		$this->load->model('amil/m_profil');
		$this->load->model('m_preference');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('convert');
		$this->load->library('hitung_zakat');


 	}

 	public function index(){
			$this->load->library('email');
			//$rekening = $this->m_tagihan->get_rek();
			$d = date('d');
			$m = date('m');
			$y = date('Y');
			$Hijriah = $this->convert->GregorianToHijriah($y, $m, $d);
			$where = $Hijriah['day'].'-0'.$Hijriah['month'];
			$reminder = $this->m_harta->get_reminder($where);
			// print_r($this->db->last_query($reminder));
			// print_r($reminder);
			// print_r($this->db->last_query($reminder));
			// exit();
			$rek = $this->m_tagihan->get_rek();
			// print_r($rek);
			// exit();
			$mail_setting = $this->m_preference->get_mail_setting();
			$zakat = $this->hitung_zakat->hitung($reminder);
			$no_rek = $this->m_profil->get_profil();

			//load library email
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $mail_setting['smtp_host'];
			$config['smtp_user'] = $mail_setting['smtp_user'];
			$config['smtp_pass'] = $mail_setting['smtp_pass'];
			$config['smtp_port'] = $mail_setting['smtp_port'];
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			
			// echo "<pre>";
			// print_r($reminder);
			// exit();
		
			$i = 0;
			foreach ($reminder as $r) {
			//initialize
			$i++;
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from($config['smtp_user']);
				// print_r($r['email_muzaki']);
				// exit();
				$this->email->to($r['email_muzaki']);
				$this->email->subject('informasi LAZIS MASJID SYUHADA');
				$message .="
					<h1>#testing WEB, mohon maaf jika terkirim... pesan ini hanya spam. <br>
					Assalammu'alaikum Warahmatullahi Wabarakatu</h1>
					saudara/saudari <b>$r[nama_muzaki]</b>, 
					<p>Sudahkah anda melaksanakan zakat? Saatnya Membayar <b>$r[jenis_zakat]</b></p>";
				 if ($zakat[$i]['bayar'] == 0) {
				$message .=	"<p>belum Wajib zakat, ingin ubah harta anda?";
					} else {
				$message .=	"<p>Wajib Membayar Zakat Rp. ".number_format($zakat[$i]['bayar'], 2,',','.')."</p>
				<h3>Silakan Transfer kesalah satu rekening dibawah ini</h3>
					<table><tr>					
						<th style='width:150px'>No Rek</th>
						<th style='width:150px'>Bank</th>
						<th style='width:200px'>Atas nama</th>
					</tr>";
					foreach($rek as $b){
				$message .=	"<tr>
						<td style='width:150px'>$b[no_rek]</td>						
						<td style='width:150px'>$b[nama_bank]</td>	
						<td style='width:200px'>$b[nama_rek]</td>
					</tr>
					</table>";
					}
					$message .=	"<p>sudah melakukan pembayaran zakat(transfer)?</p>
									<p><a href='".site_url('muzaki/confirm/langsung/'.$r['id_harta'])."' style='color: #fff;
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
					}	
				$message .=	"<p>atau terlebihdahulu ingin</p>
							<p><b>Cek Zakat anda </b><a href='".site_url('muzaki/auth/login')."' style ='font-size: 0.7em !important;
						    padding: 2px 5px !important;
						    font-weight: normal;
    						border: 1px solid transparent;
						    border-radius: 2px !important;
						    line-height: 1.25;
						    transition: all 0.15s ease-in-out;
						    color: #fff;
						    background-color: #17a2b8;
						    border-color: #33b35a;'>Klik disini</a></p>";
				$this->email->message($message);
				if ($this->email->send()) {
					echo "<script type='text/javascript'>alert('Pesan Terkirim');window.location.href='".site_url('')."'</script>";
					} 
				else {
					echo $this->email->print_debugger();
					echo "gagal";
				}
				
			}

		}
 }
 ?> 