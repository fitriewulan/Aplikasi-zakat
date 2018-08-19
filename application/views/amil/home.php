<?php $this->load->view('header') ?>
<?php $this->load->view('amil/header') ?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <div class="wrapper count-title d-flex">
                <?php 
                $cari = $this->session->userdata('cari_chart');
                // print_r($this->db->last_query($chart_pie));
                $a = [];
                $bulan = [];
                $b = [];
                $j = [];
                foreach ($chart as $c) {
                  array_push($a,$c['jumlah']);
                  array_push($bulan,$c['bulan']);
                }
                foreach ($chart_pie as $p) {
                    array_push($b, $p['jumlah']);
                    array_push($j, $p['jenis_zakat']);
                  }  
                ?>
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">BerZakat</strong><span><?= date('Y-m-d')?></span>
                  <div class="count-number"><?= $jumlah_zakat['jumlah']?></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Konfirmasi Zakat</strong><span><?= date('Y-m-d')?></span>
                  <div class="count-number"><?= $jumlah_konfirmasi['jumlah']?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <form action="<?= site_url('amil/home/filter_process')?>" method="post"  style="width: 100%; margin: 0">
              <div class="card-header d-flex align-items-center">              
                <div class="col-md-3">
                  <div class="input-group">
                    <select name="tahun" class="form-control">
                      <option value="">-- Semua Tahun --</option>
                      <?php foreach ($list_tahun as $tahun): ?>
                        <option value="<?= $tahun['tahun']?>" <?=($cari['tahun'] == $tahun['tahun'] ? 'selected' : '') ?> ><?= $tahun['tahun'] ?></option>
                      <?php endforeach ?>
                    </select>                  
                  </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary" value="search"><i class="fa fa-search"> search</i></button>
                    </div>
                </div>
              </div>
            </form>
          </div>
          <div class="row" style="margin:15px 0">
             <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
              <div class="wrapper sales-report">
                <h2 class="display h4">Diagram Pembayaran Zakat</h2>
                <p>Pembayaran zakat Perbulannya</p>
                <div class="line-chart">
                  <canvas id="lineCahrt"></canvas>
                </div>
              </div>
            </div>
             <!-- Pie Chart-->
            <div class="col-lg-4 col-md-6">
              <div class="wrapper project-progress">
                <h2 class="display h4">Diagram Pelaksanaan Zakat</h2>
                <div class="pie-chart">
                  <canvas id="pieChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
        <script src="<?= base_url('resource/build/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?= base_url('resource/build/vendor/jquery.cookie/jquery.cookie.js')?>"> </script>
       <script src="<?= base_url('resource/build/js/grasp_mobile_progress_circle-1.0.0.min.js')?>"></script>
        <script src="<?= base_url('resource/build/vendor/jquery-validation/jquery.validate.min.js')?>"></script>
        <script src="<?= base_url('resource/build/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        
        <script src="<?= base_url('resource/build/js/front.js')?>"></script>
      <!-- Header Section-->
      <script type="text/javascript">
        $(document).ready(function () {

              'use strict';

              // Main Template Color
              var brandPrimary = '#33b35a';


              // ------------------------------------------------------- //
              // Line Chart
              // ------------------------------------------------------ //
              var LINECHART = $('#lineCahrt');
              var myLineChart = new Chart(LINECHART, {
                  type: 'line',
                  options: {
                      legend: {
                          display: false
                      }
                  },
                  data: {
                      labels:<?= json_encode(array_values($bulan))?>,
                      datasets: [
                          {
                              label: "My First dataset",
                              fill: true,
                              lineTension: 0.3,
                              backgroundColor: "rgba(77, 193, 75, 0.4)",
                              borderColor: brandPrimary,
                              borderCapStyle: 'butt',
                              borderDash: [],
                              borderDashOffset: 0.0,
                              borderJoinStyle: 'miter',
                              borderWidth: 1,
                              pointBorderColor: brandPrimary,
                              pointBackgroundColor: "#fff",
                              pointBorderWidth: 1,
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor: brandPrimary,
                              pointHoverBorderColor: "rgba(220,220,220,1)",
                              pointHoverBorderWidth: 2,
                              pointRadius: 1,
                              pointHitRadius: 0,
                              data:<?= json_encode(array_values($a))?>,
                              spanGaps: false
                          }  
                      ]
                  }
              });


              // ------------------------------------------------------- //
              // Pie Chart
              // ------------------------------------------------------ //
              var PIECHART = $('#pieChart');
              var myPieChart = new Chart(PIECHART, {
                  type: 'doughnut',
                  data: {
                      labels:<?= json_encode(array_values($j))?>,
                      datasets: [
                          {
                              data:<?= json_encode(array_values($b))?>,
                              borderWidth: [1, 1, 1, 1, 1, 1],
                              backgroundColor: [
                                  brandPrimary,
                                  "rgba(75,192,192,1)",
                                  "#FFCE56",
                                  "#e91e63",
                                  "#6f42c196",
                                  "#79554891"

                              ],
                              hoverBackgroundColor: [
                                  brandPrimary,
                                  "rgba(75,192,192,1)",
                                  "#FFCE56"
                              ]
                          }]
                  }
              });

          });
      </script>
      <script type="text/javascript"></script>
<?php $this->load->view('footer') ?>    