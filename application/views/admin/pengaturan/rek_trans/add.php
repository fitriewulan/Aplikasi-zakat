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
                  <form class="form-horizontal" method="post" action="<?= site_url('admin/pengaturan/Rek_trans/process_add')?>" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Bank</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="bank" required="">
                          <option selected="">Pilih Bank</option>
                          <option value="Mandiri Syariah">Mandiri Syariah</option>
                          <option value="BNI Syariah">BNI Syariah</option>
                          <option value="Bank Muamalat">Bank Muamalat</option>
                          <option value="BCA Syariah">BCA Syariah</option>
                          <option value="BRI Syariah">BRI Syariah</option>
                          <!-- <option value=""></option> -->
                        </select>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">No Rek.</label>
                      <div class="col-sm-10">
                        <input type="text" name="no_rek" required="" class="form-control"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Nama Rek.</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama_rek" required="" class="form-control"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <div class="line"></div>
                   <!--  <div class="form-group row">
                      <label class="col-sm-2 form-control-label">icon bank</label>
                      <div class="col-sm-10">
                        <input type="file" name="icon_bank" id="icon_bank" class="form-control" accept="image/*">
                      </div>
                    </div> -->
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <!-- <button type="submit" class="btn btn-secondary">Batal</button> -->
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