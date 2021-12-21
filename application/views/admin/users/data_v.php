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
	<div class="col-md-4">
		<form class="form-horizontal" role="form" method="POST" id="form-tambah-users" action="<?= site_url('admin/users/save') ?>">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="full_name"> Nama Lengkap </label>
				<div class="col-sm-9">
					<input type="text" id="full_name" name="full_name" placeholder="Nama Lengkap" class="form-control"  value="<?= set_value('full_name') ?>"/>
					<?php echo form_error('full_name') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="username"> Username </label>
				<div class="col-sm-9">
					<input type="text" id="username" name="username" placeholder="Username" class="form-control"  value="<?= set_value('username') ?>"/>
					<?php echo form_error('username') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="email"> Email </label>
				<div class="col-sm-9">
					<input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?= set_value('email') ?>" />
					<?php echo form_error('email') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="password"> Password </label>
				<div class="col-sm-9">
					<input type="password" id="password" name="password" placeholder="Password" class="form-control"  value="<?= set_value('password') ?>"/>
					<?php echo form_error('password') ?>
				</div>
			</div>


			<div class="clearfix form-actions">
				<div class="col-md-12">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						Submit
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-8">
		<div>
			<ul class="ace-thumbnails clearfix">
				<?php 
				foreach ($data_users->result() as $row):
					$file = file_exists(base_url('./uploads/users/'.$row->foto));
					if (!$file && empty($row->foto)) {
						$src = base_url('fileAdmin/images/avatars/avatar.png');
										// $src = base_url('fileAdmin/images/no-img.png');
					}else{
						$src = base_url('./uploads/users/'.$row->foto);
					}
					?>
					<li>
						<a href="<?= $src ?>" data-rel="colorbox">
							<img width="150" height="150" alt="150x150" src="<?= $src ?>" />
							<div class="text">
								<div class="inner"><?= $row->full_name ?></div>
							</div>
						</a>
						<div class="tags">
							<?php if (!empty($row->jenis_fungsi)): ?>
								<span class="label-holder">
									<span class="label label-info"><?= $row->jenis_fungsi ?></span>
								</span>								
							<?php endif ?>
						</div>
						<div class="tools tools-top">
							<?php if($row->status == '1'): ?>
								<a class="tombol-inaktivasi" title="InAktivasi" href="<?= site_url('admin/users/lock/'.$row->id) ?>"> <i class="ace-icon fa fa-unlock red"></i></a><?php else: ?>
								<a class="tombol-aktivasi" title="Aktivasi" href="<?= site_url('admin/users/unlock/'.$row->id) ?>"> <i class="ace-icon fa fa-lock green"></i></a>
							<?php endif; ?>
							<a href="<?= site_url('admin/users/edit/'.$row->id) ?>">
								<i class="ace-icon fa fa-edit"></i>
							</a>
							<a href="<?= site_url('admin/profil/aktivitas/'.$row->username) ?>">
								<i class="ace-icon fa fa-rss"></i>
							</a>
							<a href="<?= site_url('admin/users/hapus/'.$row->id) ?>" class="tombol-hapus2">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>					
				<?php endforeach ?>


			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
		// konfirmasi aktif akun
		$('.tombol-hapus2').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href');
			swal({
				title: "Apakah Anda Yakin?",
				text: "Seluruh data meliputi aktivitas, profil, artikel, label serta kategori akan dihapus.?",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then((willDelete) => {
				if (willDelete) {
					document.location.href = href;
				}else{
					swal('Aman', 'Data tidak dihapus', 'info');
				}
			});
		});


		$('.tombol-aktivasi').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href');
			swal({
				title: "Apakah Anda Yakin?",
				text: "Ingin mengaktifkan akun ini.?",
				icon: "info",
				buttons: true,
				dangerMode: false
			}).then((willDelete) => {
				if (willDelete) {
					document.location.href = href;
				}
			});
		});


	// konfirmasi inaktif akun
	$('.tombol-inaktivasi').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		swal({
			title: "Apakah Anda Yakin?",
			text: "Ingin membekukan akun ini.?",
			icon: "warning",
			buttons: true,
			dangerMode: false
		}).then((willDelete) => {
			if (willDelete) {
				document.location.href = href;
			}
		});
	});
</script>

