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
                  <form class="form-horizontal" method="post" action="<?= site_url('admin/pengaturan/Rek_trans/update/'.$list_rek['id_rek'])?>">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Bank</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="bank" required="">
                          <option selected="">Pilih Bank</option>
                          <option value="Mandiri Syariah" <?= ('Mandiri Syariah' == $list_rek['nama_bank'] ? 'selected' : '')?>>Mandiri Syariah</option>
                          <option value="BNI Syariah" <?= ('BNI Syariah' == $list_rek['nama_bank'] ? 'selected' : '')?>>BNI Syariah</option>
                          <option value="Bank Muamalat" <?= ('Bank Muamalat' == $list_rek['nama_bank'] ? 'selected' : '')?>>Bank Muamalat</option>
                          <option value="BCA Syariah" <?= ('BCA Syariah' == $list_rek['nama_bank'] ? 'selected' : '')?>>BCA Syariah</option>
                          <option value="BRI Syariah" <?= ('BRI Syariah' == $list_rek['nama_bank'] ? 'selected' : '')?>>BRI Syariah</option>
                          <!-- <option value=""></option> -->
                        </select>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">No Rek.</label>
                      <div class="col-sm-10">
                        <input type="text" name="no_rek" required="" class="form-control" value="<?= $list_rek['no_rek']?>"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Nama Rek.</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama_rek" required="" class="form-control" value="<?= $list_rek['nama_rek']?>"><!-- <span class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                      </div>
                    </div>
                    <!-- <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">icon bank</label>
                      <div class="col-sm-10">
                        <img src="<?= base_url('resource/images/icon-bank/'.$list_rek['Icon_bank'])?>" height="100px">
                        <input type="file" name="icon_bank" class="form-control" accept="image/*">
                        <input value="<?= set_value('icon_bank', $list_rek['Icon_bank'])?>" type="hidden" name="icon_bank"  class="form-control" accept="image/*">
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