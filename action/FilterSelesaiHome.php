<?php
	@session_start();
	@include('../model/Home.php');
	
	$data = getdatasolvedFilter($_POST["tanggalmulai"],$_POST["tanggalsampai"]);
	echo json_encode($data);
?>