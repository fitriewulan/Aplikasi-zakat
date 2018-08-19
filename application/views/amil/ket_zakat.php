<?php $this->load->view('header') ?>
<?php 	$this->load->view('amil/header') ?>
	 <section class="charts">
        <div class="container-fluid">
          <header> 
            <h1 class="h3">Ketentuan Zakat</h1>
          </header>
          <div class="row">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis Zakat</th>
                        <th>Nishab</th>
                        <th>Jenis Nishab</th>
                        <th>Harga Satuan</th>
                        <th>Haul (hari)</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php $no=1;
                    	foreach ($ket_zakat as $k):?>
                      <tr>
                        <th scope="row"><?=$no++?></th>
                        <td><?= $k['jenis_zakat']?></td>
                        <td><?= $k['nisab']?></td>
                        <td><?= $k['jenis_nisab']?></td>
                        <td><?= number_format($k['harga_satuan'],2,",",".") ?></td>
                        <td><?= $k['haul']?></td>
                      </tr>
                      	<?php endforeach; ?>
                    </tbody>
                  </table>
                      <a href= "<?= site_url('amil/ket_zakat/edit')?>" class="btn btn-primary" style="float: right; margin: 10px" ><i class="fa fa-pencil"></i> Edit Nisab
                      </a>
                       <a href= "<?= site_url('amil/ket_zakat/harga_nisab')?>" class="btn btn-primary" style="float: left; margin: 10px" ><i class="fa fa-refresh"></i> Update Nisab
                      </a>
                </div>
              </div>
          </div>
        </div>
      </section>
<?php 	$this->load->view('footer') ?>