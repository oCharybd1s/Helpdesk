<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	// if(isset($_POST['tujuanHelpdesk'])){
	// 	$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
	// 	$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
	// 	$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
	// 	$_SESSION['tujuanFilter'] = $_POST['tujuanHelpdesk'];
	// 	$_SESSION['kategoriFilter'] = $_POST['kategoriHelpdesk'];
	// 	$_SESSION['jenisFilter'] = $_POST['jenisHelpdesk'];
	// 	$_SESSION['programFilter'] = $_POST['programHelpdesk'];
	// 	$_SESSION['statusFilter'] = $_POST['statusHelpdesk'];

	// 	if(url()==$systemini["IPPORT"]){
	// 		$location = "Location: ".$systemini["URL"]."HelpDesk/ithd_filter.php";
	// 	}else{
	// 		$location = "Location: ".$systemini["URLPUBLIC"]."HelpDesk/ithd_filter.php";
	// 	}
	// 	header($location); die();
	// }
	if(isset($_POST['idHelpdeskEdit'])){
		$_SESSION['halaman_terbuka'] = 'mpinjam';
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."Peminjaman/EditPinjam.php?idpinjam=".$_POST['idHelpdeskEdit'];
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."Peminjaman/EditPinjam.php?idpinjam=".$_POST['idHelpdeskEdit'];
		}
		header($location); die();
	}
?>