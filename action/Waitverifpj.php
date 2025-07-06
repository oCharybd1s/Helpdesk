<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['tanggalHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['cabangFilter'] = $_POST['cabang'];

		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."PengajuanIT/waitverifpj_filter.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."PengajuanIT/waitverifpj_filter.php";
		}

		header($location); die();
	}
?>