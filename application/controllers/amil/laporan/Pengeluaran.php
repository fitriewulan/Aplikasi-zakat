<?php 	
/**
* 
*/
class Pengeluaran extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('amil/m_laporan');
			$this->load->model('amil/m_transaksi');
			$this->load->model('admin/pengaturan/m_rektrans');
			$this->load->library('form_validation');
			if (!$this->session->userdata('login_amil')) {
				# code...
			redirect('amil/auth/login');
			}

		}

		public function index(){
			$cari = $this->session->userdata('cari_k');
			$data['list_tahun'] = $this->m_transaksi->get_all_tahun_pengeluaran();
			$data['list_keluar'] = $this->m_laporan->get_keluar($cari['bulan'],$cari['tahun']);
			$this->load->view('amil/laporan/Pengeluaran', $data);
		}

		public function filter_process() {
			$where = array('bulan' => $this->input->post('bulan'),
							'tahun' => $this->input->post('tahun')
					 ); 
			// simpan ke dalam session
			$this->session->set_userdata('cari_k',$where);
			redirect('amil/laporan/Pengeluaran');
	 	}

	 	public function tambah(){
	 		$data['rekening'] = $this->m_rektrans->get_rek();
	 		$this->load->view('amil/laporan/tambah_pengeluaran', $data);
	 	}

	 	public function add_process(){
			$this->form_validation->set_rules('ambil', 'ambil', 'required');
			$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
			$this->form_validation->set_rules('pembayaran', 'pembayaran', 'required');
			$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
			$this->form_validation->set_rules('ket', 'keterangan', 'required');

			$id_amil = $this->session->userdata('login_amil');
			if($this->form_validation->run() !== FALSE){
				$params = array(
					'id_amil' => $id_amil['id_amil'],
					'ambil' => $this->input->post('ambil'),
					'tgl_trans_umum' => $this->input->post('tanggal'),
					'jenis_transaksi' => $this->input->post('pembayaran'),
					'jumlah' => preg_replace("/[^\d]/", "", $this->input->post('jumlah')),
					'keterangan' => $this->input->post('ket'),
				); 
					$this->m_transaksi->insert_pengeluaran($params);
					redirect('amil/laporan/Pengeluaran');	
			}
			else{
				echo validation_errors();	
			}
		}

		public function update_pengeluaran($id_trans_umum){
			$where = array('id_trans_umum' => $id_trans_umum);
	 		$data['rekening'] = $this->m_rektrans->get_rek();
	 		$data['pengeluaran'] = $this->m_laporan->get_detail_keluar($where);
	 		$this->load->view('amil/laporan/edit_pengeluaran', $data);
	 	}

	 	public function process_update($id_trans_umum){
	 		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
			$this->form_validation->set_rules('pembayaran', 'pembayaran', 'required');
			$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
			$this->form_validation->set_rules('ket', 'keterangan', 'required');

			$id_amil = $this->session->userdata('login_amil');

			$where = array('id_trans_umum' => $id_trans_umum);
			if($this->form_validation->run() !== FALSE){
				$params = array(
					'id_amil' => $id_amil['id_amil'],
					'ambil' => $this->input->post('ambil'),
					'tgl_trans_umum' => $this->input->post('tanggal'),
					'jenis_transaksi' => $this->input->post('pembayaran'),
					'jumlah' => preg_replace("/[^\d]/", "", $this->input->post('jumlah')),
					'keterangan' => $this->input->post('ket'),
				); 
					$this->m_transaksi->update_pengeluaran($params, $where);
					redirect('amil/laporan/Pengeluaran');	
			}
			else{
				echo validation_errors();	
			}

	 	}

		public function export(){
		    include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		    
		    // Panggil class PHPExcel nya
		    $excel = new PHPExcel();
		    // Settingan awal fil excel
		    $excel->getProperties()->setCreator('My Notes Code')
		                 ->setLastModifiedBy('My Notes Code')
		                 ->setTitle("Laporan Pengeluaran")
		                 ->setSubject("Transaksi Pengeluaran")
		                 ->setDescription("Laporan Semua Data Transaksi Pengeluaran")
		                 ->setKeywords("Data Pengeluaran");
		    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		    $style_col = array(
		      'font' => array('bold' => true), // Set font nya jadi bold
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
		    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
		    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pengeluaran"); // Set kolom A1 dengan tulisan
		    $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		    // Buat header tabel nya pada baris ke 3
		    $excel->setActiveSheetIndex(0)->setCellValue('A3', "No Transaksi"); // Set kolom A3 dengan tulisan "NO"
		    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Tanggal"); // Set kolom B3 dengan tulisan "NIS"
		    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Amil"); // Set kolom C3 dengan tulisan "NAMA"
		    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Ambil dari"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		    $excel->setActiveSheetIndex(0)->setCellValue('E3', "pembayaran"); // Set kolom E3 dengan tulisan "ALAMAT"
		    $excel->setActiveSheetIndex(0)->setCellValue('F3', "keterangan"); // Set kolom E3 dengan tulisan "ALAMAT"
		    $excel->setActiveSheetIndex(0)->setCellValue('G3', "jumlah"); // Set kolom E3 dengan tulisan "ALAMAT"
		    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
		    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		    // Panggil function view yang ada untuk menampilkan semua data siswanya
		    $cari = $this->session->userdata('cari_k');
			$list_keluar= $this->m_laporan->get_keluar($cari['bulan'],$cari['tahun']);
		     // Untuk penomoran tabel, di awal set dengan 1
		    $total = 0;
		    $num = 0;
		    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		    foreach($list_keluar as $data){ // Lakukan looping pada variabel 
		    	$total = $total + $data['jumlah'];
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['id_trans_umum']);
		      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_trans_umum']);
		      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama_amil']);
		      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['ambil']);
		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['jenis_transaksi']);
		      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['keterangan']);
		      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['jumlah']);
		      
		      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		      
		      // $no++; // Tambah 1 setiap kali looping
		      $numrow++; // Tambah 1 setiap kali looping
		      $num = $num + $numrow;
		    }
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, "Total");
		      $excel->getActiveSheet()->mergeCells('A'.$numrow.':F'.$numrow);
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $total);		   	
		      $excel->getActiveSheet()->getStyle('A'.$numrow.':F'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		    // Set width kolom
		    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
		    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
		    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
		    
		    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    // Set orientasi kertas jadi LANDSCAPE
		    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    // Set judul file excel nya
		    $excel->getActiveSheet(0)->setTitle("Laporan Pemasukan");
		    $excel->setActiveSheetIndex(0);
		    // Proses file excel
		    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		    header('Content-Disposition: attachment; filename="laporan Peengeluaran('.date('y-m-d').').xlsx"'); // Set nama file excel nya
		    header('Cache-Control: max-age=0');

		    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		    $write->save('php://output');
		}

		public function delete_pengeluaran($id_trans_umum){
			$where= array('id_trans_umum' => $id_trans_umum);
			$this->m_transaksi->delete_pengeluaran($where);
			redirect('amil/laporan/pengeluaran');
		}
	 }
 ?>