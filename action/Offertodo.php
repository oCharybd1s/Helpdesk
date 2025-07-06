<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['tujuanHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['tujuanFilter'] = $_POST['tujuanHelpdesk'];
		$_SESSION['kategoriFilter'] = $_POST['kategoriHelpdesk'];
		$_SESSION['jenisFilter'] = $_POST['jenisHelpdesk'];
		$_SESSION['programFilter'] = $_POST['programHelpdesk'];
		$_SESSION['statusFilter'] = $_POST['statusHelpdesk'];
		$location = "Location: ".$systemini["URL"]."HelpDesk/offertodo_filter.php";
		header($location); die();
	}
	if(isset($_POST['idHelpdeskEdit'])){
		$location = "Location: ".$systemini["URL"]."HelpDesk/edit.php?nohd=".$_POST['idHelpdeskEdit'];
		header($location); die();
	}
?>