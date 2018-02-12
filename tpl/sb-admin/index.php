<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel | California</title>
	<meta name="site_url" content="<?=site_url()?>" />
  <!-- DEVELOPMENT MODE-->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- <link rel="icon" href="<?=$theme_url?>wisma-image/favicon.gif" type="image/gif" sizes="16x16"> -->

  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/bootstrap-float-label.scss">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/bootstrap-float-label.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/main/css/select2.min.css">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/AdminLTE.min.css">

  <!-- <link href="<?=$theme_url?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css' /> -->
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/_all-skins.min.css">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/clockpicker.css">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/sweetalert.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/main/css/ui.jqgrid-bootstrap.css">
  <link rel="stylesheet" href="<?=$theme_url?>assets/main/css/pnotify.custom.min.css" type="text/css"/>


  <script src="<?=$theme_url?>assets/main/js/require.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <script type="text/javascript">
  var baseURL = document.querySelector("meta[name=site_url]").getAttribute('content');
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- ====HEADER start==== -->
  <?=@$widget->header?>
  <!-- ====HEADER end==== -->

  <!-- ====ASIDE start==== -->
  <?=@$widget->aside?>
  <!-- ====ASIDE end==== -->

  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
				<?=$content?>
  </div>
</div>
<!-- ./wrapper -->
<!-- <script src="<?=$theme_url?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?=$theme_url?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$theme_url?>assets/plugins/datepicker/bootstrap-datepicker.js"></script> -->
<!-- <script src="<?=$theme_url?>assets/plugins/select2/select2.full.min.js"></script> -->
<!-- <script src="<?=$theme_url?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
<!-- <script src="<?=$theme_url?>assets/plugins/fastclick/fastclick.js"></script> -->
<!-- <script src="<?=$theme_url?>assets/dist/js/app.min.js"></script>
<script src="<?=$theme_url?>assets/dist/js/demo.js"></script> -->
</body>
</html>
