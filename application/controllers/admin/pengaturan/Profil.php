<?php 
/**
* 
*/
class Profil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/pengaturan/M_profil');
		$this->load->model('M_preference');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['list_profil'] = $this->M_profil->get_profil();
		$where_email = array('id' => 5 );
		$where_pass = array('id' => 7 );
		$data['email'] = $this->M_preference->get_mail($where_email);
		$data['pass'] = $this->M_preference->get_mail($where_pass);
		$this->load->view('Admin/pengaturan/Profil', $data);
		// print_r($data['list_profil']);
		// exit();
	}

	public function update(){
		$this->form_validation->set_rules('alamat','alamat', 'required');
		$this->form_validation->set_rules('email','email', 'required');
		$this->form_validation->set_rules('whatsapp','whatsapp', 'required');
		$this->form_validation->set_rules('fb','fb', 'required');
		$this->form_validation->set_rules('bbm','bbm', 'required');
     	 if ($this->form_validation->run() !== FALSE) {
        $params = array(
        	'alamat_lazis'=> $this->input->post('alamat'),
        	// 'value'=> $this->input->post('email'),
        	'whatsapp'=> $this->input->post('whatsapp'),
        	'facebook'=> $this->input->post('fb'),
        	'bbm'=> $this->input->post('bbm'),
        );
        // print_r($params);
        // $sql = $this->M_profil->update_profil($params);
        // // print_r($this->db->last_query($sql));
        // // exit();
        $params_email = array('value' => $this->input->post('email'));
        $params_pass = array('value' => $this->input->post('pass') );
        $where_email = array('id' => 5);
        $where_pass = array('id' => 7);
       
        if ($this->M_profil->update_profil($params)){
        	$this->M_preference->update_email($params_email, $where_email);
        	$this->M_preference->update_email($params_pass, $where_pass);
          redirect('admin/pengaturan/profil');
        }
        else{
          echo "error";
        }
      }
	}

	public function grab(){
		$date = date('Y-m-d');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.logammulia.com/price_list.php?idbutik=9&idkat=13&tanggal='.$date.'&iddesc=0001');
		curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$data = curl_exec($ch);
		curl_close($ch);
		$result = explode('<td bgcolor="#FFFFFF">', preg_replace("[^0-9]", "", $data));
		print_r($result[3]);
	}
}
 ?>