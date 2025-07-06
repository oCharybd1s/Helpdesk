<?php
	session_start();
	include("../model/SetNewpj.php");
	if(isset($_POST['tanggalPengajuanP'])){
		$getNoPJ = setNoPJ($_SESSION['cabang']);
		if(count($getNoPJ)==0){
			$No = "HR-IT".$_SESSION['cabang']."-".date('y').date('m')."001";
		}else{
			$No = $getNoPJ[0]['no'];
			for($i=3; $i>strlen($getNoPJ[0]['no']); $i--){
				$No="0".$No;
			}
			$No = "HR-IT".$_SESSION['cabang']."-".date('y').date('m').$No; //No Pengajuan fix
		}
		$No = str_replace(" ","",$No);
		$_SESSION['noPengajuan'] = $No;
		$_SESSION['counterGambarPengajuan'] = 0;
		$date=date_create($_POST['tanggalPengajuanP']);
		$Tanggal = date_format($date,"Y/m/d H:i:s");
		$dari = $_POST['pengajuanDariP'];
		$cabang = $_POST['cabangP'];
		$kepada = $_POST['kepadaP'];
		$up = $_POST['upP'];
		$investasi = $_POST['investasiP'];
		$biaya = $_POST['biayaP'];
		$jadwal = $_POST['jadwalP'];
		$alasan = str_replace("\\\\","",str_replace("'","''",$_POST['alasanP']));
		$analisis = str_replace("\\\\","",str_replace("'","''",$_POST['analisisP']));
		$autopilot = $_SESSION['autoPilotx'];
		
		$inputPengajuan = setNewPengajuan($No,$Tanggal,$kepada,$up,$dari,$cabang,$investasi,$biaya,$jadwal,$alasan,$analisis,$autopilot);

	}
?>