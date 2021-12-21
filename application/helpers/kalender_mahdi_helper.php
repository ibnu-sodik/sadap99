<?php 

date_default_timezone_set('Asia/Jakarta');

function tanggal_mahdi($tanggal)
{
	$bulan_mahdi = array(
		1 => 'Al Arif',
		'Al Qusyasyi',
		'An Nida',
		'Al Ahmadiya',
		'Al Qoyyim',
		'Al Ali',
		'Al Hasan',
		'Al Husain',
		'Al Abid',
		'Al Baqir',
		'As Sodiq',
		'Al Muntadzar',
		
	);
	$split = explode('-', $tanggal);
	if (($split[2] >= '01') && ($split[1] >= '06')) {
		$tahunMasehi 	= $split[0];
	}else{
		$tahunMasehi 	= $split[0]-1;
	}
	$tahunMahdi		= $tahunMasehi - 2012;
	return $split[2] . ' ' . $bulan_mahdi[ (int)$split[1] ] . ' ' . sprintf("%'.02d", $tahunMahdi).' MHD'; 
}

function bulan_mahdi($tanggal)
{
	$bulan_mahdi = array(
		1 => 'Al Arif',
		'Al Qusyasyi',
		'An Nida',
		'Al Ahmadiya',
		'Al Qoyyim',
		'Al Ali',
		'Al Hasan',
		'Al Husain',
		'Al Abid',
		'Al Baqir',
		'As Sodiq',
		'Al Muntadzar',
		
	);
	$split = explode('-', $tanggal);
	if (($split[2] >= '01') && ($split[1] >= '06')) {
		$tahunMasehi 	= $split[0];
	}else{
		$tahunMasehi 	= $split[0]-1;
	}
	$tahunMahdi		= $tahunMasehi - 2012;
	return $bulan_mahdi[(int)$split[1]]; 
}

function tahun_mahdi($tanggal)
{	
	$bulan_mahdi = array(
		1 => 'Al Arif',
		'Al Qusyasyi',
		'An Nida',
		'Al Ahmadiya',
		'Al Qoyyim',
		'Al Ali',
		'Al Hasan',
		'Al Husain',
		'Al Abid',
		'Al Baqir',
		'As Sodiq',
		'Al Muntadzar',
		
	);
	$split = explode('-', $tanggal);
	if (($split[2] >= '01') && ($split[1] >= '06')) {
		$tahunMasehi 	= $split[0];
	}else{
		$tahunMasehi 	= $split[0]-1;
	}
	$tahunMahdi		= $tahunMasehi - 2012;
	return sprintf("%'.02d", $tahunMahdi);
}

?>