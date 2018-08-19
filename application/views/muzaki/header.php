 <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <?php $userdata = $this->session->userdata('login_muzaki') ?>
          <div class="sidenav-header-inner text-center"><img src="<?= base_url('resource/images/muzaki/foto-profil/'.$userdata['foto_muzaki'])?>" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5 text-uppercase"><?= $userdata['nama_muzaki']?></h2><span class="text-uppercase">Muzaki</span>
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>L</strong><strong class="text-primary">S</strong></a></div>
        </div>
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li <?= (uri_string() == 'muzaki/home' ? 'class="active"' : '') ?>><a href="<?= site_url('muzaki/home/')?>"> <i class="icon-home"></i><span>Home</span></a></li>
            <li <?= ((uri_string() == 'muzaki/zakat/harta' OR uri_string() == 'muzaki/zakat/harta/add_zakat_harta') ? 'class="active"' : '') ?>><a href="<?= site_url('muzaki/zakat/harta')?>"><i class="icon-list"></i><span>Aset Kekayaan</span></a></li>
            <li <?=(uri_string() == 'muzaki/zakat/bayar' ? 'class="active"': '') ?>><a href="<?= site_url('muzaki/zakat/bayar')?>"><i class="icon-check"></i><span>Bayar Zakat</span></a></li>
            <li <?=(uri_string() == 'muzaki/transaksi' ? 'class="active"': '') ?>><a href="<?= site_url('muzaki/transaksi')?>"><i class="icon-grid"></i><span>Transaksi</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page home-page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>MUZAKI</span><strong class="text-primary"> LAZIS Syuhada</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" dat a-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-shopping-bag"></i><span class="badge badge-warning"><?= $jumlah['jumlah']?></span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <h3 class="h5"> Keranjang Zakat</h3>
                    <?php $i =0;
                     foreach ($list_keranjang as $tagihan): ?>
                      <?php $i++ ?>
                      <li><a rel="nofollow" href="#" class="dropdown-item"> 
                          <div class="notification d-flex justify-content-between">
                            <div class="notification-content"><i class="fa fa-percent "></i><?= $tagihan['jenis_zakat']?></div>
                            <div class="notification-time"><small>Rp. <?= number_format($zakat_tagihan[$i]['bayar'], 2, ',','.')?></small></div>
                          </div></a>
                      </li>
                    <?php endforeach ?>
                      <li>
                        <div class="notification d-flex justify-content-between">
                            <div class="notification-content float-right"><b>Total</b></div>
                            <div class="notification-time"><small><b>
                              <?php 
                              $total = 0;
                              $i =0 ;
                              foreach ($list_keranjang as $tagihan){
                              $i++;
                                $total += str_replace(",","", $zakat_tagihan[$i]['bayar']);
                              }?>
                              Rp. <?= number_format($total, 2, ',','.')?>
                              </b></small></div>
                          </div>
                      </li>
                      <li align = "right">
                        <a href="<?= site_url('muzaki/zakat/bayar')?>" class="btn btn-xs btn-info" style="color:white;">Lihat Kewajiban</a> 
                        <a href="#" class="btn btn-xs btn-primary" style="color:white;">Bayar</a> 
                      </li>
                  </ul>
                </li>
               <!--  <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a> -->
                <li class="nav-item"><a href="<?= site_url('muzaki/auth/logout')?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>