<?php
	@session_start();
	@include("../modul.php");
		
	$query = "UPDATE [dbo].[Mpengajuan]
			   SET [kepada] = '".$_POST["kepadaP"]."'
			      ,[up] = '".$_POST["upP"]."'
			      ,[namainvestasi] = '".$_POST["investasiP"]."'
			      ,[biaya] = ".$_POST["biayaP"]."
			      ,[jadwal] = '".$_POST["jadwalP"]."'
			      ,[alasan] = '".$_POST["alasanP"]."'
			      ,[analisis] = '".$_POST["analisisP"]."'
			 WHERE no='".$_POST["nopjlamaP"]."'";
	execute_query($query);	
?>