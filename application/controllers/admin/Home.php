<?php 
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/m_amil');
		if (!$this->session->userdata('login_admin')) {
				# code...
				redirect('admin/auth/login');
			}
	}

	public function index(){
		$data['karyawan'] = $this->m_amil->get_jumlah();
		$this->load->view('admin/home', $data);
	}
}
?>