<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['tanggalHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['cabangFilter'] = $_POST['cabang'];
		$_SESSION['jenisFilter'] = $_POST['jenisHelpdesk'];
		$_SESSION['programFilter'] = $_POST['programHelpdesk'];
		$_SESSION['statusFilter'] = $_POST['statusHelpdesk'];

		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."PATA/verifhd_filter.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."PATA/verifhd_filter.php";
		}

		header($location); die();
	}
?>