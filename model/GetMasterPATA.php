<?php
	@include("../modul.php");
	function getPegawai(){
		$query = "select nik, nama from VPrev where aktif ='1' and status = '0'";
		$data = execute_query($query);
		return $data;
	}
?>	