<?php
	include('../model/SetNewpj.php');
	$ds          = DIRECTORY_SEPARATOR;  //1
	$storeFolder = '../upload';   //2
	if (!empty($_FILES)) {
	     
	    $tempFile = $_FILES['file']['tmp_name'];          //3             
	      
	    $targetPath = $storeFolder.$ds;  //4
	    $fileName =  $_FILES['file']['name'];
		$extensionFile = pathinfo($fileName, PATHINFO_EXTENSION);
		$No = $_SESSION['noPengajuan'];


		$nomorGambar = $_SESSION['counterGambarPengajuan'];
		unset($_SESSION['counterGambarPengajuan']);
		$nomorGambar = $nomorGambar + 1;
		$_SESSION['counterGambarPengajuan'] = $nomorGambar;

		$fileName = $No."_".$nomorGambar.".".$extensionFile;
	    $targetFile =  $targetPath. $fileName;  //5
	 	// echo $tempFile."---".$targetFile <br>;
	 	// echo $no."---".$nomorGambar."---".$filename<br>;
	    move_uploaded_file($tempFile,$targetFile); //6
	    setPictPengajuan($No,$nomorGambar,$fileName);
	} 
?>