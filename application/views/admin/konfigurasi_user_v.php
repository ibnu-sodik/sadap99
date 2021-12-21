<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Tambah Data User</title>

	<meta name="csrf-token" content="<?= $csrf_token ?>">
	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace.min.css" />

	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-rtl.min.css" />
	
	<script src="<?= base_url() ?>fileAdmin/js/jquery-2.1.4.min.js"></script>
	<script src="<?=base_url()?>fileAdmin/js/sweetalert.min.js"></script>
</head>

<body class="login-layout light-login">
	<div class="main-container">
		<div class="main-content">			

			<div class="swal-warning" data-flashdata="<?= $this->session->flashdata('swalWarning'); ?>"></div>
			<div class="swal-info" data-flashdata="<?= $this->session->flashdata('swalInfo'); ?>"></div>
			<div class="swal-error" data-flashdata="<?= $this->session->flashdata('swalError'); ?>"></div>
			<div class="swal-sukses" data-flashdata="<?= $this->session->flashdata('swalSukses'); ?>"></div>

			<div class="pnotify-sukses" data-flashdata="<?= $this->session->flashdata('pnotifySukses'); ?>"></div>
			<div class="pnotify-notice" data-flashdata="<?= $this->session->flashdata('pnotifyWarning'); ?>"></div>
			<div class="pnotify-info" data-flashdata="<?= $this->session->flashdata('pnotifyInfo'); ?>"></div>
			<div class="pnotify-error" data-flashdata="<?= $this->session->flashdata('pnotifyError'); ?>"></div>

			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-user red"></i>
								<span class="red">Pengaturan</span>
								<span class="white" id="id-text2">User</span>
							</h1>
							<h4 class="light-blue" id="id-company-text">&copy; Data User</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">

							<div id="signup-box" class="signup-box visible widget-box no-border">

								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
											<i class="ace-icon fa fa-users blue"></i>
											Registrasi User Baru
										</h4>

										<div class="space-6"></div>
										<p> Masukkan data diri untuk mulai: </p>

										<form method="POST" action="<?= $form_action ?>">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" placeholder="Full name" name="full_name" value="<?= set_value('full_name') ?>" autofocus>
													<i class="ace-icon fa fa-credit-card"></i>
													<?= form_error('full_name'); ?>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
													<i class="ace-icon fa fa-envelope"></i>
													<?= form_error('email'); ?>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username') ?>">
													<i class="ace-icon fa fa-user"></i>
													<?= form_error('username'); ?>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?= set_value('password') ?>">
													<i class="ace-icon fa fa-lock"></i>
													<?= form_error('password'); ?>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" class="form-control" id="conf_password" placeholder="Konfirmasi password" name="conf_password" value="<?= set_value('conf_password') ?>">
													<i class="ace-icon fa fa-retweet"></i>
													<?= form_error('conf_password'); ?>
												</span>
											</label>

											<label class="block">
												<input type="checkbox" class="ace">
												<span class="lbl" onclick="showPass()">
													Lihat Password
												</span>
											</label>

											<div class="space-24"></div>

											<div class="clearfix">
												<button type="reset" class="width-30 pull-left btn btn-sm">
													<i class="ace-icon fa fa-refresh"></i>
													<span class="bigger-110">Reset</span>
												</button>

												<button type="submit" class="width-65 pull-right btn btn-sm btn-success">
													<span class="bigger-110">Register</span>

													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>
											</div>
										</fieldset>
									</form>
								</div>

							</div>

						</div><!-- /.signup-box -->
					</div><!-- /.position-relative -->
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.main-content -->
</div><!-- /.main-container -->

<script src="<?= base_url() ?>fileAdmin/js/jquery.pnotify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/notifikasi.js"></script>

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url() ?>fileAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">

	function showPass() {
		var x = document.getElementById('password');
		var y = document.getElementById('conf_password');

		if (x.type === "password") {
			x.type = "text";
			y.type = "text";
		}else{
			x.type = "password";
			y.type = "password";
		}
	}

	jQuery(function($) {
		$(document).on('click', '.toolbar a[data-target]', function(e) {
			e.preventDefault();
			var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
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
