<?php
	@include("../modul.php");
	function getDataPengajuan($tanggal, $bulan, $tahun,$cabang,$page){
		// echo $tahun;
		$filtertahun =  "and year(tanggal)='".$tahun."' ";
		if($tahun=='All'){
			$filtertahun = "";
		}
		$gb='';
		if(isset($_SESSION['attchFilter'])){
			if($_SESSION['attchFilter']==1){
				$gb = " and no in (select a.no from pengajuan a left join GBPengajuan b on a.no=b.no 
						where b.no is not null)"; 
			}else if($_SESSION['attchFilter']==2){
				$gb = " and no in (select a.no from pengajuan a left join GBPengajuan b on a.no=b.no 
						where b.no is null)"; 
			}else{
				$gb = ""; 
			}
		}
		$query = '';
		if($page=='waitverifpj'){
			if ($filtertahun!=''){
				$filtertahun =  "and (year(tanggal)='$tahun' or year(tanggalkonfirmasi)='$tahun') and tanggalselesai is null";
			}
			$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, NULL as tanggalselesai, NULL as tanggalkonfirmasi,  konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed FROM pengajuan where konfirmasi='0' $filtertahun";
		}else if($page=='itpj'){
			$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, NULL as tanggalselesai, NULL as tanggalkonfirmasi, konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed FROM pengajuan where konfirmasi='1' and tanggalselesai is null $filtertahun AND no in (select nopeng from vpengajuansiap) $gb";
		}else if($page=='rejectedpj'){
			$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, NULL as tanggalselesai, NULL as tanggalkonfirmasi, konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed FROM pengajuan where konfirmasi='2' $filtertahun";
		}else{
			$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, NULL as tanggalselesai, NULL as tanggalkonfirmasi, NULL as konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=Mpengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,isnull((select printed from printpengajuan where no=Mpengajuan.no),0) as printed FROM Mpengajuan where konfirmasi='0' $filtertahun $gb";
		}
		

		if($_SESSION['jabatan']==0){
			$query = $query . " and dari='".$_SESSION['siapa']."'";
		}
	    if($tanggal=='All'){}else{
	    	$query = $query . " and day(tanggal)='".$tanggal."'";
	    }
	    if($bulan=='All'){}else{
	    	$query = $query . " and month(tanggal)='".$bulan."'";
	    }
	    if($cabang=='All'){}else{
	    	$query = $query . " and cabang='".$cabang."'";
	    }
	    if($page=='waiteditpj'){
	    	$query = $query . " and konfirmasi='0' and tanggalkonfirmasi is null and konfirmasioleh is null";
	    }
	    $filtertahun =  " WHERE year(tanggal)='".$tahun."' ";
		if($tahun=='All'){
			$filtertahun = " WHERE year(tanggal)<=year(getdate()) ";
		}
	    if($page=='allpj'){
	     	$query = $query . " UNION ALL SELECT case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, CONVERT(nchar(10),tanggalselesai,5) + CONVERT(nchar(10),tanggalselesai,108) as tanggalselesai,  CONVERT(nchar(10),tanggalkonfirmasi,5) + CONVERT(nchar(10),tanggalkonfirmasi,108) as tanggalkonfirmasi,  konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed FROM pengajuan $filtertahun $gb";

			if($_SESSION['jabatan']==0){
				$query = $query . " and dari='".$_SESSION['siapa']."'";
			}
		    if($tanggal=='All'){}else{
		    	$query = $query . " and day(tanggal)='".$tanggal."'";
		    }
		    if($bulan=='All'){}else{
		    	$query = $query . " and month(tanggal)='".$bulan."'";
		    }
		    if($cabang=='All'){}else{
		    	$query = $query . " and cabang='".$cabang."'";
		    }
	    }
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	
	function getDataPengajuanBerjalan($tanggal, $bulan, $tahun,$cabang,$page){
		$filtertahun =  "and year(tanggalkonfirmasi)='".$tahun."' ";
		if($tahun=='All'){
			$filtertahun = "";
		}
		$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, NULL as tanggalselesai, NULL as tanggalkonfirmasi, konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,(select butuhacc from vkurangacc where nopeng=pengajuan.no) as kurangacc,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed FROM pengajuan where tanggalkonfirmasi is not null and konfirmasi=1 and tanggalselesai is null and no in (select nopeng from vpengajuanberjalan) $filtertahun";
		

		if($_SESSION['jabatan']==0){
			$query = $query . " and dari='".$_SESSION['siapa']."'";
		}
	    if($tanggal=='All'){}else{
	    	$query = $query . " and day(tanggal)='".$tanggal."'";
	    }
	    if($bulan=='All'){}else{
	    	$query = $query . " and month(tanggal)='".$bulan."'";
	    }
	    if($cabang=='All'){}else{
	    	$query = $query . " and cabang='".$cabang."'";
	    }
	    // if($page=='waiteditpj'){
	    // 	$query = $query . " and konfirmasi='0' and tanggalkonfirmasi is null and konfirmasioleh is null";
	    // }

	    $query = $query . " AND no in (select nopeng from vpengajuanberjalan)";
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function getDataPengajuanSelesai($tanggal, $bulan, $tahun,$cabang,$page){
		$filtertahun =  "and year(tanggalselesai)='".$tahun."' ";
		if($tahun=='All'){
			$filtertahun = "";
		}
		$query = "select case when konfirmasi=1 then 'DiTerima' when konfirmasi=2 then 'DiTolak' else '' end as Konfirmasi2, No, convert(varchar(16),tanggalselesai) as tanggalselesai, NULL as tanggalkonfirmasi, 
		konfirmasi, tanggal, kepada, up, dari, cabang, namainvestasi, biaya, jadwal,alasan, analisis, ygmengajukan, ket, CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2, 
		ISNULL((select case NickName when NIK then Left(Nama,10) else NickName end as dari2 from VPrev where NIK=pengajuan.dari),dari) as dari2, 
		case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2, 
		(select butuhacc from vkurangacc where nopeng=pengajuan.no) as kurangacc,isnull((select printed from printpengajuan where no=pengajuan.no),0) as printed 
		FROM pengajuan where konfirmasi='1' and tanggalselesai is not null $filtertahun";
		

		if($_SESSION['jabatan']==0){
			$query = $query . " and dari='".$_SESSION['siapa']."'";
		}
	    if($tanggal=='All'){}else{
	    	$query = $query . " and day(tanggalselesai)='".$tanggal."'";
	    }
	    if($bulan=='All'){}else{
	    	$query = $query . " and month(tanggalselesai)='".$bulan."'";
	    }
	    if($cabang=='All'){}else{
	    	$query = $query . " and cabang='".$cabang."'";
	    }
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function getAllCabang(){
		$query = 'select * from mcabang';
		$data = execute_query($query);
		return $data;
	}

	function FDataApprovalLevel($biaya)
	{
		$query = "SELECT * FROM MACC 
				  WHERE RANGEAWAL <= replace('".$biaya."','.','') AND RANGEAKHIR >= replace('".$biaya."','.','') AND 
				  StatusActive = 1";
				  
		$data = execute_query($query);
		return $data;
	}

?>	