<?php $this->load->view('header') ?>
<?php $this->load->view('muzaki/header') ?>
<style>
    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.21);
        position: relative;
        background-color: #ffffff;
    }
    .tablinks{
      cursor: pointer;
    }

 </style>
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">zakat/aset</li>
          </ul>
        </div>
      </div>  
      <!-- Statistics Section-->
      <section class= "dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row" style="padding: 0 0 20px 0">
            <a href="<?= site_url('muzaki/zakat/harta/add_zakat_harta')?>" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Aset & Hitung Zakat</a>
          </div>
          <div class="row"">
            <?php
            if (!empty($list_harta)): ?>
               <?php $i = 0;
                foreach ($list_harta as $Z):
                  $i++;?>
                  <div class="tab nav nav-tabs col-xl-2 col-md-4 col-7" id="nav-tab">
                    <a class="tablinks nav-item nav-link" data-toggle = "tab" role="tab" onclick= "openpage(event, <?=$Z['id_harta']?>)">
                        <div class="wrapper count-title d-flex">
                          <div class="icon"><i class="icon-bill"></i><i class="fa fa-sort-down"></i></div>
                          <div class="name"><strong class="text-uppercase"><?= $Z['jenis_zakat']?></strong><span><?= $zakat[$i]['ket']?></span>
                            <?php if ($Z['jenis_zakat'] != 'zakat fitrah'): ?>
                                <strong><span><?=date('Y')."-".$Z['month']."-".$Z['day']?></span></strong>
                            <?php else: 
                                  $this->load->library('convert');
                                  $b = $Z['month'];  
                                  $h = $Z['day'];  
                                  $d = date('d');
                                  $m = date('m');
                                  $y = date('Y');
                                  $hijriah = $this->convert->GregorianToHijriah($y, $m, $d);
                                    $t = $hijriah['year'];
                                  $date = $this->convert->toGregorian($t, $b, $h);
                                  // print_r($date);
                                  // exit();
                            ?> 
                                <strong><span><?= date('Y')."-".$date['month']."-".$date['day']?></span></strong>
                            <?php endif ?>
                           
                          </div>
                        </div>
                    </a>
                  </div>
                <?php endforeach; ?>
            <?php else: ?>
               <div class="alert alert-info" role="alert">
                Belum ada data Aset Harta <a class="alert-link">Tambah dan Hitung Aset Harta</a> yang telah anda miliki. 
            </div>
            <?php endif ?>
           
          </div>

            <?php $i = 0;
            foreach ($list_harta as $harta) : ?>
              <div id="<?=$harta['id_harta']?>" " class="tabcontent tab-pane">
                <div class="display h4">DETAIL ZAKAT </div>
                 <table class="table table-striped table-hover">
                   <tr>
                    <td>Jenis Zakat</td>
                    <td colspan="2"><b><?=$harta['jenis_zakat']?></b></td>
                  </tr>
                  <tr>
                    <td>Wajib Membayar Zakat</td>
                    <?php $i++; ?>
                    <td><b>Rp. <?= number_format($zakat[$i]['bayar'], 2, ',','.')?></b></td>
                  </tr>
                  <?php if ($harta['jenis_zakat'] == 'zakat pertenakan'): ?> 
                    <tr>  
                      <td colspan="3" align="center"><b>ATAU</b></td>
                    </tr>
                    <tr>
                        <td> BerZakat dengan </td> 
                            <?php if ($harta['jenis_nisab'] == 'Sapi'): ?>
                              <td><?= $harta['umur1']?> ekor Sapi umur 1 tahun (tabi')</td>
                              <td><?= $harta['umur2']?> ekor Sapi umur 2 tahun (musinah)</td>
                            </tr>
                            <tr> 
                                <td>Harga Sapi</td>
                                <td>Rp. <?=number_format($harta['harga_1'], 2, ',','.')?></td>
                                <td>Rp. <?=number_format($harta['harga_2'], 2, ',','.')?></td>
                            </tr>
                            <?php  elseif ($harta['jenis_nisab'] == 'Kambing'): ?>
                              <td><?= $harta['umur1']?> ekor Kambing</td>
                            </tr>
                            <tr>
                              <td>Harga Kambing</td>
                              <td>Rp. <?=number_format($harta['harga_1'], 2, ',','.')?></td>
                            </tr>
                            <?php endif ?> 
                    </tr>   
                  <?php endif ?>
                  <?php if ($harta['jenis_zakat'] == 'zakat fitrah'): ?>
                  <?php else: ?> 
                    <tr>
                        <td>Harta/Kekayaan</td>
                      <?php if ($harta['jenis_zakat'] == 'zakat pertenakan'): ?>
                        <td colspan="2"><?= $harta['total_harta']?> ekor  <?= $harta['jenis_nisab']?></td>
                      <?php elseif(($harta['jenis_zakat'] == 'zakat emas') OR ($harta['jenis_zakat'] == 'zakat perak')) : ?>  
                        <td> <?= number_format($harta['total_harta'])?> gr</td>
                      <?php else: ?>  
                        <td>Rp. <?= number_format($harta['total_harta'], 2, ',','.')?></td>
                      <?php endif;?>  
                    </tr>
                  <?php endif ?>
                  <?php if ($harta['jenis_zakat'] == 'zakat fitrah'): ?>
                  <?php else: ?> 
                    <tr>
                      <td colspan="3">
                        <a href="<?= site_url('muzaki/zakat/harta/edit/'.$harta['id_harta'])?>" class="btn btn-primary"><i class="fa fa-pencil"></i>Edit</a>
                      <?php if (!empty($harta['status_harta'])) : ?>
                        <?php if ($harta['status_harta'] == 'aktif') : ?>
                          <a href="<?= site_url('muzaki/zakat/harta/nonaktif/'.$harta['id_harta'])?>" class="btn btn-danger" onclick= "return confirm('kamu yakin ingin menonaktifkan?')"><i class="fa fa-power-off"></i> nonaktif</a>
                        <?php else: ?>
                          <a href="<?= site_url('muzaki/zakat/harta/aktif/'.$harta['id_harta'])?>" class="btn btn-warning" onclick= "return confirm('kamu yakin ingin mengaktifkan kembali?')"><i class="fa fa-check-circle-o"></i> aktif</a>
                        <?php endif; ?>
                      <?php endif; ?>
                    </td>
                    </tr>
                  <?php endif ?>
                </table> 
            </div>
            <?php endforeach; ?>
        </div>
      </section>
      <!-- <section>
        <div class="container-fluid">
             <div class="col-lg-12">
                <div class=" col-md-4 d-flex align-items-center">
                    <h3 class="display h3">Bayar Zakat</h3> 
                </div>
                <div class="card">
                  <div class="card-body " id="edit-item">
                    <form class="form-horizontal" method="post" action="bayar/tambah_zakat">
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Jenis Zakat</label>
                        <div class="col-sm-10 select">
                          <input type="hidden" name="id" class="edit-id">
                          <select name="jenis-zakat" class="selected form-control">
                            <option value="" selected="">Pilih Jenis Zakat</option>
                            <option value = "1">Zakat Profesi</option>
                            <option value = "2">Zakat Perniagaan</option>
                            <option value = "3">Zakat Emas</option>
                            <option value = "4">Zakat Perak</option>
                            <option value = "5">Zakat Pertenakan Sapi</option>
                            <option value = "6">Zakat Pertenakan Kambing</option>
                            <option value = "7">Zakat Pertenakan Kerbau</option>
                          </select>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Bayar Zakat</label>
                        <div class="col-sm-10">
                          <input type="text" name="membayar_zakat" class="form-control">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <div class="col-sm-4 offset-sm-2">
                          <button type="submit" class="btn btn-primary">Tambah Zakat</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
             </div>
        </div>
      </section> -->
      <!-- Updates Section -->
<script>
function openpage(evt, zakat) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(zakat).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<!-- <script type="text/javascript">
  function zakat(id, jenis_zakat){

    $.ajax({
      url : "<?php echo site_url('muzaki/zakat/bayar/ajax_tampil_zakat/')?>/"+id
    })
  }
</script> -->
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
    })
  })
</script>
     
<?php $this->load->view('footer') ?>    