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
			$this->load->model('admin/m_auth');
		}

		public function login(){
		$this->load->view('admin/login');
		}

		public function login_process(){
			//validation
			$this->form_validation->set_rules('username_admin', 'username', 'required');
			$this->form_validation->set_rules('password_admin', 'password', 'required');
			//process
			if($this->form_validation->run() !== FALSE){
				$where = array(
					'username_admin' => $this->input->post('username_admin'),
					'password_admin' => sha1($this->input->post('password_admin')) 
				);
				$admin = $this->m_auth->get_admin($where);
			//jika user tidak ditemukan
				if(!empty($admin)){
					$this->session->set_userdata('login_admin', $admin);
					redirect('admin/home');
				}
				else{
					$this->session->set_flashdata('login_error', 'nama pengguna atau kata sandi salah');
					redirect('admin/auth/login');
				}
				
			}
			$this->load->view('admin/login');
		}

		public function logout(){
			$this->session->unset_userdata('login_admin');
			redirect('admin/auth/login');
		}
	}
?>