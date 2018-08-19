 <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <div class="sidenav-header-inner text-center"><img src="<?= base_url('resource/images/logo/amil.png')?>" alt="person" class="img-fluid rounded-circle">
            <?php $userdata = $this->session->userdata('login_admin') ?>
            <h2 class="h5 text-uppercase">Admin</h2><span class="text-uppercase">Petugas Admin</span>
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>L</strong><strong class="text-primary">S</strong></a></div>
        </div>
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li <?= (uri_string() == 'admin/home' ? 'class="active"' : '') ?>><a href="<?= site_url('admin/home')?>"> <i class="icon-home"></i><span>Home</span></a></li>
            <li <?= (uri_string() == 'admin/amil' ? 'class="active"' : '') ?>> <a href="<?= site_url('admin/amil')?>"><i class="icon-form"></i><span>Amil</span></a></li>
          </ul>
        </div>
         <div class="admin-menu">
           <ul id="side-admin-menu" class="side-menu list-unstyled"> 
              <li <?= (uri_string() == 'admin/Pengaturan/Profil' || uri_string() == 'admin/Pengaturan/rek_trans' ? 'class="active"' : '') ?>> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="fa fa-gears"></i><span>Pengaturan</span>
                  <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
                <ul id="pages-nav-list" class="collapse list-unstyled">
                  <li> <a href="<?= site_url('admin/Pengaturan/Profil')?>">Profil Perusahaan</a></li>
                  <li> <a href="<?= site_url('admin/Pengaturan/rek_trans')?>">Rekening Perusahaan</a></li>
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
                  <div class="brand-text d-none d-md-inline-block"><span>Admin </span><strong class="text-primary"> LAZIS Syuhada</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item"><a href="<?= site_url('admin/auth/logout')?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>