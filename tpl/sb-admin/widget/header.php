<header class="main-header">
  <!-- Logo -->
  <a href="<?=@site_url()?>home" class="logo">
    <!-- <span class="logo-mini"><img src="<?=$theme_url?>wisma-image/logo_esdm.gif" style="width:40px" class="user-image" alt="User Image"></span>
    <img src="<?=$theme_url?>wisma-image/logo.png" style="width:200px" class="user-image" alt="User Image"> -->
    <span class="logo-mini">Hm</span>
    HOTEL <small>Melati</small>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- <img src="<?=$theme_url?>wisma-image/admin2.jpg" class="user-image" alt="User Image"> -->
            <?php if ($this->session->userdata('akses') == '1'):?>
            <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="user-image" alt="User Image">
            <?php elseif ($this->session->userdata('akses') == '2'):?> <!-- RESEPSIONIST -->
            <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="user-image" alt="User Image">
            <?php elseif ($this->session->userdata('akses') == '3'):?> <!-- ROOMBOY -->
            <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="user-image" alt="User Image">
            <?php elseif ($this->session->userdata('akses') == '9999'):?> <!-- ADMINISTRATOR -->
            <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="user-image" alt="User Image">
            <?php else: ?>
            <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="user-image" alt="User Image">
            <?php endif;?>
            <span class="hidden-xs"><?= $this->session->userdata('auth_data') ?></span>
          </a>
          <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if ($this->session->userdata('akses') == '1'):?>
                <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
                <?php elseif ($this->session->userdata('akses') == '2'):?> <!-- RESEPSIONIST -->
                <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
                <?php elseif ($this->session->userdata('akses') == '3'):?> <!-- ROOMBOY -->
                <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
                <?php elseif ($this->session->userdata('akses') == '9999'):?> <!-- ADMINISTRATOR -->
                <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
                <?php else: ?>
                <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
                <?php endif;?>
                <p>
                  <?php if ($this->session->userdata('akses') == '1'):?>
                  <?= $this->session->userdata('first_name').' '. $this->session->userdata('last_name') ?> - <?= $this->session->userdata('role_data') ?>
                  <?php elseif ($this->session->userdata('akses') == '2'):?> <!-- RESEPSIONIST -->
                  <?= $this->session->userdata('first_name').' '. $this->session->userdata('last_name') ?> - <?= $this->session->userdata('role_data') ?>
                  <?php elseif ($this->session->userdata('akses') == '3'):?> <!-- ROOMBOY -->
                  <?= $this->session->userdata('first_name').' '. $this->session->userdata('last_name') ?> - <?= $this->session->userdata('role_data') ?>
                  <?php elseif ($this->session->userdata('akses') == '9999'):?> <!-- ADMINISTRATOR -->
                  <?= $this->session->userdata('first_name').' '. $this->session->userdata('last_name') ?> - <?= $this->session->userdata('role_data') ?>
                  <?php else: ?>
                  <?= $this->session->userdata('first_name').' '. $this->session->userdata('last_name') ?> - <?= $this->session->userdata('role_data') ?>
                  <?php endif;?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('/edit_profile') ?>" class="btn btn-default btn-flat" style="color:black">Edit Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=@site_url()?>login/logout" class="btn btn-default btn-flat" style="color:black"><span class="glyphicon glyphicon-log-out"></span> Sign out</a>
                </div>
              </li>
            </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
