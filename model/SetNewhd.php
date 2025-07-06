<?php
	@include("../modul.php");
	@include("GetNewhd.php");
	function setNoIssue(){
		$data = getNoIssue();
		return $data;
	}
	function setNewHelpdesk($No,$Tanggal,$dari,$issue,$tujuan,$kategori,$Jenis,$Aplikasi,$StNotifPATA,$StNotifIT,$StNotifStf,$autopilot,$statusselesai,$perkiraanwaktu,$catatan,$tanggaldikerjakan,$tanggalselesai){
		if ($_SESSION['siapa']=='000636')
			$autopilot = 1;
			
		if($autopilot==0){
			$query = "insert into MIssue ([No],[Tanggal],[dari],[issue],[tujuan],[kategori],[Status],[Jenis],[Aplikasi],[StNotifPATA],[StNotifIT],[StNotifStf],[autopilot],[rating],[respon]) values ('".$No."','".$Tanggal."','".$dari."','".$issue."','".$tujuan."','".$kategori."',NULL,'".$Jenis."','".$Aplikasi."','".$StNotifPATA."','".$StNotifIT."','".$StNotifStf."','".$autopilot."',0,0)";
		}else if($autopilot==1){
			$query = "insert into MIssue ([No],[Tanggal],[dari],[issue],[tujuan],[kategori],[Status],[Jenis],[Aplikasi],[Konfirmasi],[TanggalKonfirmasi],[accPATA],[StNotifPATA],[StNotifIT],[StNotifStf],[autopilot],[rating],[respon]) values ('".$No."','".$Tanggal."','".$dari."','".$issue."','".$tujuan."','".$kategori."',NULL,'".$Jenis."','".$Aplikasi."','1',getdate(),'1','".$StNotifPATA."','".$StNotifIT."','".$StNotifStf."','".$autopilot."',0,0)";
		}
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		//jika yg input adalah orang IT, dan statusnya sudah selesai, maka lgsung update selesai
		if($statusselesai*1==1){
			$query = "update MIssue set status=1, Solusi='".$catatan."',tanggalselesai='".$tanggalselesai."',statusnote='Diinput Oleh: ".$_SESSION['siapanama']."',Ditangani='".$_SESSION['siapa']."',AcceptWork='".$tanggaldikerjakan."',ittake=1,estitok=1,IsSelesai=1, EstIT=datediff(minute,'".$tanggalselesai."','".$tanggaldikerjakan."')*-1, EstPATA=datediff(minute,'".$tanggalselesai."','".$tanggaldikerjakan."')*-1  where no='".$No."'";
		execute_query($query);
		}else{
			$query = "select dari from missue where no='".$No."'";
			$chkbuat = execute_query($query);
			if(str_replace(" ","",$chkbuat[0]["dari"])!=str_replace(" ","",$_SESSION['siapa']) && str_replace(" ","",$_SESSION['siapa'])!=''){
				$query = "update missue set statusnote='Diinput Oleh: ".$_SESSION['siapanama']."' where no='".$No."'";
				execute_query($query);
			}				
		}
	}
	function setPictHelpdesk($No,$nomorGambar,$fileName){
		$query = "insert into GBIssue values ('".$No."','".$nomorGambar."','".$fileName."')";
		execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
	}
?>