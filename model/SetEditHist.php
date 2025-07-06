<?php
	@include("../modul.php");
	function updateHelpdeskHist($No,$kolom,$nilai){
		if($kolom=="tujuan")
		{
			$query = "UPDATE missue set tujuan='".$nilai."' where no='".$No."'";
		}
		if($kolom=="kategori")
		{
			$query = "UPDATE missue set kategori='".$nilai."' where no='".$No."'";
		}
		if($kolom=="jenislap")
		{
			$query = "UPDATE missue set jenis='".$nilai."' where no='".$No."'";
		}
		if($kolom=="program")
		{
			$query = "UPDATE missue set aplikasi='".$nilai."' where no='".$No."'";
		}
		execute_query($query);
	}
?>