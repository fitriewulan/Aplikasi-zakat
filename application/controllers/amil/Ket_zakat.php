<?php   
/**
* 
*/
  class Ket_zakat extends CI_Controller
  {
    
    function __construct(){
      # code...
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('amil/m_ket_zakat');

      if (!$this->session->userdata('login_amil')) {
        # code...
      redirect('amil/auth/login');
      }
    }

    public function index(){
      $data['ket_zakat'] = $this->m_ket_zakat->get_ket();
      $this->load->view('amil/ket_zakat', $data);
    }

    public function harga_nisab(){
      $ket_zakat =  $this->m_ket_zakat->get_ket();
       // $date = date('Y-m-d');
        $date = date('Y-m-d'); 
        $day = date('l'); 
      if ($day == "Sunday" or $day == "Saturday") {
                echo "<script type='text/javascript'>alert('Mohon maaf hari sabtu, minggu data harga tidak dapat terupdate, silakan input secara manual');window.location.href='".site_url('amil/ket_zakat')."'</script>";
      } 
      else {
        foreach ($ket_zakat as $zakat){
                // $jenis_nisab = array('jenis_nisab' => $zakat['jenis_nisab']);
            if ($zakat['jenis_nisab'] == 'Emas' ) {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'http://www.logammulia.com/price_list.php?idbutik=9&idkat=13&tanggal='.$date.'&iddesc=0001');
              curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              $harga = curl_exec($ch);
              curl_close($ch);
              $result = explode('<td bgcolor="#FFFFFF">', $harga);
              $params = array('harga_satuan' => preg_replace("/[^\d]/", "",$result[3]));
              $where = array('jenis_nisab' => "Emas" );
              print_r($params);

              if (!empty($params['harga_satuan'])) {
                 $this->m_ket_zakat->update_ket($where, $params);
              } 
            
            }
            elseif($zakat['jenis_nisab'] == 'Perak') {
               $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'http://www.logammulia.com/price_list.php?idbutik=11&idkat=5&tanggal='.$date.'&iddesc=0002');
                curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $harga = curl_exec($ch);
                curl_close($ch);
                $result = explode('<td bgcolor="#FFFFFF">', $harga);
                $params = array('harga_satuan' => preg_replace("/[^\d]/", "",$result[4]));
                $where = array('jenis_nisab' => "Perak" );
                
                 if (!empty($params['harga_satuan'])) {
                 $this->m_ket_zakat->update_ket($where, $params);
                } 
            }
            elseif ($zakat['jenis_nisab'] == 'Beras' ) {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://ews.kemendag.go.id/');
              curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              $harga = curl_exec($ch);
              curl_close($ch);
              $result = explode('<div class="hargaskg">', $harga);
              $result2 = substr($result[1], 4, 6);
              // print_r($result);
              // print_r($result2);
              // print_r($params);
              $params = array('harga_satuan' => preg_replace("/[^\d]/", "", $result2));
              $where = array('jenis_nisab' => "Beras" ); 
                if (!empty($params['harga_satuan'])) {
                 $this->m_ket_zakat->update_ket($where, $params);
                }
            }
        }
       
      redirect('amil/ket_zakat'); 
      }
    }

    public function edit(){
      $data['ket_zakat'] = $this->m_ket_zakat->get_ket();
      $this->load->view('amil/edit_ket', $data);
    }

    public function update($id_ket=""){
      $this->form_validation->set_rules('harga_satuan','harga_satuan', 'required');
      if ($this->form_validation->run() !== FALSE) {
        $params = array('harga_satuan'=> $this->input->post('harga_satuan')
        );
        $where = array('jenis_nisab' => $this->input->post('jenis_nisab')
        );
        if ($this->m_ket_zakat->update_ket($where, $params)) {
          redirect('amil/ket_zakat');
        }
        else{
          echo "error";
        }
      }
    }

  }
?>