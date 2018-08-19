<?php 
$this->load->view('header');
$this->load->view('muzaki/header')
 ?>
  <section class="charts">
        <div class="container-fluid">
          <header> 
            <h1 class="h3">Transaksi Pembayaran Zakat</h1>
          </header>
          <div class="row">           
              <div class="card" style="width: 100%">
                <div  class="card-header d-flex align-items-center ">
                	<?php $cari = $this->session->userdata('cari') ?>
	              <form action="<?= site_url('muzaki/transaksi/filter_process')?>" method="post" style="width: 100%;">
		                <!-- <div class="col">
		                  <div class="form-group">
		                    <select name="kategori" class="form-control">
		                      <option value="">-</option>
		                      <option value=""></option>
		                    </select>
		                  </div>
		                </div> -->
		                <div class="col">
		                  <div class="form-group" style="margin: auto; width: 30%; float: left; padding: 10px">
		                    <select name="bulan" class="form-control" >
		                      <option value="">-- Semua Bulan --</option>
		                      <option value="01" <?= ($cari['bulan'] == '01') ? 'selected' : '' ?>>Januari</option>
		                      <option value="02" <?= ($cari['bulan'] == '02') ? 'selected' : '' ?>>Februari</option>
		                      <option value="03" <?= ($cari['bulan'] == '03') ? 'selected' : '' ?>>Maret</option>
		                      <option value="04" <?= ($cari['bulan'] == '04') ? 'selected' : '' ?>>April</option>
		                      <option value="05" <?= ($cari['bulan'] == '05') ? 'selected' : '' ?>>Mei</option>
		                      <option value="06" <?= ($cari['bulan'] == '06') ? 'selected' : '' ?>>Juni</option>
		                      <option value="07" <?= ($cari['bulan'] == '07') ? 'selected' : '' ?>>Juli</option>
		                      <option value="08" <?= ($cari['bulan'] == '08') ? 'selected' : '' ?>>Agustus</option>
		                      <option value="09" <?= ($cari['bulan'] == '09') ? 'selected' : '' ?>>September</option>
		                      <option value="10" <?= ($cari['bulan'] == '10') ? 'selected' : '' ?>>Oktober</option>
		                      <option value="11" <?= ($cari['bulan'] == '11') ? 'selected' : '' ?>>November</option>
		                      <option value="12" <?= ($cari['bulan'] == '12') ? 'selected' : '' ?>>Desember</option>
		                    </select>
		                  </div>
		                </div>
                    <div class="col">
                          <div class="input-group" style="margin: auto; width: 25%; float: left; padding: 10px">
                            <select name="tahun" class="form-control">
                              <option value="">-- Semua Tahun --</option>
                              <?php foreach ($list_tahun as $tahun): ?>
                                <option value="<?= $tahun['tahun']?>" <?= ($cari['tahun'] == $tahun['tahun'] ? 'selected' : '') ?> ><?= $tahun['tahun'] ?></option>
                              <?php endforeach ?>
                            </select>
                           
                          </div>
                    </div>
		                <div class="col">
		                  <div class="form-group" style="margin: auto; width: 30%; float: left; padding: 10px">
		                    <button class="btn btn-primary" type="submit">
		                      <i class="fa fa-search"></i> Search
		                    </button>
		                  </div>
		                </div>
	              </form>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>tanggal transaksi</th>
                        <th>Nama Rekening</th>
                        <th >Jenis Zakat</th>
                        <th width="150px">Pembayaran</th>
                        <th>status</th>
                      </tr>
                    </thead>
                    <tbody>                    	
                    	<?php
                    	$no = 1;
                      $total =0;
                    	 foreach ($list_trans as $trans): ?>
                      <tr>
                        <td scope="row"><?= $no++?></td>
                        <td><?=$trans['tgl_trans']?></td>
                        <td><?=$trans['nama_rek']?></td>             
                       	<td><?=$trans['jenis_zakat']?></td>                      
                        <td align="right">Rp. <?=number_format($trans['bayar_zakat'],2,',','.')?></td>
                         <td><?=$trans['status']?></td>
                      </tr>

                      <?php
                      $total = $total + $trans['bayar_zakat'];
                       endforeach ?>
                       <tr>
                         <td colspan="4" align="center">Total</td>
                         <td align="right">Rp. <?=number_format($total,2,',','.')?></td>
                         <td></td>
                       </tr>
                    </tbody>
                  </table>
                </div>
              </div>
           
          </div>
        </div>
      </section>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<?php $this->load->view('footer') ?>