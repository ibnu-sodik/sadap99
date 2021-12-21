<?php 
if ($this->session->userdata('login_goblog') != TRUE) {

	$url = base_url('admin');

	redirect($url);

}
$user_id 	= $this->session->userdata('id');

$query 		= $this->db->get_where('tb_users', array('id' => $user_id));

$user_data 	= $query->row_array();
$page = $_SERVER['PHP_SELF'];

$sec = "30";
$url = site_url('admin/'.strtolower($title));
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta http-equiv="refresh" content="<?php //echo $sec?>;URL='<?php //echo $page?>'">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<meta charset="utf-8" />
	<?php if(isset($title)): ?>
		<title><?=$title?> | <?= $site_title; ?> Admin Panel</title>
		<?php else: ?>
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
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/colorbox.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/pnotify.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/toastr.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<script src="<?= base_url() ?>fileAdmin/js/ace-extra.min.js"></script>
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/custom.css" />
		<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-ie.min.css" />
		<script src="<?= base_url() ?>fileAdmin/js/jquery-2.1.4.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/ace-extra.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/jquery.colorbox.min.js"></script>
		<script src="<?= base_url() ?>fileAdmin/js/jquery.toast.min.js"></script>
	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="<?= site_url('admin') ?>" class="navbar-brand">
						<small>
							<i class="fa fa-desktop"></i>
							<?= pilih_kata($site_name, 0) ?>
						</small>
					</a>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="">
							<a href="<?= base_url('') ?>" title="Lihat Website" target="_blank">
								<i class="ace-icon fa fa-eye"></i>
							</a>
						</li>
						<script type="text/javascript">
							$(document).ready(function() {
								setInterval(function() {
									$.ajax({
										url : "<?= base_url('admin/notifikasi/komentar') ?>",
										type : "POST",
										dataType : "JSON",
										cache : false,
										data : {},
										success : function(data)
										{
											$('#komentar').html(data.komentar);
											$('#jmlKomentar').html(data.jumlah);
											$('#lihatSemuaKomentar').html(data.lihatSemuaKomentar);
											$('#angkaKomentar').html(data.jmlKom);
											$('#angkaKomentar2').html(data.jmlKom);
											if (data.jumlah > '0') {
												$('#notifKomen').addClass('icon-animated-bell');
											}
										}
									});
								}, 3000);
							});
						</script>
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-comment" id="notifKomen"></i>
								<span class="badge badge-important" id="angkaKomentar"></span>
							</a>
							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header" id="jmlKomentar"></li>
								<li class="dropdown-content">
									<ul id="komentar" class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-footer" id="lihatSemuaKomentar"></li>
							</ul>
						</li>
						<?php if($this->session->userdata('access') == 1): ?>
							<script type="text/javascript">
								$(document).ready(function(){
									setInterval(function() {
										$.ajax({
											url 		: "<?= base_url('admin/notifikasi/pesan_web') ?>",
											type 		: "POST",
											dataType 	: "JSON",
											data 		: {},
											success : function(data){
												$('#jmlPesanWeb').html(data.jmlPesanBlmDibaca);
												$('#lihatSemuaPesan').html(data.lihatSemuaPesan);
												$('#jmlAngka').html(data.jmlAngka);
												$('#jmlAngka2').html(data.jmlAngka);
												$('#pesanWeb').html(data.pesanMasuk);
												if (data.jmlAngka > '0') {
													$('#notifPesan').addClass('icon-animated-vertical');
												}
											}
										});
									}, 3000);
								});
							</script>
							<li class="green dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<i class="ace-icon fa fa-envelope" id="notifPesan"></i>
									<span class="badge badge-success" id="jmlAngka"></span>
								</a>
								<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
									<li class="dropdown-header" id="jmlPesanWeb">
									</li>
									<li class="dropdown-content">
										<ul class="dropdown-menu dropdown-navbar" id="pesanWeb">
										</ul>
									</li>
									<li class="dropdown-footer" id="lihatSemuaPesan"></li>
								</ul>
							</li>
						<?php endif; ?>
						
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="javascript:void(0)" class="dropdown-toggle">
								<?php 
								$file = file_exists(base_url('./uploads/personil/'.$user_data['foto']));
								if (!$file && !empty($user_data['foto'])): ?>
									<img class="nav-user-photo" src="<?= base_url() ?>uploads/personil/<?= $user_data['foto'] ?>" alt="<?= $user_data['full_name']; ?>" /><?php else: ?>
									<img class="nav-user-photo" src="<?= get_gravatar($user_data['email']) ?>" alt="<?= $user_data['full_name'] ?>" />
								<?php endif ?>
								<span class="user-info">
									<small>Welcome,</small>
									<?= $user_data['username']; ?>
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?= site_url('admin/profil/pengaturan') ?>">
										<i class="ace-icon fa fa-cog"></i>
										Pengaturan
									</a>
								</li>
								<li>
									<a href="<?= site_url('admin/profil') ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?= site_url('admin/logout'); ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn-block" id="timestamp" style="font-size: 2em;"></button>
					</div>
					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="" id="timestamp"></span>
					</div>
				</div>
				<ul class="nav nav-list">
					<li class="<?= (($title == 'Dashboard') ? 'active' : ''); ?>">
						<a href="<?= site_url('admin/dashboard') ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?= (($title == 'Berita' || $title == 'Tambah Berita' ||$title == 'Edit Berita' ||$title == 'Hapus Berita' ||
								// kategori berita
					$title == 'Kategori Berita' || $title == 'Tambah Kategori Berita' ||$title == 'Edit Kategori Berita' ||$title == 'Hapus Kategori Berita' ||
							// label berita
					$title == 'Label Berita' || $title == 'Tambah Label Berita' ||$title == 'Edit Label Berita' ||$title == 'Hapus Label Berita') ? 'active open' : ''); ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-book"></i>
						<span class="menu-text">
							Berita
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="<?= (($title == 'Kategori Berita') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/berita/kategori') ?>">
								<i class="menu-icon fa fa-tag"></i>
								Kategori
							</a>
							<b class="arrow"></b>
						</li>
						<li class="<?= (($title == 'Label Berita') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/berita/label') ?>">
								<i class="menu-icon fa fa-tags"></i>
								Label
							</a>
							<b class="arrow"></b>
						</li>
						<li class="<?= (($title == 'Tambah Berita') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/berita/tambah') ?>">
								<i class="menu-icon fa fa-plus"></i>
								Tambah Berita
							</a>
							<b class="arrow"></b>
						</li>
						<li class="<?= (($title == 'Berita' ||	$title == 'Edit Berita' ||
						$title == 'Hapus Berita') ? 'active' : ''); ?>">
						<a href="<?= site_url('admin/berita') ?>">
							<i class="menu-icon fa fa-table"></i>
							Data Berita
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="<?= (($title == "Halaman" ||	$title == "Tambah Halaman" ||	$title == "Edit Halaman") ? 'active open' : ''); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-list-alt"></i>
					<span class="menu-text"> Halaman </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?= (($title == "Tambah Halaman") ? 'active' : '') ?>">
						<a href="<?= site_url('admin/halaman/tambah'); ?>">
							<i class="menu-icon fa fa-plus"></i>
							Tambah Halaman
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?= (($title == "Halaman" || $title == "Edit Halaman") ? 'active' : '') ?>">
						<a href="<?= site_url('admin/halaman'); ?>">
							<i class="menu-icon fa fa-list-alt"></i>
							Data Halaman
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>
			
			<li class="<?= (($title == 'Komentar') ? 'active' : ''); ?>">
				<a href="<?= site_url('admin/komentar') ?>">
					<i class="menu-icon fa fa-comment"></i>
					<span class="menu-text"> Komentar </span>
					<span id="angkaKomentar2" class="badge badge-pink"></span>
				</a>
				<b class="arrow"></b>
			</li>
			<?php if($this->session->userdata('access') == 1): ?>
				<li class="<?= (($title == 'Users') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/users') ?>">
						<i class="menu-icon fa fa-users"></i>
						<span class="menu-text"> Users </span>
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?= (($title == 'Pesan') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/pesan') ?>">
						<i class="menu-icon fa fa-envelope"></i>
						<span class="menu-text"> Pesan </span>
						<span class="badge badge-success" id="jmlAngka2"></span>
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?= (($title == 'Website' || $title == 'Menu' || $title == 'Menu Footer' || $title == 'Konten Kontak' || $title == 'Tambah Konten Kontak') ? 'active open' : ''); ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-wrench"></i>
						<span class="menu-text"> Pengaturan </span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="<?= (($title == 'Menu' || $title == 'Menu Footer') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/menu') ?>">
								<i class="menu-icon fa fa-list"></i>
								Menu
							</a>
							<b class="arrow"></b>
						</li>
						<li class="<?= (($title == 'Website') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/website') ?>">
								<i class="menu-icon fa fa-desktop"></i>
								Website
							</a>
							<b class="arrow"></b>
						</li>
						<li class="<?= (($title == 'Konten Kontak' || $title == 'Tambah Konten Kontak') ? 'active' : ''); ?>">
							<a href="<?= site_url('admin/kontak') ?>">
								<i class="menu-icon fa fa-phone"></i>
								Konten Kontak
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			<?php endif; ?>
		</ul>
		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

	</div>
	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="<?= site_url('admin') ?>">Home</a>
					</li>
					<?php if (isset($bc_menu)): ?>
						<li><a href="<?= site_url('admin/'.strtolower($bc_menu)) ?>"><?= $bc_menu ?></a></li>							
					<?php endif ?>
					<?php if (isset($bc_aktif)): ?>
						<li class="active"><?= $bc_aktif ?></li>							
					<?php endif ?>
				</ul>						
			</div>
			<div class="page-content">
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="ace-icon fa fa-cog bigger-130"></i>
					</div>
					<div class="ace-settings-box clearfix" id="ace-settings-box">
						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<div class="pull-left">
									<select id="skin-colorpicker" class="hide">
										<option data-skin="no-skin" value="#438EB9">#438EB9</option>
										<option data-skin="skin-1" value="#222A2D">#222A2D</option>
										<option data-skin="skin-2" value="#C6487E">#C6487E</option>
										<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
									</select>
								</div>
								<span>&nbsp; Choose Skin</span>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
								<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
								<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
								<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
								<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
								<label class="lbl" for="ace-settings-add-container">
									Inside
									<b>.container</b>
								</label>
							</div>
						</div><!-- /.pull-left -->
						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
								<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
								<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
								<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
							</div>
						</div>
					</div>
				</div>
				<?php 
				if (!empty($contents)) {
					echo $contents;
				}

				?>
				<div class="pesan-admin" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
				<div class="pesan-admin-error" data-flashdata="<?= $this->session->flashdata('pesan_error'); ?>"></div>
				<div class="toast-admin" data-flashdata="<?= $this->session->flashdata('toast'); ?>"></div>
				<div class="toast-admin-error" data-flashdata="<?= $this->session->flashdata('toast_error'); ?>"></div>
				<div class="pnotify-admin" data-flashdata="<?= $this->session->flashdata('pnotify'); ?>"></div>
				<div class="pnotify-admin-error" data-flashdata="<?= $this->session->flashdata('pnotify_error'); ?>"></div>
			</div>
		</div>

	</div>
	<div class="footer">
		<div class="footer-inner">
			<div class="footer-content">
				<span class="bigger-120">
					<span class="blue bolder">
						<?= pilih_kata($site_name, 0); ?>
					</span>&copy; 
					<?php if ($tahun_buat == date('Y')) {
						echo date('Y');
					}else{
						echo $tahun_buat.' - '.date('Y');
					}
					?>
				</span>
				&nbsp; &nbsp;
				<span class="action-buttons">
					<?php 
					$sql_query = $this->db->query("SELECT * FROM tb_sosmedweb ORDER BY nama_sosmed ASC");
					foreach($sql_query->result() as $row):
						?>
						<a href="<?= $row->link_sosmed ?>" target="_blank" title="<?= $row->nama_sosmed ?>">
							<i class="ace-icon <?= $row->ikon_sosmed ?> bigger-150"></i>
						</a>
					<?php endforeach; ?>
				</span>
			</div>
		</div>

	</div>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>

	</a>

</div>
<!--[if IE]>
	<script src="<?= base_url() ?>fileAdmin/js/jquery-1.11.3.min.js"></script>

<![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url() ?>fileAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");

</script>
<!-- page specific plugin scripts -->
<!--[if lte IE 8]>
<script src="<?= base_url() ?>fileAdmin/js/excanvas.min.js"></script>
<![endif]-->
<script src="<?= base_url() ?>fileAdmin/js/jquery-ui.custom.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/jquery.easypiechart.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/jquery.sparkline.index.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/jquery.pnotify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/sweetalert.min.js"></script>

<script src="<?= base_url() ?>fileAdmin/js/spin.js"></script>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<!-- ace scripts -->
<script src="<?= base_url() ?>fileAdmin/js/ace-elements.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/ace.min.js"></script>

<script src="<?= base_url() ?>fileAdmin/js/custom.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/notifikasi.js"></script>
<script>
	$(function() {		
		$('#spinner-opts small').css({display:'inline-block', width:'60px'})
		var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
		var counterTime=0;
		var date;
		setInterval(function() {
			date = new Date();
			serverTime = serverTime+1;
			date.setTime(serverTime*1000);
			time = date.toLocaleTimeString();
			$("#timestamp").html(time);
		}, 1000);
	});
</script>
</body>

</html>

