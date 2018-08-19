<?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h2 class="h5 display">Laporan Masuk Zakat</h2>
	                </div>
	                <div class="card-header d-flex align-items-center">
                		<?php $cari = $this->session->userdata('cari_m');?>
	  	              <form action="<?= site_url('amil/laporan/laporan_masuk/filter_process')?>" method="post" style = "width: 100%">
		                  <div class="col">
	  		                  <div class="input-group" style="margin: auto; width: 25%; float: left; padding: 10px">
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
		              		<!-- <div class="col">
		                 		<div class="input-group" style="width: 25%; float: left; margin: auto; padding: 10px">
	                            	<select name="jenis_zakat" class="form-control">
		  		                      <option value="">-- Semua Zakat --</option>
		  		                      <option value="1" <?= ($cari['jenis_zakat'] == '1') ? 'selected' : '' ?>>Zakat Profesi</option>
		  		                      <option value="2" <?= ($cari['jenis_zakat'] == '2') ? 'selected' : '' ?>>Zakat Perniagaan</option>
		  		                      <option value="3" <?= ($cari['jenis_zakat'] == '3') ? 'selected' : '' ?>>Zakat Emas</option>
		  		                      <option value="4" <?= ($cari['jenis_zakat'] == '4') ? 'selected' : '' ?>>Zakat Perak</option>
		  		                      <option value="5" <?= ($cari['jenis_zakat'] == '5') ? 'selected' : '' ?>>Zakat Peternakan sapi</option>
		  		                      <option value="6" <?= ($cari['jenis_zakat'] == '6') ? 'selected' : '' ?>>Zakat Peternakan Kambing</option>
		  		                      <option value="7" <?= ($cari['jenis_zakat'] == '7') ? 'selected' : '' ?>>Zakat Fitrah</option>
			  		                </select>
	                          </div>
	                 		</div> -->
	                 		<div class="col">
	                 			<div class="input-group" style="width: 20%; float: left; margin: auto; padding: 10px">
	                           		<button type="submit" class="btn btn-primary" value="search"><i class="fa fa-search"> search</i></button>
	                       		</div>
	                        </div>
	                 </form>
	                </div>
	                <div class="card-header d-flex align-items-center" >
	                   <a href="<?= site_url('amil/laporan/laporan_masuk/export/')?>" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
	                </div>
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No transaksi</th>
	                        <th>tanggal</th>
	                        <th>jenis zakat</th>
	                        <th>Rekening</th>
	                        <th align="right">Bayar Zakat</th>   
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
	                    	 $total=0;
	                    	foreach ($list_masuk as $M):?>
	                      <tr>
	                        <td><?= $M['id_trans']?></td>
	                        <td><?= $M['tgl_trans']?></td>	                        
	  	                    <td><?= $M['jenis_zakat']?></td>	                        
	                        <td><?= $M['nama_bank']?></td>
	                        <td align="right">Rp. <?=number_format( $M['bayar_zakat'],2,',','.')?></td>
	                      </tr>

	                      	<?php
	                      	 $total = $total + $M['bayar_zakat'];
	                      	  endforeach; ?>
	                       <tr>
	                      	<td colspan="4" align="right">Total</td>
	                      	<td align="right">Rp. <?=number_format($total,2,',','.')?></td>
	                      </tr>
	                      <tr>
	                      	<td colspan="3" align="right"><p><i>Tidak dapat difilter berdasarkan <b>jenis zakat<b></i></p></td>
	                      	<td align="right">Total Real</td>
	                      	<td align="right">Rp. <?=number_format($real['jumlah'],2,',','.')?></td>
	                      </tr>
	                      <tr>
	                      	<?php $Shadaqoh = $real['jumlah'] - $total; ?>
	                      	<td colspan="4" align="right">Shadaqoh</td>
	                      	<td align="right">Rp. <?=number_format($Shadaqoh,2,',','.')?></td>
	                      </tr>
	                    </tbody>
	                  </table>
	                </div>
              	  </div>
            	</div>
			</div>
		</div>
	</section>
	<?php $this->session->unset_userdata('cari_m') ?>
<?php $this->load->view('footer') ?>