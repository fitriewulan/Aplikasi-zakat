<?php $this->load->view('header');
$this->load->view('amil/header'); ?>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center" style="margin: 15px">
	                  <h2 class="h5 display col">Data Muzaki</h2>
	                  <div class="col">
	                 	<form action="<?=site_url('amil/muzaki/search')?>" method = "post">
	                 		<div class="input-group" style="width: 50%; float: right; margin: auto; ">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari..."><span class="input-group-btn">
                              <button type="submit" class="btn btn-primary" value="search"><i class="icon-search"></i></button></span>
                          </div>
                        </form>
	                 	</div>
	                </div>
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No</th>
	                        <th>Nama</th>
	                        <th width="250px">Alamat</th>
	                        <th>Email</th>
	                        <th>No HP</th>
	                        <th>Nominal Zakat</th>
	                        <th>aksi</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $no=$this->uri->segment(4)+1;
	                    	foreach ($list_muzaki as $M):?>
	                      <tr>
	                        <th scope="row"><?= $no++?></th>
	                        <td><?= $M['nama_muzaki']?></td>
	                        <td><?= $M['alamat_muzaki']?></td>
	                        <td><?= $M['email_muzaki']?></td>
	                        <td><?= $M['no_hp_muzaki']?></td>
	                        <td align="right">Rp. <?=number_format($M['total'], 2, ',','.')?></td>
	                        <td>
	                        	<a href="<?= site_url('amil/muzaki/harta/'.$M['id_muzaki'])?>" class="btn btn-xs btn-primary" ">detail zakat</a>
	                        </td>
	                      </tr>
	                      	<?php endforeach; ?>
	                    </tbody>
	                  </table>
	                  <?= $this->pagination->create_links();?>
	                </div>
             	  </div>
            	</div>
			</div>
		</div>
	</section>
<?php $this->load->view('footer') ?>