<?php $this->load->view('header');
 	$this->load->view('muzaki/layout_login/header'); ?>
<body>
	<div class="container">
		<form id="msform" method="post" action="<?= site_url('muzaki/transaksi/confirm_process')?>" enctype="multipart/form-data">
	  		<!-- fieldsets -->
	  		<fieldset>
	  		<a href="<?= site_url('muzaki/home')?>" class="navbar-brand"><img src="<?= base_url('resource/images/logo/logo.png')?>">
            </a>
		    <h2 class="fs-title">Konfirmasi Pembayaran</h2>
		    <div id="error" class="text-danger"></div>
			    <h3 class="fs-subtitle">Silakan konfirmasi pembayaran zakat anda</h3>
			    <?php if (!empty($this->session->userdata('id_tagihan'))): ?>
			    	<div class="login-mail">
						<input type="text" name="no_conf" placeholder="No Transaksi" required="" value="<?= $this->session->userdata('id_tagihan')?>" >
						<i class="glyphicon glyphicon-user"></i>
					</div>
				<?php else: ?>	
					<div class="login-mail">
						<input type="text" name="no_conf" placeholder="No Transaksi" required="" value="<?= $this->session->userdata('no_trans')?>" >
						<i class="glyphicon glyphicon-user"></i>
					</div>
			    <?php endif ?>					
					<div class="login-mail">
						<input type="text" name="nama_pembayaran" placeholder="Nama Pemiliki Rekening" required="" >
						<i class="glyphicon glyphicon-user"></i>
					</div>
					<div class="login-mail">
						<select name="to_bank" required="">
							<option selected="">Transfer ke Rekening</option>
							<?php
							 foreach ($list_rek as $rek): ?>
							<option value="<?=$rek['nama_bank']?>"><?=$rek['nama_bank']?></option>	
							<?php endforeach ?>							
						</select>
					</div>
					<div class="login-mail">
						<?php if (!empty($this->session->userdata('total_tagihan'))): ?>
							<input type="text" name="total_bayar" placeholder="Total Bayar" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= $this->session->userdata('total_tagihan'); ?>">
							<i class="glyphicon glyphicon-user"></i>	
						<?php else: ?>	
							<input type="text" name="total_bayar" placeholder="Total Bayar" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= $this->session->userdata('pembayaran');  ?>">
							<i class="glyphicon glyphicon-user"></i>
						<?php endif ?>
						
					</div>
					<div class="login-mail">
				<input type="text" name="tgl_transaksi" class="date-picker" placeholder="Tanggal Transfer" required="" value="">
			</div>
					<div class="login-mail">
						<input type="file" hidden name="foto_trans" id="file-7" accept="image/*" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" accept="image/*" multiple />
						<label for="file-7" style="float: left !important; margin-left: 10%; height: 45px;"><strong style="font-size: 14px; font-family: montserrat;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Pilih Bukti Pembayaran</strong><span style="width: 700px;"></span> </label>
					</div>
					<!-- <div class="login-mail">
						  <input type="file" name="foto_trans" id="" accept="image/*">
						<i class="glyphicon glyphicon-envelope"></i>
					</div> -->
					<button type="submit" class="action-button" id="kirimdaftar">Konfirmasi</button>
				  	<!-- <input class="action-button" id="kirimdaftar" type="submit" value="Simpan"> -->
			 	</fieldset>
		</form>		
			</div>
<script src="<?= base_url('resource/build/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>

<script>
	$('.date-picker').datetimepicker({
		format: 'Y-M-D'
	})
</script>
	<script src="<?= base_url('resource/js/format_number_rp.js')?>"></script>
<!-- <script  src="<?= base_url('resource/build/js/index.js')?>"></script> -->
  <script>
  	$("#myModal").modal();
	$("#msform").submit(function(event){
	    event.preventDefault(); //prevent default action 
	    var post_url = $(this).attr("action"); //get form action url
	    var request_method = $(this).attr("method"); //get form GET/POST method
	    var form_data = $(this).serialize(); //Encode form elements for submission
	    $('#kirimdaftar').html('<i class="fa fa-spin fa-spinner"></i> Loading...')
	    $('#kirimdaftar').attr('disabled', 'disabled')
	    $.ajax({
	        url : post_url,
	        type: request_method,
	        data : form_data
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