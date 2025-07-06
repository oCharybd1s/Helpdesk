<?php
	@session_start();
	@include('../model/SetRatingHD.php');

	// $systemini = read_ini_file();
	// $a = $_POST['ValNomor'];
	if(isset($_POST['ValNomor'])){		
		$ValueNomorHD = $_POST['ValNomor'];
		$ValueRatingHD = $_POST['ValRating'];
		$ValueCatatanHD = $_POST['ValCatatan'];
		RatingHelpdesk($ValueNomorHD,$ValueRatingHD,$ValueCatatanHD);
	}
	// echo json_encode($a);
?>