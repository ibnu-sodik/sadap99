<?php 
$data = $data->row_array();
?>
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/select2.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/chosen.min.css" />
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
	<div class="col-xs-12 col-md-8">
		<div class="tabbable">
			<ul id="mytab" class="nav nav-tabs">
				<li>
					<a href="<?= site_url('admin/menu') ?>">
						<i class="green ace-icon fa fa-list bigger-120"></i>
						Header Menu
					</a>
				</li>
				<li class="active">
					<a href="<?= site_url('admin/menu/second') ?>" >
						<i class="purple ace-icon fa fa-list-alt bigger-120"></i>
						Footer Menu
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<form class="form-horizontal" role="form" action="<?= $form_aksi.'/'.$data['id_menu']; ?>" method="POST">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="judul"> Judul Menu </label>
									<div class="col-sm-9">
										<input type="text" id="judul" name="judul" placeholder="Judul Menu" class="form-control"  value="<?= $data['judul'] ?>"/>
										<?php echo form_error('judul') ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="induk"> Induk Menu </label>
									<div class="col-sm-9">										
										<select class="form-control chosen-select" name="induk" id="induk" data-placeholder="Pilih Induk...">
											<option value="0">Tidak Berinduk</option>
											<?php 
											foreach ($pil_induk->result() as $row):
												if ($data['parent_id'] == $row->id_menu) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->id_menu; ?>" <?= $cek ?>><?= $row->judul; ?></option>
											<?php endforeach; ?>
										</select>
										<?php echo form_error('induk') ?>
									</div>
								</div>
								<div class="form-group" id="jenis_link">									
									<label class="col-sm-3 control-label no-padding-right" for="jenis_link"> Jenis Link </label>
									<div class="col-sm-9">
										<select name="jenis_link" class="form-control chosen-select">
											<?php 
											$variabel = array(
												'halaman' 	=> 'Halaman',
												'berita' 	=> 'Berita',
												'kategori' 	=> 'Kategori',
												'url'	 	=> 'URL',
											);
											foreach ($variabel as $key => $value):
												if ($data['jenis_link'] == $key) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $key ?>" <?= $cek ?>><?= $value ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" id="link_halaman">									
									<label class="col-sm-3 control-label no-padding-right" for="link_halaman"> Link Halaman </label>
									<div class="col-sm-9">
										<select name="link_halaman" class="form-control select2">
											<option value="">Pilih Halaman</option>
											<?php 
											$rhal = str_replace($url_halaman, "", $data['link']);
											foreach ($pil_halaman->result() as $row):
												if ($rhal == $row->slug_halaman) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->slug_halaman; ?>" <?= $cek ?>><?= $row->nama_halaman; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" id="link_kategori">									
									<label class="col-sm-3 control-label no-padding-right" for="link_kategori"> Link Kategori </label>
									<div class="col-sm-9 col-xs-12">
										<select name="link_kategori" class="form-control select2">
											<option value="">Pilih Kategori</option>
											<?php 
											$rkat = str_replace($url_kategori, "", $data['link']);
											foreach ($pil_kategori->result() as $row):
												if ($rkat == $row->slug_kategori) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->slug_kategori; ?>" <?= $cek ?>><?= $row->nama_kategori; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" id="link_berita">									
									<label class="col-sm-3 control-label no-padding-right" for="link_berita"> Link Berita </label>
									<div class="col-sm-9 col-xs-12">
										<select name="link_berita" class="form-control select2">
											<option value="">Pilih Berita</option>
											<?php 
											$rber = str_replace($url_berita, "", $data['link']);
											foreach ($pil_berita->result() as $row):
												if ($rber == $row->slug_berita) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->slug_berita; ?>" <?= $cek ?>><?= $row->judul_berita; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" id="link_url">									
									<label class="col-sm-3 control-label no-padding-right" for="link_url"> Link URL </label>
									<div class="col-sm-9">
										<select name="link_url1" class="form-control">
											<?php 
											$rbia = str_replace($url_biasa, "", $data['link']);
											$pil_ring = array(
												'' 			=> '',
												base_url() 	=> base_url()
											);
											foreach($pil_ring as $key => $value):
												if ($rbia != $value && !isset($rbia)) {
													$cek = 'selected';
													$link_h = $rbia;
												}else{
													$cek = '';
													$link_h = $data['link'];
												}
												?>
												<option value="<?= $key ?>" <?= $cek ?>><?= $value ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<label class="col-sm-3 control-label no-padding-right" for="link_url"></label>
									<div class="col-sm-9">
										<input type="text" name="link_url2" class="form-control" placeholder="https://nama-link.domain" value="<?= $link_h ?>">
									</div>
								</div>
								<div class="form-group">									
									<label class="col-sm-3 control-label no-padding-right" for="urut"> Urutan </label>
									<div class="col-sm-9">
										<select name="urut" class="form-control chosen-select">
											<option value="">--- Urutan ---</option>
											<?php 
											for ($i=1; $i <= 20 ; $i++):
												if ($data['urut'] == $i) {
													$cek = 'selected';
												} else {
													$cek = '';
												}
												?>
												<option value="<?= $i; ?>" <?= $cek ?>><?= $i; ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<?= form_error('urut'); ?>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"></label>
									<div class="col-sm-9">
										<label class="inline">
											<?php 
											if ($data['target'] == "_blank") {
												$check = "checked";
											}else{
												$check = "";
											}
											?>
											<input name="target" value="_blank" type="checkbox" class="ace" <?= $check ?> >
											<span class="lbl"> Buka pada tab baru</span>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"></label>
									<div class="col-sm-9">
										<input type="hidden" readonly name="kategori_menu" value="<?= $data['kategori_menu']; ?>">
										<button type="submit" name="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

</div>

<script src="<?= base_url() ?>fileAdmin/js/chosen.jquery.min.js"></script>

<script src="<?= base_url() ?>fileAdmin/js/select2.min.js"></script>
<script type="text/javascript">
	function tampil_form(selektor){
		if ($(selektor).val()=='halaman') {
			$('#link_halaman').show();
			$('#link_kategori, #link_url, #link_berita').hide();
		}else if ($(selektor).val()=='kategori') {
			$('#link_kategori').show();
			$('#link_halaman, #link_url, #link_berita').hide();
		}else if ($(selektor).val()=='url') {
			$('#link_url').show();
			$('#link_kategori, #link_halaman, #link_berita').hide();
		}else if ($(selektor).val()=='berita'){
			$('#link_berita').show();
			$('#link_kategori, #link_url, #link_halaman').hide();
		}
	}
	tampil_form('#jenis_link select');
	$('#jenis_link select').change(function(){
		tampil_form(this);
	});
	$(".select2").select2({

    	width: '100%', // need to override the changed default

    	theme: "classic"

    });
	jQuery(function($) {
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			$('.chosen-select2').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
			$(window).off('resize.chosen').on('resize.chosen', function() {
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
		}
	});
</script>