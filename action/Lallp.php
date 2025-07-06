<?php
	@session_start();
	@include('../model/GetITHD.php');
	$systemini = read_ini_file();
	$currentYear = date("Y");
	$currentMonth = date("m");
	if(isset($_POST['tujuanHelpdesk'])){
		$_SESSION['tanggalFilter'] = $_POST['tanggalHelpdesk'];
		$_SESSION['bulanFilter'] = $_POST['bulanHelpdesk'];
		$_SESSION['tahunFilter'] = $_POST['tahunHelpdesk'];
		$_SESSION['tujuanFilter'] = $_POST['tujuanHelpdesk'];
		$_SESSION['kategoriFilter'] = $_POST['kategoriHelpdesk'];
		$_SESSION['jenisFilter'] = $_POST['jenisHelpdesk'];
		$_SESSION['programFilter'] = $_POST['programHelpdesk'];
		$_SESSION['statusFilter'] = $_POST['statusHelpdesk'];
		$_SESSION['jenisfilterlap'] = $_POST["jenisfilterlap"];
		$_SESSION['jenisfilterlap'] = "";
		$_SESSION['tanggalmulailap'] = "";
		$_SESSION['tanggalsampailap'] = "";
		if(isset($_POST["jenisfilterlap"])){
			if(str_replace(" ","",$_POST["jenisfilterlap"])!=""){
				$_SESSION['jenisfilterlap'] = $_POST["jenisfilterlap"];
				$_SESSION['tanggalmulailap'] = $_POST["tanggalmulailap"];
				$_SESSION['tanggalsampailap'] = $_POST["tanggalsampailap"];
			}
		}
		if($_POST['judul']=="Laporan Helpdesk Selesai"){
			$destinasi = "Laporan/lapfinish_filter.php";
		}else {
			$destinasi = "Laporan/lallp_filter.php";
		}
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"].$destinasi;
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"].$destinasi;
		}
		header($location); die();
	}
	if( isset( $_POST['lallp'] ) ){
		$bulanx = $_POST['bulanx'];
		if($bulanx=='All'){
			$bulanx=$currentMonth;
		}
		$tahunx = $_POST['tahunx'];
		if($tahunx=='All'){
			$tahunx=$currentYear;
		}
		$getLaporanAllp = getDataLaporanAllp($bulanx,$tahunx);
		echo json_encode($getLaporanAllp);
	}
	if( isset( $_POST['lapfinishnama'] ) ){
		$jenisfilterlap = "";
		$tanggalmulailap = "";
		$tanggalsampailap = "";
		$bulanx = $_POST['bulanx'];
		if($bulanx=='All'){
			$bulanx=$currentMonth;
		}
		$tahunx = $_POST['tahunx'];
		if($tahunx=='All'){
			$tahunx=$currentYear;
		}
		if(isset($_POST["jenisfilterlap"])){
			if(str_replace(" ","",$_POST["jenisfilterlap"])!=""){
				$jenisfilterlap = $_POST["jenisfilterlap"];
				$tanggalmulailap = $_POST["tanggalmulailap"];
				$tanggalsampailap = $_POST["tanggalsampailap"];
			}
		}
		$getLaporanFinishByNama = getDataLaporanFinishByNama($bulanx,$tahunx,$jenisfilterlap,$tanggalmulailap,$tanggalsampailap);
		echo json_encode($getLaporanFinishByNama);
	}
	if( isset( $_POST['lapfinishcabang'] ) ){
		$jenisfilterlap = "";
		$tanggalmulailap = "";
		$tanggalsampailap = "";
		$bulanx = $_POST['bulanx'];
		if($bulanx=='All'){
			$bulanx=$currentMonth;
		}
		$tahunx = $_POST['tahunx'];
		if($tahunx=='All'){
			$tahunx=$currentYear;
		}
		if(isset($_POST["jenisfilterlap"])){
			if(str_replace(" ","",$_POST["jenisfilterlap"])!=""){
				$jenisfilterlap = $_POST["jenisfilterlap"];
				$tanggalmulailap = $_POST["tanggalmulailap"];
				$tanggalsampailap = $_POST["tanggalsampailap"];
			}
		}
		$getLaporanFinishByCabang = getDataLaporanFinishByCabang($bulanx,$tahunx,$jenisfilterlap,$tanggalmulailap,$tanggalsampailap);
		echo json_encode($getLaporanFinishByCabang);
	}
	if( isset( $_POST['lapfinishprogram'] ) ){
		$jenisfilterlap = "";
		$tanggalmulailap = "";
		$tanggalsampailap = "";
		$bulanx = $_POST['bulanx'];
		if($bulanx=='All'){
			$bulanx=$currentMonth;
		}
		$tahunx = $_POST['tahunx'];
		if($tahunx=='All'){
			$tahunx=$currentYear;
		}
		if(isset($_POST["jenisfilterlap"])){
			if(str_replace(" ","",$_POST["jenisfilterlap"])!=""){
				$jenisfilterlap = $_POST["jenisfilterlap"];
				$tanggalmulailap = $_POST["tanggalmulailap"];
				$tanggalsampailap = $_POST["tanggalsampailap"];
			}
		}
		$getLaporanFinishByProgram = getDataLaporanFinishByProgram($bulanx,$tahunx,$jenisfilterlap,$tanggalmulailap,$tanggalsampailap);
		echo json_encode($getLaporanFinishByProgram);
	}
	if( isset( $_POST['lappengajuan'] ) ){
		$getLaporanPengajuan = getDataLaporanPengajuan();
		echo json_encode($getLaporanPengajuan);
	}
?>