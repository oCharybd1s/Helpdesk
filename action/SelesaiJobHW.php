<?php
	session_start();
	@include("../modul.php");
	$query = "UPDATE MJobHW SET tanggalselesai=getdate()
								,solusi='".$_POST["solusiP"]."'
				WHERE no='".$_POST["nomorP"]."'";
	execute_query($query);
?>