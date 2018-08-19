 <?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Edit Harga Nisab</h2>
                </div>
                <div class="card-body">
                  <p>ubah harga jenis nisab per gr atau kg</p>
                  <form class="form-horizontal" action="<?= site_url('amil/ket_zakat/update/')?>" method="post">
                    <div class="form-group row">
                      <label class="col-sm-2">Jenis Nishab</label>
                      <div class="col-sm-10 select">
                        <select name="jenis_nisab" class="form-control">
                          <option value="Beras">Beras</option>
                          <option value="Emas">Emas</option>
                          <option value="Perak">Perak</option>

                        </select>
                        <small class="form-text">Masukan jenis nishab</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2">Harga Satuan</label>
                      <div class="col-sm-10">
                        <input id="inputHorizontalWarning" type="text" name="harga_satuan" placeholder="Harga Satuan" class="form-control form-control-warning"><small class="form-text">Harga persatuan untuk saat ini(gr/kg)</small>
                      </div>
                    </div>
                    <div class="form-group row">       
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
		</div>
	</div>
<?php $this->load->view('footer')?>