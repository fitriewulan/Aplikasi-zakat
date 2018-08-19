  <?php 
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login_muzaki')) {
				# code...
				redirect('muzaki/auth/login');
			}
		$this->load->model('muzaki/m_harta');
		$this->load->model('muzaki/m_tagihan');
		$this->load->model('muzaki/m_harta');
		$this->load->library('convert');
		$this->load->library('Hitung_zakat');
	}
	public function index(){
		$where = $this->session->userdata('login_muzaki');
		$id_muzaki = array('id_muzaki' => $where['id_muzaki'] );
		//$list_harta = $this->m_harta->get_all_harta($id_muzaki);
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
		$data['jumlah'] = $this->m_harta->get_jumlah($where['id_muzaki'],  $bulannow['month']);
		$data['list_keranjang'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
		$data['list_kewajiban'] = $this->m_harta->get_kewajiban($where['id_muzaki'],  $bulannow['month']);
		$data['zakat_tagihan'] = $this->hitung_zakat->hitung($data['list_kewajiban']);
		// $sql=$this->db->last_query($data['list_kewajiban']);
		// print_r($sql);
		// exit();
		$this->load->view('muzaki/home', $data);
	}

	// public function notif_tagihan(){
	// 	$id_muzaki = $this->session->userdata('login_muzaki');
	// 	$data['list_tagihan'] = $this->m_tagihan->get_tagihan($id_muzaki['id_muzaki']);
	// 	$this->load->view('muzaki/header', $data);
	// }

}
 ?>
 