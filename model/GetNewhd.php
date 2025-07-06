<?php
	@include("../../modul.php");
	function getNoIssue(){
		// $query = "select top 1(SUBSTRING(no,9,4) + 1) as no from MIssue where substring(no,4,2)='".date('y')."' and substring(no,7,2)='".date('m')."' order by no desc";
		$query = "select top 1(SUBSTRING(no,9,4) + 1) as no from MIssue where substring(no,4,2)='".date('y')."' order by no desc";
		$data = execute_query($query);
		return $data;
	}
	function getJLaporan(){
		$query = "select * from mjlaporan where Aktif=1 and Lap<90 order by NamaLaporan";
		$data = execute_query($query);
		return $data;
	}
	function getAplikasi(){
		$query = "select * from MAplikasi where Aktif=1 and Apl!=99 order by NamaAplikasi";
		$data = execute_query($query);
		return $data;
	}

	function getJLaporanIT(){
		$query = "select * from mjlaporan where Aktif=1 order by NamaLaporan";
		$data = execute_query($query);
		return $data;
	}
	function getAplikasiIT(){
		$query = "select * from MAplikasi where Aktif=1 order by NamaAplikasi";
		$data = execute_query($query);
		return $data;
	}

	function getListUserHd2(){
		$query = "select nik,nama from VPrev where aktif ='1' order by nama asc";
		$datauser = execute_query($query);
		return $datauser;
	}

?>	