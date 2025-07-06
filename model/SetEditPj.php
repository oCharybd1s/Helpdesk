<?php
	@include("../modul.php");
	function addComCli($isiComCli,$noissueComCli,$noComCli,$waktuComCli,$dariComCli){
		$query = "insert into mcomclipengajuan values ('".$noissueComCli."','".$noComCli."','".$waktuComCli."','".$dariComCli."','".$isiComCli."')";
		execute_query($query);

		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function savePengajuan($nopengajuan,$tanggalPengajuan,$kepada,$up,$dari,$cabang,$namainvest,$biaya,$jadwal,$alasan,$analisis,$tanggalSimpan,$simpanOleh,$nopengajuanLama,$autopilot){
		$query = "update mpengajuan set konfirmasi='1', tanggalkonfirmasi='".$tanggalSimpan."', konfirmasioleh='".$simpanOleh."', nopengajuan='".$nopengajuan."' where no='".$nopengajuanLama."'";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);

		$query = "insert into pengajuan ([No], [tanggal],  [kepada], [up], [dari], [cabang], [namainvestasi], [biaya], [jadwal], [alasan], [analisis], [ygmengajukan], [ket], [tanggalselesai], [konfirmasi],[tanggalkonfirmasi],[Status],[Ditangani], [ITTake], [AcceptWork], [autopilot]) values ('".$nopengajuan."','".$tanggalPengajuan."','".$kepada."','".$up."','".$dari."','".$cabang."','".$namainvest."','".$biaya."','".$jadwal."','".$alasan."','".$analisis."','".$dari."',NULL,NULL,0,NULL,0,NULL,NULL,NULL,'".$autopilot."')";
		echo "<script>console.log(".$query.")</script>";
		execute_query($query);
		// echo $query;;
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	// function saveAccPengajuan($noPengajuanUntukACC,$KepalaBagian,$PATA,$PDL,$PDK,$PDM,$PDB,$PDL,$PPD,$tanggalSimpan){
	// 	if($KepalaBagian==''){ //ini pengajuan 0-1jt
	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);
	// 	}else if($PDL=='DirekturTerkait'){//ini pengajuan 1-5jt
	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$KepalaBagian."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 	}else if($PDL=='PDS'){//ini pengajuan 5jt++
	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$KepalaBagian."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDK."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDM."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDB."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 		$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PPD."',NULL)";
	// 		execute_query($query);
	// 		$querySebelum = str_replace("'"," ",$query);
	// 		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	// 		execute_query($queryLog);

	// 	}
	// }
	function saveAccPengajuan($noPengajuanUntukACC,$KepalaBagian,$PATA,$PDO,$PDA,$PDL,$PVP,$PPD,$tanggalSimpan){
		if($KepalaBagian==''){ //ini pengajuan 0-1jt
			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);
		}else if($PDO=='DirekturTerkait'){//ini pengajuan 1-5jt
			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$KepalaBagian."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDO."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

		}else if($PDO=='PDO'){//ini pengajuan 5jt++
			//PERATURAN LAMA//
			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$KepalaBagian."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDO."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDA."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// // $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDM."',NULL)";
			// // execute_query($query);
			// // $querySebelum = str_replace("'"," ",$query);
			// // $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// // execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PVP."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			// // $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
			// // execute_query($query);
			// // $querySebelum = str_replace("'"," ",$query);
			// // $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// // execute_query($queryLog);

			// $query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PPD."',NULL)";
			// execute_query($query);
			// $querySebelum = str_replace("'"," ",$query);
			// $queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			// execute_query($queryLog);

			//PERATURAN BARU , diatas 5 jt, acc : User, Kepala Bagian, PATA, PDO, PDA, PPD, CE /-> info dari PATA/
			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$KepalaBagian."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDO."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDA."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PPD."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PPD."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PVP."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);


		}
	}
	function submitAccPengajuan($nopengajuan,$yangDiAcc){
		$query = "update accpengajuan set tanggalacc=getdate() where nopeng=";
		$query = $query. "'".$nopengajuan."' and kodeacc='".$yangDiAcc."'";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		
		$query = "select kodeacc from accpengajuan where nopeng ='".$nopengajuan."' and tanggalacc is not null";
		$data = execute_query($query);
		return $data;
	}
	function clearPengajuan($nopengajuan){
		$query = "update pengajuan set tanggalselesai=getdate() where no=";
		$query = $query. "'".$nopengajuan."'";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		// $queryrealisasi = "INSERT INTO [dbo].[MRealisasi]
		// 			           ([nopengajuan]
		// 			           ,[nilairealisasi])
		// 			     VALUES
		// 			           ('".$nopengajuan."'
		// 			           ,<nilairealisasi, int,>)";
		// execute_query($queryrealisasi);
	}
	function getseqgb($no){
		$query = "select count(nopengajuan) as seq from mfilerealisasi where nopengajuan='".str_replace(" ","",$no)."'";
		$dataseq = execute_query($query);
		return $dataseq;
	}
	function SetPrintPengajuan($no){
		$query = "select no from printpengajuan where no='".$no."'";
		$dataprint = execute_query($query);
		if(count($dataprint)>=1){
			$query = "update printpengajuan set printed=isnull(printed,0)+1 where no='".$no."'";
		}else{
			$query = "INSERT INTO [dbo].[PrintPengajuan]
			           ([No]
			           ,[Printed])
			     VALUES
			           ('".$no."'
			           ,1)";
		}
		execute_query($query);
	}
	function getGambarLampiran($no){
		$query = "select * from mfilelampiran where nopengajuan='".$no."' order by seq asc";
		$data = execute_query($query);
		return $data;
	}
?>	