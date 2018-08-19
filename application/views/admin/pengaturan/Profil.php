<?php $this->load->view('header') ?>
<?php $this->load->view('admin/header')?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Profil Perusahaan</h2>
                </div>
                <div class="card-body">
                <!--   <?php print_r($list_profil); ?> -->
                  <form class="form-horizontal" method="post" action="<?= site_url('admin/pengaturan/profil/update')?>">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Alamat Perusahaan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" required=""><?= $list_profil['alamat_lazis']?> </textarea>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="Email" name="email" required="" class="form-control" value="<?=$email['value']?>"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="Password" name="pass" required="" class="form-control" value="<?=$pass['value']?>"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Whatsapp</label>
                      <div class="col-sm-10">
                        <input type="text" name="whatsapp" value="<?=$list_profil['whatsapp']?>" class="form-control" required="">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Facebook</label>
                      <div class="col-sm-10">
                        <input type="text" name="fb" value="<?=$list_profil['facebook']?>" class="form-control" required="">
                      </div>
                    </div>
                    <div class="line"></div>
                     <div class="form-group row">
                      <label class="col-sm-2 form-control-label">BBM</label>
                      <div class="col-sm-10">
                        <input type="text" name="bbm" value="<?=$list_profil['bbm']?>" class="form-control" required="">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <a href="<?= site_url('admin/home')?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </section>
      <!-- Header Section-->
<?php $this->load->view('footer') ?>    