<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['bulanHelpdesk'])){
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."Absensi/absen_filter.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."Absensi/absen_filter.php";
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