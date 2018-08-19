<?php 
/**
* 
*/
	class Muzaki extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('amil/m_muzaki');
			$this->load->model('amil/m_harta');
			$this->load->model('m_preference');
			$this->load->library('form_validation');
			$this->load->library('pagination');

			if(!$this->session->userdata('login_amil')) {
				# code...
			redirect('amil/auth/login');
			}
		}

		public function index(){
			$config['base_url'] = site_url('amil/muzaki/index');
			$config['per_page'] = 15;
			//posisi link setelah index.php
			$config['uri_segment'] = 4;
			$config['attributes'] = array('class' => 'page-link');
			$config['total_rows'] = $this->m_muzaki->get_total_data();
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
			$where = $this->session->userdata('cari_muzaki');
			$data['list_muzaki'] = $this->m_muzaki->get_all_data($start, $config['per_page'], $where);
			$this->load->view('amil/muzaki', $data);
			$this->session->unset_userdata('cari_muzaki');
		}
		
		public function harta($id_muzaki= " "){
			$where = array(
				'id_muzaki' => $id_muzaki
			);
			$data['muzaki']=$this->m_muzaki->get_muzaki($where);
			$harta= $this->m_muzaki->get_muzaki($where);
			$where = array(
				'harta.id_muzaki' => $harta['id_muzaki']
			);
			$data['data_harta'] = $this->m_harta->get_harta($where);
			$this->load->view('amil/harta', $data);

		}
		public function search(){		
			$keyword = $this->input->post('keyword');
			// simpan ke dalam session
			$this->session->set_userdata('cari_muzaki', $keyword);
			redirect('amil/muzaki/');
		}

	}
 ?>