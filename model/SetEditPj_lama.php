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
		$query = "update mpengajuan set konfirmasi='1', tanggalkonfirmasi='".$tanggalSimpan."', konfirmasioleh='".$simpanOleh."' where no='".$nopengajuanLama."'";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);

		$query = "insert into pengajuan values ('".$nopengajuan."','".$tanggalPengajuan."','".$kepada."','".$up."','".$dari."','".$cabang."','".$namainvest."','".$biaya."','".$jadwal."','".$alasan."','".$analisis."','".$dari."',NULL,NULL,0,NULL,0,NULL,NULL,NULL,'".$autopilot."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
	function saveAccPengajuan($noPengajuanUntukACC,$KepalaBagian,$PATA,$PDS,$PDK,$PDM,$PDB,$PDL,$PVP,$PPD,$tanggalSimpan){
		if($KepalaBagian==''){ //ini pengajuan 0-1jt
			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PATA."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);
		}else if($PDS=='DirekturTerkait'){//ini pengajuan 1-5jt
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

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDS."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

		}else if($PDS=='PDS'){//ini pengajuan 5jt++
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

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDS."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDK."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDM."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDB."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PDL."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PVP."',NULL)";
			execute_query($query);
			$querySebelum = str_replace("'"," ",$query);
			$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
			execute_query($queryLog);

			$query = "insert into accpengajuan values ('".$noPengajuanUntukACC."','".$PPD."',NULL)";
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
	}
?>	