<?php $this->load->view('header');
	$this->load->view('admin/header');
 ?>
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Amil</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header> 
        <h1 class="h3 display">Tambah Amil</h1>
      </header>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display">Masukan data Amil secara lengkap dan benar</h2>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="<?= site_url('admin/amil/add_process')?>" method="post">
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_amil" value="<?= $this->session->flashdata('nama')?>" required="" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Alamat</label>
                  <div class="col-sm-10">
                  	<textarea class="form-control" name="alamat_amil" required=""><?= $this->session->flashdata('alamat')?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">No Hp</label>
                  <div class="col-sm-10">
                    <input type="text" name="no_hp_amil" value="<?= $this->session->flashdata('no_hp')?>" class="form-control" required="">
                  </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username_amil" value="<?= $this->session->flashdata('username')?>" required=""><span class="help-block-none">nama username harus unik</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password_amil" required="" class="form-control"><span class="help-block-none"><?= $this->session->flashdata('dispassword') ?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">konfirmasi Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="conf-password" required="" class="form-control">
                  </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                  <div class="col-sm-4 offset-sm-2">
                    <a href="<?= site_url('admin/amil')?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php 	$this->load->view('footer') ?>