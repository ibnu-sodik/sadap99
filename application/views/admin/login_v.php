<!-- <?php 
//$str = "password";

//echo sha1(md5($str));die();
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<?php if(isset($title)): ?>
		<title><?=$title?> | <?= $site_title; ?> Admin Panel</title><?php else: ?>
		<title><?= $site_title; ?></title>
	<?php endif; ?>
	<meta name="keywords" content="<?= $site_keywords; ?>">
	<meta name="description" content="<?= $site_description; ?>">
	<meta name="author" content="<?= $site_author; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $url; ?>" />
	<meta property="og:site_name" content="<?= $site_name;?>" />
	<meta property="og:image" content="<?= base_url('assets/images/'.$site_favicon); ?>" />
	<meta property="og:image:secure_url" content="<?= base_url('assets/images/'.$site_favicon); ?>" />
	<meta property="og:image:width" content="560" />
	<meta property="og:image:height" content="315" />
	<link rel="shortcut icon" href="<?= base_url('assets/images/'.$site_favicon) ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?= base_url('assets/images/'.$site_favicon) ?>">
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/font-awesome/4.5.0/css/font-awesome.min.css" />
	<!-- text fonts -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/fonts.googleapis.com.css" />
	<!-- ace styles -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-rtl.min.css" />
	<script src="<?=base_url()?>fileAdmin/js/sweetalert.min.js"></script>
</head>
<body class="login-layout" style="margin-top: 20vh;">
	<div class="main-container">
		<div class="main-content">
			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
			<div class="pesan-sukses" data-pesansukses="<?= $this->session->flashdata('pesanSukses'); ?>"></div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-desktop red"></i>
								<span class="red">Login</span>
								<span class="white" id="id-text2">Website</span>
							</h1>
							<h4 class="white" id="id-company-text">&copy; <?= ((isset($site_name)) ? $site_name : $judul); ?></h4>
						</div>
						<div class="space-6"></div>
						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header blue lighter bigger">
											<i class="ace-icon fa fa-edit green"></i>
											Masukkan Data Anda
										</h4>
										<div class="space-6"></div>
										<form method="POST" action="<?= $form_act_login; ?>">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="username" type="text" class="form-control" placeholder="Username / Email" autofocus="true" value="<?= set_value('username') ?>" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="password" type="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>
												<div class="space"></div>
												<div class="clearfix">
													<button type="submit" class="btn btn-block btn-sm btn-primary">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Login</span>
													</button>
												</div>
												<div class="space-4"></div>
												<div class="clearfix">
													<a href="<?= base_url() ?>" class="btn btn-sm btn-block">
														<i class="fa fa-arrow-left"></i> Lihat Website
													</a>
												</div>
												<div class="space-4"></div>
											</fieldset>
										</form>

									</div>
									<div class="toolbar clearfix">
										<div>
											<a href="#" data-target="#forgot-box" class="forgot-password-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Lupa Password
											</a>
										</div>
									</div>
								</div>
							</div>
							<div id="forgot-box" class="forgot-box widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header red lighter bigger">
											<i class="ace-icon fa fa-key"></i>
											Lupa Password
										</h4>
										<div class="space-6"></div>
										<p>
											Masukkan email anda untuk mendapatkan kode
										</p>
										<form method="POST" action="<?= $form_act_forget; ?>">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="email" type="email" class="form-control" placeholder="Email" required autocomplete="off" value="<?= set_value('email') ?>" />
														<i class="ace-icon fa fa-envelope"></i>
														<?= form_error('email'); ?>
													</span>
												</label>
												<div class="clearfix">
													<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
														<i class="ace-icon fa fa-lightbulb-o"></i>
														<span class="bigger-110">Kirim!</span>
													</button>
												</div>
											</fieldset>
										</form>
									</div>
									<div class="toolbar center">
										<a href="#" data-target="#login-box" class="back-to-login-link">
											Kembali login
											<i class="ace-icon fa fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="navbar-fixed-top align-right">
							<br />
							&nbsp;
							<a id="btn-login-dark" href="#">Dark</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-blur" href="#">Blur</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-light" href="#">Light</a>
							&nbsp; &nbsp; &nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url() ?>fileAdmin/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url('fileAdmin/js/goblog.js'); ?>"></script>
	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url() ?>fileAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
	<script type="text/javascript">
		jQuery(function($) {
			$(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');
				$(target).addClass('visible');
			});
		});
		jQuery(function($) {
			$('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				e.preventDefault();
			});
			$('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				e.preventDefault();
			});
			$('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				e.preventDefault();
			});
		});
	</script>

</body>

</html>

