<?php
	@include("../modul.php");
	function RatingHelpdesk($ValNomorHD, $ValRatingHD, $ValCatatanHD){
		$query = "DELETE mrating where no='".$ValNomorHD."'";
		execute_query($query);

		$query = "insert into MRating values ('".$ValNomorHD."','".$ValRatingHD."','".$ValCatatanHD."')";
		execute_query($query);

		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);

		$query = "Update MIssue set Rating='".$ValRatingHD."',respon=1 where No='".$ValNomorHD."'";
		execute_query($query);

		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		// return $query1;
	}

?>