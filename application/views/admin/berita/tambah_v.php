<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/chosen.min.css" />
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
		<div class="col-md-8 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="judul">Judul</label>
				<div class="col-sm-9">
					<input type="text" id="judul" placeholder="Judul" name="judul" class="form-control judul"  value="<?= set_value('judul') ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="judul"></label>
				<div class="col-sm-9">
					<input type="text" id="slug" placeholder="Permalink" name="slug" class="form-control slug" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="konten">Konten</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="konten" id="summernote"><?= set_value('konten') ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="image"> Gambar </label>
				<div class="col-sm-9">
					<input type="file" name="filefoto" id="image" class="dropify" data-height="190" required />
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="kategori">Kategori</label>
				<div class="col-sm-9">
					<select class="form-control chosen-select" name="kategori" id="kategori" data-placeholder="Pilih Kategori...">
						<option value=""></option>
						<?php foreach ($kategori->result() as $row): ?>
							<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
						<?php endforeach ?>
					</select>
					<?= form_error('kategori'); ?>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="label">Label</label>
				<div class="col-sm-9">
					<select multiple="" name="label[]" class="chosen-select form-control" id="label" data-placeholder="Pilih Label...">
						<?php foreach ($label->result() as $row): ?>
							<option value="<?= $row->slug_label; ?>"><?= $row->nama_label; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right" for="meta-deskripsi">Meta Deskripsi</label>
				<div class="col-sm-9">
					<textarea placeholder="Meta Deskripsi" name="deskripsi" for="meta-deskripsi" class="form-control" rows="10"><?= set_value('deskripsi') ?></textarea>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right"></label>
				<div class="col-sm-9">
					<button type="submit" name="submit" class="btn btn-block btn-primary">Publish <i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>

	</form>

</div>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/chosen.jquery.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
								//resize the chosen on window resize
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							var $this = $(this);
							$this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
										//resize chosen on sidebar collapse/expand
										$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
											if(event_name != 'sidebar_collapsed') return;
											$('.chosen-select').each(function() {
												var $this = $(this);
												$this.next().css({'width': $this.parent().width()});
											})
										});
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#label').addClass('tag-input-style');
						else $('#label').removeClass('tag-input-style');
					});
				}
			});
		</script>