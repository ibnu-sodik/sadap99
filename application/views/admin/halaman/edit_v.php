<?php $row = $data->row_array(); ?>
<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap-datepicker3.min.css" />
<div class="page-header">
	<h1>
		<a href="javascript:void(0)" onclick="kembali()"><span class="label label-lg label-primary arrowed">Kembali</span></a>
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
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" action="<?= $form_action.'/'.$row['id_halaman']; ?>">
		<div class="col-md-8 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="nama_halaman">Judul Halaman</label>
				<div class="col-sm-9">
					<input type="text" id="nama_halaman" placeholder="Judul Halaman" name="nama_halaman" class="form-control judul"  value="<?= $row['nama_halaman'] ?>" />
					<?= form_error('nama_halaman'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="slug"></label>
				<div class="col-sm-9">
					<input type="text" id="slug" placeholder="Permalink" name="slug" value="<?= $row['slug_halaman'] ?>" class="form-control slug" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="konten">Konten</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="konten" id="summernote"><?= $row['konten_halaman'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right" for="meta-deskripsi">Meta Deskripsi</label>
				<div class="col-sm-9">
					<textarea placeholder="Meta Deskripsi" name="deskripsi" for="meta-deskripsi" class="form-control" rows="10"><?= $row['deskripsi_halaman'] ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right"></label>
				<div class="col-sm-9">
					<input type="hidden" name="id_halaman" value="<?= $row['id_halaman'] ?>">
					<button type="submit" name="submit" class="btn btn-block btn-primary">Publish <i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>
<script type="text/javascript">
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
</script>