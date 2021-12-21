<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">

<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
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

	<form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" action="<?= $form_action; ?>">
		<div class="col-md-6 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="konten_kontak">Konten Kontak
					<?= form_error('konten_kontak') ?>
				</label>
				<div class="col-sm-9">
					<textarea name="konten_kontak" class="form-control" id="konten_kontak"><?= set_value('konten_kontak') ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="konten_peta">Konten Peta 
					<?= form_error('konten_peta') ?>
				</label>
				<div class="col-sm-9">
					<textarea name="konten_peta" class="form-control" id="konten_peta"><?= set_value('konten_peta') ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<div class="col-xs-3 no-padding-right"></div>
				<div class="col-xs-9">
					<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>

	</form>

</div>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script type="text/javascript">

	$('.dropify').dropify({
		messages: {
			default: 'Gambar akan dijadikan background halaman',
			replace: 'Ganti',
			remove:  'Hapus',
			error:   'error'
		}

	});
	$('#konten_kontak').summernote({
		lang: 'id-ID',
		height : 215,
		placeholder: 'Tulis isi konten...',
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}

	});
	$('#konten_peta').summernote({
		lang: 'id-ID',
		height : 215,
		placeholder: 'Sematkan peta...',
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}

	});
	function sendFile(file, editor, welEditable) {
		data = new FormData();
		data.append("file", file);
		$.ajax({
			data: data,
			type: "POST",
			url: "<?= site_url('admin/artikel/upload_image') ?>",
			cache: false,
			contentType: false,
			processData: false,
			success: function(url){
				editor.insertImage(welEditable, url);
			}
		});

	}

</script>