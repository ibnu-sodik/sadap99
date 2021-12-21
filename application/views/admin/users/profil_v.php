<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
<div class="page-header">
	<h1>
		<?= $bc_aktif; ?>
		<?php if (isset($sm_text)): ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?= $sm_text; ?>
			</small>			
		<?php endif ?>
	</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<!-- <div class="hr dotted"></div> -->
		<div class="">
			<div id="user-profile-1" class="user-profile row">
				<div class="col-xs-12 col-sm-3 center">
					<div>
						<span class="profile-picture">
							<?php 
							$file_foto = file_exists(base_url('./uploads/users/'.$foto));
							if (!$file_foto && !empty($foto)) {
								$src = base_url('./uploads/users/'.$foto);
							}else{
								$src = base_url('fileAdmin/images/avatars/avatar.png');
							}
							?>
							<img class="edit-foto img-responsive" alt="<?= $full_name ?>" src="<?= $src ?>">
							<form id="up-foto" action="<?= site_url('admin/profil/update_foto') ?>" class="hide" method="post" enctype="multipart/form-data">	
								<input type="file" name="filefoto" class="dropify" required>
								<input type="hidden" name="id" value="<?= $id ?>">
								<button type="reset" class="reset btn btn-default" ><i class="fa fa-times"></i></button>
								<button type="submit" class="btn btn-info"><i class="fa fa-upload"></i></button>
							</form>
						</span>
						<div class="space-4"></div>
						<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
							<div class="inline position-relative">
								<i class="ace-icon fa fa-circle light-green"></i>
								&nbsp;
								<span class="white"><?= $full_name ?></span>
							</div>
						</div>
					</div>
					<?php if ($jml_berita > 0): ?>
						<div class="space-6"></div>
						<div class="hr hr12 dotted"></div>
						<div class="clearfix">
							<div class="grid1">
								<span class="bigger-175 blue"><?= $jml_berita ?></span>
								<br>
								Berita
							</div>
						</div>						
					<?php endif; ?>
					<div class="hr hr16 dotted"></div>
				</div>
				<div class="col-xs-12 col-sm-9">
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name"> Nama </div>
							<div class="profile-info-value">
								<span class="edit"><?= $full_name ?></span>
								<input type="text" name="full_name" class="form-control input-sm" value="<?= $full_name ?>" id="nama_<?= $id ?>" style="display: none;">
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Username </div>
							<div class="profile-info-value">
								<span class="edit-usemail"><?= $username ?></span>
								<input type="text" name="username" class="form-control input-smue" value="<?= $username ?>" id="username_<?= $id ?>" style="display: none;">
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Email </div>
							<div class="profile-info-value">
								<span class="edit-usemail"><?= $email ?></span>
								<input type="text" name="email" class="form-control input-smue" value="<?= $email ?>" id="email_<?= $id ?>" style="display: none;">
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Fungsi/ Jabatan </div>
							<div class="profile-info-value">
								<span class="editable editable-click" title data-placement="right" data-rel="tooltip" data-original-title="Jabatan tidak bisa diubah."><?= (($jenis_fungsi == '') ? 'Fungsi/ jabatan anda belum ditetapkan.' : $jenis_fungsi) ?></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Terakhir Online </div>
							<div class="profile-info-value">
								<span class="editable editable-click"><?= waktu_berlalu($last_login) ?></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> About Me </div>
							<div class="profile-info-value">
								<span class="edit"><?= (($users_info == '') ? 'Belum pernah mengisi.' : $users_info) ?></span>
								<textarea class="form-control input-sm" name="users_info" id="usersInfo_<?= $id ?>" style="display: none;"><?= $users_info ?></textarea>
							</div>
						</div>
					</div>
					<div class="space-20"></div>
					<div class="widget-box transparent">
						<div class="widget-header widget-header-small">
							<h4 class="widget-title blue smaller">
								<i class="ace-icon fa fa-rss orange"></i>
								Aktifitas Saya Hari Ini
							</h4>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-8">
								<div id="profile-feed-1" class="profile-feed ace-scroll" style="position: relative;">
									<div class="scroll-track scroll-active" style="display: block;"></div>
									<div class="scroll-content">
										<?php 
										foreach ($log_users->result() as $row):
																// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
																	// login
											if ($row->log_tipe == 0) {
												$btn = "btn-default";
												$icon = "fa fa-sign-in";
											}elseif ($row->log_tipe == 1) {
												$btn = "btn-inverse";
												$icon = "fa fa-sign-out";
											}elseif ($row->log_tipe == 2) {
												$btn = "btn-purple";
												$icon = "fa fa-plus";
											}elseif ($row->log_tipe == 3) {
												$btn = "btn-warning";
												$icon = "fa fa-edit";
											}elseif ($row->log_tipe == 4) {
												$btn = "btn-danger";
												$icon = "fa fa-trash";
											}elseif ($row->log_tipe == 5) {
												$btn = "btn-info";
												$icon = "fa fa-refresh";
											}
											?>
											<div class="profile-activity clearfix">
												<div>
													<button class="btn btn-app btn-xs <?= $btn ?>">							
														<i class="ace-icon <?= $icon ?> bigger-230"></i>
													</button>
													<?= $row->log_description; ?>
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														<?= waktu_berlalu($row->log_time) ?>
													</div>
												</div>
											</div>											
										<?php endforeach ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="hr hr2 hr-double"></div>
					<div class="space-6"></div>
					<div class="center">
						<a href="<?= site_url('admin/profil/aktivitas/'.$username) ?>" class="btn btn-sm btn-primary btn-white btn-round">
							<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
							<span class="bigger-110">Lihat semua aktivitas saya</span>
							<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script type="text/javascript">
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});
	$('.dropify').dropify({
		maxFileSize 			: '2M',
		minWidth 				: '600',
		minHeight 				: '200',
		errorsPosition 			: 'outside',
		allowedFormats 			: ['portrait', 'square'],
		allowedFileExtensions 	: 'jpg png jpeg',
		maxFileSizePreview 		: '2M',		
		messages: {
			default: 'Pilih foto anda, Klik atau drag disini',
			replace: 'Ganti',
			remove:  'Hapus',
			error:   'Yuhuuu, ada yang salah nih.'
		},
		error: {
			'fileSize': 'Ukuran gambar terlalu besar ({{ value }} maksimal).',
			'minWidth': 'Lebar gambar terlalu kecil ({{ value }}}px minimal).',
			'maxWidth': 'Lebar gambar terlalu besar ({{ value }}}px maksimal).',
			'minHeight': 'Tinggi gambar terlalu rendah ({{ value }}}px minimal).',
			'maxHeight': 'Tinggi gambar terlalu berlebihan ({{ value }}px maksimal).',
			'imageFormat': 'Format gambar yang diizinkan adalah ({{ value }} hanya).'
		}
	});
	$(document).ready(function() {
		$(".edit-foto").click(function() {
			$("#up-foto").removeClass('hide');
			$(this).addClass('hide');
		});
		$('.reset').click(function() {
			$("#up-foto").addClass('hide');
			$(".edit-foto").removeClass('hide');
		});
		$(".edit").click(function(){
			$(".input-sm").hide();
			$(this).next(".input-sm").show().focus();
			$(this).hide();
		});
		$(".input-sm").focusout(function(){
			var un_id 		= this.id;
			var split_id 	= un_id.split("_");
			var id 		= split_id[1];
			var field 	= this.name;
			var value 	= $(this).val();
			$(this).hide();
			$(this).prev(".edit").show();
			$(this).prev(".edit").text(value);
			$.ajax({
				url : "<?= site_url('admin/profil/update') ?>",
				type : "GET",
				dataType : "JSON",
				data : {
					'id' : id, 'field' : field, 'value' : value
				},
				success : function(data){
					var tipe = data.tipe;
					toastr.options.closeButton = true;
					toastr.options.closeMethod = 'fadeOut';
					toastr.options.closeDuration = 100;
					Command: toastr[tipe](data.pesan, data.notif);
				}
			})
		});
		$(".edit-usemail").click(function(){
			$(".input-smue").hide();
			$(this).next(".input-smue").show().focus();
			$(this).hide();
		});
		$(".input-smue").focusout(function(){
			var un_id 		= this.id;
			var split_id 	= un_id.split("_");
			var id 		= split_id[1];
			var field 	= this.name;
			var value 	= $(this).val();
			$(this).hide();
			$(this).prev(".edit-usemail").show();
			$(this).prev(".edit-usemail").text(value);
			$.ajax({
				url : "<?= site_url('admin/profil/update_usemail') ?>",
				type : "GET",
				dataType : "JSON",
				data : {
					'id' : id, 'field' : field, 'value' : value
				},
				success : function(data){
					var tipe = data.tipe;
					toastr.options.closeButton = true;
					toastr.options.closeMethod = 'fadeOut';
					toastr.options.closeDuration = 100;
					Command: toastr[tipe](data.pesan, data.notif);
				}
			})
		});
		$('#profile-feed-1').ace_scroll({
			height: '300px',
			mouseWheelLock: true,
			alwaysVisible : true
		});
	});

</script>