<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $title;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta content="<?php echo $description;?>" name="description"/>
		<meta content="Ferdhika" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $asset;?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $asset;?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="<?php echo $asset;?>admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN THEME STYLES -->
		<link href="<?php echo $asset;?>global/css/components.css" rel="stylesheet" type="text/css"/>
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="<?php echo $asset;?>favicon.ico"/>
	</head>
	<body class="login">
		<!-- BEGIN LOGO -->
		<div class="logo">
			<a href="<?php echo site_url('admin');?>">
				<img src="<?php echo $asset;?>admin/layout/img/logo-big.png" alt=""/>
			</a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGIN -->
		<div class="content">
			<!-- BEGIN LOGIN FORM -->
			<form class="login-form" action="" method="post">
				<h3 class="form-title">Masuk ke akun anda.</h3>
				<?php if(!empty($message)): ?>
				<div class="alert alert-danger">
					<span><?php echo $message; ?></span>
				</div>
				<?php endif;?>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Username</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn red pull-right">
					Masuk <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
			</form>
			<!-- END LOGIN FORM -->
		</div>
		<script src="<?php echo $asset;?>js/jquery-1.11.0.min.js" type="text/javascript"></script>
		<script src="<?php echo $asset;?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>