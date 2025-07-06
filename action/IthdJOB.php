<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['tujuanHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['tujuanFilter'] = 'All';
		$_SESSION['kategoriFilter'] = 'All';
		$_SESSION['jenisFilter'] = $_POST['jenisHelpdesk'];
		$_SESSION['programFilter'] = $_POST['programHelpdesk'];
		$_SESSION['statusFilter'] = 'NBelum';

		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."HelpDesk/ithdJOB_filter.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."HelpDesk/ithdJOB_filter.php";
		}
		header($location); die();
	}
	if(isset($_POST['idHelpdeskEdit'])){
		$_SESSION['halaman_terbuka'] = 'edithd';
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."HelpDesk/edit.php?nohd=".$_POST['idHelpdeskEdit'];
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."HelpDesk/edit.php?nohd=".$_POST['idHelpdeskEdit'];
		}
		header($location); die();
	}
?>