<?php 
$this->load->view('muzaki/layout_login/header') ?>
<body>
	<div class="container">
		<form id="msform" method="post" action="<?= site_url('muzaki/auth/register_process/')?>" enctype="multipart/form-data">
	  		<!-- fieldsets -->
	  		<fieldset>
	  		<a href="<?= site_url('muzaki/home')?>" class="navbar-brand"><img src="<?= base_url('resource/images/logo/logo.png')?>">
            </a>
		    <h2 class="fs-title">Registrasi Muzaki</h2>
			    <h3 class="fs-subtitle">Silakan Masukan Identitas Diri</h3>
					<div class="login-mail">
						<input type="text" name="nama_muzaki" placeholder="Nama" required="" value="<?= $this->session->flashdata('nama')?>">
						<i class="glyphicon glyphicon-user"></i>
						
					</div>
					<div class="login-mail">
						<input type="text" placeholder="alamat" name="alamat_muzaki" required="" value="<?= $this->session->flashdata('alamat')?>" >
						<i class="glyphicon glyphicon-map-marker"></i>
					</div>
					<div class="login-mail">
						<input type="text" placeholder="No-Hp" name="no_hp_muzaki" required="" value="<?= $this->session->flashdata('no_hp')?>">
						<p align="left" style="margin: auto; width: 80%; color: #868e9680" class="fs-subtitle"><i class="glyphicon glyphicon-phone" align = "left">No Hp yang tidak pernah didaftarkan sebelumnya</i></p>
					</div>
					<div class="login-mail">
						<input type="text" placeholder="Email" name="email_muzaki" required="" value="<?= $this->session->flashdata('email')?>">
						<p align="left" style="margin: auto; width: 80%; color: #868e9680" class="fs-subtitle"><i class="glyphicon glyphicon-envelope" >Email yang tidak pernah didaftarkan sebelumnya</i><p>
					</div>
					<div class="login-mail">
						<input type="file" hidden name="foto_muzaki" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" accept="image/*" multiple />
						<label for="file-7" style="float: left !important; margin-left: 10%; height: 45px;"><strong style="font-size: 14px; font-family: montserrat;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Pilih Foto Profil</strong><span style="width: 700px;"></span> </label>		
						<p align="left" style="margin: auto; width: 80%; color: #868e9680" class="fs-subtitle"><i class="glyphicon glyphicon-envelope" >Foto tidak dapat dikosongkan</i><p>				
					</div>
					<!-- <div class="login-mail">
						  <input type="file" name="foto_muzaki" id="foto_muzaki" accept="image/*">
						<i class="glyphicon glyphicon-envelope"></i>
					</div> -->
					<div class="login-mail">
						<input type="password" placeholder="kata_sandi" name="password_muzaki" required="">
						<p align="left" style="margin: auto; width: 80%; color: #868e9680" class="fs-subtitle"><i class="glyphicon glyphicon-lock">password minimal 6 karakter</i></p>
					</div>
					<div class="login-mail">
						<a><?= $this->session->flashdata('dispassword')?><br></a>
						<input type="password" placeholder="konfirmasi password" name="conf-pass" required="">
						<i class="glyphicon glyphicon-lock"></i>
					</div>
					<p><div id="error" class="text-danger"></div></p>
					<button type="submit" class="action-button" id="kirimdaftar">Simpan</button>
				  	<!-- <input class="action-button" id="kirimdaftar" type="submit" value="Simpan"> -->
			 	</fieldset>
		</form>		
			<!-- modal -->
			<form action="<?= site_url('muzaki/auth/next_register/')?>" method="post">
				<input type="hidden" name="id_muzaki" id="next">
				<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">    
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				        	<p class="alert alert-success" id="success"></p>
				          <p>Apakah selanjutnya ingin menghitung Zakat?</p>
				        </div>
				        <div class="modal-footer">
			        	 <input type="submit" name="kirim" class="btn btn-primary" value="ya">
				         <input type="submit" name="kirim" class="btn btn-default" value="tidak">
				        </div>
				      </div>   
				    </div>
				  </div>
				</form>
			</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="<?= base_url('resource/build/vendor/jquery.cookie/jquery.cookie.js')?>"> </script>
    <script src="<?= base_url('resource/build/js/grasp_mobile_progress_circle-1.0.0.min.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/jquery-validation/jquery.validate.min.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
	<script src="<?= base_url('resource/build/js/front.js')?>"></script>
	
<!-- <script  src="<?= base_url('resource/build/js/index.js')?>"></script> -->
  <script>
  	// $("#myModal").modal();
	$("#msform").submit(function(event){
	    event.preventDefault(); //prevent default action 
	    var post_url = $(this).attr("action"); //get form action url
	    var request_method = $(this).attr("method"); //get form GET/POST method
	    var form = $('form')[0];
	    var form_data = new FormData(form); //Encode form elements for submission
	    $('#kirimdaftar').html('<i class="fa fa-spin fa-spinner"></i> Loading...')
	    // $('#kirimdaftar').attr('disabled', 'disabled')
	    $.ajax({
	        url : post_url,
	        type: request_method,
	        data : form_data,
	        contentType: false,
	        processData: false
	    }).done(function(response){ //
	    	var data = JSON.parse(response)
	    	if (data.status == 'success') {
	    		var link = $('#next').attr('action')
	    		$('#next').val(data.id_muzaki)
	    		$('#success').html(data.message)
		        $("#myModal").modal();
		        $('#error').html('');
		        $('#msform').find("input").val("");
		    } else {
		    	$('#error').html(data.message)
		    }
		    $('#kirimdaftar').html('Simpan')
		    $('#kirimdaftar').removeAttr('disabled')
	    });
	});
  </script>
  <script src="<?= base_url('resource/js/custom-file-input.js')?>"></script>
</body>
</html>