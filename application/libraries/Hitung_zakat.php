<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Hitung_zakat
{
	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('muzaki/zakat/m_harta');
		$this->CI->load->model('muzaki/m_tagihan');
		$this->CI->load->library('form_validation');
	}
	
	public function hitung($harta){
		$harta;
		$data = array();
		// echo "<pre>";
		// print_r($list_harta);
		// exit();
		$i = 0;
		foreach ($harta as $zakat ) {
			// echo "<pre>";
			// print_r($zakat);
			// exit();
			if(($zakat['id_ket'] == '1') OR ($zakat['id_ket'] == '2')){
				if ($zakat['total_harta'] >= ($zakat['nisab'] * $zakat['harga_satuan'])) {
					$bayar_zakat = $zakat['total_harta'] * 0.025;
					$keterangan = "Wajib Zakat";
				} 
				else if($zakat['total_harta'] <= ($zakat['nisab'] * $zakat['harga_satuan'])){
					$bayar_zakat = 0;
					$keterangan = "tidak wajib berzakat ";
				}
			}
			else if (($zakat['id_ket'] == '3') OR ($zakat['id_ket'] == '4')) {
				if ($zakat['total_harta'] >= $zakat['nisab']){
					$zakat_emas = $zakat['total_harta'] * 0.025;
					$bayar_zakat = $zakat_emas * $zakat['harga_satuan'];
					$keterangan = "Wajib Zakat";
				}
				else{
					$bayar_zakat = 0;
					$keterangan = "tidak wajib berzakat ";
				}
			}
			else if (($zakat['id_ket'] == '5') OR ($zakat['id_ket'] == '6')){
				if ($zakat['total_harta'] < $zakat['nisab']) {
					$zakat = 0;
					$keterangan = "tidak Wajib Zakat";
				}
				else if($zakat['total_harta'] >= $zakat['nisab']){
					$keterangan = 'wajib Zakat';
					$bayar_zakat = ($zakat['umur2'] * $zakat['harga_2']) + ($zakat['umur1'] * $zakat['harga_1']);
				}
				# code...
			}
			else if (($zakat['id_ket'] == '7')){
					$keterangan = 'wajib Zakat';
					$bayar_zakat = 2.5 * $zakat['harga_satuan'];
			}
			$i++;
			$data[$i]['bayar'] = $bayar_zakat;
			$data[$i]['ket'] = $keterangan;
			
			// 
			// // print_r($zakat)
		}
		return $data;
		
	}
}
 ?>