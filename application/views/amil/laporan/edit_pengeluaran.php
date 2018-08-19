<?php $this->load->view('header');
	$this->load->view('amil/header');
 ?>
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Edit Transaksi Uang Keluar</a></li>
        <li class="breadcrumb-item active"></li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header> 
        <h1 class="h3 display">Transaksi Uang Keluar</h1>
      </header>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display">Ubah data transaksi pengeluaran</h2>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="<?= site_url('amil/laporan/pengeluaran/process_update/'.$pengeluaran['id_trans_umum'])?>" method="post">
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Ambil Dari</label>
                  <div class="col-sm-10">
                    <select name="ambil" class="form-control"  required="">
                      <?php foreach ($rekening as $r):?>
                      <option value="<?= $r['nama_bank']?>"><?= $r['nama_bank']?></option>
                        <?php endforeach; ?>
                    </select>
                  <!--   <small class="form-text">Masukan Nama bank</small> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">tanggal</label>
                  <div class="col-sm-10">
                  	<input type="date" name="tanggal" required="" value="<?=$pengeluaran['tgl_trans_umum'] ?>" class="form-control" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Guna Membayar</label>
                  <div class="col-sm-10">
                    <input type="text" name="pembayaran" value="<?= $pengeluaran['jenis_transaksi']?>" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jumlah" value="<?= $pengeluaran['jumlah'] ?>" required=""  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" name="ket" required="" value="<?=$pengeluaran['keterangan']?>" class="form-control">
                  </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                  <div class="col-sm-4 offset-sm-2">
                    <a href="<?=site_url('amil/laporan/pengeluaran')?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="<?= base_url('resource/build/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
  <script src="<?= base_url('resource/js/format_number_rp.js')?>"></script>
  <script>
  $('.date-picker').datetimepicker({
    format: 'Y-M-D'
  })
</script>
<?php 	$this->load->view('footer') ?>