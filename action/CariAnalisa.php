<?php
	@session_start();
	@include('../model/GetITHD.php');

	$DataAlasan = getAnalisisPJ($_POST["nopjP"]);
	echo json_encode($DataAlasan);
?>