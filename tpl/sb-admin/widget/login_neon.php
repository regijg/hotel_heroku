<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<meta name="site_url" content="<?=site_url()?>" />


  <link rel="icon" href="<?=$theme_url?>wisma-image/favicon.gif" type="image/gif" sizes="16x16">

	<title>WISMA | Login</title>

	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/jquery-ui-1.10.3.custom.min.css">
	<!-- <link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/entypo.css"> -->
	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/neon-core.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/neon-theme.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/neon-forms.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/mainlogin/css/custom.css">

	<script src="<?=$theme_url?>assets/mainlogin/js/require.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

  <script type="text/javascript">
    var baseURL = document.querySelector("meta[name=site_url]").getAttribute('content');
  </script>
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>
<div class="login-container">

	<div class="login-header login-caret">

		<div class="login-content">

			<a href="index.html" class="logo">
				<!-- <img src="<?= $theme_url ?>assets/images/logo@2x.png" width="120" alt="" /> -->
			</a>
			<h2 style="color:white; font-weight:bold">HOTEL</h2>

			<!-- <p class="description">Dear user, log in to access the admin area!</p> -->

			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>

	</div>

	<div class="login-progressbar">
		<div></div>
	</div>

	<div class="login-form">

		<div class="login-content">

			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
			</div>

			<form method="post" action="javascript:;" id="form">
				<div class="form-group">

					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>

						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>

						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>

				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>

			</form>

		</div>

	</div>

</div>

<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/mainlogin',
        "jspage"					: 	'js/page/login'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpllogin'
     ], function(){});
});
</script>

</body>
</html>
