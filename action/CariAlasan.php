<?php
	@session_start();
	@include('../model/GetITHD.php');

	$DataAlasan = getAlasanPJ($_POST["nopjP"]);
	echo json_encode($DataAlasan);
?>