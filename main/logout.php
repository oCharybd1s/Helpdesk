<?php
	session_start();
	// session_unset();
	// session_destroy();
	unset($_SESSION['siapa']);
	unset($_SESSION['siapanama']);
	unset($_SESSION['siapanickName']);
	unset($_SESSION['gambarPP']);
	unset($_SESSION['cabang']);
	unset($_SESSION['namacabang']);
	unset($_SESSION['jabatan']);
	unset($_SESSION['nname']);
	unset($_SESSION['timeout']);
	setcookie("halaman", "", time() - 3600);
	setcookie("subhalaman", "", time() - 3600);
	setcookie("yanglogin", "", time() - 3600);
	setcookie("namamenu", "", time() - 3600);
	setcookie("icon", "", time() - 3600);
	@include_once('../modul.php'); 
	$systemini = read_ini_file();
	$location = "Location: ".$systemini["MAINURL"];
	header($location); die();
	unset($_SESSION['jenisfilterlap']);
	unset($_SESSION['tanggalmulailap']);
	unset($_SESSION['tanggalsampailap']);
?>