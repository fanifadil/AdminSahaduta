<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('modul template/head'); ?>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url('Dashboard') ?>" class="site_title"><i><img width="30px" height="" src="<?= base_url("build/images/"); ?>Logo2.png" alt=""></i> <span>Sahaduta Klinik</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <?php if($user['foto'] == "") : ?>
                <img src="<?= base_url('build/foto/thumb/'); ?>icon.jpg" alt="..." width="50px" height="45px" class="img-circle profile_img">
              <?php else : ?>
              <img src="<?= base_url('build/foto/thumb/'.$user['foto']); ?>" alt="..." class="img-circle profile_img">
            <?php endif; ?>
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?= $user['nama_pegawai']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <?php $this->load->view('modul template/sidebar'); ?>
          <!-- /sidebar menu -->

          
        </div>
      </div>

      <!-- top navigation -->
      <?php $this->load->view('modul template/topnavigation'); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <?php $this->load->view($isi); ?>
      <!-- /page content -->

      <!-- footer content -->
      <?php $this->load->view('modul template/footer'); ?>
      <!-- /footer content -->
    </div>
  </div>

  <!-- compose -->
  <?php $this->load->view('modul template/compose'); ?>
  <!-- /compose -->

  <?php $this->load->view('modul template/js'); ?>

</body>

</html>