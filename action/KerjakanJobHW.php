<?php
	session_start();
	@include("../modul.php");
	$query = "UPDATE MJobHW SET ditangani='".$_SESSION['siapa']."'
								,tanggalditangani=getdate()
				WHERE no='".$_POST["nomorP"]."'";
	execute_query($query);
?>