<?php 
$data = $data_pk->row();
if ($data_pm->num_rows() > 0) {
	$data2 = $data_pm->row();
	$nama 			= $data2->nama_depan.' '.$data2->nama_belakang;
	$alamat_email 	= 'mailto:'.$data2->alamat_email;
}else{
	$text = "Data dengan penerima tersebut sudah tidak ada.";
	$this->session->set_flashdata('pesan_error', $text);
	redirect('admin/pesan/keluar');
}
?>

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
	<div class="message-container">
		<div class="message-navbar">
			<div class="message-bar">
				<div class="message-toolbar">
					<a href="<?= site_url('admin/pesan/hapus_keluar/'.$data->id_pesan) ?>" class="tombol-hapus btn btn-xs btn-white btn-primary">
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
			</div>
		</div>
		<div class="message-list-container">
			<div class="message-content" id="id-message-content">
				<div class="message-header clearfix">
					<div class="pull-left">
						<span class="blue bigger-125"> <?= $data2->subjek_pesan ?> </span>
						<div class="space-4"></div>
						<?php if ($data2->bintang == 1): ?>
							<i class="ace-icon fa fa-star orange2"></i>
						<?php endif ?>
						&nbsp;
						<img class="middle" alt="<?= $nama ?>" src="<?= get_gravatar($data2->alamat_email) ?>?s=50&r=pg" width="32">
						&nbsp;
						<a href="<?= $alamat_email ?>" class="sender"><?= $nama; ?></a>
						&nbsp;
						<i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
						<span class="time grey">
							<?= tanggal_indo($data2->dikirim_pada) ?>
							<?= date('H:i', strtotime($data2->dikirim_pada)); ?>							
						</span>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 5px;"></div>
				<div class="message-body" style="overflow-y: auto;overflow-x: hidden; max-height: 300px;">
					<div class="">
						<p><?= $data2->isi_pesan; ?></p>
					</div>
				</div>
				<div class="hr hr-double"></div>
				<?php if ($data_pk->num_rows() > 0): ?>
					<?php foreach ($data_pk->result() as $row2): ?>

						<div class="message-header clearfix">
							<div class="pull-right">
								<span class="blue bigger-125"> <?= $row2->subjek_pesan ?> </span>
								<div class="space-4"></div>
								&nbsp;
								<img class="middle" alt="<?= $site_name ?>" src="<?= base_url('assets/images/'.$site_logo) ?>" width="32">
								&nbsp;
								<a href="javascript:void(0)" class="sender">Admin <?= $site_name ?></a>
								&nbsp;
								<i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
								<span class="time grey">
									<?= tanggal_indo($row2->dikirim_pada) ?>
									<?= date('H:i', strtotime($row2->dikirim_pada)); ?>
								</span>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 5px;"></div>
						
						<div class="message-body text-right" style="overflow-y: auto;overflow-x: hidden; max-height: 300px;">
							<div class="">
								<p><?= $row2->isi_pesan; ?></p>
							</div>
						</div>
						<div class="hr hr-double"></div>
						<?php 
						if ($row2->attachment != ''):
							$file = base_url('uploads/attachment/'.$row2->attachment);
							?>
							<div class="message-attachment clearfix">
								<div class="pull-right">
									<div class="attachment-title">
										<span class="blue bolder bigger-110">Attachments</span>
									</div>
									&nbsp;
									<ul class="attachment-list pull-left list-unstyled">
										<li>
											<a href="javascript:void(0)" class="attached-file">
												<i class="ace-icon fa fa-file-o bigger-110"></i>
												<span class="attached-name"><?= $row2->attachment; ?></span>
											</a>
											<span class="action-buttons">
												<a href="javascript:void()" data-id="<?= $row2->id_pesan ?>" class="tombol-download" title="Download">
													<i class="ace-icon fa fa-download bigger-125 blue"></i>
												</a>
											</span>
										</li>
									</ul>
								</div>
							</div>							
						<?php endif; ?>
					<?php endforeach; ?>			
				<?php endif; ?>
			</div>
		</div>

	</div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.tombol-download').click(function(){
			var id = $(this).data('id');
			window.location = "<?= site_url('admin/pesan/download_attachment/') ?>"+id;
		});
	});

</script>