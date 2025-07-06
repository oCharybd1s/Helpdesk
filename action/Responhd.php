<?php
	@session_start();
	@include('../model/SetResponHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['ValNomorRes'])){
		$ValueNomorResHD = $_POST['ValNomorRes'];
		$ValueCatatanResHD = $_POST['ValCatatanRespon'];
		ResponHelpdesk($ValueNomorResHD,$ValueCatatanResHD);
	}
?>