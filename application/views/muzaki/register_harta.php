<?php $this->load->view('header');
 	$this->load->view('muzaki/layout_login/header'); ?>
<body>
	<div class="container" >
		<form id="msform" action="<?= site_url('muzaki/register_harta/hitung_harta/')?>" method="post">		
	  <!-- progressbar -->
		  <fieldset>
		  	<a href="<?= site_url('muzaki/home')?>" class="navbar-brand"><img src="<?= base_url('resource/images/logo/logo.png')?>">
            </a>
		    <h2 class="fs-title">Registrasi Harta</h2>
		    <h3 class="fs-subtitle">Silakan Masukan Harta atau Kekayaan</h3>
		    <input type="hidden" name="id_harta" id="harta">
		    <input type="hidden" name="id_muzaki" value="<?= $id_muzaki?>">
    		<div class="login-mail">
    		 	<select type="text" name="ket_zakat" placeholder="Jenis Zakat">
    		 			<option value="">Pilih Jenis Zakat</option>
						<option value = "1">Zakat Profesi</option>
						<option value = "2">Zakat Perniagaan</option>
						<option value = "3">Zakat Emas</option>
						<option value = "4">Zakat Perak</option>
						<option value = "5">Zakat Pertenakan Sapi</option>
						<option value = "6">Zakat Pertenakan Kambing</option>
				</select>
				
			</div>
			<div class="login-mail">
				<div class="card-body">
					<div id="formulir">	
					</div>
				</div>
			</div>
			<div class="login-mail">
				<input type="text" name="waktu" class="date-picker" placeholder="waktu berzakat" required="" value="">
			</div>
			<input type="submit" id="kirimdaftar" class="submit action-button"  onclick="return confirm('Data yang diregistrasi sudah benar, simpan?')">  
		</fieldset>
		</form>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="<?= base_url('resource/build/vendor/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('resource/build/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
<script src="<?= base_url('resource/js/format_number_rp.js')?>"></script>
<script>
	$('.date-picker').datetimepicker({
		format: 'Y-M-D'
	})
</script>
<script type="text/javascript">
	$("select").change(function() {
    // hide all optional elements
    $('.optional').css('display','none');

	    $("select option:selected").each(function () {
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
	        $('#formulir').html(formulir)
	    });
	});

	// (function($, undefined){
	// 	"use strict";
	// 	//when ready.
	// 	$(function(){
	// 		var $form = $( "#msform" );
	// 		var $input = $form.find( "input" );
	// 		$input.on("keyup", function( event ){
	// 			var selection = window.getSelection().toString();
	// 			if(selection !== ''){
	// 				return;
	// 			}
	// 			if ($.inArray(event.keyCode,[38,40,37,39])!==-1) {
	// 				return;
	// 			}
	// 			var $this = $(this);
	// 			//get the value
	// 			var input = $this.val();
	// 			var input = input.replace(/[\D\s\._\-]+/g,"");
	// 			input = input ? parseInt(input, 10):0;

	// 			$this.val(function(){
	// 				return(input === 0) ? "": input.toLocaleString("en-US");
	// 			});
	// 		});

	// 		$form.on("submit", function(event){
	// 			var $this = $(this);
	// 			var arr = $this.serializeArray();

	// 			for (var i = 0; i < arr.length; i++) {
	// 				arr[i].value = arr[i].value.replace(/[($)]\s\._\-]+/g, '');
	// 			}
	// 			console.log(arr);
	// 			event.preventDefault();
	// 		});
	// 	});
	// })(jQuery);
	
	// $("input").change(function(){
	// 	$("#formatnumbering").on('keyup', function(){
	// 	    var n = parseInt($(this).val().replace(/\D/g,''),10);
	// 	    $(this).val(n.toLocaleString());
	// 	});
	// });
</script>
<!-- <script>
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
	    		var link = $('#harta').attr('action')
	    		$('#harta').val(data.id_harta)
	    		$('#success').html(data.message)
		        $("#myModal").modal();
		        $('#error').html('');
		        $('#msform').find("input").val("");
		    } else {
		    	$('#error').html(data.message)
		    }
		    $('#kirimdaftar').val('hitung')
		    $('#kirimdaftar').removeAttr('disabled')
	    });
	});
  </script> -->
</body>
</html>