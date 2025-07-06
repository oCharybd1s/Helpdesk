<?php
@session_start();
@include('../model/SetNewPjLama.php');
// $_SESSION['counterGambarPengajuan']= 0;


if(isset($_POST['initialP']))
{
	// echo "1";
	if($_POST['initialP']=='newPengLama')
	{
		// echo "2";
		
		$nopengajuan = $_POST['nopengP'];
		$oldnumber = $_POST['oldnumberP'];
		$_SESSION['noPengajuan'] = $nopengajuan;
		$_SESSION['counterGambarPengajuan']= 0;
		$dateentry = $_POST['dateentryP'];
		$tanggalPengajuan = $_POST['tanggalPengajuanP'];
		$kepada = $_POST['kepadaP'];
		$up = $_POST['upP'];
		$dari = $_POST['dariP'];
		$cabang = $_POST['cabangP'];
		$namainvest = $_POST['namainvestP'];
		$biaya = $_POST['biayaP'];
		$jadwal = $_POST['jadwalP'];
		$alasan = $_POST['alasanP'];
		$analisis = $_POST['analisisP'];
		$realisasi = $_POST['realisasiP'];
		$approval = $_POST['approvalP'];
		$approvalname = $_POST['approvalnameP'];
		$approvaldate = $_POST['approvaldateP'];
		$simpanOleh = $_SESSION['siapa'];
		$autopilot = $_SESSION['autoPilotx'];
		
		$noseq = getseqgb($nopengajuan);
		$_SESSION['counterGambarPengajuan'] = $noseq[0]["seq"];
		$_SESSION['realisasi'] = $realisasi;

		savePengajuanLama($nopengajuan,$oldnumber, $dateentry, $tanggalPengajuan, $kepada, $up, $dari, $cabang, $namainvest, $biaya, $jadwal, $alasan, $analisis, $realisasi, $approval, $approvalname, $approvaldate, $simpanOleh, $autopilot);
	}
}
?>