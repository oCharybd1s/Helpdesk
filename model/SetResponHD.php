<?php
	@include("../modul.php");
	function ResponHelpdesk($ValNomorResHD, $ValCatatanResHD){

		$queryA = "insert into MRespon values ('".$ValNomorResHD."',getdate(),'".$ValCatatanResHD."')";
		execute_query($queryA);

		$querySebelum = str_replace("'"," ",$queryA);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);

		$queryB = "Update MIssue set Respon=1 ,Status=0, TanggalSelesai=NULL where No='".$ValNomorResHD."'";
		execute_query($queryB);

		$querySebelum = str_replace("'"," ",$queryB);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}

?>