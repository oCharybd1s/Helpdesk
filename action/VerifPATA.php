<?php
	@session_start();
	@include("../model/SetVerifPATA.php");
	date_default_timezone_set("Asia/Jakarta");
	$current_date = date('m/d/Y G:i:s');
	if(isset($_POST['alasanReject'])){ //untuk reject
		$alasanReject = $_POST['alasanReject'];
		$idReject = $_POST['idReject'];
		$jenisLaporan = $_POST['jenisLaporan'];
		$jenisProgram = $_POST['jenisProgram'];
		$ranah = $_POST['ranah'];
		$tujuan = $_POST['tujuan'];
		$kategori = $_POST['kategori'];
		verifHD($alasanReject,$idReject,$jenisLaporan,$jenisProgram,$ranah,$current_date,'reject','0','',$tujuan, $kategori);
	}
	if(isset($_POST['estimasiPATA'])){ //untuk confirm
		$estimasiPATA = $_POST['estimasiPATA'];
		$idConfirm = $_POST['idConfirm'];
		$jenisLaporan = $_POST['jenisLaporan'];
		$jenisProgram = $_POST['jenisProgram'];
		$ranah = $_POST['ranah'];
		$prioritas = $_POST['prioritas'];
		$notepata = $_POST['notepata'];
		$tujuan = $_POST['tujuan'];
		$kategori = $_POST['kategori'];
		verifHD('',$idConfirm,$jenisLaporan,$jenisProgram,$ranah,$current_date,$estimasiPATA,$prioritas,$notepata,$tujuan, $kategori);
	}
?>