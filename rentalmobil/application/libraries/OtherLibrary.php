<?php if ( !defined('BASEPATH')) exit();

class otherLibrary
{
    function __construct()
    {
    	
 		function cari_hari($tgl){
  			$hari = date('l', strtotime($tgl));
		    if ($hari == "Monday") {
		    $day = "Senin, ";
		    }if ($hari == "Tuesday") {
		    $day = "Selasa, ";
		    }if ($hari == "Wednesday") {
		    $day = "Rabu, ";
		    }if ($hari == "Thursday") {
		    $day = "Kamis, ";
		    }if ($hari == "Friday") {
		    $day = "Jumat, ";
		    }if ($hari == "Saturday") {
		    $day = "Sabtu, ";
		    }if ($hari == "Sunday") {
		    $day = "Minggu, ";
			}
			return $day;
		}

		function cari_level($level){
  			if ($level == 1) {
  				$lvl = "Administrator";
  			} else {
  				$lvl = "Penanggung Jawab";
  			}
			return $lvl;
		}

		function cari_nama($nama){
			$this->load->model('mbagian');
			return $this->mbagian->nama_skpd($nama);
		}

    }
}