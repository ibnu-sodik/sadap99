<?php 
if (isset($canonical) && isset($url)) {
	$canonical = $canonical;
	$url = $url;
}else{
	$canonical = site_url('');
	$url = site_url('');
}
$page = $_SERVER['PHP_SELF'];

$sec = "30";
$hari_ini = date('Y-m-d');
$page = $this->uri->segment(1);
?>
<!DOCTYPE html>
<html lang="id-ID">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php 
	if(isset($title)): ?>
		<title><?=$title?> | <?= $site_title; ?></title>
		<meta property="og:title" content="<?= $title;?>" /><?php else: ?>
		<title><?= $site_title; ?></title>
		<meta property="og:title" content="<?= $site_title;?>" />
	<?php endif; ?>
	<meta name='robots' content='noindex, nofollow' />
	<?php 
	if (isset($description)): ?>
		<meta name="description" content="<?= $description; ?>" />
		<meta property="og:description" content="<?= $description;?>" /><?php else: ?>
		<meta name="description" content="<?= $site_description; ?>" />
		<meta property="og:description" content="<?= $site_description;?>" />
	<?php endif; ?>
	<?php 
	if (isset($author)): ?>
		<meta name="author" content="<?= $author; ?>"><?php else: ?>
		<meta name="author" content="<?= $site_author; ?>">
	<?php endif; ?>

	<?php 
	if (isset($description)): ?>
		<meta name="description" content="<?= $description; ?>" />
		<meta property="og:description" content="<?= $description;?>" /><?php else: ?>
		<meta name="description" content="<?= $site_description; ?>" />
		<meta property="og:description" content="<?= $site_description;?>" />
	<?php endif; ?>
	<?php 
	if (isset($author)): ?>
		<meta name="author" content="<?= $author; ?>"><?php else: ?>
		<meta name="author" content="<?= $site_author; ?>">
	<?php endif; ?>
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $url; ?>" />
	<meta property="og:site_name" content="<?= $site_name;?>" />
	<?php 
	if (isset($gambar)): ?>
		<meta property="og:image" content="<?= $gambar; ?>" />
		<meta property="og:image:secure_url" content="<?= $gambar; ?>" /><?php else: ?>
		<meta property="og:image" content="<?= base_url('assets/images/'.$site_favicon); ?>" />
		<meta property="og:image:secure_url" content="<?= base_url('assets/images/'.$site_favicon); ?>" />
	<?php endif; ?>

	<?php 
	if(isset($url_prev)): ?>
		<link rel="prev" href="<?= $url_prev;?>" />
	<?php endif; ?>
	<?php 
	if (isset($url_next)): ?>
		<link rel="next" href="<?= $url_next;?>" />
	<?php endif; ?>

	<link rel="shortcut icon" href="<?= base_url('assets/images/'.$site_favicon) ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?= base_url('assets/images/'.$site_favicon) ?>">
	<link rel="icon" href="<?= base_url('assets/images/'.$site_favicon) ?>" sizes="32x32" />
	<link rel="icon" href="<?= base_url('assets/images/'.$site_favicon) ?>" sizes="192x192" />
	<meta name="msapplication-TileImage" content="<?= base_url('assets/images/'.$site_favicon) ?>" />

	<meta property="og:image:width" content="560" />
	<meta property="og:image:height" content="315" />
	<meta name="generator" content="WordPress 5.8.2" />
	<link rel="canonical" href="<?= $canonical; ?>">
	<link rel="https://api.w.org/" href="<?= base_url() ?>wp-json/" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?= base_url() ?>/sitemap" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?= base_url() ?>wlwmanifest.xml" />

	<link rel='stylesheet' id='wp-block-library-css'  href='<?= base_url() ?>assets/css/dist/block-library/style.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='wp-block-library-theme-inline-css'  href='<?= base_url() ?>assets/css/dist/block-library/theme-inline.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='dashicons-css'  href='<?= base_url() ?>assets/css/dashicons.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='colormag_style-css'  href='<?= base_url() ?>assets/themes/colormag/style.css' type='text/css' />
	<link rel="stylesheet" id="colormag_style-inline-css" type="text/css" href="<?= base_url() ?>assets/themes/colormag/style-inline.css">
	<link rel='stylesheet' id='colormag-featured-image-popup-css-css'  href='<?= base_url() ?>assets/themes/colormag/js/magnific-popup/magnific-popup.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='colormag-fontawesome-css'  href='<?= base_url() ?>assets/themes/colormag/fontawesome/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='colormag_googlefonts-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A400%2C600&#038;1&#038;display=swap&#038;ver=2.1.0' type='text/css' media='all' />
	<link rel='stylesheet' id='pgntn_stylesheet-css'  href='<?= base_url() ?>assets/css/pagination-style.css' type='text/css' media='all' />
	

	<script type='text/javascript' src='<?= base_url() ?>assets/js/jquery/jquery.min.js' id='jquery-core-js'></script>
	<script type='text/javascript' src='<?= base_url() ?>assets/js/jquery/jquery-migrate.min.js' id='jquery-migrate-js'></script>
	<!--[if lte IE 8]>
		<script type='text/javascript' src='<?= base_url() ?>wp-content/themes/colormag/js/html5shiv.min.js' id='html5-js'></script>
	<![endif]-->
	
</head>

<body class="home blog wp-custom-logo wp-embed-responsive <?= (($page == "kontak" || $page == "halaman" || $page == "sitemap") ? 'no-sidebar' : 'right-sidebar') ?> <?= (($title == "Halaman 404") ? 'no-sidebar' : 'right-sidebar') ?>  box-layout">
	<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#main">Skip to content</a>

		<?php include 'header.php'; ?>

		<div id="main" class="clearfix">
			<div class="inner-wrap clearfix">