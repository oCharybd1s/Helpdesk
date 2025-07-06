<?php
	@session_start();
	@include("../modul.php");
	function remPictDoc($nohd,$filename){
		$query = "delete from gbissue where no='".$nohd."' and namafile='".$filename."'";
		execute_query($query);	
	}
	function getGambarHD2($idhd){
		$query = "select * from gbissue where no ='".$idhd."' order by seq";
		$data2 = execute_query($query);
		return $data2;
	}
?>