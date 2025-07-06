<?php
	session_start();
	@include("../modul.php");
	if(str_replace($_POST['aksiP']," ","")=="new"){
		// $query = "atas";
		$query = "INSERT INTO [dbo].[THPinjam]
			           ([nopinjam]
			           ,[tanggal]
			           ,[idpeminjam]
			           ,[idpemberipinjaman]
			           ,[duedate]
			           ,[statuskembali]
			           ,[tanggalkembali]
			           ,[catatan]
			           ,[idpenerima])
			     VALUES
			           ('".$_POST['nopinjamP']."'
			           ,'".$_POST['tanggalP']."'
			           ,'".$_SESSION['siapa']."'
			           ,''
			           ,'".$_POST['duedateP']."'
			           ,0
			           ,NULL
			           ,'".$_POST["catatanP"]."'
			           ,'')";
		execute_query($query);
		for($i=0;$i<count($_POST["idbarangP"]);$i++){
			$query = "INSERT INTO [dbo].[TPinjam]
				           ([nopinjam]
				           ,[seq]
				           ,[idbarang]
				           ,[namabarang]
				           ,[qty])
				     VALUES
				           ('".$_POST['nopinjamP']."'
				           ,".($i+1)."
				           ,'".$_POST['idbarangP'][$i]."'
				           ,'".$_POST['descriptP'][$i]."'
				           ,'".$_POST['qtyP'][$i]."')";
			execute_query($query);	
		}		

	}else{
		// $query = "bawah";
		// delete first
		$query = "delete THPinjam where nopinjam='".$_POST['nopinjamP']."'";
		execute_query($query);
		$query = "delete TPinjam where nopinjam='".$_POST['nopinjamP']."'";
		execute_query($query);

		$query = "INSERT INTO [dbo].[THPinjam]
			           ([nopinjam]
			           ,[tanggal]
			           ,[idpeminjam]
			           ,[idpemberipinjaman]
			           ,[duedate]
			           ,[statuskembali]
			           ,[tanggalkembali]
			           ,[catatan]
			           ,[idpenerima])
			     VALUES
			           ('".$_POST['nopinjamP']."'
			           ,'".$_POST['tanggalP']."'
			           ,'".$_SESSION['siapa']."'
			           ,''
			           ,'".$_POST['duedateP']."'
			           ,0
			           ,NULL
			           ,'".$_POST["catatanP"]."'
			           ,'')";
		execute_query($query);
		for($i=0;$i<count($_POST["idbarangP"]);$i++){
			$query = "INSERT INTO [dbo].[TPinjam]
				           ([nopinjam]
				           ,[seq]
				           ,[idbarang]
				           ,[namabarang]
				           ,[qty])
				     VALUES
				           ('".$_POST['nopinjamP']."'
				           ,".($i+1)."
				           ,'".$_POST['idbarangP'][$i]."'
				           ,'".$_POST['descriptP'][$i]."'
				           ,'".$_POST['qtyP'][$i]."')";
			execute_query($query);
		}

	}	
	//update stock
	$query = "update x set alocate=isnull(c.qty,0) from mbarang  x
			left join 
			(select a.idbarang,sum(a.qty) as qty
			from tpinjam a
			left join thpinjam b on a.nopinjam=b.nopinjam
			where statuskembali=0 or tanggalkembali is null
			group by a.idbarang) c on x.idbarang=c.idbarang";
	execute_query($query);	
// echo json_encode($query);


?>