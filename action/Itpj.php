<?php
	@session_start();
	@include('../model/GetITHD.php');
	$systemini = read_ini_file();
	if(isset($_POST['idHelpdeskEdit'])){
		$_SESSION['halaman_terbuka'] = 'editpengajuan';
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."PengajuanIT/editpengajuan.php?nopengajuan=".$_POST['idHelpdeskEdit']."&&jenis=".$_POST['jenisP'];
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."PengajuanIT/editpengajuan.php?nopengajuan=".$_POST['idHelpdeskEdit']."&&jenis=".$_POST['jenisP'];
		}
		header($location); die();
	}

	if(isset($_POST['tanggalHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['cabangFilter'] = $_POST['cabang'];
		if($_POST['jenisP']=="berjalan"){
				$hal = "PengajuanIT/itpjberjalan_filter.php";
			}else if($_POST['jenisP']=="siap"){
				$hal = "PengajuanIT/itpj_filter.php";
			}else{
				$hal = "PengajuanIT/itpjselesai_filter.php";
			}

		if(url()==$systemini["IPPORT"]){
			
			$location = "Location: ".$systemini["URL"].$hal;
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"].$hal;
		}

		header($location); die();
	}
?>