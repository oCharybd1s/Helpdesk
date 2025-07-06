<?php
	@session_start();
	@include("../model/SetMasterPATA.php");
	if(isset($_POST['idaplikasiEdit'])){
		$idaplikasiEdit = $_POST['idaplikasiEdit'];
		$namaAplikasiBaruEdit = $_POST['namaAplikasiBaruEdit'];
		$actionEdit = $_POST['actionEdit'];
		$judulEdit = $_POST['judulEdit'];
		if($judulEdit=="Master Aplikasi"){
			if($actionEdit=='hapus'){
				hapusMasterAplikasi($idaplikasiEdit);
			}else if($actionEdit=='ubah'){
				editMasterAplikasi($idaplikasiEdit,$namaAplikasiBaruEdit);
			}
		}else if($judulEdit=="Master Jenis Laporan"){
			if($actionEdit=='hapus'){
				hapusMasterLaporan($idaplikasiEdit);
			}else if($actionEdit=='ubah'){
				editMasterLaporan($idaplikasiEdit,$namaAplikasiBaruEdit);
			}
		}
	}
	if(isset($_POST['nomorAplikasiBaru'])){
		$nomorAplikasiBaru = $_POST['nomorAplikasiBaru'];
		$namaAplikasiBaru = $_POST['namaAplikasiBaru'];
		$judulBaru = $_POST['judulBaru'];
		if($judulBaru=='Master Aplikasi'){
			tambahMasterAplikasi($nomorAplikasiBaru,$namaAplikasiBaru);
		}else if($judulBaru=='Master Jenis Laporan'){
			tambahMasterLaporan($nomorAplikasiBaru,$namaAplikasiBaru);
		}
	}
	if(isset($_POST['idIT'])){
		$idIT = $_POST['idIT'];
		tambahOrangIT($idIT);
	}
	if(isset($_POST['idPegawaiEdit'])){
		$idPegawaiEdit = $_POST['idPegawaiEdit'];
		$statusDataEdit = $_POST['statusDataEdit'];
		$actionEdit = $_POST['actionEdit'];
		if($actionEdit=='hapus'){
			hapusHakAdmin($idPegawaiEdit);
		}else if($actionEdit=='ubah'){
			editHakAdmin($idPegawaiEdit,$statusDataEdit);
		}
	}
?>