<?php
include('../action/HapusData.php');
	if(isset($_POST["namafileP"])){		
		//hapus file fisik
		$fileName_tmp1 = "../upload/".$_POST['namafileP'];
		unlink($fileName_tmp1);
		//hapus dari database
		remPictDoc($_POST["nodhP"],$_POST['namafileP']);
		$data = getGambarHD2($_POST["nodhP"]);	
		echo json_encode($data);
	}
?>