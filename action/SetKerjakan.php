<?php
	@session_start();
	@include("../model/SetVerifPATA.php");
	
	setkerjakan($_POST["nohelpdeskAccWork"],$_POST['estwaktu'],$_POST['tujuan'],$_POST['jenislaporan'],$_POST['program']);
?>