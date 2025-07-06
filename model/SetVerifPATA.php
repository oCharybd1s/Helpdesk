<?php
	@include("../modul.php");
	function verifHD($alasanReject,$id,$jenisLaporan,$jenisProgram,$ranah,$current_date,$estimasiPATA,$prioritas,$notepata,$tujuan){
		if($estimasiPATA=='reject'){
			if($ranah=='Helpdesk'){
				$query = "update MIssue set prioritas='".$prioritas."', Konfirmasi='2', TanggalKonfirmasi='".$current_date."',AccPata='2',jenis='".$jenisLaporan."', aplikasi='".$jenisProgram."', EstPATA=0, AlTolak='".$alasanReject."',tujuan='".$tujuan."', kategori='".$kategori."' where no=";
				$query = $query. "'".$id."'";
				execute_query($query);

				$querySebelum = str_replace("'"," ",$query);
				$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
				execute_query($queryLog);
			}else if($ranah=='Pengajuan'){
				if(strlen($id)==16){ //jika sudah masuk tabel pengajuan
					$query = "update pengajuan set konfirmasi='2', tanggalkonfirmasi='".$current_date."', ket='".$alasanReject."' where no=";
					$query = $query. "'".$id."'";
					execute_query($query);
				}else{ //jika masih ada di tabel mpengajuan
					$query = "update mpengajuan set konfirmasi='2', tanggalkonfirmasi='".$current_date."', ket='".$alasanReject."' where no=";
					$query = $query. "'".$id."'";
					execute_query($query);
				}				
				// echo $query;
				$querySebelum = str_replace("'"," ",$query);
				$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
				execute_query($queryLog);
			}
		}else{
			if($ranah=='Helpdesk'){
				//jika sudah selesai, maka tidak usah updaye estpata dan estit
				$query2 = "select case when tanggalselesai is null then 0 else 1 end as selesai from missue where no='".$id."'";
				$check = execute_query($query2);
				if($check[0]["selesai"]*1==1){
					$query = "update MIssue set prioritas='".$prioritas."', Konfirmasi='1', TanggalKonfirmasi='".$current_date."', AccPata='1',jenis='".$jenisLaporan."',aplikasi='".$jenisProgram."',tujuan='".$tujuan."'";
			        $query = $query. ",NotePATA='".$notepata."' ";
			        $query = $query. ", kategori='".$kategori."' ";
			      	$query = $query. " where no='".$id."'";
			      	execute_query($query);
				}else{
					$query = "update MIssue set prioritas='".$prioritas."', Konfirmasi='1', TanggalKonfirmasi='".$current_date."', AccPata='1',jenis='".$jenisLaporan."',aplikasi='".$jenisProgram."',tujuan='".$tujuan."'";
			        $query = $query. ",EstPATA = '".$estimasiPATA."', EstIT = '".$estimasiPATA."', NotePATA='".$notepata."' ";
			        $query = $query. ", kategori='".$kategori."' ";
			      	$query = $query. " where no='".$id."'";
			      	execute_query($query);
				}		
				// echo $query;	 	
				$querySebelum = str_replace("'"," ",$query);
				$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
				execute_query($queryLog);
			}else if($ranah=='Pengajuan'){
				$query = "update pengajuan set konfirmasi='1', tanggalkonfirmasi='".$current_date."',NotePATA='".$notepata."' where no=";
				$query = $query. "'".$id."'";
				execute_query($query);
				
				$querySebelum = str_replace("'"," ",$query);
				$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
				execute_query($queryLog);
			}
		}
	}
	function setkerjakan($no,$estwaktu,$tujuan,$jenislaporan,$program){
		$query = "UPDATE missue SET ditangani='".$_SESSION["siapa"]."',acceptwork=getdate(),estIT=".$estwaktu.",
				tujuan='".$tujuan."',jenis='".$jenislaporan."',aplikasi='".$program."'
				WHERE no='".$no."'";
		// echo $query;
		execute_query($query);
	}
	function setselesaihd($no){
		$query = "UPDATE missue set tanggalselesai=getdate() where no='".$no."'";
		execute_query($query);	
	}

?>