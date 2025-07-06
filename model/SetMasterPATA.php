<?php
	@include("../modul.php");
	function editMasterAplikasi($idaplikasiEdit,$namaAplikasiBaruEdit){
		$query = "update maplikasi set NamaAplikasi='".$namaAplikasiBaruEdit."' where apl='".$idaplikasiEdit."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function hapusMasterAplikasi($idaplikasiEdit){
		$query = "update maplikasi set Aktif=0 where apl='".$idaplikasiEdit."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function tambahMasterAplikasi($nomorAplikasiBaru,$namaAplikasiBaru){
		$query = "insert into maplikasi values('".$nomorAplikasiBaru."','".$namaAplikasiBaru."',1)";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function editMasterLaporan($idLap,$namaLap){
		$query = "update mjlaporan set NamaLaporan='".$namaLap."' where Lap='".$idLap."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function hapusMasterLaporan($idLap){
		$query = "delete from mjlaporan where lap='".$idLap."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function tambahMasterLaporan($nomorAplikasiBaru,$namaAplikasiBaru){
		$query = "insert into mjlaporan values('".$nomorAplikasiBaru."','".$namaAplikasiBaru."')";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function tambahOrangIT($idnya){
		$query = "update VPrev set status = 1 where nik='".$idnya."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function hapusHakAdmin($idPegawaiEdit){
		$query = "update VPrev set status = 0 where nik='".$idPegawaiEdit."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function editHakAdmin($idPegawaiEdit,$statusDataEdit){
		$query = "update VPrev set status='".$statusDataEdit."' where nik='".$idPegawaiEdit."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
?>