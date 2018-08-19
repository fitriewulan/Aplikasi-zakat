<?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center" style="margin: 15px">
	                  <h2 class="h5 display">Data Transaksi</h2>
	                 	<div class="col">
	                 	<form action="<?=site_url('amil/transaksi/search')?>" method = "post">
	                 		<div class="input-group" style="width: 27%; float: right; margin: auto; ">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari..."><span class="input-group-btn">
                              <button type="submit" class="btn btn-primary" value="search"><i class="icon-search"></i></button></span>
                          	</div>
                        </form>
	                 	</div>
	                </div>
	          <!--       <div class="card-header d-flex align-items-center">
	                  div class="col">
		                	<?php $cari = $this->session->userdata('cari') ?>
		  	              <form action="<?= site_url('amil/transaksi/filter_process')?>" method="post">
		  		                  <div class="input-group" style="margin: auto; width: 50%; float: left">
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
		  		                    <button class="btn btn-primary" type="submit">
		  		                      <i class="fa fa-search"></i>
		  		                    </button>
		  		                  </div>
		  	              </form>
		              </div>
	                </div> -->
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No</th>
	                        <th>tanggal</th>
	                        <th>Nama Muzaki</th>	                       	
	                        <th>Nama Rekening</th>	                       	
	                        <th>total zakat</th>
	                        <th>ke Bank</th>
	                        <th>status</th>
	                        <th>aksi</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
	                    	 $no=$this->uri->segment(4)+1;
	                    	foreach ($list_transaksi as $M):?>
	                      <tr>
	                        <th scope="row"><?= $no++?></th>
	                        <td><?= $M['tgl_trans']?></td>
	                        <td><?= $M['nama_muzaki']?></td>
	                        <td><?= $M['nama_rek']?></td>
	                        <td><?= $M['trans_pembayaran']?></td>
	                        <td><?= $M['nama_bank']?></td>
	                        <td>
		                      <?php if (!empty($M['status'])) : ?>
		                        <?php if ($M['status'] == 'waiting') : ?>
		                          <a href="<?= site_url('amil/transaksi/verify/'.$M['id_trans']) ?>" class="btn btn-xs btn-success" title="Verify" onclick="return confirm('Are you sure you want to verify this transaction?')">
		                            <i class="fa fa-check"></i>
		                          </a>
		                        <?php endif; ?>
		                      <?php else: ?>
		                        <a href="<?= site_url('admin/transaksi/expired/'.$M['id_tagihan']) ?>" class="btn btn-xs btn-warning" title="Set Expired" onclick="return confirm('Are you sure you want to make this transaction expired?')">
		                          <i class="fa fa-times"></i>
		                        </a>
		                      <?php endif; ?>
		                      <?php if (!empty($M['bukti_trans'])) : ?>
		                      <a href="<?= base_url('resource/images/payments/'.$M['bukti_trans']) ?>" class="btn btn-xs btn-primary" target="_blank">
		                        <i class="fa fa-download"></i>
		                      </a>
		                      <?php endif; ?>
		                    </td>
	                        <td>
	                        	<?php if ($M['status'] == "waiting"): ?>		
	                        	<a href="<?= site_url('amil/transaksi/edit/'.$M['id_trans'])?>" class="btn btn-xs btn-primary" "><i class="fa fa-pencil"></i></a>
	                        	<a href="<?= site_url('amil/transaksi/delete/'.$M['id_trans'])?>" class="btn btn-xs btn-danger" "><i class="fa fa-trash"></i></a>
	                        	<?php endif ?>
	                        </td>
	                      </tr>
	                      	<?php endforeach; ?>
	                    </tbody>
	                  </table>
	                  <?= $this->pagination->create_links();?>
	                </div>
              </div>
            </div>
			</div>
		</div>
	</section>
<?php $this->load->view('footer') ?>