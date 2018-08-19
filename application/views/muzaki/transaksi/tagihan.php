<?php 
$this->load->view('muzaki/layout_login/header');
$this->load->view('header');
$this->load->view('muzaki/header'); ?>
<div class="container">
		<form id="msform">
	  <!-- progressbar -->
		  <ul id="progressbar">
		    <li class="active"><a href="<?= site_url('muzaki/tagihan/')?>">List Pembayaran</a></li>
		    <li>Wajib Zakat</li>
		  </ul>
		  <!-- fieldsets -->
		  <fieldset>
		    <h2 class="fs-title">List Pembayaran</h2></a>
		    <h3 class="fs-subtitle">Zakat yang akan anda bayarkan</h3>
		    <div class="card">
		      <div class="card-body">
		              <?php
		              $total = 0;
		              $i = 0;
		               foreach($list_tagihan as $tagihan): 
		               	?>
		               		
		        <table class="table table-heading" style="border: 0;">
		              <tbody>
		                <tr>
		                  <th class="table-grid">Jenis Zakat</th>
		                  <th>Kadar Nisab</th>    
		                  <th style="width: 200px">Harga</th>
		                </tr>
		              </tbody>
	                	<?php 
	                	foreach ($tagihan['detail'] as $data) : ?>
			              <tr>
			                <td>
				                <?php if ($data['jenis_zakat'] == 'zakat profesi'): ?>  
				                  <div class="sed" align="left">
				                      <h2 class="h5 text-uppercase"><a href="single.html"><?= $data['jenis_zakat']?></a></h2>
				                        <p>(zakat yang dibayarkan oleh seorang yg berprofesi sesuai dengan kadar zakat)</p>
				                  </div>
				                 <?php elseif ($data['jenis_zakat'] == 'zakat pertenakan'):?>
				                  <div class="sed" align="left">
				                      <h2 class="h5 text-uppercase"><a href="single.html"><?= $data['jenis_zakat']?></a></h2>
				                        <p>(zakat yang dibayarkan oleh seorang yg memiliki ternak sesuai dengan kadar zakat)</p>
				                  </div>  
				                <?php elseif ($data['jenis_zakat'] == 'zakat perniagaan'):?>
				                  <div class="sed" align="left">
				                      <h2 class="h5 text-uppercase"><a href="single.html"><?= $data['jenis_zakat']?></a></h2>
				                        <p>(zakat yang dibayarkan oleh seorang yg memiliki perniagaan sesuai dengan kadar zakat)</p>
				                  </div>
				                  <?php elseif ($data['jenis_zakat'] == 'zakat emas'):?>
				                    <div class="sed" align="left">
				                        <h2 class="h5 text-uppercase"><a href="single.html"><?= $data['jenis_zakat']?></a></h2>
				                        <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Emas sesuai dengan kadar zakat)</p>
				                    </div>
				                  <?php elseif ($data['jenis_zakat'] == 'zakat perak'):?>
				                  <div class="sed" align="left">
				                        <h2 class="h5 text-uppercase"><a href="single.html"><?= $data['jenis_zakat']?></a></h2>
				                        <p>(zakat yang dibayarkan oleh seorang yg memiliki Simpanan Perak sesuai dengan kadar zakat)</p>
				                  </div>  
				                <?php endif ?>
			                </td>
			                <td><?=$data['jenis_nisab']?></td>
			                <?php $i++;?>
			                <td>Rp. <?= number_format($data['bayar_zakat'], 2,',','.')?></td>
			            <?php endforeach; ?>
		                </tr>
		                  <?php $zakat = $this->session->userdata('tambah_zakat'); ?>
		                  <?php $jenis_zakat = $this->session->userdata('jenis_zakat'); ?>
		                  <?php if (!empty($zakat)): ?>
		                  <tr>
		                    <td>
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
		                    <td align="right">Rp. <?= number_format($zakat['membayar_zakat'], 2, ',','.')?></td>
		                  </tr>
		                  <?php endif ?>  
		              <tr>
		                <td colspan="2" align="right"><b>Total</b></td>
		                <td>Rp. <?= number_format($tagihan['total_tagihan'], 2, ',','.')?></td>    
		              </tr>
		              <tr>
		                <td colspan="5" align="right"><a href="<?= site_url('muzaki/tagihan/rekening/'.$tagihan['id_tagihan'])?>" class="btn btn-primary">Bayar Zakat</a></td>
		              </tr>
		        </table>
		                <?php 
		            	// endforeach;
		               endforeach; ?>
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
