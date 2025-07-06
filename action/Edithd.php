<?php
	@session_start();
	@include('../model/SetEditHD.php');

	$systemini = read_ini_file();
	if(isset($_POST['isiComCli'])){
		$isiComCli = $_POST['isiComCli'];
		$noissueComCli = $_POST['noissueComCli'];
		$noComCli = $_POST['noComCli'];
		$waktuComCli = $_POST['waktuComCli'];
		$dariComCli = $_POST['dariComCli'];
		$inputComcli = addComCli($isiComCli,$noissueComCli,$noComCli,$waktuComCli,$dariComCli);
	}
	if(isset($_POST['nohelpdeskAccWork'])){
		$nohelpdesk = $_POST['nohelpdeskAccWork'];
		$ditangani = $_POST['ditanganiAccWork'];
		$status = $_POST['statusAccWork'];
		$tujuan = $_POST['tujuanAccWork'];
		$kategori = $_POST['kategoriAccWork'];
		$jenisLap = $_POST['jenisLapAccWork'];
		$progDimaksud = $_POST['progDimaksudAccWork'];
		$stnotifIT = $_POST['stnotifITAccWork'];
		$EstITOK = $_POST['EstITOKAccWork'];
		$EstIT = $_POST['EstITAccWork'];
		$ITTake = $_POST['ITTakeAccWork'];
		$catatan = $_POST['catatanAccWork'];
		acceptWork($nohelpdesk,$ditangani,$status,$tujuan,$kategori,$jenisLap,$progDimaksud,$stnotifIT,$EstITOK,$EstIT,$ITTake,$catatan);
	}
	if(isset($_POST['nohelpdeskSelesai'])){
		$nohelpdesk = $_POST['nohelpdeskSelesai'];
		$status = $_POST['statusSelesai'];
		$stnotifIT = $_POST['stnotifITSelesai'];
		$catatan = str_replace("'","''",$_POST['catatanSelesai']);
		$keywords = $_POST['keywordsSelesai'];
		$tglSelesai = getdate();
		clearHelpdesk($nohelpdesk,$status,$stnotifIT,$catatan,$tglSelesai);
		addProgramTerkait($nohelpdesk,$keywords);

	}
	if(isset($_POST['tugaskanIT'])){
		$nohelpdeskTugaskanIT = $_POST['nohelpdeskTugaskanIT'];
		$tugaskanIT = $_POST['tugaskanIT'];
		tugaskanHelpdesk($nohelpdeskTugaskanIT,$tugaskanIT);
	}
	if(isset($_POST['nohelpdeskEditPATA'])){
		$nohelpdeskEditPATA = $_POST['nohelpdeskEditPATA'];
		$tujuanEditPATA = $_POST['tujuanEditPATA'];
		$kategoriEditPATA = $_POST['kategoriEditPATA'];
		$jenisLapEditPATA = $_POST['jenisLapEditPATA'];
		$progDimaksudEditPATA = $_POST['progDimaksudEditPATA'];
		$catatanEditPATA = $_POST['catatanEditPATA'];
		$deskripsi = $_POST['deskripsiP'];
		editHelpdeskPATA($nohelpdeskEditPATA,$tujuanEditPATA,$kategoriEditPATA,$jenisLapEditPATA,$progDimaksudEditPATA,$catatanEditPATA);
		updatedeskripsihd($nohelpdeskEditPATA,$deskripsi);
	}
	if(isset($_POST['ubahITMember'])) {
		$nohelpdeskTugaskanIT = $_POST['nohelpdeskTugaskanIT'];
		$ubahITMember = $_POST['ubahITMember'];
		$itmemberlama = $_POST['ITLama'];
		
		ubahIT($nohelpdeskTugaskanIT,$ubahITMember,$itmemberlama);
	}
	if(isset($_POST['catatanEdit'])) {
		$noHelpdesk = $_POST['noHelpdesk'];
		$catatanEdit = $_POST['catatanEdit'];
		
		tambahCatatan($noHelpdesk,$catatanEdit);
	}
?>