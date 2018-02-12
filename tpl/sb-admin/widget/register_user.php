<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<meta name="site_url" content="<?=site_url()?>" />

	<link rel="icon" href="<?=$theme_url?>assets/images/favicon.ico">

	<title>HOTEL | Login</title>

	<link rel="stylesheet" href="<?=$theme_url?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/neon-core.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/neon-theme.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/neon-forms.css">
	<link rel="stylesheet" href="<?=$theme_url?>assets/css/custom.css">

	<script src="<?=$theme_url?>assets/js/jquery-1.11.3.min.js"></script>
	<!-- Bottom scripts (common) -->
	<script src="<?=$theme_url?>assets/js/gsap/TweenMax.min.js"></script>
	<script src="<?=$theme_url?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?=$theme_url?>assets/js/bootstrap.js"></script>
	<script src="<?=$theme_url?>assets/js/joinable.js"></script>
	<script src="<?=$theme_url?>assets/js/resizeable.js"></script>
	<script src="<?=$theme_url?>assets/js/neon-api.js"></script>
	<script src="<?=$theme_url?>assets/js/jquery.validate.min.js"></script>
	<script src="<?=$theme_url?>assets/js/neon-login.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="<?=$theme_url?>assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="<?=$theme_url?>assets/js/neon-demo.js"></script>

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

			<a class="logo">
				<img src="<?=$theme_url?>assets/images/logo@2x.png" width="200" alt="" />
			</a>
			<p class="description">Dear user, log in to access the admin area!</p>
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

			<?php
        $success_msg= $this->session->flashdata('success_msg');
        $error_msg= $this->session->flashdata('error_msg');

            if($success_msg){
              ?>
             	<div class="alert alert-success">
                  <?php echo $success_msg; ?>
              </div>
                  <?php
              }
            if($error_msg){
              ?>
              <div class="alert alert-danger">
                  <?php echo $error_msg; ?>
              </div>
                  <?php
              }
      ?>
			<form method="post" action="<?=site_url()?>login/auth">

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


			<div class="login-bottom-links">

				<a href="<?= base_url('login/register')?>" class="link">Register ?</a>

				<br />

				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>

			</div>

		</div>

	</div>

</div>

</body>
</html>
