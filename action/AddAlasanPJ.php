<?php
	@session_start();
	@include("../modul.php");
	
	$query = "INSERT INTO [dbo].[MAlasanPJ]
	           ([No]
	           ,[Tanggal]
	           ,[dari]
	           ,[Alasan])
	     VALUES
	           ('".$_POST["nopjP"]."'
	           ,getdate()
	           ,'".$_SESSION['siapa']."'
	           ,'".$_POST["alasanP"]."')";
	execute_query($query);
	echo $_SESSION['siapanama'];
?>