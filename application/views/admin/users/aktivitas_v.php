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
	<div class="col-md-12 col-xs-12">
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-responsive">
			<table id="tabelKu" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Aktivitas</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Jam</th>
						<th class="text-center">Browser</th>
						<th class="text-center">Platform</th>
						<th class="text-center">IP Address</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					foreach ($log_users->result() as $row):
							// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
																	// login
						if ($row->log_tipe == 0) {
							$btn = "btn-default";
							$icon = "fa fa-sign-in";
						}elseif ($row->log_tipe == 1) {
							$btn = "btn-inverse";
							$icon = "fa fa-sign-out";
						}elseif ($row->log_tipe == 2) {
							$btn = "btn-purple";
							$icon = "fa fa-plus";
						}elseif ($row->log_tipe == 3) {
							$btn = "btn-warning";
							$icon = "fa fa-edit";
						}elseif ($row->log_tipe == 4) {
							$btn = "btn-danger";
							$icon = "fa fa-trash";
						}elseif ($row->log_tipe == 5) {
							$btn = "btn-info";
							$icon = "fa fa-refresh";
						}
						?>
						<tr>
							<td>
								<button class="btn btn-xs <?= $btn ?>">
									<i class="ace-icon <?= $icon ?> bigger-230"></i>
								</button>

								<?= $row->log_description; ?> &nbsp;
								<span class="time">
									<i class="ace-icon fa fa-clock-o bigger-110"></i>
									<?= waktu_berlalu($row->log_time) ?>
								</span>
							</td>
							<td class="text-center"><?= tanggal_indo($row->log_time); ?></td>
							<td class="text-center"><?= hanya_jam($row->log_time); ?></td>
							<td class="text-center"><?= $row->log_browser; ?></td>
							<td class="text-center"><?= $row->log_platform; ?></td>
							<td class="text-center"><?= $row->log_ip; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- inline scripts related to this page -->

<script type="text/javascript">
	jQuery(function($) {


 		// kategori script
 		$('.edit-kategori').on('click', function() {
 			var id = $(this).data('id');
 			var name = $(this).data('kategori');
 			$('[name="id_kategori"]').val(id);
 			$('[name="kategori2"]').val(name);
 			$('#editModal').modal('show');
 		});


		//initiate dataTables plugin
		$('#tabelKu').DataTable();

	})

</script>