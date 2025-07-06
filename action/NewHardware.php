<?php
	session_start();
	@include("../modul.php");

	if($_POST['aksiP']==1){		
		$query = "INSERT INTO [dbo].[MBarang]
			           ([idbarang]
			           ,[descript]
			           ,[onhand]
			           ,[alocate])
			     VALUES
			           ('".$_POST["idbarangP"]."'
			           ,'".$_POST["descriptP"]."'
			           ,".$_POST["onhandP"]."
			           ,0)";		
		execute_query($query);	

	}else{
		$query = "UPDATE MBarang SET descript='".$_POST["descriptP"]."',onhand=".$_POST["onhandP"]."
				 WHERE idbarang='".$_POST["idbarangP"]."'";
		execute_query($query);
	}	
// echo json_encode($query);
?>