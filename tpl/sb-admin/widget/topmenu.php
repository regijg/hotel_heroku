<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
		<?php
		if ($this->uri->segment(2)=='pengambilan_obat' || $this->uri->segment(1)=='pengambilan_obat'){?>
		<li class="<?=$menuRule->dashboard?> active "><a href="<?=@site_url()?>pengambilan_obat"><i class="fa fa-fw fa-home"></i>&nbsp;Dashboard</a></li>
		<?php } else {?>
		<li class="<?=$menuRule->dashboard?>"><a href="<?=@site_url()?>pengambilan_obat"><i class="fa fa-fw fa-home"></i>&nbsp;Dashboard</a></li>
		<?php } ?>
		
		<li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-heart"></i>&nbsp;Pelayanan
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	         <li><a href="<?=@site_url()?>pelayanan"><i class="fa fa-fw fa-heart "></i>&nbsp;Penjualan Obat</a></li>
	         <li><a href="<?=@site_url()?>retur_obat"><i class="fa fa-fw fa-undo"></i>&nbsp;Retur Obat</a></li>
	          <li><a href="<?=@site_url()?>pengambilan_obat"><i class="fa fa-fw fa-list"></i>&nbsp;Antrian Obat</a></li>
        </ul>
      </li> 
		
		<?php
	//	if ($this->uri->segment(2)=='pelayanan' || $this->uri->segment(1)=='pelayanan'){?>
	<!-- <li class="active"><a href="<?=@site_url()?>pelayanan"><i class="fa fa-fw fa-heart"></i>&nbsp;Pelayanan</a></li>
		<?php// } else {?>
		<li><a href="<?=@site_url()?>pelayanan"><i class="fa fa-fw fa-heart"></i>&nbsp;Pelayanan</a></li> -->
		<?php// } ?>
		
		<?php
		//if ($this->uri->segment(2)=='pengambilan_obat' || $this->uri->segment(1)=='pengambilan_obat'){?>
		<!-- <li class="active"><a href="<?=@site_url()?>pengambilan_obat"><i class="fa fa-fw fa-list"></i>&nbsp;Antrian Obat</a></li>
		<?php// } else {?>
		<li><a href="<?=@site_url()?>pengambilan_obat"><i class="fa fa-fw fa-list"></i>&nbsp;Antrian Obat</a></li> -->
		<?php// } ?>
		
		<?php
		//if ($this->uri->segment(2)=='penyerahan_obat' || $this->uri->segment(1)=='penyerahan_obat'){?>
		<!--  <li class="active"><a href="<?=@site_url()?>penyerahan_obat"><i class="fa fa-fw fa-thumbs-up"></i>&nbsp;Penyerahan Obat</a></li>-->
		<?php // } else {?>
		<!--  <li><a href="<?=@site_url()?>penyerahan_obat"><i class="fa fa-fw fa-thumbs-up"></i>&nbsp;Penyerahan Obat</a></li>-->
		<?php // } ?>
		
			<li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-medkit"></i>&nbsp;Master Obat
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	         <li><a href="<?=@site_url()?>master_obat"><i class="fa fa-fw fa-medkit"></i>&nbsp;Master Obat</a></li>
	         <li><a href="<?=@site_url()?>master_obat/jenis_obat"><i class="fa fa-fw fa-list"></i>&nbsp;Jenis Obat</a></li>
	          <li><a href="<?=@site_url()?>master_obat/racikan_obat"><i class="fa fa-fw fa-plus"></i>&nbsp;Racikan Obat</a></li>
	          <li><a href="<?=@site_url()?>master_obat/harga_obat"><i class="fa fa-fw fa-dollar"></i>&nbsp;Harga Obat</a></li>
       
        </ul>
      </li> 
      
      <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-briefcase"></i>&nbsp;Inventory
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	         <li><a href="<?=@site_url()?>penerimaan"><i class="fa fa-fw fa-arrow-circle-down"></i>&nbsp;Penerimaan</a></li>
	         <li><a href="<?=@site_url()?>pengeluaran"><i class="fa fa-fw fa-arrow-circle-up"></i>&nbsp;Pengeluaran</a></li>
	         <li><a href="<?=@site_url()?>penerimaan/stock_obat"><i class="fa fa-fw fa-archive"></i>&nbsp;Persediaan Obat</a></li>
	          <li><a href="<?=@site_url()?>koreksi_stock"><i class="fa fa-fw fa-spinner"></i>&nbsp;Mutasi Persediaan</a></li>
        </ul>
      </li> 
      
        <?php
	//	if ($this->uri->segment(3)=='stock_obat' || $this->uri->segment(2)=='stock_obat'){?>
	<!-- 	<li class="active"><a href="<?=@site_url()?>penerimaan/stock_obat"><i class="fa fa-fw fa-archive"></i>&nbsp;Persediaan Obat</a></li>
		<?php // } else {?>
		<li><a href="<?=@site_url()?>penerimaan/stock_obat"><i class="fa fa-fw fa-archive"></i>&nbsp;Persediaan Obat</a></li> -->
		<?php //} ?>
      
      <?php
		if ($this->uri->segment(2)=='pasien' || $this->uri->segment(1)=='pasien'){?>
		<li class="active"><a href="<?=@site_url()?>pelayanan"><i class="fa fa-fw fa-users"></i>&nbsp;Pasien</a></li>
		<?php } else {?>
		<li><a href="<?=@site_url()?>pasien"><i class="fa fa-fw fa-users"></i>&nbsp;Pasien</a></li>
		<?php } ?>
		
		<?php
		//if ($this->uri->segment(2)=='retur_obat' || $this->uri->segment(1)=='retur_obat'){?>
	<!-- 	<li class="active"><a href="<?=@site_url()?>retur_obat"><i class="fa fa-fw fa-undo"></i>&nbsp;Retur Obat</a></li>
		<?php //} else {?>
		<li><a href="<?=@site_url()?>retur_obat"><i class="fa fa-fw fa-undo"></i>&nbsp;Retur Obat</a></li> -->
		<?php //} ?>
		
			<?php
		//if ($this->uri->segment(2)=='koreksi_stock' || $this->uri->segment(1)=='koreksi_stock'){?>
		<!--  <li class="active"><a href="koreksi_stock"><i class="fa fa-fw fa-book"></i>&nbsp;Mutasi Stok</a></li>
		<?php // } else {?>
		<li><a href="<?=@site_url()?>koreksi_stock"><i class="fa fa-fw fa-book"></i>&nbsp;Mutasi Stok</a></li> -->
		<?php //} ?>
		
      
       <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-print"></i>&nbsp;Laporan
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	         <li><a href="<?=@site_url()?>report/laporan_harian/index">&nbsp;Laporan Penjualan Obat</a></li>
	         <li><a href="<?=@site_url()?>report/laporan_stok_obat/index">&nbsp;Laporan Stok Obat</a></li>
        </ul>
      </li> 
     
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?=@site_url()?>login/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
		</ul>

	</div>
</nav>