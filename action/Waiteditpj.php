<?php
	@session_start();
	@include('../model/GetITHD.php');

	$systemini = read_ini_file();

	$filter=0;
	if (isset($_POST['tanggalHelpdesk'])) {
		$filter=1;
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['cabangFilter'] = $_POST['cabang'];
		
	}
	// if (isset($_POST['tanggalHelpdesk']) && $_POST['tanggalHelpdesk']=='All' 
	//  && isset($_POST['bulanHelpdesk']) && $_POST['bulanHelpdesk'] =='All'
	//  && isset($_POST['tahunHelpdesk']) && $_POST['tahunHelpdesk'] == date("Y")
	//  && isset($_POST['cabang']) && $_POST['cabang']=='All' ) {
	// 	$filter=0;
	// } else {
	
	// 	echo "<script> console.log('HELPDESK : waiteditpj_filter') </script>";
	// 	$filter=1;
	// }
	
	if($filter==1){
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."PengajuanIT/waiteditpj_filter.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."PengajuanIT/waiteditpj_filter.php";
		}

		header($location); die();
	} else {

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