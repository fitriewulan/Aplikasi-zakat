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
			$this->load->model('amil/m_auth');
		}

		public function login(){
		$this->load->view('amil/login');
		}

		public function login_process(){
			//validation
			$this->form_validation->set_rules('username_amil', 'username', 'required');
			$this->form_validation->set_rules('password_amil', 'password', 'required');
			//process
			if($this->form_validation->run() !== FALSE){
				$where = array(
					'username_amil' => $this->input->post('username_amil'),
					'password_amil' => sha1($this->input->post('password_amil')),
					'status_amil' => 'aktif' 
				);
				$amil = $this->m_auth->get_amil($where);
			//jika user tidak ditemukan
				if(!empty($amil)){
					$this->session->set_userdata('login_amil', $amil);
					redirect('amil/home');
				}
				else{
					$this->session->set_flashdata('login_error', 'nama pengguna atau kata sandi salah');
					redirect('amil/auth/login');
				}
				
			}
			$this->load->view('amil/login');
		}

		public function logout(){
			$this->session->unset_userdata('login_amil');
			redirect('amil/auth/login');
		}
	}
?>