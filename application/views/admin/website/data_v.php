<?php 
$row = $data->row_array();
?>
<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
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
	<div class="col-xs-12 col-md-12">
		<div class="tabbable">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a data-toggle="tab" href="#basic">
						<i class="green ace-icon fa fa-file bigger-120"></i>
						Basic
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#kontak">
						<i class="red ace-icon fa fa-envelope bigger-120"></i>
						Kontak
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#api">
						<i class="red ace-icon fa fa-fire bigger-120"></i>
						Website API
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#sosmedWeb">
						<i class="purple ace-icon fa fa-link bigger-120"></i>
						Sosmed Web
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="basic" class="tab-pane fade in active">
					<div class="row">
						<form class="form-horizontal" method="POST" action="<?= $aksi_basic ?>">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_title">Judul Website</label>
									<div class="col-sm-9">
										<input type="text" id="site_title" placeholder="Judul Website" name="site_title" class="form-control"  value="<?= $row['site_title'] ?>" autofocus/>
										<?= form_error('site_title'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_name">Nama Website</label>
									<div class="col-sm-9">
										<input type="text" id="site_name" placeholder="Nama Website" name="site_name" class="form-control"  value="<?= $row['site_name'] ?>"/>
										<?= form_error('site_name'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_keywords">Keywords Website</label>
									<div class="col-sm-9">
										<input type="text" id="site_keywords" placeholder="Keywords Website" name="site_keywords" class="form-control"  value="<?= $row['site_keywords'] ?>"/>
										<?= form_error('site_keywords'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_description">Deskripsi Website</label>
									<div class="col-sm-9">
										<textarea name="site_description" placeholder="Deskripsi Website" id="site_description" class="form-control" rows="3"><?= $row['site_description'] ?></textarea>
										<?= form_error('site_description'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="tahun_buat">Tahun Pembuatan</label>
									<div class="col-sm-9">
										<input type="number" min="0" id="tahun_buat" placeholder="Tahun Pembuatan" name="tahun_buat" class="form-control"  value="<?= $row['tahun_buat'] ?>"/>
										<?= form_error('tahun_buat'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="limit_post">Batas Jumlah Postingan</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="number" id="limit_post" name="limit_post" min="0" max="10" class="form-control" value="<?= $row['limit_post'] ?>" data-rel="tooltip">
											<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Maksimal Batas Jumlah Postingan adalah 10" >?</span>
										</div>	
										<?= form_error('limit_post') ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 no-padding-right"></label>
									<div class="col-sm-9">
										<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</div>
						</form>
						<!-- logo -->
						<form class="form-horizontal" method="POST" action="<?= $aksi_logo ?>" enctype="multipart/form-data">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_logo">Logo Website</label>
									<div class="col-sm-9">
										<input type="file" id="site_logo" name="site_logo" class="dropify"  data-height="190" data-default-file="<?= base_url('assets/images/'.$row['site_logo']) ?>"/>
										<?= form_error('site_logo') ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_favicon">Ikon Website</label>
									<div class="col-sm-9">
										<input type="file" id="site_favicon" name="site_favicon" class="dropify"  data-height="190" data-default-file="<?= base_url('assets/images/'.$row['site_favicon']) ?>"/>
										<?= form_error('site_favicon') ?>
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-sm-3 no-padding-right"></label>
									<div class="col-sm-9">
										<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="kontak" class="tab-pane fade">
					<div class="row">
						<form class="form-horizontal" method="POST" action="<?= $aksi_kontak ?>">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_email">Email Website</label>
									<div class="col-sm-9">
										<input type="email" id="site_email" placeholder="Email Website" name="site_email" class="form-control"  value="<?= $row['site_email'] ?>" autofocus />
										<?= form_error('site_email'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_telp">Nomor Telepon</label>
									<div class="col-sm-9">
										<input type="number" id="site_telp" placeholder="Nomor Telepon" name="site_telp" class="form-control"  value="<?= $row['site_telp'] ?>"/>
										<?= form_error('site_telp'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_nowa">Nomor WhatsApp</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="number" id="site_nowa" placeholder="Nomor WhatsApp" name="site_nowa" class="form-control"  value="<?= $row['site_nowa'] ?>"  data-rel="tooltip"/>
											<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-title="Gunakan awalan kode negara" data-content="Contoh : 62813xxxx" >?</span>			
										</div>
										<?= form_error('site_nowa'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="site_pesanTeks">Teks Pesan</label>
									<div class="col-sm-9">
										<div class="input-group">
											<textarea id="site_pesanTeks" name="site_pesanTeks" placeholder="Teks Pesan" class="form-control"  data-rel="tooltip"><?= $row['site_pesanTeks'] ?></textarea>
											<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Teks ini akan digunakan untuk pesan pada WhatsApp" >?</span>			
										</div>
										<?= form_error('site_pesanTeks'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 no-padding-right"></label>
									<div class="col-sm-9">
										<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="api" class="tab-pane fade">
					<div class="row">
						<form class="form-horizontal" method="POST" action="<?= $aksi_api ?>">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="api_tinify">API Tinify</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" id="api_tinify" placeholder="API Tinify" name="api_tinify" class="form-control"  value="<?= $row['api_tinify'] ?>" data-rel="tooltip" />
											<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="API Tinify digunakan untuk kompresi gambar saat upload gambar" >?</span>			
										</div>
										<?= form_error('api_tinify'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 no-padding-right"></label>
									<div class="col-sm-9">
										<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="sosmedWeb" class="tab-pane fade">
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
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url('admin/website/update_sosmed')?>">
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
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>
<script type="text/javascript">
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});
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