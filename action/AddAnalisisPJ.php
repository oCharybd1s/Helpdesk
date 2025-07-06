<?php
	@session_start();
	@include("../modul.php");
	
	$query = "INSERT INTO [dbo].[MAnalisisPJ]
			           ([No]
			           ,[Tanggal]
			           ,[dari]
			           ,[analisis])
	     VALUES
	           ('".$_POST["nopjP"]."'
	           ,getdate()
	           ,'".$_SESSION['siapa']."'
	           ,'".$_POST["analisisP"]."')";
	execute_query($query);
	echo $_SESSION['siapanama'];
?>