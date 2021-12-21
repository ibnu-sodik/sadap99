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
	<div class="col-md-3 col-xs-12">
		<div class="control-group">
			<label class="form-control-label bolder blue">Filter Berdasarkan Kategori</label>
			<?php foreach ($fil_kategori->result() as $row): ?>
				<div class="checkbox">
					<label>
						<input name="kategori" class="fil_selector kategori ace ace-checkbox-2" type="checkbox" value="<?= $row->id_kategori ?>" />
						<span class="lbl"> <?= $row->nama_kategori ?></span>
					</label>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div id="filter_data" class="col-md-9">
	</div>
	<div class="col-sm-12 text-center" id="pagination_link">
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		filter_data(1);
		function filter_data(page)
		{
			$('#filter_data').html('<div id="loading"></div>');
			var action = 'get_data';
			var kategori = filtrasi('kategori');
			$.ajax({
				url : "<?= base_url('admin/berita/get_data/') ?>"+page,
				method : "POST",
				dataType : "JSON",
				data : {
					action : action,
					kategori : kategori
				},
				success : function(data)
				{
					$('#filter_data').html(data.daftar_berita);
					$('#pagination_link').html(data.pagination_link);
				}
			});
		}
		function filtrasi(class_name) {
			var filter = [];
			$('.' + class_name + ':checked').each(function() {
				filter.push($(this).val());
			});
			return filter;
		}
		$(document).on("click", ".pagination li a", function(event){
			event.preventDefault();
			var page = $(this).data("ci-pagination-page");
			filter_data(page);
		});
		$('.fil_selector').click(function() {
			filter_data(1);
		});
	});
	function conf_hapus() {
		event.preventDefault();
		var a 		= document.getElementById('tombolHapus');
		const href 	= a.getAttribute('href');
		swal({
			title: "Apakah Anda Yakin?",
			text: "Data Ini Akan Saya Hapus!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			closeOnConfirm: false,
			closeOnCancel: false,
			showCancelButton: true
		}).then((willDelete) => {
			if (willDelete) {
				document.location.href = href;
			}else{
				swal("Batal", "Data tidak kami hapus :)", "error");
			}
		});
	}
</script>