<?php $this->load->view('header') ?>
<?php $this->load->view('admin/header')?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Karyawan LAZIS MS</strong><span><?= date('Y-m-d')?></span>
                  <div class="count-number"><?=$karyawan['jumlah']?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card bar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Beranda Admin Lazis Masjid Syuhada</h2>
                </div>
                <div class="card-body">
                  <img src="<?=base_url('resource/images/logo/logolazis.png')?>">
                  <p>Selamat datang di beranda Admin,...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Header Section-->
<?php $this->load->view('footer') ?>    