<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['tanggalHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['cabangFilter'] = $_POST['cabang'];
		$_SESSION['attchFilter'] = $_POST['attchP'];
		if($_POST['judul']=="Laporan Semua Pengajuan"){
			$destinasi = "Laporan/lappengajuan_filter.php";
		}else {
			$destinasi = "PengajuanIT/allpj_filter.php";
		}

		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"].$destinasi;
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"].$destinasi;
		}
		header($location); die();
	}
	if(isset($_POST['idHelpdeskEdit'])){
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."HelpDesk/edit.php?nohd=".$_POST['idHelpdeskEdit'];
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."HelpDesk/edit.php?nohd=".$_POST['idHelpdeskEdit'];
		}
		header($location); die();
	}
?>