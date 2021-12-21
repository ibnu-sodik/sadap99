<?php 
$data = $data_pesan->row();

$nama = $data->nama_depan.' '.$data->nama_belakang;

$alamat_email = 'mailto:'.$data->alamat_email;
?>

<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">

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

	<div class="col-md-6 col-xs-12">
		<div class="message-container">
			<div class="message-navbar clearfix">
				<div class="message-bar">
					<div class="message-toolbar">
						<a href="<?= site_url('admin/pesan/hapus/'.$data->id_pesan) ?>" class="tombol-hapus btn btn-xs btn-white btn-primary">
							<i class="ace-icon fa fa-trash bigger-125 orange"></i>
							<span class="bigger-110">Hapus</span>
						</a>
					</div>
				</div>
				<div>
					<div class="messagebar-item-left">
						<a href="javascript:void(0)" onclick="kembali()" class="btn-back-message-list">
							<i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
							<b class="bigger-110 middle">Kembali</b>
						</a>
					</div>
					<div class="messagebar-item-right">
						<i class="ace-icon fa fa-clock-o bigger-110 orange"></i>
						<span class="grey"><?= tanggal_indo($data->dikirim_pada) ?></span>
					</div>
				</div>
			</div>
			<div class="message-list-container">
				<div class="message-content" id="id-message-content">
					<div class="message-header clearfix">
						<div class="pull-left">
							<span class="blue bigger-125"> <?= $data->subjek_pesan ?> </span>
							<div class="space-4"></div>
							<?php if ($data->bintang == 1): ?>
								<i class="ace-icon fa fa-star orange2"></i>
							<?php endif ?>
							&nbsp;
							<img class="middle" alt="<?= $nama ?>" src="<?= get_gravatar($data->alamat_email) ?>?s=50&r=pg" width="32">
							&nbsp;
							<a href="<?= $alamat_email ?>" class="sender"><?= $nama; ?></a>
							&nbsp;
							<i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
							<span class="time grey"><?= date('H:i', strtotime($data->dikirim_pada)); ?></span>
						</div>
					</div>
					<div class="hr hr-double"></div>
					<div class="message-body" style="overflow-y: auto;overflow-x: hidden; max-height: 300px;">
						<div class="">
							<p><?= $data->isi_pesan; ?></p>
						</div>
					</div>
					<div class="hr hr-double"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-6 col-xs-12">
		<div class="message-container">
			<div id="id-message-new-navbar" class="message-navbar clearfix">
				<div class="message-bar">
					<div class="message-toolbar">
						<span class="bigger-110">Kirim balasan pesan ke <b><?= $nama ?></b></span>
					</div>
				</div>
			</div>
			<form action="<?= $form_action ?>" class="form-horizontal message-form col-xs-12" enctype="multipart/form-data" method="POST">
				<div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="email_penerima">Email</label>
						<div class="col-sm-9">
							<div class="input-icon block col-xs-12 no-padding">
								<input type="hidden" name="nama_penerima" value="<?= $nama ?>">
								<input type="email" name="email_penerima" id="email_penerima" placeholder="Email" value="<?= $data->alamat_email ?>" readonly class="form-control">		
								<i class="ace-icon fa fa-user"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="subjek_pesan">Subjek</label>
						<div class="col-sm-9">
							<div class="input-icon block col-xs-12 no-padding">
								<input maxlength="100" type="text" class="col-xs-12" name="subjek_pesan" id="subjek_pesan" placeholder="Subjek" value="Balasan dari pesan : <?= $data->subjek_pesan ?>" readonly>
								<i class="ace-icon fa fa-comment-o"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">
							<span class="inline space-24 hidden-480"></span>
							Pesan
						</label>
						<div class="col-sm-9">
							<textarea id="isi_pesan" name="isi_pesan" class="form-control" placeholder="Tulis disini"><?= set_value('isi_pesan') ?></textarea>
							<?= form_error('isi_pesan'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="attachment">Attachment </label>
						<div class="col-sm-9">
							<input type="file" name="attachment" id="attachment">
							<span class="help-block">Maksimal ukuran file : 2Mb</span>
							<span class="help-block">Extensi yang diizinkan : gif|jpg|png|jpeg|bmp|zip|rar|pdf|docx|xlsx</span>
						</div>
					</div>
					<div class="hr hr-18 dotted"></div>
					<div class="align-right">
						<button type="submit" class="btn btn-sm btn-primary">
							<i class="ace-icon fa fa-send bigger-140"></i>
							Kirim
						</button>
					</div>
					<div class="space"></div>
				</div>
			</form>
		</div>

	</div>
</div>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>

<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>

<script type="text/javascript">

	$('#isi_pesan').summernote({
		lang: 'id-ID',
		height : 230,
		placeholder: 'Tulis pesan disini...',
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}

	});
	jQuery(function($) {
		$('#attachment').ace_file_input({
			no_file:'Tidak ada file dipilih ...',
			btn_choose:'Pilih',
			btn_change:'Ubah',
			droppable:true,
			onchange:null
		});

	});

</script>