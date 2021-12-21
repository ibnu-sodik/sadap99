<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1.0" />
	<meta name="format-detection" content="telephone=no" />
	<title></title>
</head>
<body>
	<h3><?= $subjek ?></h3>
	<p>kode reset password anda adalah <?= $reset_code; ?></p>
	<p>Klik Tombol Reset Password untuk mengatur ulang sandi anda.</p>
	<a href="<?= $url_reset ?>">Reset Password</a>
</body>
</html>