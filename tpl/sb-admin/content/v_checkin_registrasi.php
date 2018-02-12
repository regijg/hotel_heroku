<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />
<section class="content-header">
  <h1>

  </h1>
  <ol class="breadcrumb">
		<li><a href="<?= base_url('/tamu_menginap') ?>"><i class="fa fa-circle-o"></i> TAMU MENGINAP</a></li>
    <li><a href="<?= base_url('/tamu_menginap/checkin') ?>"><i class="fa fa-circle"></i> Check-IN</a></li>
    <!-- <li><a href="<?= base_url('/registrasi/checkout') ?>"><i class="fa fa-circle-o"></i> Check-OUT</a></li> -->
  </ol>
</section><br>
<section class="content">
	<div class="box">
	      <div class="box-header" style="text-align:center">
	        <h3 class="box-title">Data Tamu Checkin</h3>
	      </div>
	      <!-- /.box-header -->
	      <div class="box-body">
	        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
	          <thead>
	          <tr>
							<th style="font-size:12px; width:90px; text-align:center">No Registrasi</th>
							<th style="font-size:12px; width:160px;">Nama</th>
							<th style="font-size:12px;">Alamat</th>
							<th style="font-size:12px; width:100px;">Telpon</th>
							<th style="font-size:12px; width:80px; text-align:center">No. Kamar</th>
							<th style="font-size:12px; text-align:center">Nama Diklat</th>
	          </tr>
	          </thead>
						<?php foreach ($listDataTamuCheckin as $k) { ?>
								<tbody>
								<tr>
										<td style="font-size:12px; text-align:center"><?= $k->reg_no ?></td>
										<td style="font-size:12px"><?= $k->nama ?></td>
										<td style="font-size:12px"><?= $k->alamat ?></td>
										<td style="font-size:12px"><?= $k->telpon ?></td>
										<td style="font-size:12px; text-align:center"><?= $k->room_number ?></td>
										<td style="font-size:12px"><?= $k->judul_diklat ?></td>
								</tr>
								</tbody>
						<?php } ?>
	        </table>
	      </div>
	      <!-- /.box-body -->
	</div>
</section>
<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/tamu'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
<!-- <script src="<?=$theme_url?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$theme_url?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
