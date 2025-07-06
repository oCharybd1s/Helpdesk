<?php
	@include("../modul.php");
	function addComCli($isiComCli,$noissueComCli,$noComCli,$waktuComCli,$dariComCli){
		$query = "insert into mcomcli values ('".$noissueComCli."','".$noComCli."','".$waktuComCli."','".$dariComCli."','".$isiComCli."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function acceptWork($idHelpdesk,$ditangani,$status,$tujuan,$kategori,$jenisLap,$progDimaksud,$stnotifIT,$EstITOK,$EstIT,$ITTake,$catatan){
		$query = "update MIssue set ditangani='".$ditangani."',status='".$status."', tujuan='".$tujuan."', kategori='".$kategori."', jenis='".$jenisLap."', aplikasi='".$progDimaksud."', stnotifIT='".$stnotifIT."', EstITOK='".$EstITOK."', EstIT='".$EstIT."', ITTake='".$ITTake."', Solusi='".$catatan."', AcceptWork=getdate()  where no=";
		$query = $query. "'".$idHelpdesk."'";
		execute_query($query);

		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function clearHelpdesk($nohelpdesk,$status,$stnotifIT,$catatan,$tglSelesai){
		$query = "update MIssue set tanggalselesai=getdate() ,status='".$status."', stnotifIT='".$stnotifIT."', Solusi='".$catatan."'  where no=";
		$query = $query. "'".$nohelpdesk."'";
		execute_query($query);

		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function addProgramTerkait($nohelpdesk,$keywordsSelesai){
		$query = "insert into MIssueProgramTerkait values('".$nohelpdesk."','".$keywordsSelesai."')";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function tugaskanHelpdesk($nohelpdeskTugaskanIT,$tugaskanIT){
		$query = "update MIssue set offerditangani='".$tugaskanIT."', accPATA = 1, konfirmasi = 1, tanggalkonfirmasi=getdate() where no=";
		$query = $query. "'".$nohelpdeskTugaskanIT."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function editHelpdeskPATA($nohelpdeskEditPATA,$tujuanEditPATA,$kategoriEditPATA,$jenisLapEditPATA,$progDimaksudEditPATA,$catatanEditPATA){
		$query = "update MIssue set tujuan='".$tujuanEditPATA."', kategori = '".$kategoriEditPATA."', jenis = '".$jenisLapEditPATA."', aplikasi = '".$progDimaksudEditPATA."', solusi = '".$catatanEditPATA."',statusnote='' where no=";
		$query = $query. "'".$nohelpdeskEditPATA."'";
		execute_query($query);
		
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function updatedeskripsihd($nohelpdeskEditPATA,$deskripsi){
		$query = "update MIssue set issue='".$deskripsi."' where no='".$nohelpdeskEditPATA."'";
		execute_query($query);
	}
	function ubahIT($nohelpdeskTugaskanIT,$ubahITMember,$itmemberlama) {
		$query = "update MIssue set Ditangani='".$ubahITMember."', status=1, Solusi='Tugas dialihkan dari ".$itmemberlama." ke ".$ubahITMember."' where no=";
		$query = $query. "'".$nohelpdeskTugaskanIT."'";
		//echo $query;
		execute_query($query);
	}
	function tambahCatatan($noHelpdesk,$catatanEdit) {
		$query = "update MIssue set Solusi='".$catatanEdit."' where no='".$noHelpdesk."'";
		// echo $query;
		execute_query($query);
	}
?>