<?php
	@session_start();
	@include('../model/GetITHD.php');
	
	$nobaru = FDataGetNoPengajuanBaru($_POST['kategori']);
	echo json_encode($nobaru);
?>