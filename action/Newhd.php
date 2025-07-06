<?php
	// ini identik dengan newpj
	@session_start();
	@include("../model/SetNewhd.php");

	if(isset($_POST['tanggalIssueP'])){
		$getNoIssue = setNoIssue();
		if(count($getNoIssue)==0){
			$No = "IT/".date('y')."/000001";
		}else{
			$No = $getNoIssue[0]['no'];
			for($i=6; $i>strlen($getNoIssue[0]['no']); $i--){
				$No="0".$No;
			}
			$No = "IT/".date('y')."/".$No; //No Helpdesk fix
		}
		$_SESSION['noHelpdesk'] = $No;
		$_SESSION['counterGambar'] = 0;
		$date=date_create($_POST['tanggalIssueP']);
		$Tanggal = date_format($date,"Y/m/d H:i:s");
		$datedikerjakan=date_create($_POST['tanggaldikerjakanP']);
		$Tanggaldikerjakan = date_format($datedikerjakan,"Y/m/d H:i:s");
		$dateselesai=date_create($_POST['tanggalselesaiP']);
		$Tanggalselesai = date_format($dateselesai,"Y/m/d H:i:s");
		$statusselesai = 0;
		if(isset($_POST['statusselesaiP'])){
			if($_POST['statusselesaiP']*1==1){
				$statusselesai = $_POST['statusselesaiP'];
			}
		}
		$dari = $_POST['issueDariP'];
		$tujuan = $_POST['tujuanP'];
		$kategori = $_POST['kategoriP'];
		$issue = str_replace("\\\\","",str_replace("'","''",$_POST['deskP']));
		$issue = $issue. "\n\n\nDari IP :".$IPKOMP;
		// $issue = $_POST['deskP'];
		$Jenis = $_POST['jenisLapP'];
		$Aplikasi = $_POST['progDimaksudP'];
		$StNotifPATA = 0;	$StNotifIT = 0;
		$StNotifStf = 0;	$autopilot = $_SESSION['autoPilotx'];
		$inputHelpdesk = setNewHelpdesk($No,$Tanggal,$dari,$issue,$tujuan,$kategori,$Jenis,$Aplikasi,$StNotifPATA,$StNotifIT,$StNotifStf,$autopilot,$statusselesai,$_POST['perkiraanwaktuP'],$_POST['catatanP'],$Tanggaldikerjakan,$Tanggalselesai);
	}
?>