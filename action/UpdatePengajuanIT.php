<?php
	@session_start();
	@include("../modul.php");
	
	if($_POST["iseditanalisisP"]==1){
		$query = "delete manalisispj where no='".$_POST["nopjlamaP"]."'";
		execute_query($query);
		$query = "UPDATE [dbo].[pengajuan]
			   SET [No] = '".$_POST["nopjP"]."'
			      ,[kepada] = '".$_POST["kepadaP"]."'
			      ,[up] = '".$_POST["upP"]."'
			      ,[namainvestasi] = '".$_POST["investasiP"]."'
			      ,[biaya] = ".$_POST["biayaP"]."
			      ,[jadwal] = '".$_POST["jadwalP"]."'
			      ,[analisis] = '".$_POST["analisisP"]."'
			 WHERE no='".$_POST["nopjlamaP"]."'";
		execute_query($query);
	}else
	{
		$query = "UPDATE [dbo].[pengajuan]
			   SET [No] = '".$_POST["nopjP"]."'
			      ,[kepada] = '".$_POST["kepadaP"]."'
			      ,[up] = '".$_POST["upP"]."'
			      ,[namainvestasi] = '".$_POST["investasiP"]."'
			      ,[biaya] = ".$_POST["biayaP"]."
			      ,[jadwal] = '".$_POST["jadwalP"]."'
			 WHERE no='".$_POST["nopjlamaP"]."'";
		execute_query($query);
	}		

	$query = "UPDATE [dbo].[ACCPENGAJUAN]
			   SET [NoPeng] = '".$_POST["nopjP"]."'
			 WHERE NoPeng='".$_POST["nopjlamaP"]."'";
	execute_query($query);
	$jabatanarr = [];
	$jabatanlst = "()";
	if(substr($_POST["nopjP"],7,1)==1){
		$jabatanarr = ['PATA'];
		$jabatanlst = "('PATA')";
	}else if(substr($_POST["nopjP"],7,1)==2){
		$jabatanarr = ['KepalaBagian','PATA','DirekturTerkait'];
		$jabatanlst = "('KepalaBagian','PATA','DirekturTerkait')";
	}else if(substr($_POST["nopjP"],7,1)==3){
		// saveAccPengajuan($_SESSION['noPengajuan'],'KepalaBagian','PATA','PDS','PDK','PDM','PDB','PDL','PPD',$tanggalSimpan);
		$jabatanarr = ['KepalaBagian','PATA','PDO','PDA','PPD','CE'];
		$jabatanlst = "('KepalaBagian','PATA','PDO','PDA','PPD','CE')";
		// saveAccPengajuan($_SESSION['noPengajuan'],'KepalaBagian','PATA','PDO','PDA','PDL','PVP','PPD',$tanggalSimpan);
	}	
	//hapus accpengajuan sesuai dengan tingkat
	$query = "DELETE accpengajuan where nopeng='".$_POST["nopjP"]."' and kodeacc not in $jabatanlst";
	execute_query($query);
	//insert yang belum ada 
	for($i=0;$i<count($jabatanarr);$i++){
		$query = "SELECT * from accpengajuan where nopeng='".$_POST["nopjP"]."' and kodeacc='".$jabatanarr[$i]."'";
		$chk = execute_query($query);
		if(count($chk)<1){
			$query = "INSERT INTO accpengajuan (nopeng,kodeacc,tanggalacc)
					VALUES('".$_POST["nopjP"]."','".$jabatanarr[$i]."',NULL)";
			execute_query($query);
		}
	}
?>