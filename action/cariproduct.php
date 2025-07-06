<?php
	@session_start();
	@include('../model/GetITHD.php');

	$Databarang = getDataBarang($_POST["prodnoP"]);
	echo json_encode($Databarang);
?>