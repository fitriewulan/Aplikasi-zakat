<?php 
/**
* 
*/
class Transaksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('amil/m_transaksi');
	}

	public function index() {
		$data['list_transaksi'] = $this->m_transaction->get_all_transaction();
		// load view
		$this->load->view('amil/transaksi/index', $data);
	}
}
 ?>