<?php 
@include("../modul.php");

function savePengajuanLama($nopengajuan, $oldnumber, $dateentry, $tanggalPengajuan, $kepada, $up, $dari, $cabang, $namainvest, $biaya, $jadwal, $alasan, $analisis, $realisasi, $approval, $approvalname, $approvaldate, $simpanOleh, $autopilot)
{
	$query = "select 'OLDPENG-'+right(year(getdate()),2)+right('000000'+convert(varchar(6),isnull(max(right(
			no,6))+1,1)),6) as NoPeng from PENGAJUAN
			WHERE left(NO,7)='OLDPENG'";
	$SetNoPeng = execute_query($query);
    $NewNoPeng = $SetNoPeng[0]["NoPeng"];

	$query = "insert into pengajuan values ('".$NewNoPeng."','".$tanggalPengajuan."','".$kepada."','".$up."','".$dari."','".$cabang."','".$namainvest."','".$biaya."','".$jadwal."','".$alasan."','".$analisis."','".$dari."',NULL,'".$tanggalPengajuan."',1,'".$tanggalPengajuan."',0,NULL,NULL,NULL,'".$autopilot."')";
		execute_query($query);

	$querySebelum = str_replace("'"," ",$query);
	$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
	execute_query($queryLog);

	if(count($approval) > 0)
	{
		for($i=0;$i<count($approval);$i++)
		{
			$querypembinv = "INSERT INTO [dbo].[ACCPENGAJUAN]
			       ([NoPeng]
			       ,[KodeACC]
			       ,[TanggalACC]
			       )
			       VALUES
			       ('".$NewNoPeng."'
			       ,'".$approval[$i]."'
			       ,'".$tanggalPengajuan."')";
			execute_query($querypembinv);
			// echo $query;
		}	
	}
	else
	{
		for($i=0;$i<count($approvalname);$i++)
		{
			$querypembinv = "INSERT INTO [dbo].[ACCPENGAJUAN]
			       ([NoPeng]
			       ,[KodeACC]
			       ,[TanggalACC]
			       )
			       VALUES
			       ('".$NewNoPeng."'
			       ,'".$approvalname[$i]."'
			       ,'".$approvaldate[$i]."')";
			execute_query($querypembinv);
			// echo $query;
		}
	}
	

	$query = "INSERT INTO [dbo].[DateEntryPeng]
		           ([nopeng]
		           ,[entrydate])
		     VALUES
		           ('".$NewNoPeng."'
		           ,'".$dateentry."')";
	execute_query($query);

	$query = "INSERT INTO [dbo].[OldNumPengajuan]
		           ([nopeng]
		           ,[oldnumber])
		     VALUES
		           ('".$NewNoPeng."'
		           ,'".$oldnumber."')";
	execute_query($query);

}
function getseqgb($no){
	$query = "select count(nopengajuan) as seq from mfilerealisasi where nopengajuan='".str_replace(" ","",$no)."'";
	$dataseq = execute_query($query);
	return $dataseq;
}
?>