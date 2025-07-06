<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$datalaporan = FDataLaporanHarian($_POST['mulaiP'],$_POST['sampaiP']);
	echo json_encode($datalaporan);
?>