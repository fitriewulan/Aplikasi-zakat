<?php 
	/**
	* 
	*/
	class Laporan_masuk extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('amil/m_laporan');
			$this->load->model('amil/m_transaksi');
			if (!$this->session->userdata('login_amil')) {
				# code...
			redirect('amil/auth/login');
			}

		}

		public function index(){
			$cari = $this->session->userdata('cari_m');
			$data['list_tahun'] = $this->m_transaksi->get_all_tahun();
			$data['list_masuk'] = $this->m_laporan->get_masuk($cari['bulan'], $cari['tahun'], $cari['jenis_zakat']);
			// print_r($this->db->last_query($data['list_masuk']));
			// exit();
			$data['real'] = $this->m_laporan->get_real($cari['bulan'], $cari['tahun']);
			// print_r($this->db->last_query($data['real']));
			// exit();
			$this->load->view('amil/laporan/laporan_pemasukan', $data);
		}

		public function filter_process() {
			$where = array('bulan' => $this->input->post('bulan'),
							'jenis_zakat' => $this->input->post('jenis_zakat'),
							'tahun' => $this->input->post('tahun'),
					 ); 
			// simpan ke dalam session
			$this->session->set_userdata('cari_m',$where);
			redirect('amil/laporan/laporan_masuk');
	 	}

	 	 public function export(){
		    include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		    
		    // Panggil class PHPExcel nya
		    $excel = new PHPExcel();
		    // Settingan awal fil excel
		    $excel->getProperties()->setCreator('My Notes Code')
		                 ->setLastModifiedBy('My Notes Code')
		                 ->setTitle("Laporan pemasukan")
		                 ->setSubject("Transaksi Pemasukan")
		                 ->setDescription("Laporan Semua Data Transaksi pemasukan")
		                 ->setKeywords("Data Pemasukan");
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
		    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pemasukan"); // Set kolom A1 dengan tulisan "DATA SISWA"
		    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		    // Buat header tabel nya pada baris ke 3
		    $excel->setActiveSheetIndex(0)->setCellValue('A3', "No Transaksi"); // Set kolom A3 dengan tulisan "NO"
		    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Tanggal"); // Set kolom B3 dengan tulisan "NIS"
		    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Jenis Zakat"); // Set kolom C3 dengan tulisan "NAMA"
		    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Rekening"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Bayar Zakat"); // Set kolom E3 dengan tulisan "ALAMAT"
		    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
		    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		    // Panggil function view yang ada untuk menampilkan semua data siswanya
		    $cari = $this->session->userdata('cari_m');
		    $list_masuk =$this->m_laporan->get_masuk($cari['bulan'], $cari['tahun'], $cari['jenis_zakat']);
		    $real =$this->m_laporan->get_real($cari['bulan'], $cari['tahun']);
		     // Untuk penomoran tabel, di awal set dengan 1
		    $total = 0;
		    $num = 0;
		    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		    foreach($list_masuk as $data){ // Lakukan looping pada variabel 
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['id_trans']);
		      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_trans']);
		      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['jenis_zakat']);
		      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nama_bank']);
		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['bayar_zakat']);
		      
		      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		      
		      // $no++; // Tambah 1 setiap kali looping
		      $numrow++; // Tambah 1 setiap kali looping
		      $num = $num + $numrow;
		       $total = $total + $data['bayar_zakat'];
		    }
		    // print_r($total);
		    $num1 = $numrow + 1;
		    $num2 = $num1 + 1;
		    $shadaqoh = $real['jumlah'] - $total;
		    // print_r($real['jumlah']);
		    // print_r($shadaqoh);
		    // exit();
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, "Total");
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$num1, "Tidak dapat difilter berdasarkan jenis zakat");
		      $excel->setActiveSheetIndex(0)->setCellValue('D'.$num1, "Total Real");
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$num2, "Shadaqoh");


		      $excel->getActiveSheet()->mergeCells('A'.$numrow.':D'.$numrow);
		      $excel->getActiveSheet()->mergeCells('A'.$num1.':C'.$num1);
		      $excel->getActiveSheet()->mergeCells('A'.$num2.':D'.$num2);
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		      $excel->getActiveSheet()->getStyle('A'.$num1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		      $excel->getActiveSheet()->getStyle('A'.$num2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $total);		   	
		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$num1, $real['jumlah']);		   	
		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$num2, $shadaqoh);	

		      $excel->getActiveSheet()->getStyle('A'.$numrow.':D'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('A'.$num1.':C'.$num1)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('A'.$num2.':D'.$num2)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('D'.$num1)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$num1)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$num2)->applyFromArray($style_row);
		    // Set width kolom
		    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
		    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
		    
		    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    // Set orientasi kertas jadi LANDSCAPE
		    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    // Set judul file excel nya
		    $excel->getActiveSheet(0)->setTitle("Laporan Pemasukan");
		    $excel->setActiveSheetIndex(0);
		    // Proses file excel
		    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		    header('Content-Disposition: attachment; filename="laporan Pemasukan('.date('y-m-d').').xlsx"'); // Set nama file excel nya
		    header('Cache-Control: max-age=0');

		    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		    $write->save('php://output');
		  }
	}
 ?>