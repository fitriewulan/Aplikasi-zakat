<?php 
$this->load->view('muzaki/layout_login/header');
$this->load->view('header');
$this->load->view('muzaki/header'); ?>
<div class="container">
		<form id="msform">
	  <!-- progressbar -->
		  <ul id="progressbar">
		    <li><a href="<?= site_url('muzaki/tagihan')?>">List Pembayaran</a></li>
		    <li class="active">Transfer</li>
		  </ul>
		 <?php 
			$this->session->set_userdata('pembayaran', $tagihan['total_tagihan']);
			$this->session->set_userdata('no_trans', $tagihan['id_tagihan']);
			$coba1 =$this->session->userdata('pembayaran');
			$coba2 = $this->session->userdata('no_trans');
			// print_r($coba1);
			// print_r($coba2);
		  ?>
		  <fieldset>
		    <h2 class="fs-title">Pembayaran Via Transfer</h2>
		    <h2 class="display h4">Total Pembayaran : <strong>Rp. <?=number_format($tagihan['total_tagihan'], 2, ',','.')?></strong></h3>
		   	<h2 class="display h5">No. Trans : <?=$tagihan['id_tagihan']?></strong></h3>
		    <h3 class="fs-subtitle">Transfer Zakat anda ke No. Rek dibawah ini</h3>
		    <div class="card" >
		      <div class="card-body">
		      	<div class="row d-flex align-items-stretch">
		      		<?php foreach ($rekening as $rekening): ?>
		            <div class="col" >
		              <!-- Income-->
		              <div class="wrapper income text-center">
		                <div class="icon"><img src="<?= base_url('resource/images/icon-bank/'.$rekening['Icon_bank'])?>" style="width: 100px"></div>
		                <div class="number">a.n <?= $rekening['nama_rek']?></div><strong class="text-primary number"><?= $rekening['no_rek']?></strong>
		              </div>
		            </div>
		            <?php endforeach ?>
		      	</div>
		      	<div class="card-body text-center">
                  <a href="<?= site_url('muzaki/transaksi/confirm')?>" class="btn btn-primary">Konfirmasi Pembayaran</a>
                </div>
		      </div>
		     </div>
		  </fieldset>
		</form>
	</div>
<script src="<?= base_url('resource/build/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
<script>
	$('.date-picker').datetimepicker({
		format: 'Y-M-D'
	})
</script>
<?php $this->load->view('footer') ?>    
