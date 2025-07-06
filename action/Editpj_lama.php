<?php
	@session_start();
	@include('../model/SetEditPj.php');
	$systemini = read_ini_file();
	date_default_timezone_set("Asia/Jakarta"); 
	$tanggalSimpan = date('m/d/Y G:i:s');

	if(isset($_POST['isiComCli'])){
		$isiComCli = $_POST['isiComCli'];
		$noissueComCli = $_POST['noissueComCli'];
		$noComCli = $_POST['noComCli'];
		$waktuComCli = $_POST['waktuComCli'];
		$dariComCli = $_POST['dariComCli'];
		$inputComcli = addComCli($isiComCli,$noissueComCli,$noComCli,$waktuComCli,$dariComCli);
	}
	if(isset($_POST['nopengajuanEdit'])){
		$nopengajuan = $_POST['nopengajuanEdit'];
		$_SESSION['noPengajuan'] = $nopengajuan;
		$_SESSION['counterGambarPengajuan']= 0;
		$nopengajuanLama = $_POST['nopengajuanLamaEdit'];
		$tanggalPengajuan = $_POST['tanggalPengajuanEdit'];
		$kepada = $_POST['kepadaEdit'];
		$up = $_POST['upEdit'];
		$dari = $_POST['dariEdit'];
		$cabang = $_POST['cabangEdit'];
		$namainvest = $_POST['namainvestEdit'];
		$biaya = $_POST['biayaEdit'];
		$jadwal = $_POST['jadwalEdit'];
		$alasan = $_POST['alasanEdit'];
		$analisis = $_POST['analisisEdit'];
		$simpanOleh = $_SESSION['siapa'];
		$autopilot = $_SESSION['autoPilotx'];
		savePengajuan($_SESSION['noPengajuan'],$tanggalPengajuan,$kepada,$up,$dari,$cabang,$namainvest,$biaya,$jadwal,$alasan,$analisis, $tanggalSimpan,$simpanOleh,$nopengajuanLama,$autopilot);
		if(substr($nopengajuan,7,1)==1){
			saveAccPengajuan($_SESSION['noPengajuan'],'','PATA','','','','','','','',$tanggalSimpan);
		}else if(substr($nopengajuan,7,1)==2){
			saveAccPengajuan($_SESSION['noPengajuan'],'KepalaBagian','PATA','DirekturTerkait','','','','','','',$tanggalSimpan);
		}else if(substr($nopengajuan,7,1)==3){
			// saveAccPengajuan($_SESSION['noPengajuan'],'KepalaBagian','PATA','PDS','PDK','PDM','PDB','PDL','PPD','PCA',$tanggalSimpan);
			saveAccPengajuan($_SESSION['noPengajuan'],'KepalaBagian','PATA','PDO','PDA','PDL','PVP','PPD',$tanggalSimpan);
		}
	}
	if(isset($_POST['yangDiAcc'])){
		$nopengajuan = $_POST['nopengajuan'];
		$yangDiAcc = $_POST['yangDiAcc'];
		$cekyangSudahDiAcc = submitAccPengajuan($nopengajuan,$yangDiAcc);
		echo json_encode($cekyangSudahDiAcc);
	}
	if(isset($_POST['nopengTambahan'])){
		$_SESSION['noPengajuan'] = $_POST['nopengTambahan'];
		$_SESSION['counterGambarPengajuan'] = $_POST['jumGambarTambahan'];
	}
	if(isset($_POST['noClear'])){
		$noPengajuan = $_POST['noClear'];
		clearPengajuan($noPengajuan);
	}
	if(isset($_POST['noPrint'])){
		$_SESSION['noPrint'] = $_POST['noPrint'];
		$_SESSION['tanggalPrint'] = $_POST['tanggalPrint'];
		$_SESSION['dariPrint'] = $_POST['dariPrint'];
		$_SESSION['namaPrint'] = $_POST['namaPrint'];
		$_SESSION['cabangPrint'] = $_POST['cabangPrint'];
		$_SESSION['kepadaPrint'] = $_POST['kepadaPrint'];
		$_SESSION['upPrint'] = $_POST['upPrint'];
		$_SESSION['biayaPrint'] = $_POST['biayaPrint'];
		$_SESSION['jadwalPrint'] = $_POST['jadwalPrint'];
		$_SESSION['namainvestasiPrint'] = $_POST['namainvestasiPrint'];
		$_SESSION['alasanPrint'] = $_POST['alasanPrint'];
		$_SESSION['analisisPrint'] = $_POST['analisisPrint'];

		if (substr($_POST["noPrint"],7,1)=='1'){	
			if(url()==$systemini["IPPORT"]){
				$location = $systemini["URL"]."PengajuanIT/printsd1.php";
			}else{
				$location = $systemini["URLPUBLIC"]."PengajuanIT/printsd1.php";
			}
			echo $location;
		}else if (substr($_POST["noPrint"],7,1)=='2'){		
			if(url()==$systemini["IPPORT"]){
				$location = $systemini["URL"]."PengajuanIT/printsd5.php";
			}else{
				$location = $systemini["URLPUBLIC"]."PengajuanIT/printsd5.php";
			}
			echo $location;
		}else if (substr($_POST["noPrint"],7,1)=='3'){		
			if(url()==$systemini["IPPORT"]){
				$location = $systemini["URL"]."PengajuanIT/printda5.php";
			}else{
				$location = $systemini["URLPUBLIC"]."PengajuanIT/printda5.php";
			}
			echo $location;
		}
	}
?>