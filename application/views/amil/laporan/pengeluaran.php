<?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<section>
		<div class="container-fluid">
			<div class="row container">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h2 class="h5 display">Laporan Pengeluaran</h2>	                  	                     
	                </div>
	                <div class="card-header d-flex align-items-center">
	                
                		<?php $cari = $this->session->userdata('cari_k');?>
	  	              <form action="<?= site_url('amil/laporan/Pengeluaran/filter_process')?>" method="post" style = "width: 100%">
		                  <div class="col">
	  		                  <div class="input-group" style="margin: auto; width: 30%; float: left; padding: 10px">
	  		                    <select name="bulan" class="form-control">
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
	                 			<div class="input-group" style="width: 10%; float: left; margin: auto; padding: 10px">
	                           		<button type="submit" class="btn btn-primary" value="search"><i class="fa fa-search"> search</i></button>	                           		
	                       		</div>
	                       		<div class="input-group" style="width: 20%; margin: auto; padding: 10px; float: right;">
	                       			<a href="<?= site_url('amil/laporan/pengeluaran/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Pengeluaran</a>
	                       		</div>
	                        </div>
	                 </form>
	                </div>
	                <div class="card-header d-flex align-items-center">
	                   <a href="<?= site_url('amil/laporan/Pengeluaran/export/')?>" class="btn btn-default" style="text-align: right;"><i class="fa fa-file-excel-o"></i> Export Excel</a>
	                </div>
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No transaksi</th>
	                        <th>tanggal</th>
	                        <th>Amil</th>
	                        <th>Ambil Dari</th>
	                        <th>Pembayaran</th>
	                        <th>Keterangan</th>   
	                        <th>Jumlah</th>   
	                        <th>aksi</th>   

	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
	                    	 $no=1;
	                    	 $total = 0;
	                    	foreach ($list_keluar as $M):?>
	                      <tr>
	                      	<td><?= $M['id_trans_umum']?></td>	                      	
	                        <td><?= $M['tgl_trans_umum']?></td>
	                        <td><?= $M['nama_amil']?></td>
	                        <td><?= $M['ambil']?></td>
	                        <td><?= $M['jenis_transaksi']?></td>
	                        <td><?= $M['keterangan']?></td>
	  	                    <td align="right">Rp. <?=number_format($M['jumlah'],2,',','.')?></td>	                        
	                        <td>
	                        	<a href="<?= site_url('amil/laporan/Pengeluaran/update_pengeluaran/'.$M['id_trans_umum'])?>" class="btn btn-xs btn-primary" "><i class="fa fa-pencil"></i></a>
	                        	<a href="<?= site_url('amil/laporan/Pengeluaran/delete_pengeluaran/'.$M['id_trans_umum'])?>" class="btn btn-xs btn-danger" "><i class="fa fa-trash"></i></a>
	                        </td>
	                      </tr>
	                      	<?php 
	                      	$total = $total + $M['jumlah'];
	                      	endforeach; ?>
	                       <tr>
	                      	<td colspan="6" align="right">Total</td>
	                      	<td align="right">Rp. <?=number_format($total,2,',','.')?></td>
	                      	<td ></td>
	                      </tr>
	                    </tbody>
	                  </table>
	                </div>
              	  </div>
            	</div>
			</div>
		</div>
	</section>
<?php $this->load->view('footer') ?>