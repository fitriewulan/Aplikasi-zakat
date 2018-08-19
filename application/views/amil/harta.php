<?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h2 class="h5 display">Atas Nama Muzaki : <?= $muzaki['nama_muzaki'] ?></h2>
	                </div>
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No</th>
	                        <th>jenis zakat</th>
	                        <th>nisab</th>
	                        <th>Harta</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $no=1;
	                    	foreach ($data_harta as $M):?>
	                      <tr>
	                        <th scope="row"><?= $no++?></th>
	                        <td><?= $M['jenis_zakat']?></td>
	                        <td><?=$M['jenis_nisab']?></td>
	                        <?php if ($M['jenis_zakat'] == 'zakat profesi' OR $M['jenis_zakat'] == 'zakat fitrah'): ?>
	                        	<td>Rp. <?= number_format($M['total_harta'],2,",",".")?></td>
	                        <?php elseif ($M['jenis_zakat'] == 'zakat emas' OR $M['jenis_zakat'] == 'zakat perak') :?>
	                        	<td><?= $M['total_harta']?> gram</td>
	                        <?php else :?>
	                        	<td><?= $M['total_harta']?> ekor</td>
	                        <?php endif ?>
	                        
	                      </tr>
	                      	<?php endforeach; ?> 
	                    </tbody>
	                  </table>
	                  <a href="<?= site_url('amil/muzaki/')?>" class="btn btn-primary">back</a>
	                </div>
              </div>
            </div>
			</div>
		</div>
	</section>
<?php $this->load->view('footer') ?>