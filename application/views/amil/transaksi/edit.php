 <?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Edit Transaksi Pembayaran</h2>
                </div>
                <div class="card-body">
                  <p>Edit Transaksi pembayaran zakat</p>
                  <form class="form-horizontal" action="<?= site_url('amil/transaksi/update/'.$transaksi['id_trans'])?>" method="post">
                    <div class="form-group row">
                      <label class="col-sm-2">tanggal</label>
                      <div class="col-sm-10">
                        <input id="inputHorizontalWarning" type="text" name="tgl_trans" class="form-control form-control-warning date-picker" value="<?=$transaksi['tgl_trans']?>"  required="">
                      </div>
                    </div>                    
                     <div class="form-group row">
                      <label class="col-sm-2">Total Zakat</label>
                      <div class="col-sm-10">
                        <input id="inputHorizontalWarning" type="text" name="trans_pembayaran" class="form-control form-control-warning" value="<?=$transaksi['trans_pembayaran']?>"  required="">
                      </div>
                    </div> 
                    <div class="form-group row">       
                      <div class="col-sm-10 offset-sm-2">
                        <a href="<?= site_url('amil/transaksi')?>" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Simpan" class="btn btn-primary" onclick="return confirm('Mengubah data transaksi pembayaran?')">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
		</div>
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
<?php $this->load->view('footer')?>