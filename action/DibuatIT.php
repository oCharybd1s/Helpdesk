<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$systemini = read_ini_file();
	$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
	$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
	$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
	$_SESSION['statusSelesaiFilter'] = $_POST['statusselesaiP'];	
	$location = "Location: ".$systemini["URL"]."HelpDesk/HDIt_filter.php";
	header($location); die();
?>