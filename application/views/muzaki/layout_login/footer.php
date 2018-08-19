<footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?= base_url('resource/images/logo/konsultasi-&-jemput-zakat.png')?>" class="logo" style=" height: 120px;">
                </div>
                <div class="col-sm-5">
                    <h5><img style=" height: 40px" src="<?= base_url('resource/images/logo/location.png')?>"> Alamat</h5>
                    <ul>
                        <li><a href="https://www.google.co.id/maps/place/Lazis+Masjid+Syuhada/@-7.7862462,110.3691923,15z/data=!4m5!3m4!1s0x0:0x53412b1f7b0993e9!8m2!3d-7.7862462!4d110.3691923"><?= $profil_lazis['alamat_lazis']?></a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Contact Us</h5>
                    <ul>
                        <li><img src="<?= base_url('resource/images/logo/wa1.png')?>" style=" height: 20px;"> <?= $profil_lazis['whatsapp']?> </a></li>
						<li><img src="<?= base_url('resource/images/logo/bbm.png')?>" style=" height: 20px;"> <?= $profil_lazis['bbm']?></li>
						<li><a href="#"><img src="<?= base_url('resource/images/logo/fb1.png')?>" style=" height: 20px;"> <?= $profil_lazis['facebook']?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>