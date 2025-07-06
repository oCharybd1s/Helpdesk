<?php
	include('../model/SetNewhd.php');
	$ds          = DIRECTORY_SEPARATOR;  //1
	$storeFolder = '../upload';   //2
	if (!empty($_FILES)) {
	     
	    $tempFile = $_FILES['file']['tmp_name'];          //3             
	      
	    $targetPath = $storeFolder.$ds;  //4
	    $fileName =  $_FILES['file']['name'];
		$extensionFile = pathinfo($fileName, PATHINFO_EXTENSION);
		$No = str_replace("/","",str_replace("/","",$_SESSION['noHelpdesk']));

		$nomorGambar = $_SESSION['counterGambar'];
		unset($_SESSION['counterGambar']);
		$nomorGambar = $nomorGambar + 1;
		$_SESSION['counterGambar'] = $nomorGambar;

		$fileName = $No."_".$nomorGambar.".".$extensionFile;
	    $targetFile =  $targetPath. $fileName;  //5
	 	
	    move_uploaded_file($tempFile,$targetFile); //6
	    setPictHelpdesk($No,$nomorGambar,$fileName);
	} 
?>