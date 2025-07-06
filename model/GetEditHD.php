<?php
	@include("../modul.php");
	function getDetHD($idhd){
		$query = "select convert(nchar(20),i.tanggal,113) as tanggal2, p.nama, c.namacab, i.*,case when (select no from mpause where no=i.No and resumed is null) is null then 0 else 1 end as paused  from missue i, VPrev p, mcabang c where i.dari = p.nik and p.cabang = c.cab and i.no='".$idhd."'";
		$data = execute_query($query);
		return $data;
	}
	function getGambarHD($idhd){
		$query = "select * from gbissue where no ='".$idhd."' order by seq";
		$data = execute_query($query);
		// echo $query;
		return $data;
	}
	
	function getItMember(){
		$query = "select * from VPrev where status >=1";
		$data = execute_query($query);
		return $data;
	}
	function getKomcli($idhd){
		$query = "select * from mcomcli where noissue ='".$idhd."' order by No asc";
		$data = execute_query($query);
		return $data;
	}
	function updateSudahLihatHD($idhd){
		$query = "UPDATE MLIHAT SET statuslihat=1 where userid='".$_SESSION['siapa']."' and idupdate in (select idupdate from mupdate where nomer='".$idhd."')";
		// echo $query;
		execute_query($query);
	}
?>	