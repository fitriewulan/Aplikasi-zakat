<?php $this->load->view('header');
 $this->load->view('admin/header') ?>
<section>
	<?php $cari = $this->session->userdata('cari'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h2 class="h5 display">Daftar Data Amil</h2>
	                </div>
	                 <div class="card-header d-flex align-items-center">
	                 	<div class="col" style="float: left; margin: auto;"><a href="<?= site_url('admin/amil/add')?>" class="btn btn-primary"><i class="fa fa-user-plus"></i>Tambah</a></div>
	                 	<div class="col">
	                 	<form action="<?=site_url('admin/amil/search')?>" method = "post">
	                 		<div class="input-group" style="width: 50%; float: right; margin: auto;"">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari..." value="<?=$cari?>"><span class="input-group-btn">
                              <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button></span>
                          </div>
                        </form>
	                 	</div>
	                  
	                </div>
	                <div class="card-body">
	                  <table class="table table-striped table-sm">
	                    <thead>
	                      <tr>
	                        <th>No</th>
	                        <th>bertanggungjawab</th>
	                        <th>Nama</th>
	                        <th>Nama Pengguna</th>
	                        <th>alamat</th>
	                        <th>no hp</th>
	                        <th>aksi</th>
	                        
	                      </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $no=1;
	                    	foreach ($list_amil as $A):?>
	                      <tr>
	                        <th scope="row"><?= $no++?></th>
	                        <td><?= $A['username_admin']?></td>
	                        <td><?= $A['nama_amil']?></td>
	                        <td><?= $A['username_amil']?></td>
	                        <td><?= $A['alamat_amil']?></td>
	                        <td><?= $A['no_hp_amil']?></td>
	                        <td>
		                      <?php if (!empty($A['status_amil'])) : ?>
		                        <?php if ($A['status_amil'] == 'aktif') : ?>
		                          <a href="<?= site_url('admin/amil/nonaktif/'.$A['id_amil'])?>" class="btn btn-xs btn-danger" onclick= "return confirm('kamu yakin ingin menonaktifkan?')">non aktif</a>
								<?php else: ?>
									<a href="<?= site_url('admin/amil/aktif/'.$A['id_amil'])?>" class="btn btn-xs btn-warning" onclick= "return confirm('kamu yakin ingin mengaktifkan kembali?')">aktif</a>
		                        <?php endif; ?>
		                      <?php endif; ?>
		                    </td>
	                      </tr>
	                      	<?php endforeach; ?>
	                    </tbody>
	                  </table>
	                </div>
              </div>
            </div>
			</div>
		</div>
	</section>
<?php $this->load->view('footer') ?>