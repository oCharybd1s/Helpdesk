<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$data = FDataListJobInternalFilter($_POST["bulanP"],$_POST["tahunP"]);
	echo json_encode($data);
?>