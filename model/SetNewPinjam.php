<?php
	@include("../modul.php");
	@include("GetNewpj.php");
	function setNoPJ($cabang){
		$data = getNoPJ($cabang);
		return $data;
	}
	function setNewPengajuan($No,$Tanggal,$kepada,$up,$dari,$cabang,$investasi,$biaya,$jadwal,$alasan,$analisis,$autopilot){
		$query = "insert into mpengajuan ([No],[tanggal],[kepada],[up],[dari],[cabang],[namainvestasi],[biaya],[jadwal],[alasan],[analisis],[ygmengajukan],[konfirmasi],[tanggalkonfirmasi],[konfirmasioleh],[autopilot]) values ('".$No."','".$Tanggal."','".$kepada."','".$up."','".$dari."','".$cabang."','".$investasi."','".$biaya."','".$jadwal."','".$alasan."','".$analisis."','".$dari."',0,NULL,NULL,'".$autopilot."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		// echo $query;
	}
	function setPictPengajuan($No,$nomorGambar,$fileName){
		$query = "insert into gbpengajuan values ('".$No."','".$nomorGambar."','".$fileName."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
?>