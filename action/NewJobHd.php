<?php
	session_start();
	@include("../modul.php");
	if($_POST["aksiP"]==1){ //input baru
		$query = "select 'ITHW'+right('00000000000'+convert(varchar(11),isnull(max(right(no,11))+1,1)),11) as nomor from mjobhw";
		$datanomor = execute_query($query);
		$nomor = $datanomor[0]["nomor"];

		$query = "INSERT INTO [dbo].[MJobHW]
			           ([No]
			           ,[Tanggal]
			           ,[Dari]
			           ,[Job]
			           ,[Ditangani]
			           ,[TanggalDitangani]
			           ,[TanggalSelesai]
			           ,[Solusi])
			     VALUES
			           ('".$nomor."'
			           ,getdate()
			           ,'".$_POST['dariP']."'
			           ,'".$_POST['jobP']."'
			           ,NULL
			           ,NULL
			           ,NULL
			           ,'')";
		execute_query($query);
	}else{
		$query = "UPDATE [dbo].[MJobHW]
				   SET [Dari] = '".$_POST['dariP']."'
				      ,[Job] = '".$_POST['jobP']."'
				 WHERE No='".$_POST["noP"]."'";
		execute_query($query);
	}
?>