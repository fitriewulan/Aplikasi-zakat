<?php $this->load->view('muzaki/layout_login/header') ?>
<body style="background: #FFFFFF;">
	<div class="container">
		<div class="row" style="height: auto">
			<div class="col">
				<div class="login-page">
					<div class="logo">
					<img src="<?= base_url('resource/images/logo/logoLazis.png')?>" alt="">
					</div>
					<div class="isi_konten">
					<h5><b>"Sucikan Harta Berdayakan Dhuafa" ~Lazis Syuhada</b></h5>
					<h3><p>وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ وَارْكَعُوا مَعَ الرَّاكِعِينَ</p></h3>
					<p><i>"Dan dirikanlah shalat, tunaikanlah zakat dan ruku'lah beserta orang-orang yang ruku."(QS Al-Baqarah: 43)</i></p></div>
				</div>
			</div>
			<div class="col">
				<div class="login-page">
				  <div class="form">
				  	<p class = "message"><i><?= $this->session->flashdata('login_error')?></i></p>
				    <form class="login-form" action="<?= site_url('muzaki/auth/login_process')?>" method="post">
				      <input type="text" name="email_muzaki" required="" placeholder="email" value="<?= set_value('email')?>"/>
				      <input type="password" name="password_muzaki" required="" placeholder="kata sandi"/>
				      <!-- <p class="message">lupa kata sandi?<a href="#">klik disini</a></p> -->
				      <button >Masuk</button>
				    </form>
				    <br><p class="message"><b>ATAU</b></p><br>
				    <form class="login-form" action="<?= site_url('muzaki/auth/register')?>">
				  		<button>Daftar Baru</button>
				  	</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('muzaki/layout_login/footer')?>