<?php
function tgl_indo($tgl, $replace_with = '-')
{
	if (date_is_empty($tgl)) {
		return $replace_with;
	}
	$tanggal = substr($tgl, 8, 2);
	$bulan = getBulan(substr($tgl, 5, 2));
	$tahun = substr($tgl, 0, 4);
	return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function tgl_indo2($tgl, $replace_with = '-')
{
	if (date_is_empty($tgl)) {
		return $replace_with;
	}
	$tanggal = substr($tgl, 8, 2);
	$jam = substr($tgl, 11, 8);
	$bulan = getBulan(substr($tgl, 5, 2));
	$tahun = substr($tgl, 0, 4);
	return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $jam;
}
function tgl_indo_in($tgl, $replace_with = '-')
{
	if (date_is_empty($tgl)) {
		return $replace_with;
	}
	$tanggal = substr($tgl, 0, 2);
	$bulan = substr($tgl, 3, 2);
	$tahun = substr($tgl, 6, 4);
	$jam = substr($tgl, 11);
	$jam = empty($jam) ? '' : ' ' . $jam;
	return $tahun . '-' . $bulan . '-' . $tanggal . $jam;
}

function date_is_empty($tgl)
{
	return (is_null($tgl) || substr($tgl, 0, 10) == '0000-00-00');
}

function getBulan($bln)
{
	switch ($bln) {
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function getHari($tgl)
{
	$daftar_hari = array(
		'Sunday' => 'Minggu',
		'Monday' => 'Senin',
		'Tuesday' => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'Jumat',
		'Saturday' => 'Sabtu'
	);
	$namahari = date('l', strtotime($tgl));
	return $daftar_hari[$namahari];
}

function getStatus($status)
{
	if ($status == "0") {
		$st = "Belum Selesai";
	} else if ($status == "1") {
		$st = "Selesai";
	} else if ($status == "2") {
		$st = "Diproses";
	} else if ($status == "3") {
		$st = "Dibtalkan";
	}

	return $st;
}

function timeAgo($time_ago)
{
	$time_ago = strtotime($time_ago);
	$cur_time   = time();
	$time_elapsed   = $cur_time - $time_ago;
	$seconds    = $time_elapsed;
	$minutes    = round($time_elapsed / 60);
	$hours      = round($time_elapsed / 3600);
	$days       = round($time_elapsed / 86400);
	$weeks      = round($time_elapsed / 604800);
	$months     = round($time_elapsed / 2600640);
	$years      = round($time_elapsed / 31207680);
	// Seconds
	if ($seconds <= 60) {
		return "Baru Saja";
	}
	//Minutes
	else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "1 menit yang lalu";
		} else {
			return "$minutes menit yang lalu";
		}
	}
	//Hours
	else if ($hours <= 24) {
		if ($hours == 1) {
			return "1 jam yang lalu";
		} else {
			return "$hours jam yang lalu";
		}
	}
	//Days
	else if ($days <= 7) {
		if ($days == 1) {
			return "kemarin";
		} else {
			return "$days hari yang lalu";
		}
	}
	//Weeks
	else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			return "1 minggu yang lalu";
		} else {
			return "$weeks minggu yang lalu";
		}
	}
	//Months
	else if ($months <= 12) {
		if ($months == 1) {
			return "1 bulan yang lalu";
		} else {
			return "$months bulan yang lalu";
		}
	}
	//Years
	else {
		if ($years == 1) {
			return "1 tahun yang lalu";
		} else {
			return "$years yang lalu";
		}
	}
}

function getRupiah($harga = 0)
{
	if ($harga != null) {
		return "Rp " . number_format($harga, 0, ",", ".");
	} else {
		return "Rp 0";
	}
}

function getRupiahs($harga = 0)
{
	if ($harga != null) {
		return number_format($harga, 0, ",", ".");
	} else {
		return "0";
	}
}
