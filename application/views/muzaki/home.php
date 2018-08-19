<?php $this->load->view('header');
 $this->load->view('muzaki/header') 
 ?>
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
            <li class="breadcrumb-item active">Home</li>
          </ul>
        </div>
      </div>
      <!-- Statistics Section-->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row" style="padding: 0 0 20px 0; ">
            <div class=" col-md-4 d-flex align-items-center">
                <h3 class="display h3">Kewajiban Ber-Zakat Bulan ini</h3> 
            </div>
          </div>
          <div class="row">
            <?php
            if (!empty($list_kewajiban) ):?>
            <?php
            $i=0;
             foreach ($list_kewajiban as $Z) :
            $i++?>
            <?php if ($zakat_tagihan[$i]['bayar'] != 0) {?>
              <div class="tab nav nav-tabs col-xl-2 col-md-4 col-7 dropdown" id="nav-tab">
                <a class="tablinks nav-item nav-link" data-toggle = "tab" role="tab" onclick= "openpage(event, <?=$Z['id_harta']?>)">
                    <div class="wrapper count-title d-flex">
                      <div class="icon"><i class="icon-bill"></i><i class="fa fa-sort-down"></i></div>
                      <div class="name"><strong class="text-uppercase"><?= $Z['jenis_zakat']?></strong><span><?= $zakat_tagihan[$i]['ket']?></span>
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
            <?php } ?>            
            <?php endforeach; ?>
          <?php else: ?>
            <div class="alert alert-info" role="alert">
              Belum wajib ber-Zakat saat ini <a href="<?= site_url('muzaki/zakat/harta')?>" class="alert-link">Lihat aset/harta zakat</a> yang telah anda dimiliki. 
            </div>
          <?php endif ?>
          </div>
          <!-- <pre>
          <?php // print_r($list_pertenakan) ?>
          </pre> -->
            <?php 
            $i =0;
            foreach ($list_kewajiban as $Z) : 
            $i++;
            ?>
              <div id="<?=$Z['id_harta']?>" class="tabcontent tab-pane">
                <div class="display h4">DETAIL ZAKAT </div>
                 <table class="table table-striped table-hover">
                  <tr>
                    <td>Wajib Membayar Zakat</td>
                    <td colspan="2"><b>Rp. <?= number_format($zakat_tagihan[$i]['bayar'], 2, ',','.')?></b></td>
                  </tr>
                  <?php if ($Z['jenis_zakat'] == 'zakat pertenakan'): ?> 
                    <tr>  
                      <td colspan="3" align="center"><b>ATAU</b></td>
                    </tr>
                    <tr>
                        <td> BerZakat dengan </td> 
                            <?php if ($Z['jenis_nisab'] == 'Sapi'): ?>
                              <td><?= $Z['umur1']?> ekor Sapi umur 1 tahun (tabi')</td>
                              <td><?= $Z['umur2']?> ekor Sapi umur 2 tahun (musinah)</td>
                            </tr>
                            <tr> 
                                <td>Harga Sapi per Ekor</td>
                                <td>Rp. <?=number_format($Z['harga_1'], 2, ',','.')?></td>
                                <td>Rp. <?=number_format($Z['harga_2'], 2, ',','.')?></td>
                            </tr>
                            <?php  elseif ($Z['jenis_nisab'] == 'Kambing'): ?>
                              <td><?= $Z['umur1']?> ekor Kambing</td>
                            </tr>
                            <tr>
                              <td>Harga Kambing</td>
                              <td>Rp. <?=number_format($Z['harga_1'], 2, ',','.')?></td>
                            </tr>
                            <?php endif ?> 
                    </tr>   
                  <?php endif ?>
                  <tr>
                    <td>Harta/Kekayaan</td>
                  <?php if ($Z['jenis_zakat'] == 'zakat pertenakan'): ?>
                    <td colspan="2"><?= $Z['total_harta']?> ekor  <?= $Z['jenis_nisab']?></td>
                   <?php elseif(($Z['jenis_zakat'] == 'zakat emas') OR ($Z['jenis_zakat'] == 'zakat perak')) : ?>  
                    <td> <?= number_format($Z['total_harta'])?> gr</td>
                  <?php else: ?>  
                    <td>Rp. <?= number_format($Z['total_harta'], 2, ',','.')?></td>
                  <?php endif;?>      
                  </tr>
                </table>
                 <a href="<?= site_url('muzaki/zakat/bayar')?>" class="btn btn-info">Lihat Kewajiban zakat</a>
                <?php if (strtotime(date('Y-m-d')) >= strtotime($Z['tgl_tagihan']) && strtotime(date('Y-m-d')) <= strtotime($Z['jangka_waktu'])): ?>
                  <a href="<?= site_url('muzaki/tagihan')?>" class="btn btn-outline-info">Konfirmasi Pembayaran</a> 
                <?php else: ?>
                  <a href="<?= site_url('muzaki/zakat/bayar')?>" class="btn btn-primary">Bayar Kewajiban Zakat</a> 
                <?php endif; ?>         
              </div>
            <?php endforeach; ?>
        </div>
      </section>
      <section  class="section-margin">
        <div class="container-fluid">
          <div class="wrapper income">
              <div class="display h1" style="padding: 0 0 20px 0">Keutamaan Berzakat</div> 
                  <div  class="col-lg-8">
                  <p style="color: #000;"><b>Zakat dari segi istilah fikih yaitu,<i>"sejumlah harta tertentu yang diwajibkan Allah diserahkan kepada orang-orang yang berhak menerimanya, disamping berarti mengeluarkan jumlah tertentu itu sendiri"</i></b></p>
                </div>
                <br><p style="color: #000;"><b>Dalil Zakat</b></p>
                <p style="color: #000;">Didalam Al-Qur'an, Allah SWT telah menyebutkan zakat dan shalat sejumlah 82 ayat. Dari sini disimpulkan secara <i>deduktif</i> bahwa setelah shalat zakat merupakan rukun islam yang terpenting </p>
                <p style="color: #000;">Al-Baqarah 2:110 </p>
                <h3><p style="color: #000;">وَأَقِيمُواْ الصَّلاَةَ وَآتُواْ الزَّكَاةَ وَمَا تُقَدِّمُواْ لأَنفُسِكُم مِّنْ خَيْرٍ تَجِدُوهُ عِندَ اللّهِ إِنَّ اللّهَ بِمَا تَعْمَلُونَ بَصِيرٌ</p></h3>
                <i><p style="color: #000;">"Dan dirikanlah shalat dan tunaikanlah zakat. Dan kebaikan apa saja yang kalian usahakan bagi dirimu, tentu kalian akan mendapat pahalanya di sisi Allah. Sesungguhnya Allah Maha Melihat apa-apa yang kalian kerjakan"</p></i>
                <img class="img-fluid" style="float:right; padding:10px" src="<?= base_url('resource/images/contoh_home.jpg')?> ">
                <br><p style="color: #000;"><b>Kedudukan Zakat Dalam Islam</b></p>
                <p style="color: #000;" >Zakat merupaka rukun Islam terpenting setelah syahadat dan shalat, serta merupakan pilar berdirinya bangunan Islam</p>
                <p style="color: #000;">Perhatian Islam yang sangat besar dengan berusaha menyelesaikan masalah kemiskinan dan mengayomi kaum papa tanpa didahului oleh revolusi atau gerakan menuntut hak-hak kaum miskin</p>
               <br><p style="color: #000;"><b>Waktu Wajib zakat dan Waktu Wajib Pelaksaannya</b><br>
                  Pada fuqaha sepakat bahwa zakat wajib dikeluarkan segera setelah terpenuhi syara-syaratnya, baik nishab, haul, maupun lainnya(al-Zuhaily, 1997:119). Dengan demikian, barang siapa berkewajiban mengeluarkan zakat dan mampu mengeluarkannya, dia tidak boleh menangguhkannya. Dia akan berdosa jika mengakhirkan pengeluaran  zakatnya tanpa uzur, karena harta yang dimiliki seseorang pada hakikatnya adlah titipan sebagai amanat Allah SWT untuk disalurkan sesuia dengan kehendak pemiliknya, maka permasalahan ini sama dengan barang titipan yang dituntut oleh pemiliknya
                </p>

          </div>
        </div>
      </section>
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
     
     
<?php $this->load->view('footer') ?>    