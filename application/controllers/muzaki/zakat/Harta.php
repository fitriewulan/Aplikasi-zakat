<?php 
	/**
	* 
	*/
	class Harta extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('muzaki/m_harta');
			$this->load->model('muzaki/m_tagihan');
			$this->load->library('convert');
			$this->load->library('Hitung_zakat');
			if (!$this->session->userdata('login_muzaki')) {
				# code...
				redirect('muzaki/auth/login');
			}
		}

		public function index(){
			$where = $this->session->userdata('login_muzaki');
			$id_muzaki = array('id_muzaki' => $where['id_muzaki'] );
			$d = date('d');
			$m = date('m');
			$y = date('Y');
			$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
			$data['jumlah'] = $this->m_harta->get_jumlah($where['id_muzaki'],  $bulannow['month']);
			$data['list_keranjang'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
			//$data['zakat_tagihan'] = $this->hitung_zakat->hitung($data['list_tagihan']);
			$data['list_harta'] = $this->m_harta->get_all_harta($id_muzaki);
			$data['zakat'] = $this->hitung_zakat->hitung($data['list_harta']);
						
			$this->load->view('muzaki/zakat/harta/index', $data);
		}

		public function register_harta() {
			$data['id_muzaki'] = $this->session->userdata('id_muzaki');
			$data['ket_zakat'] = $this->m_harta->get_ket_zakat();
			$this->load->view('muzaki/tambah_zakat', $data);
		}

		public function add_zakat_harta(){
			$data['id_muzaki'] = $this->session->userdata('login_muzaki');
			$where = $this->session->userdata('login_muzaki');
			$d = date('d');
			$m = date('m');
			$y = date('Y');
			$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
			$data['jumlah'] = $this->m_harta->get_jumlah($where['id_muzaki'],  $bulannow['month']);
			$data['list_keranjang'] = $this->m_harta->get_checkout($where['id_muzaki'],  $bulannow['month']);
			$this->load->view('muzaki/tambah_zakat', $data);
		}

		public function hitung_harta() {
			// $id_muzaki = $this->input->post('id_muzaki');
			$id_muzaki = $this->session->userdata('login_muzaki');
			$id = array('id_muzaki' => $id_muzaki['id_muzaki'],
						'harta.id_ket' => $this->input->post('ket_zakat'));
			$params = array('id_ket' => $this->input->post('ket_zakat'));
			$waktu_zakat = $this->input->post('waktu');
			$ket_zakat = $this->m_harta->get_ket_detail($params);
			$waktu = array('bulan' => date('m', strtotime($waktu_zakat)),
							'tahun' => date('Y', strtotime($waktu_zakat)),
							'tgl' => date('d', strtotime($waktu_zakat))
			 		);
			$bulan = $this->convert->GregorianToHijriah($waktu['tahun'], $waktu['bulan'], $waktu['tgl']);
			$ket_zakat = $this->m_harta->get_ket_detail($params['id_ket']);
			$zakat = $this->m_harta->get_detail($id);
			// $sql = mysql_query($this->db->last_query($zakat));
			// $cek_data = mysql_num_rows($sql);
			// print_r($zakat);
			// print_r($this->db->last_query($zakat));
			
			if (empty($zakat)) {
				if (!empty($params['id_ket'])){
				//zakat profesi
				if($params['id_ket'] == '1'){
					$this->form_validation->set_rules('penghasilan', 'penghasilan', 'required');
					$this->form_validation->set_rules('bonus', 'bonus', 'required');
					$this->form_validation->set_rules('kebutuhan_pokok', 'kebutuhan_pokok', 'required');
					$this->form_validation->set_rules('hutang', 'hutang', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$P_profesi = array(
							'penghasilan' => preg_replace("/[^\d]/", "", $this->input->post('penghasilan')),
							'bonus' => preg_replace("/[^\d]/", "", $this->input->post('bonus')),
							'kebutuhan_pokok' => preg_replace("/[^\d]/", "", $this->input->post('kebutuhan_pokok')),
							'hutang' => preg_replace("/[^\d]/", "", $this->input->post('hutang'))
						);
						$bruto_harta = ($P_profesi['penghasilan'] + $P_profesi['bonus']);
						$total_harta = $bruto_harta - ($P_profesi['kebutuhan_pokok'] + $P_profesi['hutang']);	
						if ($total_harta >= ($ket_zakat['nisab'] * $ket_zakat['harga_satuan'])) {
							$zakat = $total_harta * 0.025;
							$keterangan = "Wajib Berzakat";
						}
						else {
							$zakat = 0;
							$keterangan = "Tidak wajib zakat";
						}
					$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $this->input->post('waktu'),
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
					$this->m_harta->insert_harta($harta);
					}
					else {
						echo validation_errors();
					}
				}
				//zakat perniagaan
				else if($params['id_ket'] == '2'){
					$this->form_validation->set_rules('modal', 'modal', 'required');
					$this->form_validation->set_rules('untung', 'untung', 'required');
					$this->form_validation->set_rules('rugi', 'rugi', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$P_perniagaan = array(
							'modal' => preg_replace("/[^\d]/", "", $this->input->post('modal')),
							'piutang' => preg_replace("/[^\d]/", $this->input->post('piutang')),
							'untung' =>preg_replace("/[^\d]/", $this->input->post('untung')),
							'rugi' => preg_replace("/[^\d]/",$this->input->post('rugi')),
							'hutang' =>preg_replace("/[^\d]/", $this->input->post('hutang'))
						);
						$bruto_harta = ($P_perniagaan['modal'] + $P_perniagaan['keuntungan'] + $P_perniagaan['piutang']);
						$total_harta = $bruto_harta - ($P_perniagaan['kebutuhan_pokok']+$P_perniagaan['hutang']);
						if ($total_harta >= ($ket_zakat['nisab'] * $ket_zakat['harga_satuan'])) {
							$zakat = $total_harta * 0.025;
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
						$this->m_harta->insert_harta($harta);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat emas
				else if($params['id_ket'] == '3'){
					$this->form_validation->set_rules('jml_emas', 'jml_emas');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$bruto_harta = preg_replace("/[^\d]/", "", $this->input->post('jml_emas'));
						$total_harta = $bruto_harta ;
						if ($total_harta >= $ket_zakat['nisab']){
							$zakat_emas = $total_harta * 0.025;
							$zakat = $zakat_emas * $ket_zakat['harga_satuan'];
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
						$this->m_harta->insert_harta($harta);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat perak
				else if ($params['id_ket'] == '4'){
					$this->form_validation->set_rules('jml_perak', 'jml_perak', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$bruto_harta = preg_replace("/[^\d]/", "", $this->input->post('jml_perak'));
						$total_harta = $bruto_harta;
						if ($total_harta >= $ket_zakat['nisab']){
							$zakat_perak = $total_harta * 0.025;
							$zakat = $zakat_perak * $ket_zakat['harga_satuan'];
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
						$this->m_harta->insert_harta($harta);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat sapi
				else if ($params['id_ket'] == '5'){
					$this->form_validation->set_rules('jml_hewan', 'jumlah hewan', 'required');
					$this->form_validation->set_rules('harga_hewan1', 'harga hewan1', 'required');
					$this->form_validation->set_rules('harga_hewan2', 'harga hewan2', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$p_peternakan = array(
							'jml_hewan'=> preg_replace("/[^\d]/", "", $this->input->post('jml_hewan')),
							'harga_hewan1'=> preg_replace("/[^\d]/", "", $this->input->post('harga_hewan1')),
							'harga_hewan2'=> preg_replace("/[^\d]/", "", $this->input->post('harga_hewan2')),
						); 
						$bruto_harta = $p_peternakan['jml_hewan'];
						$total_harta = $bruto_harta;
						if ($total_harta < $ket_zakat['nisab']) {
							$zakat = 0;
							$keterangan = "tidak Wajib Zakat";
						}
						else if($total_harta >= $ket_zakat['nisab']){
							$keterangan = 'wajib Zakat';
							$hewan1 = $total_harta / 40;
							$hewan2 = $total_harta / 30;
							$modulus2 = $total_harta % 30;
							$modulus1 = $total_harta % 40;   
							if ($modulus1 == 0 && $modulus2 == 0) {
								$hewan1;
								$hewan2 = 0;
							}
							else if ($modulus1 == 0 or $modulus1 < 10 && $modulus2 != 0 ){
								$hewan1;
								$hewan2 =0;
							}
							else if ($modulus1 != 0  && $modulus2 == 0 or $modulus1 < 10){
								$hewan2;
								$hewan = 0;
							}
							else if ($modulus1 < 30 && $modulus1 > 10){
								$hewan1 = $hewan1 - 1;
								$x = 40 + $modulus1;
								$hewan2 = $x / 30;
							} 
							else if($modulus1 >= 30){
								$hewan2 = $modulus1 / 30; 
							}
							// $zakat = (floor($hewan2) * $p_peternakan['harga_hewan2']) + (floor($hewan1) * $p_peternakan['harga_hewan1']);
						}
						$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
						$idh = $this->m_harta->insert_harta($harta);
						$zakat_peternakan = array(
							'id_harta'=> $idh,
							'umur1' => floor($hewan1),
							'umur2' => floor($hewan2),
							'harga_1' => $p_peternakan['harga_hewan1'],
							'harga_2' => $p_peternakan['harga_hewan2']
						);
						$this->m_harta->insert_peternakan($zakat_peternakan);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat kambing
				else if ($params['id_ket'] == '6'){
					$this->form_validation->set_rules('jml_hewan', 'jml_hewan', 'required');
					$this->form_validation->set_rules('harga_hewan', 'harga hewan', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$p_peternakan = array(
							'jml_hewan' => preg_replace("/[^\d]/", "", $this->input->post('jml_hewan')),
							'harga_hewan' => preg_replace("/[^\d]/", "", $this->input->post('harga_hewan')),
						);
						$bruto_harta = $p_peternakan['jml_hewan'];
						$total_harta = $bruto_harta;
						if ($total_harta < $ket_zakat['nisab']) {
							$zakat = 0;
							$keterangan = "tidak Wajib Zakat";
						}
						else if($total_harta >= $ket_zakat['nisab']){
							$keterangan = "Wajib Zakat";
							if ($total_harta <= 120){
								$hewan1 = 1;
							}
							else if($total_harta >= 121 && $total_harta <=200){
								$hewan1 = 2;
							}
							else if($total_harta >= 201){
								$hewan1 = floor($total_harta / 100);
								$modulus = $total_harta % 100;
								if($modulus != 0){
									$hewan1 = $hewan1 + 1;
								}
							}
							$zakat = $hewan1 * $p_peternakan['harga_hewan'];
						}
						$harta = array(
							'id_muzaki' => $id_muzaki['id_muzaki'],
							'id_ket' => $this->input->post('ket_zakat'),
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month'],
							'status_harta' => 'aktif'
						);
						$idh = $this->m_harta->insert_harta($harta);
						$zakat_peternakan = array(
							'id_harta'=> $idh,
							'umur1' => floor($hewan1),
							'harga_1' => $p_peternakan['harga_hewan']
						);
						$this->m_harta->insert_peternakan($zakat_peternakan);
					}
				}   
				// print_r($harta);
				// exit();
				redirect('muzaki/zakat/harta');
			}	

			} else {
				echo "<script type='text/javascript'>alert('Jenis zakat ini sudah anda miliki, data tidak dapat ditambahkan');window.location.href='".site_url('muzaki/zakat/harta/add_zakat_harta')."'</script>";		
			}
			
		}

		

		public function edit($where = " "){
			$id_muzaki = $this->session->userdata('login_muzaki');
			$d = date('d');
			$m = date('m');
			$y = date('Y');
			$bulannow = $this->convert->GregorianToHijriah($y, $m, $d);
			$data['jumlah'] = $this->m_harta->get_jumlah($id_muzaki['id_muzaki'],  $bulannow['month']);
			$data['list_keranjang'] = $this->m_harta->get_checkout($id_muzaki['id_muzaki'],  $bulannow['month']);
			$id_harta = array('harta.id_harta' => $where);
			$data['list_harta'] = $this->m_harta->get_all_detail($id_harta);
			$data['id_harta'] = $where;
			$this->load->view('muzaki/zakat/harta/edit', $data);
		} 

		public function update(){
			$id_muzaki = $this->input->post('id_muzaki');
			$where = array('id_harta' => $this->input->post('id_harta'));
			// print_r($where);
			// exit();
			$params = $this->input->post('id_ket');
			$waktu_zakat = $this->input->post('waktu');
			$ket_zakat = $this->m_harta->get_ket_detail($params);
			$waktu = array('bulan' => date('m', strtotime($waktu_zakat)),
							'tahun' => date('Y', strtotime($waktu_zakat)),
							'tgl' => date('d', strtotime($waktu_zakat))
			 		);
			$bulan = $this->convert->GregorianToHijriah($waktu['tahun'], $waktu['bulan'], $waktu['tgl']);
			$ket_zakat = $this->m_harta->get_ket_detail($params);
			print_r($params);
			if (!empty($params)){
				print_r($params);
				//zakat profesi
				if($params == '1'){
					$this->form_validation->set_rules('penghasilan', 'penghasilan', 'required');
					$this->form_validation->set_rules('bonus', 'bonus', 'required');
					$this->form_validation->set_rules('kebutuhan_pokok', 'kebutuhan_pokok', 'required');
					$this->form_validation->set_rules('hutang', 'hutang', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$P_profesi = array(
							'penghasilan' => preg_replace("/[^\d]/", "", $this->input->post('penghasilan')),
							'bonus' => preg_replace("/[^\d]/", "", $this->input->post('bonus')),
							'kebutuhan_pokok' => preg_replace("/[^\d]/", "", $this->input->post('kebutuhan_pokok')),
							'hutang' => preg_replace("/[^\d]/", "", $this->input->post('hutang'))
						);
						$bruto_harta = ($P_profesi['penghasilan'] + $P_profesi['bonus']);
						$total_harta = $bruto_harta - ($P_profesi['kebutuhan_pokok'] + $P_profesi['hutang']);	
						if ($total_harta >= ($ket_zakat['nisab'] * $ket_zakat['harga_satuan'])) {
							$zakat = $total_harta * 0.025;
							$keterangan = "Wajib Berzakat";
						}
						else {
							$zakat = 0;
							$keterangan = "Tidak wajib zakat";
						}
					$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $this->input->post('waktu'),
							'bulan_Hijriah' => $bulan['month'],
						);
					$this->m_harta->update($harta, $where);
					}
					else {
						echo validation_errors();
					}
				}
				//zakat perniagaan
				else if($params == '2'){
					$this->form_validation->set_rules('modal', 'modal', 'required');
					$this->form_validation->set_rules('untung', 'untung', 'required');
					$this->form_validation->set_rules('rugi', 'rugi', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$P_perniagaan = array(
							'modal' => preg_replace("/[^\d]/", "", $this->input->post('modal')),
							'piutang' => preg_replace("/[^\d]/", $this->input->post('piutang')),
							'untung' =>preg_replace("/[^\d]/", $this->input->post('untung')),
							'rugi' => preg_replace("/[^\d]/",$this->input->post('rugi')),
							'hutang' =>preg_replace("/[^\d]/", $this->input->post('hutang'))
						);
						$bruto_harta = ($P_perniagaan['modal'] + $P_perniagaan['keuntungan'] + $P_perniagaan['piutang']);
						$total_harta = $bruto_harta - ($P_perniagaan['kebutuhan_pokok']+$P_perniagaan['hutang']);
						if ($total_harta >= ($ket_zakat['nisab'] * $ket_zakat['harga_satuan'])) {
							$zakat = $total_harta * 0.025;
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month']
						);
						$this->m_harta->update($harta, $where);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat emas
				else if($params == '3'){
					$this->form_validation->set_rules('jml_emas', 'jml_emas');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$bruto_harta = preg_replace("/[^\d]/", "", $this->input->post('jml_emas'));
						$total_harta = $bruto_harta ;
						if ($total_harta >= $ket_zakat['nisab']){
							$zakat_emas = $total_harta * 0.025;
							$zakat = $zakat_emas * $ket_zakat['harga_satuan'];
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month']
						);
						$this->m_harta->update($harta, $where);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat perak
				else if ($params == '4'){
					$this->form_validation->set_rules('jml_perak', 'jml_perak', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$bruto_harta = preg_replace("/[^\d]/", "", $this->input->post('jml_perak'));
						$total_harta = $bruto_harta;
						if ($total_harta >= $ket_zakat['nisab']){
							$zakat_perak = $total_harta * 0.025;
							$zakat = $zakat_perak * $ket_zakat['harga_satuan'];
							$keterangan = "Wajib Zakat";
						}
						else{
							$zakat = 0;
							$keterangan = "tidak wajib berzakat ";
						}
						$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month']
						);
						$this->m_harta->update($harta, $where);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat sapi
				else if ($params == '5'){
					$this->form_validation->set_rules('jml_hewan', 'jumlah hewan', 'required');
					$this->form_validation->set_rules('harga_hewan1', 'harga hewan1', 'required');
					$this->form_validation->set_rules('harga_hewan2', 'harga hewan2', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$p_peternakan = array(
							'jml_hewan'=> preg_replace("/[^\d]/", "", $this->input->post('jml_hewan')),
							'harga_hewan1'=> preg_replace("/[^\d]/", "", $this->input->post('harga_hewan1')),
							'harga_hewan2'=> preg_replace("/[^\d]/", "", $this->input->post('harga_hewan2')),
						); 
						$bruto_harta = $p_peternakan['jml_hewan'];
						$total_harta = $bruto_harta;
						if ($total_harta < $ket_zakat['nisab']) {
							$zakat = 0;
							$keterangan = "tidak Wajib Zakat";
						}
						else if($total_harta >= $ket_zakat['nisab']){
							$keterangan = 'wajib Zakat';
							$hewan1 = $total_harta / 40;
							$hewan2 = $total_harta / 30;
							$modulus2 = $total_harta % 30;
							$modulus1 = $total_harta % 40;   
							if ($modulus1 == 0 && $modulus2 == 0) {
								$hewan1;
								$hewan2 = 0;
							}
							else if ($modulus1 == 0 or $modulus1 < 10 && $modulus2 != 0 ){
								$hewan1;
								$hewan2 =0;
							}
							else if ($modulus1 != 0  && $modulus2 == 0 or $modulus1 < 10){
								$hewan2;
								$hewan = 0;
							}
							else if ($modulus1 < 30 && $modulus1 > 10){
								$hewan1 = $hewan1 - 1;
								$x = 40 + $modulus1;
								$hewan2 = $x / 30;
							} 
							else if($modulus1 >= 30){
								$hewan2 = $modulus1 / 30; 
							}
							// $zakat = (floor($hewan2) * $p_peternakan['harga_hewan2']) + (floor($hewan1) * $p_peternakan['harga_hewan1']);
						}
						$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month']
						);
						$this->m_harta->update($harta, $where);
						$zakat_peternakan = array(
							'umur1' => floor($hewan1),
							'umur2' => floor($hewan2),
							'harga_1' => $p_peternakan['harga_hewan1'],
							'harga_2' => $p_peternakan['harga_hewan2']
						);
						$this->m_harta->update_peternakan($zakat_peternakan, $where);
					}
					else{
						echo validation_errors();
					}
				}
				//zakat kambing
				else if ($params== '6'){
					$this->form_validation->set_rules('jml_hewan', 'jml_hewan', 'required');
					$this->form_validation->set_rules('harga_hewan', 'harga hewan', 'required');
					$this->form_validation->set_rules('waktu', 'waktu', 'required');
					if ($this->form_validation->run() !== FALSE) {
						$p_peternakan = array(
							'jml_hewan' => preg_replace("/[^\d]/", "", $this->input->post('jml_hewan')),
							'harga_hewan' => preg_replace("/[^\d]/", "", $this->input->post('harga_hewan')),
						);
						$bruto_harta = $p_peternakan['jml_hewan'];
						$total_harta = $bruto_harta;
						if ($total_harta < $ket_zakat['nisab']) {
							$zakat = 0;
							$keterangan = "tidak Wajib Zakat";
						}
						else if($total_harta >= $ket_zakat['nisab']){
							$keterangan = "Wajib Zakat";
							if ($total_harta <= 120){
								$hewan1 = 1;
							}
							else if($total_harta >= 121 && $total_harta <=200){
								$hewan1 = 2;
							}
							else if($total_harta >= 201){
								$hewan1 = floor($total_harta / 100);
								$modulus = $total_harta % 100;
								if($modulus != 0){
									$hewan1 = $hewan1 + 1;
								}
							}
							$zakat = $hewan1 * $p_peternakan['harga_hewan'];
						}
						$harta = array(
							'bruto_harta' => $bruto_harta,
							'total_harta' => $total_harta,
							// 'keterangan' => $keterangan,
							// 'membayar_zakat' => $zakat,
							'waktu_zakat' => $waktu_zakat,
							'bulan_Hijriah' => $bulan['month']
						);
						$this->m_harta->update($harta, $where);
						$zakat_peternakan = array(
							'umur1' => floor($hewan1),
							'harga_1' => $p_peternakan['harga_hewan']
						);
						$this->m_harta->update_peternakan($zakat_peternakan, $where);
					}
				}   
				redirect('muzaki/zakat/harta');
			}	
		}

		public function nonaktif($id_harta){
			$where = array('harta.id_harta' => $id_harta);
			$params = array('status_harta' => 'non aktif');
			$this->m_harta->update_status($params, $where);
			redirect('muzaki/zakat/harta');
		}

		public function aktif($id_harta = ""){
			$where = array('harta.id_harta' => $id_harta);
			$params = array('status_harta' => 'aktif');
			$this->m_harta->update_status($params, $where);
			redirect('muzaki/zakat/harta');
		}
	}
 ?>