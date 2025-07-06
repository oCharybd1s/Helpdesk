<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$data = FDataHdDitanganiFilter($_POST["jenisfilter"],$_POST["tanggalmulai"],$_POST["tanggalsampai"],$_POST["bulanfilter"],$_POST["tahunfilter"]);
	echo json_encode($data);
?>