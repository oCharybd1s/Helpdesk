<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$systemini = read_ini_file();
	$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
	$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
	$location = "Location: ".$systemini["URL"]."IT-JOB/ListLebih90_filter.php";
	header($location); die();
?>