<?php $this->load->view('header') ?>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Login Admin</span><strong class="text-primary">LAZIS MS</strong></div>
            <p>ini hanya dapat dilogin oleh admin lazis masjid syuhada, silakan masuk menggunakan username dan password yang sudah terdaftar sebelumnya</p>
            <form id="login-form" action="<?= site_url('admin/auth/login_process')?>" method="post">
              
              <div class="form-group">
                <!-- <?php $admin= $this->session->userdata('login_admin'); ?> -->
                <label for="login-username" class="label-custom">User Name</label>
                <input id="login-username" type="text" name="username_admin" required="">
              </div>
              <div class="form-group">
                 <label for="login-password" class="label-custom">Password</label>
                <input id="login-password" type="password" name="password_admin" required="" >
              </div>
               <p><strong><?= $this->session->flashdata('login_error') ?></strong></p>
              <input class="btn btn-primary" type="submit" name="login" value="login">
              <!-- This should be submit button but I replaced it with <a> for demo purposes-->
            </form>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <script src="<?= base_url('resource/build/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/jquery.cookie/jquery.cookie.js')?>"> </script>
    <script src="<?= base_url('resource/build/js/grasp_mobile_progress_circle-1.0.0.min.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/jquery-validation/jquery.validate.min.js')?>"></script>
    <script src="<?= base_url('resource/build/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script src="<?= base_url('resource/build/js/front.js')?>"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>