<?php 
$this->load->view('muzaki/layout_login/header');
$this->load->view('header');
 $this->load->view('muzaki/header'); ?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
        	<form id="msform" action="<?= site_url('muzaki/zakat/harta/update/')?>" method="post">		
	  <!-- progressbar -->
			  <fieldset>
			    <h2 class="fs-title">Edit Zakat</h2>
			    <h3 class="fs-subtitle">Silakan Mengubah Harta atau Kekayaan</h3>
			    <input type="hidden" name="id_harta" id="harta" value="<?= $id_harta?>">
			    <input type="hidden" name="id_ket" id="harta" value="<?= $list_harta['id_ket']?>">
			    <input type="hidden" name="id_muzaki">
	    		<div class="login-mail">
	    		 	<!-- <select type="text" name="ket_zakat" placeholder="Jenis Zakat">
	    		 			<option value="">Pilih Jenis Zakat</option>
							<option value = "1">Zakat Profesi</option>
							<option value = "2">Zakat Perniagaan</option>
							<option value = "3">Zakat Emas</option>
							<option value = "4">Zakat Perak</option>
							<option value = "5">Zakat Pertenakan Sapi</option>
							<option value = "6">Zakat Pertenakan Kambing</option>
					</select>	 -->
					<div class="card-body">
					<!-- <div id="formulir">	
					</div> -->
					<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Jenis Zakat</span></label>
					<input type="text" name="total_harta" placeholder="Harta" required="" value="<?=$list_harta['jenis_zakat']?>" readonly>
					</div>
					<div class="card-body">
					<?php if ($list_harta['id_ket'] == 1 ): ?>
						<input  class="optional profesi" class="hidden-txt" type="text" placeholder = "Penghasilan Bulanan" name="penghasilan" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this)"">
						<input class="optional profesi" class="hidden-txt" type="text" placeholder = "Bonus Bulanan" name="bonus" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this)"">
						<input class="optional profesi" class="hidden-txt" type="text" placeholder = "kebutuhan pokok bulanan" name="kebutuhan_pokok" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
						<input class="optional profesi"  class="hidden-txt" type="text" placeholder = "hutang" step="any" name="hutang"  required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this)">;
					<?php elseif ($list_harta['id_ket'] == 2):?>
						<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "Modal selama setahun" name="modal" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
						<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "Piutang" name="piutang" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
						<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "keuntungan selama setahun" name="untung" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
						<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "kerugian selama setahun" name="rugi" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					<?php elseif ($list_harta['id_ket'] == 3):?>
						<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Total Harta Emas(gr)</span></label>
						<input class="optional emas" class="hidden-txt" type="text" value="<?=$list_harta['total_harta']?>" placeholder = "jumlah Emas(gr)" name="jml_emas" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					<?php elseif ($list_harta['id_ket'] == 4):?>
						<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Total Harta Perak(gr)</span></label>
						<input class="emas" class="hidden-txt" type="text" value="<?=$list_harta['total_harta']?>" placeholder = "Jumlah Perak(gr)" name="jml_perak" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					<?php elseif ($list_harta['id_ket'] == 5):?>
						<p>Minimal Waktu kepemilikan hewan ternak 1 tahun dan tidak dipekerjakan</p>
						<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Total Harta Sapi(Ekor)</span></label>
	            		<input id="jml" class="hidden-txt" type="text" value="<?=$list_harta['total_harta']?>" placeholder = "Jumlah Hewan Sapi(ekor)" name="jml_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	            		<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Harga Sapi umur 1 thn saat ini</span></label>
	            	 	<input class="hidden-txt" type="text" value="<?=number_format($list_harta['harga_1'], 2, ',','.')?>" name="harga_hewan1" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	            	 	<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Harga Sapi umur 2 thn saat ini</span></label>
		            	<input class="hidden-txt" type="text" value="<?=number_format($list_harta['harga_2'], 2, ',','.')?>" name="harga_hewan2" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					<?php else: ?>
						<p>Minimal Waktu kepemilikan hewan ternak 1 tahun dan tidak dipekerjakan</p>
						<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Total Harta kambing(Ekor)</span></label>
	            		<input class="hidden-txt" type="text" value="<?=number_format($list_harta['total_harta'], 2, ',','.')?>" placeholder = "Jumlah Hewan Kambing(ekor)" name="jml_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
	            		<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Harga kambing saat ini</span></label>
	            		<input class="hidden-txt" type="text" value="<?=number_format($list_harta['harga_1'], 2, ',','.')?>" name="harga_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					<?php endif ?>
					</div>
				</div>
				<?php if ($list_harta['id_ket'] == 1 OR $list_harta['id_ket'] == 2):?>
					<div class="login-mail">
						<div class="card-body">
						<!-- <div id="formulir">	
						</div> -->
						<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Total Harta</span></label>
						<input type="text" name="total_harta" placeholder="Harta" required="" value="<?=number_format($list_harta['total_harta'], 2, ',','.')?>" readonly>
						<!-- <input type="text" name="total_harta" class="coba" placeholder="Harta" required="" value="<?=number_format($list_harta['total_harta'], 2, ',','.')?>" readonly> -->
						</div>
					</div>	
				<?php endif ?>
				<div class="login-mail">
					<label class="form-control-label name row" style="margin-left:90px;"><strong style="color: #aaa"><span>Waktu Berzakat <i>pertama kali di input</i></span></strong></label>
					<input type="text" name="waktu" class="date-picker" placeholder="waktu berzakat" required="" value="<?=$list_harta['waktu_zakat']?>">
				</div>
				<input type="submit" id="kirimdaftar" class="submit action-button" value="Edit Zakat"/>  
			  </fieldset>
			</form>
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script> -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="<?= base_url('resource/build/vendor/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
<script src="<?= base_url('resource/js/format_number_rp.js')?>"></script>
<script src="js/front.js"></script>
<script>
	$('.date-picker').datetimepicker({
		format: 'Y-M-D'
	})
</script>
<script type="text/javascript">
	$("select").change(function() {
    // hide all optional elements
    $('.coba').css('display','none');

	    $("input").each(function () {
	    	var formulir = ''
	        if($(this).val() == "1") {
	           
	        	formulir ='<input  class="optional profesi" class="hidden-txt" type="text" placeholder = "Penghasilan Bulanan" name="penghasilan" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional profesi" class="hidden-txt" type="text" placeholder = "Bonus Bulanan" name="bonus" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional profesi" class="hidden-txt" type="text" placeholder = "kebutuhan pokok bulanan" name="kebutuhan_pokok" step="any" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional profesi"  class="hidden-txt" type="text" placeholder = "hutang" step="any" name="hutang"  required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        } else if($(this).val() == "2") {
	            // $('.pertenakan').css('display','block');
	            formulir = '<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "Modal selama setahun" name="modal" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "Piutang" name="piutang" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "keuntungan selama setahun" name="untung" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
				formulir += '<input class="optional perniagaan" class="hidden-txt" type="text" placeholder = "kerugian selama setahun" name="rugi" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        } else if($(this).val() == "3") {
	            // $('.perniagaan').css('display','block');
	            formulir += '<input class="optional emas" class="hidden-txt" type="text" placeholder = "jumlah Emas(gr)" name="jml_emas" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        }
	        else if($(this).val() == "4") {
	            formulir += '<input class="emas" class="hidden-txt" type="text" placeholder = "Jumlah Perak(gr)" name="jml_perak" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        }
	        else if($(this).val() == "5") {
	        	formulir += 'Minimal Waktu kepemilikan hewan ternak 1 tahun dan tidak dipekerjakan'
	            formulir += '<input id="jml" class="hidden-txt" type="text" placeholder = "Jumlah Hewan Sapi(ekor)" name="jml_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	            	 formulir += '<input class="hidden-txt" type="text" placeholder = "Harga Sapi umur 1 thn saat ini" name="harga_hewan1" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
		            formulir += '<input class="hidden-txt" type="text" placeholder = "Harga Sapi umur 2 thn saat ini" name="harga_hewan2" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        }
	        else if($(this).val() == "6") {
	        	formulir += 'Minimal Waktu kepemilikan hewan ternak 1 tahun dan tidak dipekerjakan'
	            formulir += '<input class="hidden-txt" type="text" placeholder = "Jumlah Hewan Kambing(ekor)" name="jml_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	            formulir += '<input class="hidden-txt" type="text" placeholder = "Harga kambing saat ini" name="harga_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        }
	        // else if($(this).val() == "7") {
	        // 	formulir += 'Minimal Waktu kepemilikan hewan ternak 1 tahun dan tidak dipekerjakan'
	        //     formulir += '<input class="hidden-txt" type="text" placeholder = "Jumlah Hewan Kerbau(ekor)" name="jml_hewan" required="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">'
	        // }
	        $('#formulir').html(formulir)
	    });
	});
</script>
<script src="<?= base_url('resource/js/format_number_rp.js')?>"></script>
        </div>
      </section>
      
<?php $this->load->view('footer') ?>    