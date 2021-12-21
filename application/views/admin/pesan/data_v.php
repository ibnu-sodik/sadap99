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
	<div class="tabbable">
		<ul class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
			<li class="active">
				<a href="<?= site_url('admin/pesan') ?>" aria-expanded="true">
					<i class="blue ace-icon fa fa-inbox bigger-130"></i>
					<span class="bigger-110">Pesan Masuk</span>
				</a>
			</li>
			<li class="">
				<a href="<?= site_url('admin/pesan/keluar') ?>" aria-expanded="true">
					<i class="orange ace-icon fa fa-external-link bigger-130"></i>
					<span class="bigger-110">Pesan Keluar</span>
				</a>
			</li>

		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active">
				<div class="table-responsive konten-pesan" id="id-message-list-navbar">

					<table class="table table-hover table-bordered" id="tabelku">
						<thead>
							<tr>
								<th class="text-center">
									<label class="inline middle">
										<input type="checkbox" id="id-toggle-all" class="ace" />
										<span class="lbl"></span>
									</label>
								</th>
								<th class="text-center">Pengirim</th>
								<th class="text-center">Subjek</th>
							</tr>
						</thead>
						<tbody class="message-list">
							<?php 
							foreach($data_pesan->result() as $row):
								$pengirim = $row->nama_depan.' '.$row->nama_belakang;
								if ($row->dibaca == 0 ) {
									$font = "font-weight: bold; color: #1C55CA;";
								}else{
									$font = "";
								}
								?>
								<tr style="cursor: pointer; <?= $font ?>" class="pesan-item" id="<?= $row->id_pesan; ?>">
									<td class="text-center">
										<label class="inline">
											<input type="checkbox" class="ace" name="id_pesan[]" value="<?= $row->id_pesan ?>" />
											<span class="lbl"></span>
										</label>
									</td>
									<td data-id="<?= $row->id_pesan; ?>" class="text-left"><?= $pengirim ?></td>
									<td data-id="<?= $row->id_pesan; ?>" class="text-left"><?= $row->subjek_pesan ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<div class="message-navbar hide clearfix">
						<div class="message-bar">
							<div class="message-toolbar hide">
								<button type="button" class="btn btn-white btn-primary" id="hapusChk">
									<i class="ace-icon fa fa-trash-o bigger-125 orange"></i>
									<span class="bigger-110">Hapus</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">


	jQuery(function($){


	//basic initializations
	$('.message-list .pesan-item input[type=checkbox]').removeAttr('checked');
	$('.message-list').on('click', '.pesan-item input[type=checkbox]' , function() {
		$(this).closest('.pesan-item').toggleClass('selected');
		//display action toolbar when a message is selected
		if(this.checked) Inbox.display_bar(1);
		else {
			Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
			//determine number of selected messages and display/hide action toolbar accordingly
		}		
	});


	$('#id-toggle-all').removeAttr('checked').on('click', function() {
		if (this.checked) {
			Inbox.select_all();
		}else{
			Inbox.select_none();
		}
	});


	var Inbox = {
		//displays a toolbar according to the number of selected messages
		display_bar : function (count) {
			if(count == 0) {
				$('#id-toggle-all').removeAttr('checked');
				$('#id-message-list-navbar .message-toolbar').addClass('hide');
				$('#id-message-list-navbar .message-navbar').addClass('hide');
			}
			else {
				$('#id-message-list-navbar .message-navbar').removeClass('hide');
				$('#id-message-list-navbar .message-toolbar').removeClass('hide');
			}
		}
		,
		select_all : function() {
			var count = 0;
			$('.pesan-item input[type=checkbox]').each(function(){
				this.checked = true;
				$(this).closest('.pesan-item').addClass('selected');
				count++;
			});
			$('#id-toggle-all').get(0).checked = true;
			Inbox.display_bar(count);
		}
		,
		select_none : function() {
			$('.pesan-item input[type=checkbox]').removeAttr('checked').closest('.pesan-item').removeClass('selected');
			$('#id-toggle-all').get(0).checked = false;
			Inbox.display_bar(0);
		}
	}


	//show message list (back from writing mail or reading a message)
	Inbox.show_list = function() {
		// $('.message-navbar').addClass('hide');
		$('#id-message-list-navbar').removeClass('hide');

		$('.message-list').removeClass('hide').next().addClass('hide');
		//hide the message item / new message window and go back to list
	}


});


	$(document).ready(function(){
		$('#hapusChk').click(function() {
			var id_pesan = [];
			var cek = $('ace')

			$(':checkbox:checked').not("#id-toggle-all").each(function(i) {
				id_pesan[i] = $(this).val();
			});
			var jumlah = id_pesan.length;
			swal({
				title: "Apakah Anda Yakin?",
				text: jumlah+" data tersebut akan saya hapus!?.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				closeOnConfirm: false,
				closeOnCancel: false,
				showCancelButton: true
			}).then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type : "GET",
						dataType : "JSON",
						url : "<?= site_url('admin/pesan/multi_hapus_masuk') ?>",
						data : {id_pesan : id_pesan},
						success : function(data)
						{
							for (var i = 0; i < jumlah; i++) {
								$('tr#'+id_pesan[i]+'').fadeOut('slow');								
								var tipe = data.tipe;
								toastr.options.closeButton = true;
								toastr.options.closeMethod = 'fadeOut';
								toastr.options.closeDuration = 100;
								Command: toastr[tipe](data.pesan, 'Berhasil...');
								$('#id-message-list-navbar .message-navbar').addClass('hide');
								$('#id-toggle-all').removeAttr('checked');
							}
						}
					});
				}else{
					swal("Aman...", "Data tidak terhapus. :)", "error");
				}
			});
		});
		$('.konten-pesan table tr td').not(":first-child").on('click', function(e) {
			e.stopPropagation();
			e.preventDefault();
			var id_pesan=$(this).data('id');
			window.location = "<?php echo site_url('admin/pesan/detail/');?>"+id_pesan;
		});
		$('#tabelku').dataTable();
	});

</script>