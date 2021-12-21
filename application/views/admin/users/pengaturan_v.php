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
<div id="user-profile-2" class="user-profile">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-18">
			<li class="active">
				<a data-toggle="tab" href="#sosmedUser" aria-expanded="true">
					<i class="green ace-icon fa fa-link bigger-120"></i>
					Sosmedku
				</a>
			</li>


			<li class="">
				<a data-toggle="tab" href="#updatePass" aria-expanded="false">
					<i class="purple ace-icon fa fa-key bigger-120"></i>
					Ubah Password
				</a>
			</li>


		</ul>


		<div class="tab-content no-border padding-24">
			<div id="sosmedUser" class="tab-pane active">
				<div class="row">
					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-1">
						<form class="form-horizontal" method="POST" action="<?= $aksi_sosmed ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="nama_sosmed">Nama</label>


								<div class="col-sm-9">
									<input type="text" id="nama_sosmed" placeholder="Nama Sosmed" name="nama_sosmed" class="form-control" />
									<?= form_error('nama_sosmed'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="link_sosmed">Link</label>


								<div class="col-sm-9">
									<input type="text" id="link_sosmed" placeholder="Link Sosmed" name="link_sosmed" class="form-control" />
									<?= form_error('link_sosmed'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="ikon_sosmed">Ikon</label>


								<div class="col-sm-9">
									<div class="input-group">
										<input type="text" id="ikon_sosmed" placeholder="Ikon Sosmed" name="ikon_sosmed" class="form-control" />
										<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Cara penulisan : fa fa-facebook">?</span>
									</div>
									<?= form_error('ikon_sosmed'); ?>
								</div>
							</div>


							<div class="form-group">
								<label class="control-label col-sm-3 no-padding-right"></label>
								<div class="col-sm-9">
									<input type="hidden" name="id_users" value="<?= $id_users ?>">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
								</div>
							</div>
						</form>
					</div>


					<?php foreach($data_sosmed->result() as $row): ?>
						<div class="col-xs-12 col-sm-3 col-md-3  widget-container-col" id="widget-container-col-1">
							<div class="widget-box" id="widget-box-1">
								<div class="widget-header">
									<h5 class="widget-title"><?= $row->nama_sosmed ?></h5>


									<div class="widget-toolbar">


										<a href="javascript:void(0)" class="orange edit-sosmed" title="Edit" data-id="<?= $row->id_sosmed ?>" data-nama="<?= $row->nama_sosmed ?>" data-link="<?= $row->link_sosmed ?>" data-ikon="<?= $row->ikon_sosmed ?>" >
											<i class="ace-icon fa fa-edit"></i>
										</a>


										<a href="#" data-action="collapse" title="Collapse">
											<i class="ace-icon fa fa-chevron-up"></i>
										</a>


										<a href="#" class="tombol-hapus" title="Hapus">
											<i class="red ace-icon fa fa-times"></i>
										</a>
									</div>
								</div>


								<div class="widget-body">
									<div class="widget-main">
										<div class="table-responnsive">
											<table class="table table-hover" width="100%">
												<tr>
													<th>Link</th>
													<td>:</td>
													<td>
														<a class="text-default" href="<?= $row->link_sosmed ?>" target="_blank"><?= $row->link_sosmed ?></a>
													</td>
												</tr>
												<tr>
													<th>Ikon</th>
													<td>:</td>
													<td><i class="<?= $row->ikon_sosmed ?>"></i></td>
												</tr>
											</table>								
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>


				</div>
			</div>


			<div id="updatePass" class="tab-pane">
				<div class="row">
					<div class="col-sm-6">
						<form action="<?= $aksi_upPass ?>" method="POST" class="form-horizontal">							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="pass_baru">Password Baru</label>


								<div class="col-sm-9">
									<div class="input-group">							
										<input type="password" id="pass_baru" placeholder="Password Baru" name="pass_baru" class="form-control" value="<?= set_value('pass_baru') ?>" />
										<span class="input-group-addon t_passBaru">
											<i class="fa fa-eye" id="icon"></i>
										</span>
									</div>
									<?= form_error('pass_baru'); ?>
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="pass_conf">Konfirmasi Password</label>


								<div class="col-sm-9">
									<div class="input-group">
										<input type="password" id="pass_conf" placeholder="Konfirmasi Password" name="pass_conf" class="form-control" value="<?= set_value('pass_conf') ?>" />
										<span class="input-group-addon t_passConf">
											<i class="fa fa-eye" id="icon2"></i>
										</span>										
									</div>
									<?= form_error('pass_conf'); ?>
								</div>
							</div>


							<div class="form-group">
								<label class="control-label col-sm-3 no-padding-right"></label>
								<div class="col-sm-9">
									<input type="hidden" name="id_users" value="<?= $id_users ?>">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


		</div>
	</div>

</div>
<!-- modal edit -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Sosmed</h4>
			</div>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url('admin/profil/update_sosmed')?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_sosmed2" class="col-sm-3 control-label no-padding-right">Nama Sosmed</label>
						<div class="col-sm-9">
							<input type="text" name="nama_sosmed2" id="nama_sosmed2" placeholder="Nama Sosmed" class="form-control" autofocus>
							<?= form_error('nama_sosmed2') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="link_sosmed2" class="col-sm-3 control-label no-padding-right">Link Sosmed</label>
						<div class="col-sm-9">
							<input type="text" name="link_sosmed2" id="link_sosmed2" placeholder="Link Sosmed" class="form-control">
							<?= form_error('link_sosmed2') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="ikon_sosmed2" class="col-sm-3 control-label no-padding-right">Ikon Sosmed</label>
						<div class="col-sm-9">
							<div class="input-group">							
								<input type="text" name="ikon_sosmed2" id="ikon_sosmed2" placeholder="Ikon Sosmed" class="form-control">
								<span class="input-group-addon">
									<i class="" id="ikon"></i>
								</span>
							</div>
							<?= form_error('ikon_sosmed2') ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_sosmed">
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});


	$(document).on('click', '.t_passConf', function() {
		$('#icon2').toggleClass("fa-eye fa-eye-slash");
		var input = $("#pass_conf");
		input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
	});


	$(document).on('click', '.t_passBaru', function() {
		$('#icon').toggleClass("fa-eye fa-eye-slash");
		var input = $("#pass_baru");
		input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
	});


	jQuery(function($) {
		$('.edit-sosmed').on('click', function() {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var link = $(this).data('link');
			var ikon = $(this).data('ikon');


			$('[name="id_sosmed"]').val(id);
			$('[name="nama_sosmed2"]').val(nama);
			$('[name="link_sosmed2"]').val(link);
			$('[name="ikon_sosmed2"]').val(ikon);
			$('#ikon').addClass(ikon);


			$('#editModal').modal('show');
		})
	})
</script>