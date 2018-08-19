<?php 
	/**
	* 
	*/
	class Auth extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('muzaki/m_auth');
			$this->load->model('muzaki/m_muzaki');
			$this->load->model('muzaki/m_harta');
			$this->load->model('m_preference');
			$this->load->model('admin/pengaturan/M_profil');
			# code...
		}

		public function login(){
			$data['profil_lazis'] = $this->M_profil->get_profil();
			$this->load->view('muzaki/login', $data);
		}

		public function login_process(){
			$this->form_validation->set_rules('email_muzaki', 'email', 'required');
			$this->form_validation->set_rules('password_muzaki', 'password', 'required');
			//process
			if($this->form_validation->run() !== FALSE){
				$where = array(
					'email_muzaki' => $this->input->post('email_muzaki'),
					'password_muzaki' => sha1($this->input->post('password_muzaki')) 
				);
				$muzaki = $this->m_auth->get_muzaki($where);

			//jika user tidak ditemukan
				if(!empty($muzaki)){
					$this->session->set_userdata('login_muzaki', $muzaki);
					redirect('muzaki/home');
				}
				else{
					$this->session->set_flashdata('login_error', 'nama pengguna atau kata sandi <b>SALAH</b>');
					redirect('muzaki/auth/login');
				}	
			}
			$this->load->view('muzaki/auth/login');
		}

		public function logout(){
			$this->session->unset_userdata('tambah_zakat');
			$this->session->unset_userdata('jenis_zakat');
			$this->session->unset_userdata('login_muzaki');
			redirect('muzaki/auth/login');
		}

		public function register(){
			$this->load->view('muzaki/register');
		}

		public function register_process(){
			$this->form_validation->set_rules('nama_muzaki', 'nama', 'required');
			// $this->form_validation->set_rules('tangal_lahir', 'tanggal_lahir', 'required');
			$this->form_validation->set_rules('alamat_muzaki', 'alamat', 'required|is_unique[muzaki.email_muzaki]');
			$this->form_validation->set_rules('email_muzaki', 'email', 'required|is_unique[muzaki.email_muzaki]');
			$this->form_validation->set_rules('no_hp_muzaki', 'No Hp', 'required|max_length[13]|min_length[11]');
			// $this->form_validation->set_rules('foto_muzaki', 'foto', 'required');
			$this->form_validation->set_rules('password_muzaki', 'kata sandi', 'required|min_length[6]');
			$this->form_validation->set_rules('conf-pass', 'conf pass', 'required|min_length[6]');

			// $response = array();

			//process
			if ($this->form_validation->run() !== FALSE) {
				//validasi tidak error
			//default icon
				$foto = 'default.jpg';
				//upload icon
				$config['upload_path']='resource/images/muzaki/foto-profil/';
				$config['allowed_types']='jpg|jpeg|png|ico|bmp';
				$config['file_name']= strtolower(str_replace('.','', $this->input->post('email_muzaki')));
				print_r($config['file_name']);
				// exit();
				if (isset($_FILES['foto_muzaki'])){
					$this->load->library('upload', $config);
					//load library upload & menggunakan config yang dibuat
					if ($this->upload->do_upload('foto_muzaki')){
						# code...
						//ambil nama file yang baru diupload & masukan ke variable foto
						$foto = $this->upload->data('file_name');
					} 
					else {
						echo $this->upload->display_errors(); exit();
					}
				}
				$params = array(
					'nama_muzaki' => $this->input->post('nama_muzaki'),
					/*'tanggal_lahir' => $this->input->post('tanggal_lahir'),*/
					'alamat_muzaki' => $this->input->post('alamat_muzaki'),
					'email_muzaki' => $this->input->post('email_muzaki'),
					'foto_muzaki' => $foto,
					'no_hp_muzaki' => $this->input->post('no_hp_muzaki'),
					'password_muzaki' => sha1($this->input->post('password_muzaki'))	
				);
				$sandi = sha1($this->input->post('conf-pass'));

				if($params['password_muzaki']==$sandi){
					$id = $this->m_muzaki->insert($params);
					
					// $zakat_fitrah = array('id_ket' => "7",
					// 				'id_muzaki' => $id,
					// 				'bulan hijriah' => "31-08"
					// 				);
					// $this->m_harta->insert_harta($zakat_fitrah);
					if ($id) {
						$response['status'] = 'success';
						$response['id_muzaki'] = $id;
						$response['message'] = 'Data berhasil disimpan';
					} else {
						$response['status'] = 'error';
						$response['message'] = 'ada yang error';
					}
					// $data = $this->m_muzaki->get_all_detail($params);	
				}
				else{
					// $this->session->set_flashdata('nama', $params['nama_muzaki']);
					// $this->session->set_flashdata('alamat', $params['alamat_muzaki']);
					// $this->session->set_flashdata('email', $params['email_muzaki']);
					// $this->session->set_flashdata('no_hp', $params['no_hp_muzaki']);
					// $this->session->set_flashdata('dispassword', 'password tidak sama');
					// $dispassword = $this->session->flashdata('dispassword');
					$response['status'] = 'error';
					$response['message'] = 'konfirmasi password tidak sama ';
				}
			} 
			else {
				$response['status'] = 'error';
				$response['message'] = validation_errors();
			}
			echo json_encode($response);
		}

		public function next_register(){
			$this->load->library('email');
			$id_muzaki = $this->input->post('id_muzaki');
			$zakat_fitrah = array('id_ket' => "7",
									'id_muzaki' => $id_muzaki,
									'waktu_zakat' => '1596-09-05',
									'bulan_hijriah' => "9"
									);
			$this->m_harta->insert_harta($zakat_fitrah);
			$where = array('id_muzaki' => $id_muzaki );
			$muzaki = $this->m_muzaki->get_all_detail($where);
			$mail_setting = $this->m_preference->get_mail_setting();
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
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from($config['smtp_user']);
				// print_r($r['email_muzaki']);
				// exit();
				$this->email->to($muzaki['email_muzaki']);
				$this->email->subject('informasi LAZIS SYUHADA');
				$message ="
					<h1>#testing WEB, mohon maaf jika terkirim... pesan ini hanya spam. <br>
					Assalammu'alaikum Warahmatullahi Wabarakatu</h1>
					saudara/saudari <b>$muzaki[nama_muzaki]</b>, 
					<p>Anda telah terdaftar sebagai muzaki di LAZIS SYUHADA</p>
					<p> Silakan Login dengan</p>
					<p> email : $muzaki[email_muzaki]</p>
					<p><a href='".site_url('muzaki/auth/login')."' style='color: #fff;
							 background-color: #33b35a;
					    border-color: #33b35a; font-weight: normal;
					    border: 1px solid transparent;
					    padding: 0.5rem 0.75rem;
					    font-size: 1rem;
					    line-height: 1.25;
					    border-radius: 0;
					    -webkit-transition: all 0.15s ease-in-out;
					    transition: all 0.15s ease-in-out;'>Login</a></p>
				";	
				$this->email->message($message);
				$this->email->send();
			$kirim = $this->input->post('kirim');
			if($kirim == 'ya'){
				$this->session->set_userdata('id_muzaki', $id_muzaki);
				redirect('muzaki/register_harta');
			}
			else if($kirim == 'tidak'){
				$this->session->userdata('login_muzaki');
				redirect('muzaki/home');
			}
		}


	}
 ?>