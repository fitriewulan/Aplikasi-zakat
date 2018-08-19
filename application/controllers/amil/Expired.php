<?php 
/**
* 
*/
class Expired extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('amil/m_transaksi');
	}

	public function index() {
		$params = array(
			'tagihan.status' => 'yes'
		);
		
		$data = $this->m_transaksi->get_expired();
		foreach ($data as $d) {
			$params = array('tagihan.status' => "no"
			);
			$where = array('id_tagihan' => $d['id_tagihan'] );
			$this->m_transaksi->update_tagihan($params, $where);
		}
	}
}
 ?>