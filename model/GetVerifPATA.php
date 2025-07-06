<?php
	@include("../modul.php");
	function getDataHelpdesk($tanggal, $bulan, $tahun, $jenisLaporan, $jenisProgram, $status){
		$query = "select tujuan, kategori,datediff(day,getdate(),tanggalkonfirmasi) as batas,case when konfirmasi=1 then 'Sudah' else 'Belum' end as Konfirmasi2,*,CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2,case when MIssue.status='0' then 'Dalam Penanganan' when MIssue.status='1' then 'Selesai' when MIssue.status IS NULL or MIssue.status='' then 'Belum Ditangani' end as Status2, EstPATA, 
			case NickName when NIK then Left(Nama,10) else NickName end as dariNama,
		    solusi,(Select NickName From VPrev where NIK=Ditangani and aktif = 1) as DitanganiOleh,
		    ISNULL((
		    select case Lap
		        when Lap then NamaLaporan else '' end as Jenis2
		    from MJLaporan where Lap=Missue.Jenis), Jenis) as Jenis2,
		        jenis,Ditangani,
		    ISNULL((
		    select case Apl
		        when Apl then NamaAplikasi else '' end as Aplikasi2
		    from MAplikasi where Apl=Missue.Aplikasi), Aplikasi) as Aplikasi2,
		    case when tanggalselesai='' or tanggalselesai is null then '' else CONVERT(nchar(10),TanggalSelesai,5) + CONVERT(nchar(10),TanggalSelesai,108)  end as TanggalSelesai2,
		    case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,statusnote
		    FROM MIssue left join VPrev on VPrev.NIK=MIssue.dari where no is not null";

		     if($tanggal=='All'){}else{
		    	$query = $query . " and day(tanggal)='".$tanggal."'";
		    }
		    if($bulan=='All'){}else{
		    	$query = $query . " and month(tanggal)='".$bulan."'";
		    }
		    if($tahun=='All'){}else{
		    	$query = $query . " and year(tanggal)='".$tahun."'";
		    }

		    if($jenisLaporan=='All'){}else{
		    	$query = $query . " and Jenis='".$jenisLaporan."'";
		    }
		    if($jenisProgram=='All'){}else{
		    	$query = $query . " and aplikasi='".$jenisProgram."'";
		    }
		    if($status=='All'){}else{
		    	if($status=='Belum'){
		    		$query = $query . " and MIssue.status IS NULL";
		    	}else if($status=='Dalam'){
	    			$query = $query . " and MIssue.status='0'";
		    	}else if($status=='Selesai'){
					$query = $query . " and MIssue.status='1'";
		    	}
		    }
		    $query = $query . " and accPATA = 0";
		    //echo $query."<br/>";
		$data = execute_query($query);
		return $data;
	}

?>	