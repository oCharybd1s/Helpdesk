<?php
	// ini identik dengan newpj
	@session_start();
	@include("../model/SetEditHist.php");

	if(isset($_POST['noP'])){		
		//$inputHelpdesk = updateHelpdeskHist($No,$Tanggal);
		updateHelpdeskHist($_POST["noP"],$_POST["kolomP"],$_POST["nilaiP"]);
	}
?>