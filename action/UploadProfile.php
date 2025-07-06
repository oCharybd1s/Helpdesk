<?php
	include('../model/Home.php');
	$ds          = DIRECTORY_SEPARATOR;  //1
	$storeFolder = '../upload';   //2
	if (!empty($_FILES)) {
	     
	    $tempFile = $_FILES['file']['tmp_name'];          //3             
	      
	    $targetPath = $storeFolder.$ds;  //4
	    $fileName =  $_FILES['file']['name'];
		$extensionFile = pathinfo($fileName, PATHINFO_EXTENSION);

		$fileName = $_SESSION['siapa'].".".$extensionFile;
		 $_SESSION['gambarPP'] = $fileName;
	    $targetFile =  $targetPath. $fileName;  //5
	 	
	    move_uploaded_file($tempFile,$targetFile); //6
	    updateProfile($_SESSION['siapa'],'','',$fileName);
	} 
?>