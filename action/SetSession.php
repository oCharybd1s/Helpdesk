<?php
	include('../model/SetNewpj.php');
	// session_start();

	$seq = getSeqLampiran($_POST["noP"]);
	$_SESSION['noPengajuan'] = $_POST["noP"];
	$_SESSION['counterGambarPengajuan'] = $seq[0]["seq"];

	echo $_SESSION['noPengajuan']."_".($_SESSION['counterGambarPengajuan']+1);
	// echo json_encode($_SESSION['noPengajuan']);
?>