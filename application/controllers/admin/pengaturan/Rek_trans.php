<?php 
/**
* 
*/
class Rek_trans extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/pengaturan/M_RekTrans');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['list_rek'] = $this->M_RekTrans->get_rek();
		$this->load->view('Admin/pengaturan/rek_trans/index', $data);
		// print_r($data['list_profil']);
		// exit();
	}

	public function add(){
		$this->load->view('admin/pengaturan/rek_trans/add');
	}

	public function process_add(){
		//validasi inputan
		$this->form_validation->set_rules('bank', 'bank', 'required|max_length[255]');
		$this->form_validation->set_rules('no_rek', 'no_rek', 'required|max_length[255]');
		$this->form_validation->set_rules('nama_rek', 'nama_rek', 'required|max_length[255]');
		//jalankan validasi
		if ($this->form_validation->run() !== FALSE) {
			//validasi tidak error
			//default icon
			$icon= strtolower(str_replace(' ', '-', $this->input->post('bank'))).'.png';
			//upload icon
			// $config['upload_path']='resource/images/icon-bank/';
			// $config['allowed_types']='jpg|jpeg|png|ico|bmp';
			// $config['file_name']=strtolower(str_replace(' ', '-', $this->input->post('bank')));
			// $this->load->library('upload', $config);
			// //load library upload & menggunakan config yang dibuat
			// if ($this->upload->do_upload('icon_bank')){
			// 	# code...
			// 	//ambil nama file yang baru diupload & masukan ke variable logo
			// 	$icon = $this->upload->data('file_name');
			// } 
			// else {
			// 	echo $this->upload->display_errors(); exit();
			// }
			$params = array(
				'nama_bank'=> $this->input->post('bank'),
				'no_rek'=> $this->input->post('no_rek'),
				'nama_rek'=> $this->input->post('nama_rek'),
				//buat mengganti link yg ada space '' menjadi -
				'Icon_bank'=>$icon
				);
			if($this->M_RekTrans->insert($params)){
				redirect('admin/pengaturan/rek_trans');
			}
			else{
				echo 'error';
			}
		}
		$this->load->view('admin/pengaturan/rek_trans/add');
	}

	public function edit($id_rek = ""){
		$where = array('id_rek' => $id_rek);
		$data['list_rek'] = $this->M_RekTrans->get_detail_rek($where);
		$this->load->view('Admin/pengaturan/rek_trans/edit', $data);
	}

	public function update($id_rek = ""){
		$this->form_validation->set_rules('bank','bank', 'required|max[255]');
		$this->form_validation->set_rules('no_rek','no_rek', 'required|max[255]');
		$this->form_validation->set_rules('nama_rek', 'nama_rek', 'required|max_length[255]');
		//jalankan validasi
     	 if ($this->form_validation->run() !== FALSE) {
     	 	$icon= strtolower(str_replace(' ', '-', $this->input->post('bank'))).'.png';
			// jika upload logo baru
			// if (!empty($_FILES['brand_logo']['tmp_name'])) {
			// 	// upload logo
			// 	$config['upload_path'] = 'resource/images/icon-bank/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png|ico|bmp';
			// 	$config['file_name'] = strtolower(str_replace(' ', '-', $this->input->post('bank')));
			// 	// load library upload & menggunakan config yg dibuat
			// 	$this->load->library('upload', $config);
			// 	// proses upload
			// 	// brand_logo adalah nama input file
			// 	if ($this->upload->do_upload('icon_bank')) {
			// 		// ambil nama file yg baru diupload & masukkan ke variable logo
			// 		$logo = $this->upload->data('file_name');
			// 	} else {
			// 		echo $this->upload->display_errors();
			// 	}
			// }
	        $params = array(
	        	'nama_bank'=> $this->input->post('bank'),
	        	'no_rek'=> $this->input->post('no_rek'),
	        	'nama_rek'=> $this->input->post('nama_rek'),
	        	'Icon_bank'=> $icon
	        );
	        $where = array('id_rek' => $id_rek );
	        if ($this->M_RekTrans->update_rek($params, $where)) {
	          redirect('admin/pengaturan/Rek_trans/');
	        }
	        else{
	          echo "error";
	        }
	    }
	}
	public function delete($id_rek = ""){
		$params = array('id_rek' => $id_rek);
		$rek = $this->M_RekTrans->get_detail_rek($params);
		$this->M_RekTrans->delete($params);
		redirect('admin/pengaturan/rek_trans');
	}
}
 ?>