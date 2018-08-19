<?php 
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('amil/m_harta');
		$this->load->model('amil/m_transaksi');
		
		if (!$this->session->userdata('login_amil')) {
				# code...
			redirect('amil/auth/login');
		}
	}

	public function index(){
		$cari = $this->session->userdata('cari_chart');
		//transaksi
		$data['jumlah_zakat'] = $this->m_harta->get_jumlah();
		//konfirmasi
		$data['jumlah_konfirmasi'] = $this->m_harta->get_confirm();
		$data['list_tahun'] = $this->m_transaksi->get_all_tahun();
		//chart
		$data['chart'] = $this->m_harta->get_chart($cari['tahun']);
		// $sql2 = $this->db->last_query($data['chart']);
		$data['chart_pie'] = $this->m_harta->get_chart_jenis($cari['tahun']);
		$this->load->view('amil/home', $data);
	}

	public function filter_process() {
			$where = array('tahun' => $this->input->post('tahun')); 
			// simpan ke dalam session
			$this->session->set_userdata('cari_chart',$where);
			redirect('amil/home');
	 	}
}
?>