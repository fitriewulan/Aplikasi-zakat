<?php 	
	/**
	* 
	*/
	class Amil extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('admin/m_amil');
			$this->load->library('form_validation');

			if (!$this->session->userdata('login_admin')) {
				# code...
				redirect('admin/auth/login');
			}

		}

		public function index(){
			$where = $this->session->userdata('cari');
			print_r($where);
			$data['list_amil'] = $this->m_amil->get_all_amil($where);
			$this->session->unset_userdata('cari');
			// print_r($this->db->last_query($data['list_amil']));
			// exit();
			$this->load->view('admin/amil', $data);
		}

		public function search(){
			/*$keyword = $this->input->post('keyword');
			$data['list_amil'] = $this->m_amil->search($keyword);
			$this->load->view('admin/amil', $data);*/

			$keyword = $this->input->post('keyword');
			// simpan ke dalam session
			$this->session->set_userdata('cari', $keyword);
			redirect('admin/amil');
		}

		public function add(){
			$this->load->view('admin/add_amil');
		}

		public function add_process(){
			$this->form_validation->set_rules('nama_amil', 'nama_amil', 'required');
			$this->form_validation->set_rules('alamat_amil', 'alamat_amil', 'required');
			$this->form_validation->set_rules('no_hp_amil', 'no_hp_amil', 'required');
			$this->form_validation->set_rules('username_amil', 'username_amil', 'required|is_unique[amil.username_amil]');
			$this->form_validation->set_rules('password_amil', 'password_amil');
			$this->form_validation->set_rules('conf-password', 'conf-password', 'required');

			$id_admin = $this->session->userdata('login_admin');
			/*print_r($id_admin['id_admin']);
			exit();*/
			if($this->form_validation->run() !== FALSE){
				$params = array(
					'nama_amil' => $this->input->post('nama_amil'),
					'alamat_amil' => $this->input->post('alamat_amil'),
					'no_hp_amil' => $this->input->post('no_hp_amil'),
					'username_amil' => $this->input->post('username_amil'),
					'password_amil' => sha1($this->input->post('password_amil')),
					'id_admin' => $id_admin['id_admin']
				); 
				$sandi = sha1($this->input->post('conf-password'));

				if ($params['password_amil'] == $sandi){
					$this->m_amil->insert($params);
					redirect('admin/amil');
				}
				else{
					$this->session->set_flashdata('nama', $params['nama_amil']);
					$this->session->set_flashdata('alamat', $params['alamat_amil']);
					$this->session->set_flashdata('no_hp', $params['no_hp_amil']);
					$this->session->set_flashdata('username', $params['username_amil']);
					$this->session->set_flashdata('dispassword', 'password tidak sama, silakan isi kembali');
					redirect('admin/amil/add');
				}
			}
			// else{
			// 	echo validation_errors();	
			// }
		}

		public function nonaktif($id_amil = ""){
			$id_amil = array('id_amil' => $id_amil);
			$params = array('status_amil' => 'nonaktif');
			$this->m_amil->update_status($params, $id_amil);
			redirect('admin/amil');
		}

		public function aktif($id_amil = ""){
			$id_amil = array('id_amil' => $id_amil);
			$params = array('status_amil' => 'aktif');
			$this->m_amil->update_status($params, $id_amil);
			redirect('admin/amil');
		}
	}
?>