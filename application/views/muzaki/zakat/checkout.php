<?php 
$this->load->view('header');
$this->load->view('muzaki/header')
 ?>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <table class="table table-heading" style="border: 0;">
              <tr>
                <td colspan="5" align="right"><span><i>Cek Tagihan yang akan dibayar</i> </span> <a href="<?= site_url('muzaki/tagihan/')?>" class="btn btn-primary"> Tagihan Zakat</a></td>
              </tr>
              <tbody>
                <tr>
                  <th class="table-grid">Jenis Zakat</th>
                  <th>Kadar Nisab</th>    
                  <th style="width: 150px">Harga</th>
                  <th><i class="fa fa-check"></i></th>
                </tr>

              </tbody>
              <form action="<?= site_url('muzaki/tagihan/insert_tagihan/')?>" method="post">
                <?php
                $total = 0;
                $i = 0;
                 foreach($list_tagihan as $tagihan): ?>
                <tr>
                  <td>  
                  <?php if ($tagihan['jenis_zakat'] == 'zakat profesi'): ?>  
                    <div class="card-columns">
                     <a href="single.html" class="at-in"><img src="<?= base_url('resource/images/jenis-zakat/zakatprofesi.png')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                    </div>
                    <div class="sed" align="left">
                        <h2 class="h5 text-uppercase"><a href="single.html"><?= $tagihan['jenis_zakat']?></a></h2>
                          <p>(zakat yang dibayarkan oleh seorang yg berprofesi sesuai dengan kadar zakat)</p>
                    </div>
                   <?php elseif ($tagihan['jenis_zakat'] == 'zakat pertenakan'):?>
                    <div class="card-columns">
                     <a href="single.html" class="at-in"><img style="margin: 5px" src="<?= base_url('resource//images/jenis-zakat/zakatpertenakan.jpg')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                    </div>
                    <div class="sed" align="left">
                        <h2 class="h5 text-uppercase"><a href="single.html"><?= $tagihan['jenis_zakat']?></a></h2>
                          <p>(zakat yang dibayarkan oleh seorang yg memiliki ternak sesuai dengan kadar zakat)</p>
                    </div>  
                  <?php elseif ($tagihan['jenis_zakat'] == 'zakat perniagaan'):?>
                    <div class="card-columns">
                     <a href="single.html" class="at-in"><img style="margin: 5px" src="<?= base_url('resource/images/jenis-zakat/perniagaan.jpg')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                    </div>
                    <div class="sed" align="left">
                        <h2 class="h5 text-uppercase"><a href="single.html"><?= $tagihan['jenis_zakat']?></a></h2>
                          <p>(zakat yang dibayarkan oleh seorang yg memiliki perniagaan sesuai dengan kadar zakat)</p>
                    </div>
                    <?php elseif ($tagihan['jenis_zakat'] == 'zakat emas'):?>
                    <div class="card-columns">
                       <a href="single.html" class="at-in"><img style="margin: 5px" src="<?= base_url('resource/images/jenis-zakat/emas.jpg')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                      </div>
                      <div class="sed" align="left">
                          <h2 class="h5 text-uppercase"><a href="single.html"><?= $tagihan['jenis_zakat']?></a></h2>
                          <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Emas sesuai dengan kadar zakat)</p>
                      </div>
                    <?php elseif ($tagihan['jenis_zakat'] == 'zakat perak'):?>
                   <div class="card-columns">
                       <a href="single.html" class="at-in"><img style="margin: 5px" src="<?= base_url('resource/images/jenis-zakat/perak.jpg')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                    </div>
                    <div class="sed" align="left">
                          <h2 class="h5 text-uppercase"><a href="single.html"><?= $tagihan['jenis_zakat']?></a></h2>
                          <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Perak sesuai dengan kadar zakat)</p>
                    </div>  
                  <?php endif ?>
                  </td>
                  <td><?=$tagihan['jenis_nisab']?></td>
                  <?php $i++ ?>
                  <td>Rp. <?= number_format($zakat_tagihan[$i]['bayar'], 2, ',','.')?></td>
                  <td>
                    <div class="form-check">
                      <input type="checkbox" id="inlineCheckbox1" name="cek[]" value="<?= $tagihan['id_harta']?>" checked>
                    <!--   <?php
                      if (isset($_POST['cek'])){
                      echo $_POST['cek']; // Displays value of checked checkbox.
                      }
                      ?>
                    </div> -->
                  </td>
                  <?php
                  $total += str_replace(",","", $zakat_tagihan[$i]['bayar']); ?>
                  <?php endforeach; ?>
                </tr>
                    <?php $zakat = $this->session->userdata('tambah_zakat'); ?>
                    <?php $jenis_zakat = $this->session->userdata('jenis_zakat'); ?>
                    <?php if (!empty($zakat)): ?>
                    <tr>
                      <td>
                        <div class="card-columns">
                         <a href="single.html" class="at-in"><img src="<?= base_url('resource/images/zakatprofesi.png')?>" alt="Card image cap" class="card-img-top" alt=""></a>
                        </div>
                        <div class="sed" align="left">
                            <h2 class="h5 text-uppercase"><a href="single.html"><?= $jenis_zakat['jenis_zakat']?></a></h5>
                            <?php if ($jenis_zakat['jenis_zakat'] == 'zakat profesi'): ?>
                              <p>(zakat yang dibayarkan oleh seorang yg berprofesi sesuai dengan kadar zakat)</p>
                            <?php elseif ($jenis_zakat['jenis_zakat'] == 'zakat pertenakan'):?>
                              <p>(zakat yang dibayarkan oleh seorang yg memiliki ternak sesuai dengan kadar zakat)</p>
                            <?php elseif ($jenis_zakat['jenis_zakat'] == 'zakat perniagaan'):?>
                              <p>(zakat yang dibayarkan oleh seorang yg memiliki perniagaan sesuai dengan kadar zakat)</p>
                               <?php elseif ($jenis_zakat['jenis_zakat'] == 'zakat emas'):?>
                              <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Emas sesuai dengan kadar zakat)</p>
                             <?php elseif ($jenis_zakat['jenis_zakat'] == 'zakat perak'):?>
                              <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Perak sesuai dengan kadar zakat)</p>
                            <?php endif ?>
                        </div>
                      </td>
                      <td><?= $jenis_zakat['jenis_nisab']?></td>
                      <td>Rp. <?= number_format($zakat['membayar_zakat'], 2, ',','.')?></td>
                    </tr>
                    <?php endif ?>
                    
                  <?php
                   $total = $total + $zakat['membayar_zakat'] ?>
                <tr>
                  <td colspan="2" align="right"><b>Total</b></td>
                  <td>Rp. <?= number_format($total, 2, ',','.')?></td>    
                </tr>
                <tr>
                 <!--  <td colspan="5" align="right"><a href="<?= site_url('muzaki/tagihan/insert_tagihan/')?>" class="btn btn-primary">Checkout Zakat</a></td> -->
                  <td colspan="5" align="right"><button class="btn btn-primary">Checkout Zakat</button></td>
                </tr>
             </form>
        </table>
      </div>
    </div>
  </div>,
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<!-- <script type="text/javascript">
  function zakat(id, jenis_zakat){

    $.ajax({
      url : "<?php echo site_url('muzaki/zakat/bayar/ajax_tampil_zakat/')?>/"+id
    })
  }
</script>
<script>
  $(document).ready(function(c) {
    $('.close1').on('click', function(c){
      $('.cart-header').fadeOut('slow', function(c){
        $('.cart-header').remove();
      });
      });   
  });
</script>
<script>
  $(document).ready(function(c) {
    $('.close2').on('click', function(c){
      $('.cart-header1').fadeOut('slow', function(c){
        $('.cart-header1').remove();
      });
    });   
   });
</script>
<script>
  $(document).ready(function(c) {
    $('.close3').on('click', function(c){
      $('.cart-header2').fadeOut('slow', function(c){
        $('.cart-header2').remove();
      });
    });   
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('select').select()
  })

  $('select[name="jenis-zakat"]').change(function(){
    var link_url = "<?= site_url('muzaki/zakat/bayar/ajax_tampil_zakat/') ?>"
    // var request_method = $(this).attr("method");
    // var form_data = $(this).serialize();
    $.ajax({
      url : link_url + $(this).val(),
      // type : request_method,
      // data : form_data
    }).done(function(data){
      if (data) {
        $('input[name="waktu_zakat"]').val(data.waktu_zakat)
        $('input[name="membayar_zakat"]').val(data.membayar_zakat)
        $('input[name="membayar_zakat"]').attr('readonly', 'readonly')
      } else {
        $('input[name="membayar_zakat"]').val(null)
        $('input[name="membayar_zakat"]').removeAttr('readonly')
      }
      // var hasil = JSON.parse(data)
      // data.
     /* if (jenis == '1') {
        bayar.val(hasil.membayar_zakat);
        waktu.val(hasil.waktu_zakat);
      }
      else if (jenis == '2') {
        bayar.val()
      }*/
    })
  })
</script>-->
 <?php $this->load->view('footer') ?>
