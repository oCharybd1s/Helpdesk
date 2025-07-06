<?php
	session_start();
	@include("../modul.php");

	if($_POST['pauseP']==1){	//jika dipause	
		$query = "INSERT INTO [dbo].[MPauseHW]
			           ([no]
			           ,[paused]
			           ,[resumed])
			     VALUES
			           ('".$_POST["nohdP"]."'
			           ,getdate()
			           ,NULL)";		
		execute_query($query);	

	}else{
		$query = "UPDATE MPauseHW set resumed=getdate() where no='".$_POST["nohdP"]."' and resumed is null";
		execute_query($query);
	}	
?>