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
	function setPictNota($No,$namafile,$realisasi){
		$query = "select count(nopengajuan)+1 as seq from mfilerealisasi where nopengajuan='".$No."'";
		$dataseq = execute_query($query);
		// $query = "DELETE MRealisasi
		// 	      WHERE nopengajuan='".$No."'";
		// execute_query($query);
		// $query = "INSERT INTO [dbo].[MRealisasi]
		// 	           ([nopengajuan]
		// 	           ,[nilairealisasi])
		// 	     VALUES
		// 	           ('".$No."'
		// 	           ,".$realisasi.")";
		// execute_query($query);
		$query = "INSERT INTO [dbo].[MFileRealisasi]
			           ([nopengajuan]
			           ,[seq]
			           ,[namafile])
			     VALUES
			           ('".$No."'
			           ,".$dataseq[0]["seq"]."
			           ,'".$namafile."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function getSeqLampiran($no){
		$query = "select isnull(max(seq),0) as seq from mfilelampiran where nopengajuan='".$no."'";
		$data = execute_query($query);
		return $data;
	}
	function UploadFileLampiranPJ($no,$namafile,$seq){
		$query = "INSERT INTO [dbo].[MFileLampiran]
           ([nopengajuan]
           ,[seq]
           ,[namafile])
     VALUES
           ('".$no."'
           ,".$seq."
           ,'".$namafile."')";
     	execute_query($query);
	}

?>