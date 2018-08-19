<?php $this->load->view('header') ?>
<?php 	$this->load->view('admin/header') ?>
	 <section class="charts">
        <div class="container-fluid">
          <header> 
            <h1 class="h3">Ketentuan Zakat</h1>
          </header>
          <div class="row">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="<?= site_url('admin/pengaturan/Rek_trans/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</a>
                  </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Bank</th>
                        <th>No Rek</th>
                        <th>logo</th>
                        <th>aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php $no=1;
                    	foreach ($list_rek as $rek):?>
                      <tr>
                        <th scope="row"><?=$no++?></th>
                        <td><img src="<?= base_url('resource/images/icon-bank/'.$rek['Icon_bank'])?>" style="width:80px"></td>
                        <td><?= $rek['nama_bank']?></td>
                        <td><?= $rek['no_rek']?></td>
                        <td><?= $rek['nama_rek']?></td>
                        <td> <a href= "<?= site_url('admin/pengaturan/Rek_trans/edit/'. $rek['id_rek'])?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                             <a href= "<?= site_url('admin/pengaturan/Rek_trans/delete/'. $rek['id_rek'])?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
                      </tr>
                      	<?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </section>
<?php 	$this->load->view('footer') ?>