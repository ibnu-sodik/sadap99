<?php 
$row = $data->row_array();
?>
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
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" action="<?= $form_action.'/'.$row['id_berita']; ?>">
		<div class="col-md-8 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="judul">Judul</label>
				<div class="col-sm-9">
					<input type="text" id="judul" placeholder="Judul" value="<?= $row['judul_berita'] ?>" name="judul" class="form-control judul" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="judul"></label>
				<div class="col-sm-9">
					<input type="text" id="slug" value="<?= $row['slug_berita'] ?>" placeholder="Permalink" name="slug" class="form-control slug" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="konten">Konten</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="konten" id="summernote"><?= $row['konten_berita'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="image"> Gambar </label>
				<div class="col-sm-9">
					<input type="file" name="filefoto" id="image" class="dropify" data-height="190" data-default-file="<?= base_url('uploads/berita/'.$row['gambar_berita']) ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="kategori">Kategori</label>
				<div class="col-sm-9">
					<select class="form-control chosen-select" name="kategori" id="kategori" data-placeholder="Pilih Kategori...">
						<option value=""></option>
						<?php foreach ($kategori->result() as $val): ?>
							<?php if ($row['id_kategori_berita'] == $val->id_kategori): ?>
								<option value="<?= $val->id_kategori; ?>" selected><?= $val->nama_kategori; ?></option>
								<?php else: ?>
									<option value="<?= $val->id_kategori; ?>"><?= $val->nama_kategori; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
						<?= form_error('kategori'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="label">Label</label>
					<div class="col-sm-9">
						<select multiple="" name="label[]" class="chosen-select form-control" id="label" data-placeholder="Pilih Label..." data-live-search="true">
							<?php 
							$label_berita = $row['label_berita'];
							$str_label = explode(",", $label_berita);
							for($i = 0; $i < count($str_label); $i++){}
								foreach ($label->result() as $rlabel):
									$hasil = str_replace(",", " ", $row['label_berita']);
											// var_dump($hasil);die();
									?>
									<option value="<?= $rlabel->slug_label ?>" <?php if(in_array($rlabel->slug_label, $str_label)) echo "selected='selected'"; ?>><?= $rlabel->nama_label ?></option>
							 		<!-- <option <?php if(preg_match("/$val->slug_label/i", $hasil)) {echo "selected";} ?> >
							 			<?= $val->nama_label; ?></option> -->
							 		<?php endforeach; ?>
							 	</select>
							 </div>
							</div>
				<div class="form-group">
					<label class="control-label col-sm-3 no-padding-right" for="meta-deskripsi">Meta Deskripsi</label>
					<div class="col-sm-9">
						<textarea placeholder="Meta Deskripsi" name="deskripsi" for="meta-deskripsi" class="form-control" rows="10"><?= $row['deskripsi_berita'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 no-padding-right"></label>
					<div class="col-sm-9">
						<input type="hidden" name="id_berita" value="<?= $row['id_berita']; ?>">
						<button type="submit" name="submit" class="btn btn-block btn-primary">Publish <i class="fa fa-send"></i></button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
	<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
	<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
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