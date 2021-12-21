// notifikasi.js
// digunakan untuk menampilkan pesan
// @author Ibnu Sodik


/*=====================================================*/
/*=======================SWEETALERT====================*/
/*=====================================================*/
const swalWarning = $('.swal-warning').data('flashdata');
if (swalWarning) {
	swal({
		title : "Perhatian!",
		text : swalWarning,
		icon : "warning",
		button : false,
		content : true
	});
}

const swalSukses = $('.swal-sukses').data('flashdata');
if (swalSukses) {
	swal({
		title : "Sukses!",
		text : swalSukses,
		icon : "success",
		button : false,
		content : true
	});
}

const swalInfo = $('.swal-info').data('flashdata');
if (swalInfo) {
	swal({
		title : "Informasi!",
		text : swalInfo,
		icon : "info",
		button : false,
		content : true
	});
}

const swalError = $('.swal-error').data('flashdata');
if (swalError) {
	swal({
		title : "Error!",
		text : swalError,
		icon : "error",
		button : false,
		content : true
	});
}


/*=====================================================*/
/*=======================PNOTIFY=======================*/
/*=====================================================*/
const pnotifySukses = $('.pnotify-sukses').data('flashdata');
if (pnotifySukses) {
	new PNotify({
		title : "Sukses!",
		text : pnotifySukses,
		type : "success",
		history : true,
		delay : 3000
	})
}

const pnotifyWarning = $('.pnotify-notice').data('flashdata');
if (pnotifyWarning) {
	new PNotify({
		title : "Perhatian!",
		text : pnotifyWarning,
		type : "notice",
		history : true,
		delay : 3000
	})
}

const pnotifyInfo = $('.pnotify-info').data('flashdata');
if (pnotifyInfo) {
	new PNotify({
		title : "Informasi!",
		text : pnotifyInfo,
		type : "info",
		history : true,
		delay : 3000
	})
}

const pnotifyError = $('.pnotify-error').data('flashdata');
if (pnotifyError) {
	new PNotify({
		title : "Error!",
		text : pnotifyError,
		type : "error",
		history : true,
		delay : 3000
	})
}

function notify_success(pesan){
	new PNotify({
		title: 'Berhasil',
		text: pesan,
		type: 'success',
		history: false,
		delay:4000
	});

}
function notify_info(pesan){
	new PNotify({
		title: 'Informasi',
		text: pesan,
		type: 'info',
		history: false,
		delay:2000
	});

}
function notify_error(pesan){
	new PNotify({
		title: 'Error',
		text: pesan,
		type: 'error',
		history: false,
		delay:2000
	});

} 

function pesan_error(pesan){
	var tampil = '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i> Perhatian</h4>'+pesan+'</div>'
	return tampil;

}
function pesan_sukses(pesan){
	var tampil = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i> Informasi</h4>'+pesan+'</div>';
	return tampil;

}
// toast
const toastAdmin = $('.toast-admin').data('flashdata');
if (toastAdmin) {
	$.toast({
		heading : 'Berhasil.!',
		text : toastAdmin,
		icon: 'success', 
		showHideTransition: 'slide', 
				// allowToastClose: true,
				hideAfter: 5000, 
				stack: 3, 
				position: 'bottom-center', 
				textAlign: 'left',  
				loader: true,  
				loaderBg: '#fff'
			});
}
// toasterror

const pnotifyAdmin = $('.pnotify-admin').data('flashdata');

if (pnotifyAdmin) {
	new PNotify({
		title: 'Berhasil.!',
		text: pnotifyAdmin,
		type: 'success',
		history: false,
		delay:4000
	});

}
const flashDataAdmin = $('.pesan-admin').data('flashdata');

if (flashDataAdmin) {
	swal({
		title: 'Berhasil.!',
		text: flashDataAdmin,
		icon: "success",
		timer : 3000,
		button: false
	});

}
const flashDataAdminError = $('.pesan-admin-error').data('flashdata');

if (flashDataAdminError) {
	swal({
		title: 'Oops.!',
		text: flashDataAdminError,
		icon: "error",
		timer : 3000,
		button: false
	});

}
const pnotifyAdminError = $('.pnotify-admin-error').data('flashdata');

if (pnotifyAdminError) {
	new PNotify({
		title: 'Oops.!',
		text: pnotifyAdminError,
		type: 'error',
		history: false,
		delay:4000
	});

}