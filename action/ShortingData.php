<?php
	@session_start();
	// @include("../modul.php");
	@include('../model/GetITHD.php');
	
	if($_POST["appP"]=="hd3menit"){		
		$data = getkurang3menit($_POST["tahunP"],$_POST["bulanP"]);
	}
	if($_POST["appP"]=="overtime"){		
		$data = getovertime($_POST["tahunP"],$_POST["bulanP"]);
	}
	echo json_encode($data);
?>