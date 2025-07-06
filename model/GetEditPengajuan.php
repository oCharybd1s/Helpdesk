<?php
	@include("../modul.php");
	function getDetMPj($idpj){
		$query = "select convert(nchar(20),m.tanggal,113) as tanggal2, NULL as tanggalselesai, p.nama, m.*,0 as selesai from mpengajuan m, VPrev p where m.no='".$idpj."' and m.dari=p.nik";
		$data = execute_query($query);
		return $data;
	}
	function getDetPj($idpj){
		$query = "select convert(nchar(20),m.tanggal,113) as tanggal2, p.nama, m.*,case when m.tanggalselesai is null then 0 else 1 end as selesai from pengajuan m, VPrev p where m.no='".$idpj."' and m.dari=p.nik";
		$data = execute_query($query);
		return $data;
	}
	function getGambarHPj($idpj){
		$query = "select * from gbpengajuan where no ='".$idpj."' order by seq";
		$data = execute_query($query);
		return $data;
	}
	function getGambarLampiranPj($idpj){
		$query = "select * from MFileLampiran where nopengajuan ='".$idpj."' order by seq";
		$data = execute_query($query);
		return $data;
	}
	function getGambarNota($idpj){
		$query = "select * from mfilerealisasi where nopengajuan ='".$idpj."' order by seq";
		$data = execute_query($query);
		return $data;
	}
	function getTotalRealisasi($idpj){
		// $query = "select * from mrealisasi where nopengajuan ='".$idpj."'";
		$query = "select b.nopr,b.tgldatang,b.noinventaris,isnull(b.nilairealisasi,0) as nilairealisasi from pengajuan a
				left join mrealisasi b on a.no=b.nopengajuan where a.no='".$idpj."'";
		$data = execute_query($query);
		return $data;
	}
	function getKomcliPj($idpj){
		$query = "select * from mcomclipengajuan where nopengajuan ='".$idpj."' order by No asc";
		$data = execute_query($query);
		return $data;
	}
	function getAccPeng($idpj){
		$query = "select convert(nchar(20),tanggalacc,113) as tanggal2, * from accpengajuan where nopeng ='".$idpj."'";
		$data = execute_query($query);
		return $data;
	}
	function getAccPengPATA($idpj){
		$query = "select case when tanggalacc is null then 0 else 1 end as statusacc from accpengajuan where nopeng ='".$idpj."' AND KodeACC='PATA'";
		$data = execute_query($query);
		return $data;
	}
	function getAccPengSudah($idpj){
		$query = "select convert(nchar(20),tanggalacc,113) as tanggal2, * from accpengajuan where nopeng ='".$idpj."' and tanggalacc is not null";
		$data = execute_query($query);
		return $data;
	}
	function updateSudahLihat($idpj){
		$query = "UPDATE MLIHAT SET statuslihat=1 where userid='".$_SESSION['siapa']."' and idupdate in (select idupdate from mupdate where nomer='".$idpj."')";
		execute_query($query);
	}
	function getOldNumber($idpj){
		$query = "select a.no, b.oldnumber
				  from pengajuan a
				  inner join OldNumPengajuan b
				  on a.no = b.NoPeng
				  where a.no = '".$idpj."'";
		$data = execute_query($query);
		return $data;


	}



?>	