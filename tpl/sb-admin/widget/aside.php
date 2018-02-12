<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php if ($this->session->userdata('akses') == '1'):?>
        <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" style="height:45px" alt="User Image">
        <?php elseif ($this->session->userdata('akses') == '2'):?> <!-- RESEPSIONIST -->
        <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" style="height:45px" alt="User Image">
        <?php elseif ($this->session->userdata('akses') == '3'):?> <!-- ROOMBOY -->
        <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" style="height:45px" alt="User Image">
        <?php elseif ($this->session->userdata('akses') == '9999'):?> <!-- ADMINISTRATOR -->
        <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" style="height:45px" alt="User Image">
        <?php else: ?>
        <img src="<?=$theme_url?>user-image/<?= $this->session->userdata('photo_file') ?>" class="img-circle" alt="User Image">
        <?php endif;?>
      </div>
      <div class="pull-left info">
        <!-- <p>RJG</p> -->
        <p><?= $this->session->userdata('role_data') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <?php if ($this->session->userdata('akses') == '1'):?> <!-- MANAGER -->
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url('/')?>"><i class="fa fa-home"></i> <span>Home</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/reservasi')?>"><i class="fa fa-book"></i> <span>Reservasi</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/checkinout')?>"><i class="fa fa-key"></i> <span>Check-IN / OUT</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/tamu_menginap')?>"><i class="fa fa-key"></i> <span>Guest List</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/housekeeping')?>"><i class="fa fa-building-o"></i> <span>Room Checking</span><span class="pull-right-container"><span></a></li>
        <li class="treeview"><a href="#"><i class="fa fa-database"></i> <span>Master Data</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('/registrasi')?>"><i class="fa fa-circle-o"></i> Data Tamu</a></li>
          </ul>
        </li>

      <?php elseif ($this->session->userdata('akses') == '2'):?> <!-- RESEPSIONIST -->
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url('/')?>"><i class="fa fa-home"></i> <span>Home</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/reservasi')?>"><i class="fa fa-book"></i> <span>Reservasi</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/checkinout')?>"><i class="fa fa-key"></i> <span>Check-IN / OUT</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/tamu_menginap')?>"><i class="fa fa-key"></i> <span>Guest List</span><span class="pull-right-container"><span></a></li>
        <li class="treeview"><a href="#"><i class="fa fa-database"></i> <span>Master Data</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('/registrasi')?>"><i class="fa fa-circle-o"></i> Data Tamu</a></li>
          </ul>
        </li>

      <?php elseif ($this->session->userdata('akses') == '3'):?> <!-- ROOMBOY -->
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url('/home')?>"><i class="fa fa-home"></i> <span>Room Status</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/housekeeping')?>"><i class="fa fa-building-o"></i> <span>Room Checking</span><span class="pull-right-container"><span></a></li>

      <?php elseif ($this->session->userdata('akses') == '9999'):?> <!-- ADMINISTRATOR -->
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url('/')?>"><i class="fa fa-home"></i> <span>Home</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/reservasi')?>"><i class="fa fa-book"></i> <span>Reservasi</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/checkinout')?>"><i class="fa fa-key"></i> <span>Check-IN / OUT</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/tamu_menginap')?>"><i class="fa fa-user"></i> <span>Guest List</span><span class="pull-right-container"><span></a></li>
        <li><a href="<?= base_url('/housekeeping')?>"><i class="fa fa-building-o"></i> <span>Room Checking</span><span class="pull-right-container"><span></a></li>
        <li class="treeview"><a href="#"><i class="fa fa-database"></i> <span>Master Data</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('/registrasi')?>"><i class="fa fa-circle-o"></i> Data Tamu</a></li>
            <li><a href="<?= base_url('/user')?>"><i class="fa fa-circle-o"></i> Data User</a></li>
          </ul>
        </li>

      <?php else:?>
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('/')?>">
            <i class="fa fa-home"></i> <span>Home</span>
            <span class="pull-right-container"><span>
          </a>
        </li>
        <?php endif;?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
