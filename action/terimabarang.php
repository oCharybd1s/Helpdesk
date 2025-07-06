<?php
	session_start();
	@include("../modul.php");
	$query = "UPDATE THPinjam set idpenerima='".$_SESSION['siapa']."',statuskembali=1,tanggalkembali=getdate() where nopinjam='".$_POST["nopinjamP"]."'";
	execute_query($query);


?>