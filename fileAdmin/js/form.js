

$('.dropify').dropify({
	messages: {
		default: 'Drag atau drop gambar disni',
		replace: 'Ganti',
		remove:  'Hapus',
		error:   'error'
	}
});

$('#summernote').summernote({
	lang: 'id-ID',
	height : 550,
	placeholder: 'Tulis disini...',
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