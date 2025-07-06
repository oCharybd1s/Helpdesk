<?php
	session_start();
	@include("../modul.php");
	$query = "UPDATE THPinjam set idpemberipinjaman='".$_SESSION['siapa']."' where nopinjam='".$_POST["nopinjamP"]."'";
	execute_query($query);


?>