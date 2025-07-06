<?php
	session_start();
	@include("../modul.php");

	
		$query = "DELETE MBarang where idbarang='".$_POST["idbarangP"]."'";		
		execute_query($query);	
?>