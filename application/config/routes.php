<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 		= 'beranda';

// website
$route['berita/(:any)']				= "berita/detail/$1";
$route['berita/halaman/(:any)']		= "berita/index/$1";
$route['agenda/(:any)']				= "agenda/detail/$1";
$route['agenda/halaman/(:any)']		= "agenda/index/$1";

$route['halaman/(:any)']			= "halaman/detail/$1";
$route['video/(:any)']				= "video/detail/$1";
$route['video/halaman/(:any)']		= "video/index/$1";

$route['kirim-komentar']			= "berita/kirim_komentar";
$route['balas-komentar']			= "berita/balas_komentar";

$route['author/(:any)']				= "author/detail/$1";
$route['author/halaman/(:any)']		= "author/index/$1";

$route['kategori/(:any)']			= "kategori/detail/$1";
$route['kategori/(:any)/(:num)']	= "kategori/detail/$1/$2";

$route['label/(:any)']				= "label/detail/$1";
$route['label/(:any)/(:num)']		= "label/detail/$1/$2";

$route['pencarian']					= 'hasil/pencarian/';
$route['pencarian/(:any)']			= 'hasil/pencarian/$1';
$route['kontak/kirim-pesan']		= "kontak/kirim_pesan";
// Admin
$route['admin'] 					= 'admin/login';
$route['admin/konfigurasi-website'] = 'admin/website/konfigurasi_website';
$route['admin/konfigurasi-user'] 	= 'admin/users/konfigurasi_user';
$route['admin/pengaturan'] 			= 'admin/website';

// $route['admin/berita/(:num)'] 			= 'admin/berita';

$route['admin/add-website']						= 'admin/settings/add_website';
$route['admin/update-password/(:any)']			= 'admin/reset/update_password/$1';
$route['admin/send-reset-code']					= 'admin/reset/send_reset_code';
$route['admin/reset-password/(:any)']			= 'admin/reset/index/$1';
$route['admin/aktivasi/(:any)']					= 'admin/aktivasi/index/$1';

$route['admin/berita/hapus-kategori/(:num)'] 	= 'admin/berita/hapus_kategori/$1';
$route['admin/berita/hapus-label/(:num)'] 		= 'admin/berita/hapus_label/$1';

$route['admin/galeri/simpan-album'] 			= 'admin/galeri/simpan_album';
$route['admin/galeri/update-album'] 			= 'admin/galeri/update_album';
$route['admin/galeri/hapus-album/(:num)'] 		= 'admin/galeri/hapus_album/$1';

$route['404_override'] 							= 'halaman_404';
$route['translate_uri_dashes'] 					= FALSE;
