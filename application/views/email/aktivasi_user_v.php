<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap");
		:root {
			--blue: #2780e3;
			--indigo: #6610f2;
			--purple: #613d7c;
			--pink: #e83e8c;
			--red: #ff0039;
			--orange: #f0ad4e;
			--yellow: #ff7518;
			--green: #3fb618;
			--teal: #20c997;
			--cyan: #9954bb;
			--white: #fff;
			--gray: #868e96;
			--gray-dark: #373a3c;
			--primary: #2780e3;
			--secondary: #373a3c;
			--success: #3fb618;
			--info: #9954bb;
			--warning: #ff7518;
			--danger: #ff0039;
			--light: #f8f9fa;
			--dark: #373a3c;
			--breakpoint-xs: 0;
			--breakpoint-sm: 576px;
			--breakpoint-md: 768px;
			--breakpoint-lg: 992px;
			--breakpoint-xl: 1200px;
			--font-family-sans-serif: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			--font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
		}

		*,
		*::before,
		*::after {
			box-sizing: border-box;
		}


		html {
			font-family: sans-serif;
			line-height: 1.15;
			-webkit-text-size-adjust: 100%;
			-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		}


		article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
			display: block;
		}


		body {
			margin: 0;
			font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			font-size: 0.9375rem;
			font-weight: 400;
			line-height: 1.5;
			color: #373a3c;
			text-align: left;
			background-color: #fff;
		}


		[tabindex="-1"]:focus:not(:focus-visible) {
			outline: 0 !important;
		}


		hr {
			box-sizing: content-box;
			height: 0;
			overflow: visible;
		}


		h1, h2, h3, h4, h5, h6 {
			margin-top: 0;
			margin-bottom: 0.5rem;
		}


		p {
			margin-top: 0;
			margin-bottom: 1rem;
		}


		img {
			vertical-align: middle;
			border-style: none;
		}


		.text-left {
			text-align: left !important;
		}


		.text-right {
			text-align: right !important;
		}


		.text-center {
			text-align: center !important;
		}


		.text-justify {
			text-align: justify !important;
		}


		.bg-secondary {
			background-color: #373a3c !important;
		}


		a.bg-secondary:hover, a.bg-secondary:focus,
		button.bg-secondary:hover,
		button.bg-secondary:focus {
			background-color: #1f2021 !important;
		}


		.row {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}


		.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
		.col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
		.col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
		.col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
		.col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
		.col-xl-auto {
			position: relative;
			width: 100%;
			padding-right: 15px;
			padding-left: 15px;
		}


		.btn {
			display: inline-block;
			font-weight: 400;
			color: #373a3c;
			text-align: center;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			background-color: transparent;
			border: 1px solid transparent;
			padding: 0.375rem 0.75rem;
			font-size: 0.9375rem;
			line-height: 1.5;
			border-radius: 0;
			transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}


		.btn-success:hover {
			color: #fff;
			background-color: #339414;
			border-color: #2f8912;
		}


		.btn-success:focus, .btn-success.focus {
			color: #fff;
			background-color: #339414;
			border-color: #2f8912;
			box-shadow: 0 0 0 0.2rem rgba(92, 193, 59, 0.5);
		}


		.btn-success.disabled, .btn-success:disabled {
			color: #fff;
			background-color: #3fb618;
			border-color: #3fb618;
		}


		.btn-success:not(:disabled):not(.disabled):active, .btn-success:not(:disabled):not(.disabled).active,
		.show > .btn-success.dropdown-toggle {
			color: #fff;
			background-color: #2f8912;
			border-color: #2c7e11;
		}


		.btn-success:not(:disabled):not(.disabled):active:focus, .btn-success:not(:disabled):not(.disabled).active:focus,
		.show > .btn-success.dropdown-toggle:focus {
			box-shadow: 0 0 0 0.2rem rgba(92, 193, 59, 0.5);
		}


		.btn-info {
			color: #fff;
			background-color: #9954bb;
			border-color: #9954bb;
		}


		.btn-info:hover {
			color: #fff;
			background-color: #8542a7;
			border-color: #7e3f9d;
		}


		.btn-info:focus, .btn-info.focus {
			color: #fff;
			background-color: #8542a7;
			border-color: #7e3f9d;
			box-shadow: 0 0 0 0.2rem rgba(168, 110, 197, 0.5);
		}


		.btn-info.disabled, .btn-info:disabled {
			color: #fff;
			background-color: #9954bb;
			border-color: #9954bb;
		}


		.btn-info:not(:disabled):not(.disabled):active, .btn-info:not(:disabled):not(.disabled).active,
		.show > .btn-info.dropdown-toggle {
			color: #fff;
			background-color: #7e3f9d;
			border-color: #773b94;
		}


		.btn-info:not(:disabled):not(.disabled):active:focus, .btn-info:not(:disabled):not(.disabled).active:focus,
		.show > .btn-info.dropdown-toggle:focus {
			box-shadow: 0 0 0 0.2rem rgba(168, 110, 197, 0.5);
		}


		.btn-warning {
			color: #fff;
			background-color: #ff7518;
			border-color: #ff7518;
		}


		.btn-warning:hover {
			color: #fff;
			background-color: #f16100;
			border-color: #e45c00;
		}


		.btn-warning:focus, .btn-warning.focus {
			color: #fff;
			background-color: #f16100;
			border-color: #e45c00;
			box-shadow: 0 0 0 0.2rem rgba(255, 138, 59, 0.5);
		}


		.btn-warning.disabled, .btn-warning:disabled {
			color: #fff;
			background-color: #ff7518;
			border-color: #ff7518;
		}


		.btn-warning:not(:disabled):not(.disabled):active, .btn-warning:not(:disabled):not(.disabled).active,
		.show > .btn-warning.dropdown-toggle {
			color: #fff;
			background-color: #e45c00;
			border-color: #d75700;
		}


		.btn-warning:not(:disabled):not(.disabled):active:focus, .btn-warning:not(:disabled):not(.disabled).active:focus,
		.show > .btn-warning.dropdown-toggle:focus {
			box-shadow: 0 0 0 0.2rem rgba(255, 138, 59, 0.5);
		}


		.btn-danger {
			color: #fff;
			background-color: #ff0039;
			border-color: #ff0039;
		}


		.btn-danger:hover {
			color: #fff;
			background-color: #d90030;
			border-color: #cc002e;
		}


		.btn-danger:focus, .btn-danger.focus {
			color: #fff;
			background-color: #d90030;
			border-color: #cc002e;
			box-shadow: 0 0 0 0.2rem rgba(255, 38, 87, 0.5);
		}


		.btn-danger.disabled, .btn-danger:disabled {
			color: #fff;
			background-color: #ff0039;
			border-color: #ff0039;
		}


		.btn-danger:not(:disabled):not(.disabled):active, .btn-danger:not(:disabled):not(.disabled).active,
		.show > .btn-danger.dropdown-toggle {
			color: #fff;
			background-color: #cc002e;
			border-color: #bf002b;
		}


		.btn-danger:not(:disabled):not(.disabled):active:focus, .btn-danger:not(:disabled):not(.disabled).active:focus,
		.show > .btn-danger.dropdown-toggle:focus {
			box-shadow: 0 0 0 0.2rem rgba(255, 38, 87, 0.5);
		}


		.btn-primary {
			color: #fff;
			background-color: #2780e3;
			border-color: #2780e3;
		}


		.btn-primary:hover {
			color: #fff;
			background-color: #1a6dca;
			border-color: #1967be;
		}


		.btn-primary:focus, .btn-primary.focus {
			color: #fff;
			background-color: #1a6dca;
			border-color: #1967be;
			box-shadow: 0 0 0 0.2rem rgba(71, 147, 231, 0.5);
		}


		.btn-primary.disabled, .btn-primary:disabled {
			color: #fff;
			background-color: #2780e3;
			border-color: #2780e3;
		}


		.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active,
		.show > .btn-primary.dropdown-toggle {
			color: #fff;
			background-color: #1967be;
			border-color: #1761b3;
		}


		.btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus,
		.show > .btn-primary.dropdown-toggle:focus {
			box-shadow: 0 0 0 0.2rem rgba(71, 147, 231, 0.5);
		}


		@media (min-width: 576px) {
			.text-sm-left {
				text-align: left !important;
			}
			.text-sm-right {
				text-align: right !important;
			}
			.text-sm-center {
				text-align: center !important;
			}
		}


		@media (min-width: 768px) {
			.text-md-left {
				text-align: left !important;
			}
			.text-md-right {
				text-align: right !important;
			}
			.text-md-center {
				text-align: center !important;
			}
		}


		@media (min-width: 992px) {
			.text-lg-left {
				text-align: left !important;
			}
			.text-lg-right {
				text-align: right !important;
			}
			.text-lg-center {
				text-align: center !important;
			}
		}


		@media (min-width: 1200px) {
			.text-xl-left {
				text-align: left !important;
			}
			.text-xl-right {
				text-align: right !important;
			}
			.text-xl-center {
				text-align: center !important;
			}
		}



	</style>

</head>

<body>

	<div class="col-md-12">
		<h3>Halo <?= $full_name ?>!</h3>
		<p>Mulai sekarang anda adalah personil di <?= $site_name ?></p>
		<p>Gunakan data dibawah ini untuk login.</p>
		<table class="table">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $full_name ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?= $username ?></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><?= $password ?></td>
			</tr>
		</table>
		<p>Silahkan klik tombol Aktivasi Akun untuk mendapatkan akses pada <?= $site_name; ?></p>
		<a class="btn btn-primary" href="<?= $url_aktivasi ?>">Aktivasi Akun</a>

	</div>

	<div class="text-center bg-secondary">
		<span>
			<span><?= pilih_kata($site_name, 0); ?></span>&copy; 
			<?php if ($tahun_buat == date('Y')) {
				echo date('Y');
			}else{
				echo $tahun_buat.' - '.date('Y');
			}
			?>
		</span>

	</div>

</body>
</html>