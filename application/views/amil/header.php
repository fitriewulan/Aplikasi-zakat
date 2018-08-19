 <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <div class="sidenav-header-inner text-center"><img src="<?= base_url('resource/images/logo/amil.png')?>" alt="person" class="img-fluid rounded-circle">
            <?php $userdata = $this->session->userdata('login_amil') ?>
            <h2 class="h5 text-uppercase"><?= $userdata['nama_amil']?></h2><span class="text-uppercase">Petugas Amil</span>
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>L</strong><strong class="text-primary">S</strong></a></div>
        </div>
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li <?= (uri_string() == 'amil/home' ? 'class="active"' : '') ?>><a href="<?= site_url('amil/home')?>"> <i class="icon-home"></i><span>Home</span></a></li>
            <li <?= (uri_string() == 'amil/ket_zakat' ? 'class="active"' : '') ?>> <a href="<?= site_url('amil/ket_zakat')?>"><i class="icon-form"></i><span>Ketentuan Zakat</span></a></li>
            <li <?= (uri_string() == 'amil/muzaki' ? 'class="active"' : '') ?>> <a href="<?= site_url('amil/muzaki')?>"><i class="icon-presentation"></i><span>Data Muzaki</span></a></li>
            <!-- <li <?= (uri_string() == 'amil/tagihan' ? 'class="active"' : '') ?>> <a href="<?= site_url('amil/tagihan')?>"> <i class="icon-grid"> </i><span>Tagihan</span></a></li> -->
            <li <?= (uri_string() == 'amil/transaksi' ? 'class="active"' : '') ?>> <a href="<?= site_url('amil/transaksi')?>"> <i class="icon-grid"> </i><span>Transaksi</span></a></li>
          </ul>
        </div>
         <div class="admin-menu">
           <ul id="side-admin-menu" class="side-menu list-unstyled"> 
              <li <?= (uri_string() == 'amil/laporan/laporan_masuk' || uri_string() == 'amil/laporan/laporan_keluar' ? 'class="active"' : '') ?>> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Laporan</span>
                  <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
                <ul id="pages-nav-list" class="collapse list-unstyled">
                  <li> <a href="<?= site_url('amil/laporan/laporan_masuk')?>">Laporan Pemasukan</a></li>
                  <li> <a href="<?= site_url('amil/laporan/Pengeluaran')?>">Laporan Pengeluaran</a></li>
                </ul>
              </li>
          </ul>
        </div>
    </nav>
    <div class="page home-page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Amil </span><strong class="text-primary"> LAZIS Syuhada</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item"><a href="<?= site_url('amil/auth/logout')?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>