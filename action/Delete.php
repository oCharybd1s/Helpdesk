<?php
	if(isset($_POST["filename"])){
		$fileName_tmp1 = "../upload/".$_POST['filename'];
		unlink($fileName_tmp1);
	}
?>