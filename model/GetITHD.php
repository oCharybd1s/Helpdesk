<?php
	@include("../modul.php");
	function getDataItHD($tanggal, $bulan, $tahun,$tujuan,$kategori, $jenisLaporan, $jenisProgram, $status, $form){
		$query = '';
		$query = "select prioritas,tujuan,case when datediff(minute,AcceptWork,TanggalSelesai)>EstIT then 'Overtime' when datediff(minute,AcceptWork,TanggalSelesai)<=EstIT then 'Tepat' else 'Progress' end as overtime,kategori,datediff(day,getdate(),tanggalkonfirmasi) as batas,case when konfirmasi=1 then 'Sudah' else 'Belum' end as Konfirmasi2,MIssue.*,CONVERT(nchar(10),Tanggal,5) + CONVERT(nchar(10),Tanggal,108) as Tgl2,case when status='0' then 'Dalam Penanganan' when status='1' then 'Selesai' when status IS NULL or status='' then 'Belum Ditangani' end as Status2,tanggal, EstPATA, EstIT, accPATA,
		    ISNULL((
		      select top 1 case NickName
		        when NIK then Left(Nama,10) else NickName end as dari2
		      from VPrev where NIK=MIssue.dari),dari) as dari2,  
		      (Select top 1 NickName From VPrev where NIK=isnull(Ditangani,OfferDitangani)) as DitanganiOleh,
		      ISNULL((
		      select case Lap
		        when Lap then NamaLaporan else '' end as Jenis2
		      from MJLaporan where Lap=Missue.Jenis), Jenis) as Jenis2,
		      ISNULL((
		      select case Apl
		        when Apl then NamaAplikasi else '' end as Aplikasi2
		      from MAplikasi where Apl=Missue.Aplikasi), Aplikasi) as Aplikasi2,
		    case when tanggalselesai='' or tanggalselesai is null then '' else CONVERT(nchar(10),TanggalSelesai,5) + CONVERT(nchar(10),TanggalSelesai,108)  end as TanggalSelesai2,
		    case when tanggalkonfirmasi='' or tanggalkonfirmasi is null then '' else convert(varchar(16),TanggalKonfirmasi) end as TanggalKonfirmasi2,convert(nchar(12),Tanggal,105) as Tanggal22,solusi,rating,respon,(select top 1 cabang from VPrev where NIK=MIssue.dari) as cabang,datediff(minute,MIssue.AcceptWork,MIssue.TanggalSelesai)-isnull(b.totpaused,0) as lamapengerjaan,NotePATA,statusnote,case when isnull(isselesai,0)=1 then 'Langsung Selesai' else 'Input Baru' end as isselesai
		    FROM MIssue left join VPause b on MIssue.no=b.no where MIssue.no is not null 
		    ";
	// fiter--------------------------------
		if($form=='lapfinish'){
			if($tanggal=='All'){
				//dari form laporan laporan finish
				if(isset($_SESSION['jenisfilterlap'])){
					// echo $_SESSION['jenisfilterlap']."</br>";
					if(str_replace(" ","",$_SESSION['jenisfilterlap'])!="" && str_replace(" ","",$_SESSION['jenisfilterlap'])!="bulanan"){
						$query .= " AND (TanggalSelesai BETWEEN '".$_SESSION['tanggalmulailap']."' AND '".$_SESSION['tanggalsampailap']."')";
					}else{
						if($bulan!="All"){
							$query .= " and month(TanggalSelesai)='".$bulan."' AND year(TanggalSelesai)='".$tahun."'";
						}else{
							$query .= " year(TanggalSelesai)='".$tahun."'";
						}						
					}
				}
			}else{
	    		$query = $query . " and day(TanggalSelesai)='".$tanggal."'";
		    }
		    if($bulan!='All'){}else{
		    	$query = $query . " and month(TanggalSelesai)='".$bulan."'";
		    }
		    if($tahun!='All'){}else{
		    	$query = $query . " and year(TanggalSelesai)='".$tahun."'";
		    }
	    }else{
	    	if($tanggal=='All'){}else{
		    	$query = $query . " and day(tanggal)='".$tanggal."'";
		    }
		    if($bulan=='All'){}else{
		    	$query = $query . " and month(tanggal)='".$bulan."'";
		    }
		    if($tahun=='All'){}else{
		    	$query = $query . " and year(tanggal)='".$tahun."'";
		    }
	    }
	    
	    if($tujuan=='All'){}else{
	    	$query = $query . " and tujuan='".$tujuan."'";
	    }
	    if($kategori=='All'){}else{
	    	$query = $query . " and kategori='".$kategori."'";
	    }
	    if($jenisLaporan=='All'){}else{
	    	$query = $query . " and Jenis='".$jenisLaporan."'";
	    }
	    if($jenisProgram=='All'){}else{
	    	$query = $query . " and aplikasi='".$jenisProgram."'";
	    }
	    if($status=='All'){}else{
	    	if($status=='Belum'){
	    		$query = $query . " and status IS NULL";
	    	}else if($status=='Dalam'){
    			$query = $query . " and status='0'";
	    	}else if($status=='Selesai'){
				$query = $query . " and status='1'";
	    	}
	    }
	// --------------------------------
	    if($form=='ithd'){
	    	// $query = $query . " and (status is null) and (ditangani is null  or ditangani ='') and accPATA = 1 ";
	    	$query = $query . " and Aplikasi<>12 and (status is null) and (ditangani is null  or ditangani ='') and accPATA = 1 ";
	    }else if($form=='ithdSAP'){
	    	//khusus SAP
	    	$query = $query . " and Aplikasi=12 and (status is null) and (ditangani is null  or ditangani ='') and accPATA = 1 ";
	    }else if($form=='ithdJOB'){
	    	//khusus SAP
	    	$query = $query . " and Jenis>90 and (status is null) and (ditangani is null  or ditangani ='') and accPATA = 1 ";
	    }else if($form=='todo'){
			if($_SESSION['jabatan']==1){
				$query = $query . "  and status = '0' and ditangani='".$_SESSION['siapa']."' and accPATA = 1 ";
			}else if($_SESSION['jabatan']==2){
				$query = $query . "  and status = '0' and accPATA = 1 ";
			}
	    }else if($form=='allp'){
	    	if($_SESSION['jabatan']==0){
				$query = $query . " ";
	    	}else{
				$query = $query . " and accPATA = 1";
	    	}
	    }else if($form=='offertodo'){
	    	if($_SESSION['jabatan']==2){ //jika PATA
				$query = $query . " and status is null and accPATA = 1 and TanggalSelesai is null and (ditangani is null or ditangani = '') and offerditangani is not null";
	    	}else{
				$query = $query . " and status is null and accPATA = 1 and OfferDitangani = '".$_SESSION['siapa']."' and TanggalSelesai is null and (ditangani is null or ditangani = '')";
	    	}			
	    }else if($form=='rejectedhd'){
	    	if($_SESSION['jabatan']==0){
			$query = $query . " and accPATA = 2 and dari ='".$_SESSION['siapa']."'";
	    	}else{
			$query = $query . " and accPATA = 2 ";
	    	}
	    }else if($form=='lapfinish'){
			$query = $query . " and status = '1' and accPATA = 1 ";
	    }else if($form=="HDIt"){
	    	if($tanggal=='All'){}else{
		    	$query = $query . " and day(tanggal)='".$tanggal."'";
		    }
		    if($bulan=='All'){}else{
		    	$query = $query . " and month(tanggal)='".$bulan."'";
		    }
		    if($tahun=='All'){}else{
		    	$query = $query . " and year(tanggal)='".$tahun."'";
		    }
		    if($status=='All'){
				$query = $query . " and statusnote is not null and convert(varchar,statusnote)<>''";
		    }else{
		    	if($status=='1'){
		    		$query = $query . " and statusnote is not null and convert(varchar,statusnote)<>'' and isnull(isselesai,0)=1";
		    	}else{
		    		$query = $query . " and statusnote is not null and convert(varchar,statusnote)<>'' and isnull(isselesai,0)=0";
		    	}
		    } 	
	    }

	    if($_SESSION['jabatan']==0){
	    	$query = $query . " and dari ='".$_SESSION['siapa']."'";
	    	if($form=='ComplainOpen'){
				$query = $query . " and tanggalselesai is null and accPATA != 2 AND year(tanggal)='".$tahun."'";
		    }else if($form=='ComplainDone'){
				$query = $query . " and tanggalselesai is not null and accPATA = 1 AND month(tanggal)='".$bulan."' and year(tanggal)='".$tahun."'";
		    }else if($form=='ComplainOpenRingkasanTerbuka'){
				$query = $query . " and tanggalselesai is null and accPATA != 2 and year(tanggal)='".date('Y')."'";
		    }else if($form=='ComplainOpenRingkasanSelesai'){
				$query = $query . " and tanggalselesai is not null and accPATA = 1 and year(tanggal)='".date('Y')."'";
		    }else if($form=='ComplainOpenRingkasanDibuat'){
				$query = $query . " and year(tanggal)='".date('Y')."'";
		    }else if($form=='ComplainTerbukaAll'){
				$query = $query . " and tanggalselesai is null and accPATA != 2";
		    }else if($form=='ComplainRejected'){
				$query = $query . " and accPATA = 2";
		    }
	    }
	    // $query = $query . " ORDER BY MIssue.No desc";
	    $query = $query . " order by MIssue.prioritas asc,MIssue.tanggal asc";
		// echo $query."<br><br><br>";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanAllp($bulanx,$tahunx){
		$query = "select i.ditangani,p.nama, sum(case when tanggalselesai is not null then 1 else 0 end ) as selesai,
			sum(case when tanggalselesai is null then 1 else 0 end ) as progress, 
			sum(case when tanggalselesai is null then 1 else 1 end ) as total
			from MISSUE i, VPrev p
			where year(i.tanggal) = ".$tahunx." and month(i.tanggal) = ".$bulanx." and i.ditangani is not null and  i.ditangani !='          ' and i.ditangani = p.nik
			group by i.ditangani, p.nama
			union 
			select '999999' as ditangani, '<b>Grand Total</b>' as nama, sum(case when tanggalselesai is not null then 1 else 0 end ) as selesai,
			sum(case when tanggalselesai is null then 1 else 0 end ) as progress,  sum(case when tanggalselesai is null then 1 else 1 end ) as total
			from missue i
			where year(i.tanggal) = ".$tahunx." and month(i.tanggal) = ".$bulanx." and i.ditangani is not null and  i.ditangani !='' 
			order by i.ditangani";

		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanFinishByNama($bulanx,$tahunx,$jenisfilter,$tanggalmulai,$tanggalsampai){
		if(str_replace(" ","",$jenisfilter)!="" && str_replace(" ","",$jenisfilter)!="bulanan"){
			$tanggalmulai = date_format(date_create($tanggalmulai),"Y/m/d");
			$tanggalsampai = date_format(date_create($tanggalsampai),"Y/m/d");
			$query = "select i.ditangani,p.nama,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)>i.EstIT then 1 else 0 end) as overtime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 0 end) as ontime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 1 end) as total
			from MISSUE i, VPrev p
			where (i.tanggalselesai between '".$tanggalmulai."' AND '".$tanggalsampai."') and i.ditangani is not null and  i.ditangani !='          ' and i.ditangani = p.nik
			group by i.ditangani, p.nama
			union 
			select '999999' as ditangani, '<b>Grand Total</b>' as nama,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)>i.EstIT then 1 else 0 end) as overtime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 0 end) as ontime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 1 end) as total
			from missue i
			where (i.tanggalselesai between '".$tanggalmulai."' AND '".$tanggalsampai."') and i.ditangani is not null and  i.ditangani !='' 
			order by i.ditangani";
			// echo $query;
		}else{
			$query = "select i.ditangani,p.nama,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)>i.EstIT then 1 else 0 end) as overtime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 0 end) as ontime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 1 end) as total
			from MISSUE i, VPrev p
			where year(i.tanggalselesai) = ".$tahunx." and month(i.tanggalselesai) = ".$bulanx." and i.ditangani is not null and  i.ditangani !='          ' and i.ditangani = p.nik
			group by i.ditangani, p.nama
			union 
			select '999999' as ditangani, '<b>Grand Total</b>' as nama,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)>i.EstIT then 1 else 0 end) as overtime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 0 end) as ontime,
			sum(case when datediff(minute,i.AcceptWork,i.TanggalSelesai)<=i.EstIT then 1 else 1 end) as total
			from missue i
			where year(i.tanggalselesai) = ".$tahunx." and month(i.tanggalselesai) = ".$bulanx." and i.ditangani is not null and  i.ditangani !='' 
			order by i.ditangani";
		}		
		// echo $query."</br>";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanFinishByCabang($bulanx,$tahunx,$jenisfilter,$tanggalmulai,$tanggalsampai){
		if(str_replace(" ","",$jenisfilter)!="" && str_replace(" ","",$jenisfilter)!="bulanan"){
			$tanggalmulai = date_format(date_create($tanggalmulai),"Y/m/d");
			$tanggalsampai = date_format(date_create($tanggalsampai),"Y/m/d");
			$query = "select c.namacab, count(c.namacab) as total
					from missue i, mcabang c, VPrev p
					where (i.TanggalSelesai BETWEEN '".$tanggalmulai."' AND '".$tanggalsampai."') and i.dari = p.nik and p.cabang=c.cab
					group by c.namacab
					order by total desc";			
		}else{
			$query = "select c.namacab, count(c.namacab) as total
				from missue i, mcabang c, VPrev p
				where year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx." and i.dari = p.nik and p.cabang=c.cab
				group by c.namacab
				order by total desc";			
		}
		$data = execute_query($query);
		return $data;
	}
	function GetNewNoOldPeng()
	{
		$query = "select 'OLDPENG-'+right(year(getdate()),2)+right('000000'+convert(varchar(6),isnull(max(right(no,6))+1,1)),6) as NoPeng from PENGAJUAN
			WHERE left(NO,7)='OLDPENG'";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanFinishByCabangTotal($bulanx,$tahunx){
		if(isset($_SESSION['jenisfilterlap'])){
			if(str_replace(" ","",$_SESSION['jenisfilterlap'])!="" && str_replace(" ","",$_SESSION['jenisfilterlap'])!="bulanan"){
				$kondisi = " (i.TanggalSelesai BETWEEN '".$_SESSION['tanggalmulailap']."' AND '".$_SESSION['tanggalsampailap']."') ";
			}else{
				$kondisi = " year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx."";
			}
		}else{
			$kondisi = " year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx."";
		}
		$query = "select '<b>Total</b>' as namacab, count(c.namacab) as total
				from missue i, mcabang c, VPrev p
				where $kondisi and i.dari = p.nik and p.cabang=c.cab";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanFinishByProgram($bulanx,$tahunx,$jenisfilter,$tanggalmulai,$tanggalsampai){
		if(str_replace(" ","",$jenisfilter)!="" && str_replace(" ","",$jenisfilter)!="bulanan"){
			$tanggalmulai = date_format(date_create($tanggalmulai),"Y/m/d");
			$tanggalsampai = date_format(date_create($tanggalsampai),"Y/m/d");
			$query = "select a.NamaAplikasi, count(a.apl) as total
				from missue i, maplikasi a
				where (i.TanggalSelesai BETWEEN '".$tanggalmulai."' AND '".$tanggalsampai."') and i.jenis = a.apl
				group by a.NamaAplikasi
				order by total desc";
		}else{
			$query = "select a.NamaAplikasi, count(a.apl) as total
				from missue i, maplikasi a
				where year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx." and i.jenis = a.apl
				group by a.NamaAplikasi
				order by total desc";
		}		
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanFinishByProgramTotal($bulanx,$tahunx){
		if(isset($_SESSION['jenisfilterlap'])){
			if(str_replace(" ","",$_SESSION['jenisfilterlap'])!="" && str_replace(" ","",$_SESSION['jenisfilterlap'])!="bulanan"){
				$kondisi = " (i.TanggalSelesai BETWEEN '".$_SESSION['tanggalmulailap']."' AND '".$_SESSION['tanggalsampailap']."') ";
			}else{
				$kondisi = " year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx."";
			}
		}else{
			$kondisi = " year(i.TanggalSelesai) = ".$tahunx." and month(i.TanggalSelesai) = ".$bulanx."";
		}
		$query = "select '<b>Total</b>' as NamaAplikasi, count(a.apl) as total
				from missue i, maplikasi a
				where $kondisi and i.jenis = a.apl";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanPengajuan($bulanx,$tahunx){
		$query = "select X.cabang, 
	        ISNULL(A.sd1,0) sd1, 
	        convert(float,ISNULL(A.sd1,0))/(select sum(sd1) from (SELECT count(substring(No,8,1)) as sd1, cabang FROM pengajuan where substring(No,8,1)='1' and (cabang !=null or cabang<>'') GROUP BY cabang) aa)*100 as persensd1,
	        ISNULL(B.sd5,0) sd5, 
	        convert(float,ISNULL(B.sd5,0))/(select sum(sd5) from (SELECT count(substring(No,8,1)) as sd5, cabang FROM pengajuan where substring(No,8,1)='2' and (cabang !=null or cabang<>'') GROUP BY cabang) bb)*100 as persensd5,
	        ISNULL(C.da5,0) da5, 
	        convert(float,ISNULL(C.da5,0))/(select sum(da5) from (SELECT count(substring(No,8,1)) as da5, cabang FROM pengajuan where substring(No,8,1)='3' and (cabang !=null or cabang<>'') GROUP BY cabang) cc)*100 as persenda5,
	        ISNULL(A.sd1,0)+ISNULL(B.sd5,0)+ISNULL(C.da5,0) JUMLAH
		    FROM (SELECT namacab as Cabang from MCabang where Cab !=null or Cab<>'') X
		    left join (SELECT count(substring(No,8,1)) as sd1, cabang FROM pengajuan where substring(No,8,1)='1' and (cabang !=null or cabang<>'' and year(tanggal) = ".$tahunx." and month(tanggal) = ".$bulanx.") GROUP BY cabang) A
		    ON X.Cabang = A.cabang
		    left join (SELECT count(substring(No,8,1)) as sd5, cabang FROM pengajuan where substring(No,8,1)='2' and (cabang !=null or cabang<>'' and year(tanggal) = ".$tahunx." and month(tanggal) = ".$bulanx.") GROUP BY cabang) B
		    ON X.Cabang = B.cabang
		    left join (SELECT count(substring(No,8,1)) as da5, cabang FROM pengajuan where substring(No,8,1)='3' and (cabang !=null or cabang<>'' and year(tanggal) = ".$tahunx." and month(tanggal) = ".$bulanx.") GROUP BY cabang) C
		    ON X.Cabang = C.cabang
		    group by X.cabang, A.sd1, B.sd5, C.da5";
		$data = execute_query($query);
		return $data;
	}
	function getDataLaporanPengajuanTotal(){
		$query = "select '<b>Grand Total</b>' as cabang, sum(a.sd1) as sd1, sum(a.persensd1) as persensd1, sum(a.sd5) as sd5,  sum(a.persensd5) as persensd5, sum(a.da5) as da5, sum(a.persenda5) as persenda5, sum(a.JUMLAH) as JUMLAH from (select X.cabang, 
	        ISNULL(A.sd1,0) sd1, 
	        convert(float,ISNULL(A.sd1,0))/(select sum(sd1) from (SELECT count(substring(No,8,1)) as sd1, cabang FROM pengajuan where substring(No,8,1)='1' and (cabang !=null or cabang<>'') GROUP BY cabang) aa)*100 as persensd1,
	        ISNULL(B.sd5,0) sd5, 
	        convert(float,ISNULL(B.sd5,0))/(select sum(sd5) from (SELECT count(substring(No,8,1)) as sd5, cabang FROM pengajuan where substring(No,8,1)='2' and (cabang !=null or cabang<>'') GROUP BY cabang) bb)*100 as persensd5,
	        ISNULL(C.da5,0) da5, 
	        convert(float,ISNULL(C.da5,0))/(select sum(da5) from (SELECT count(substring(No,8,1)) as da5, cabang FROM pengajuan where substring(No,8,1)='3' and (cabang !=null or cabang<>'') GROUP BY cabang) cc)*100 as persenda5,
	        ISNULL(A.sd1,0)+ISNULL(B.sd5,0)+ISNULL(C.da5,0) JUMLAH
		    FROM (SELECT namacab as Cabang from MCabang where Cab !=null or Cab<>'') X
		    left join (SELECT count(substring(No,8,1)) as sd1, cabang FROM pengajuan where substring(No,8,1)='1' and (cabang !=null or cabang<>'') GROUP BY cabang) A
		    ON X.Cabang = A.cabang
		    left join (SELECT count(substring(No,8,1)) as sd5, cabang FROM pengajuan where substring(No,8,1)='2' and (cabang !=null or cabang<>'') GROUP BY cabang) B
		    ON X.Cabang = B.cabang
		    left join (SELECT count(substring(No,8,1)) as da5, cabang FROM pengajuan where substring(No,8,1)='3' and (cabang !=null or cabang<>'') GROUP BY cabang) C
		    ON X.Cabang = C.cabang
		    group by X.cabang, A.sd1, B.sd5, C.da5) as a";
    	$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskByAplikasi($tahun){
		$query = "select aplk.NamaAplikasi, isnull(b.jumlah,0) as jumlah from maplikasi aplk left outer join 
			(select a.apl, count(i.aplikasi) as jumlah
			from missue i, maplikasi a
			where i.aplikasi = a.apl and year(i.tanggal) = ".$tahun."
			group by a.apl) as b on aplk.apl = b.apl order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskByJenisLaporan($tahun){
		$query = "select lapor.NamaLaporan, isnull(b.jumlah,0) as jumlah from MJLaporan lapor left outer join 
			(select j.Lap, count(i.jenis) as jumlah
			from missue i, MJLaporan j
			where i.jenis = j.lap and year(i.tanggal) = ".$tahun."
			group by j.Lap) as b on lapor.lap = b.lap order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getTotalHelpdesk($tahun){
		$query = "select count(no) as jumlah
				from missue
				where year(tanggal) = ".$tahun." order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskSelesai($tahun){
		$query = "select count(no) as jumlah
				from missue
				where year(tanggal) = ".$tahun." and status = 1 and accpata=1 order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskDitolak($tahun){
		$query = "select count(no) as jumlah
				from missue
				where year(tanggal) = ".$tahun." and accpata=2 order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskBelumDitangani($tahun){
		$query = "select count(no) as jumlah
				from missue
				where year(tanggal) = ".$tahun." and accpata=1 and status is null order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}
	function getDataHelpdeskSedangDitangani($tahun){
		$query = "select count(no) as jumlah
				from missue
				where year(tanggal) = ".$tahun." and accpata=1  and status = 0 order by jumlah desc";
		$data = execute_query($query);
		return $data;
	}

	function getDataPinjam(){
		$kondisi = "";
		if($_SESSION["divisi"]!="IT"){
			$kondisi = " WHERE idpeminjam='".$_SESSION['siapa']."'"; 
		}
		$query = "select a.*,b.nama,convert(varchar(12),tanggal,103) as tanggal2,convert(varchar(12),duedate,103) as duedate2,
					case when statuskembali=1 then 'Sudah Kembali' when idpemberipinjaman='' then '-' else 'Belum Kembali' end as status2,
					convert(varchar(12),tanggalkembali,103) as tanggalkembali2,c.nama as namapemberi,d.nama as namapenerima
					from thpinjam a left join
					VPrev b on a.idpeminjam=b.nik
					left join
					VPrev c on a.idpemberipinjaman=c.nik
					left join
					VPrev d on a.idpenerima=d.nik
					$kondisi";
		$datapinjam = execute_query($query);
		return $datapinjam;
	}

	function getDataPinjamEdit($nopinjam){
		$query = "select a.*,b.nama,convert(varchar(12),tanggal,101) as tanggal2,convert(varchar(12),duedate,101) as duedate2 from thpinjam a left join
		VPrev b on a.idpeminjam=b.nik
				where a.nopinjam='".$nopinjam."' ";
		$datapinjam = execute_query($query);
		return $datapinjam;
	}

	function getDataPinjamEditDetail($nopinjam){
		$query = "select a.*,b.onhand-isnull(b.alocate,0)+a.qty as available  from tpinjam a
				left join mbarang b on a.idbarang=b.idbarang
				where a.nopinjam='".$nopinjam."' order by seq asc";
		$datapinjamdetail = execute_query($query);
		return $datapinjamdetail;
	}

	function getNoPinjam(){
		$query = "select 'P'+right('000000000'+convert(varchar(9),isnull(max(right(nopinjam,9)+1),1)),9) as nomer from thpinjam";
		$nomer = execute_query($query);
		return $nomer;
	}

	function getDataBarang($prodno){
		$query = "SELECT *,isnull(onhand,0)-isnull(alocate,0) as available FROM MBarang where idbarang like '%".$prodno."%'";
		$databarang = execute_query($query);
		if(count($databarang)<1){
			$query = "SELECT *,isnull(onhand,0)-isnull(alocate,0) as available FROM MBarang";
			$databarang = execute_query($query);
		}
		return $databarang;
	}
	function getNomerBarang(){
		$query = "select 'BR'+right('00000000'+convert(varchar(8),max(right(idbarang,8)+1)),8) as nomer from mbarang";
		$nomerbarang = execute_query($query);
		return $nomerbarang;
	}
	function getDatahardware(){
		$query = "select * from mbarang";
		$databarang = execute_query($query);
		return $databarang;
	}
	function getDatahardwareEdit($idbarang){
		$query = "select * from mbarang where idbarang='".$idbarang."'";
		$databarang = execute_query($query);
		return $databarang;
	}
	function FgetjumdataTugasS($noid){
		$query = "select count(no) as jumlah from missue where OfferDitangani='".$noid."' and isnull(TanggalSelesai,'')=''";
		$jumtugas = execute_query($query);
		return $jumtugas;
	}
	function FgetdataAlertTugas($noid){
		//hilangkan yg sudah selesai dari notif
		$query = "update c set statuslihat=1
				from mupdate a
				left join missue b on a.nomer=b.No
				left join mlihat c on a.idupdate=c.idupdate
				where tanggalselesai is not null";
		execute_query($query);
		$kondisi = "";
		if($_SESSION["divisi"]!="IT"){
			$kondisi = " AND b.dari='".$noid."'"; 
		}

		$query = "select a.nomer as No,convert(varchar(35),b.issue) as issue,case when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)<59 then 
				CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0),' menit')
					when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)>=60 AND ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0)<24 
					then CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0),' jam') 
					ELSE CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 86400,0),' hari') end AS menit,
					c.nama as darinama,a.keterangan as judul,'goDetail' as linkedit
				from mupdate a left join missue b on a.nomer=b.No
				left join VPrev c on b.dari=c.nik
				left join mlihat d on a.idupdate=d.idupdate
				where a.jenis='HD' and d.statuslihat=0 and d.userid='".$noid."' $kondisi
				UNION ALL
				select a.nomer as No,convert(varchar(35),b.namainvestasi) as issue,case when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)<59 then 
				CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0),' menit')
					when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)>=60 AND ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0)<24 
					then CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0),' jam') 
					ELSE CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 86400,0),' hari') end AS menit,
					c.nama as darinama,a.keterangan as judul,'goEditPengajuanFromNotif' as linkedit
				from mupdate a left join pengajuan b on a.nomer=b.No
				left join VPrev c on b.dari=c.nik
				left join mlihat d on a.idupdate=d.idupdate
				where a.jenis='PG' and d.statuslihat=0 and d.userid='".$noid."' $kondisi
				UNION ALL
				select a.nomer as No,convert(varchar(35),b.namainvestasi) as issue,case when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)<59 then 
				CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0),' menit')
					when ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 60,0)>=60 AND ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0)<24 
					then CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 3600,0),' jam') 
					ELSE CONCAT(ROUND(DATEDIFF(SECOND,a.tanggal, getdate()) / 86400,0),' hari') end AS menit,
					c.nama as darinama,a.keterangan as judul,'goEditPengajuanFromNotif' as linkedit
				from mupdate a left join Mpengajuan b on a.nomer=b.No
				left join VPrev c on b.dari=c.nik
				left join mlihat d on a.idupdate=d.idupdate
				where a.jenis='MPG' and d.statuslihat=0 and d.userid='".$noid."'$kondisi
				ORDER BY menit asc";
		$dettugas = execute_query($query);
		return $dettugas;
	}
	function getDataUserDashboard(){
		$query = "select * from VPrev where year(lastlogin)=year(getdate()) and month(lastlogin)=month(getdate()) and day(lastlogin)=day(getdate())";
		$jumuserlogin = execute_query($query);
		return $jumuserlogin;
	}
	function getDataPengajuanDashboard(){
		$query = "select a.No,a.Tanggal,b.Nama as dari,a.cabang,a.namainvestasi,a.alasan,a.biaya
				from mpengajuan a
				left join VPrev b on a.dari=b.NIK
				where year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate()) and day(a.tanggal)=day(getdate())";
		$pengajuandashboard = execute_query($query);
		return $pengajuandashboard;
	}
	function getDataHelpdeskDashboard(){
		$query = "select a.*,b.Nama as namadari,c.Nama as namaditangani,convert(varchar(12),tanggalselesai,105) as TanggalSelesai2
				from missue a
				left join VPrev b on a.dari=b.nik
				left join VPrev c on a.ditangani=c.nik
				where year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate()) and day(a.tanggal)=day(getdate())";
		$helpdeskdashboard = execute_query($query);
		return $helpdeskdashboard;
	}
	function getJenisHelpdeskHariIini(){
		$query = "select b.NamaLaporan,count(no) as jumlah
				from missue a
				left join mjlaporan b on a.Jenis=b.Lap
				where year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate()) and day(a.tanggal)=day(getdate()) 
				group by b.NamaLaporan";
		$jumhelpdesk = execute_query($query);
		return $jumhelpdesk;
	}
	function getJumlahDikerjakan(){
		$query = "select a.nama,isnull(count(b.no),0) as jumlah from 
				(select * from absen_new.dbo.pegawai where divisi='IT' and cabang='HO' and aktif=1) a
				left join 
				(select * from missue where year(tanggal)=year(getdate()) and month(tanggal)=month(getdate()) and day(tanggal)=day(getdate())) b 
				on b.Ditangani=a.noid or b.OfferDitangani=a.noid
				where a.nama is not null
				group by a.nama";
		$jumlahDikerjakan = execute_query($query);
		return $jumlahDikerjakan;
	}	
	function getJumlahHelpdeskSelesai(){
		$query = "select a.*,b.Nama as namadari,c.Nama as namaditangani,
				case when datediff(minute,a.acceptwork,a.TanggalSelesai)-isnull(d.totpaused,0)<1 then convert(varchar(10),datediff(second,a.acceptwork,a.TanggalSelesai)-(isnull(d.totpaused,0)*60))+' Detik' else convert(varchar(10),datediff(minute,a.acceptwork,a.TanggalSelesai)-isnull(d.totpaused,0))+' menit' end as waktupengerjaan
				from missue a
				LEFT JOIN VPrev b on a.dari=b.NIK
				LEFT JOIN VPrev c on a.Ditangani=c.NIK or a.OfferDitangani=c.NIK
				left join vpause d on a.No=d.No
				where a.TanggalSelesai is not null and year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate()) 
				and day(a.tanggal)=day(getdate())";
		$hdselesai = execute_query($query);
		return $hdselesai;
	}
	function getJumlahHelpdeskSelesaiBulan(){
			$query = "select a.*,b.Nama as namadari,c.Nama as namaditangani,case when datediff(minute,a.acceptwork,a.TanggalSelesai)<1 then convert(varchar(10),datediff(second,a.acceptwork,a.TanggalSelesai))+' Detik' else convert(varchar(10),datediff(minute,a.acceptwork,a.TanggalSelesai))+' menit' end as waktupengerjaan
				from missue a
				LEFT JOIN VPrev b on a.dari=b.NIK
				LEFT JOIN VPrev c on a.Ditangani=c.NIK or a.OfferDitangani=c.NIK
				where a.TanggalSelesai is not null and year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate())";
		$hdselesai = execute_query($query);
		return $hdselesai;
	}
	function waktupengerjaanavg(){
		$query = "select a.nama,count(no) as jumhd,case when sum(datediff(minute,b.AcceptWork,b.TanggalSelesai))/count(no)<1 then convert(varchar(10),sum(datediff(second,b.AcceptWork,b.TanggalSelesai))/count(no))+' Detik' else convert(varchar(10),sum(datediff(minute,b.AcceptWork,b.TanggalSelesai))/count(no))+' Menit' end as avgwaktu from
				(select * from absen_new.dbo.pegawai where divisi='IT' and cabang='HO' and aktif=1) a
				LEFT JOIN missue b on b.Ditangani=a.noid or b.OfferDitangani=a.noid
				where b.TanggalSelesai is not null and year(b.tanggal)=year(getdate()) 
				and month(b.tanggal)=month(getdate()) and day(b.tanggal)=day(getdate())
				group by a.nama";
		$avgwaktu = execute_query($query);
		return $avgwaktu;
	}
	function waktupengerjaanavgbulan(){
		$query = "select a.nama,count(no) as jumhd,case when sum(datediff(minute,b.AcceptWork,b.TanggalSelesai))/count(no)<1 then convert(varchar(10),sum(datediff(second,b.AcceptWork,b.TanggalSelesai))/count(no))+' Detik' else convert(varchar(10),sum(datediff(minute,b.AcceptWork,b.TanggalSelesai))/count(no))+' Menit' end as avgwaktu from
				(select * from absen_new.dbo.pegawai where divisi='IT' and cabang='HO' and aktif=1) a
				LEFT JOIN missue b on b.Ditangani=a.noid or b.OfferDitangani=a.noid
				where b.TanggalSelesai is not null and year(b.tanggal)=year(getdate()) 
				and month(b.tanggal)=month(getdate())
				group by a.nama";
		$avgwaktu = execute_query($query);
		return $avgwaktu;
	}
	function getbelumselesaibulan(){
		$query = "select a.*,b.nama as namadari,c.Nama as namaditangani
				from missue a 
				LEFT JOIN VPrev b on a.dari=b.NIK
				LEFT JOIN VPrev c on a.Ditangani=b.NIK or a.OfferDitangani=c.NIK
				where a.TanggalSelesai is null and year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate())";
		$dataBelumSelesai = execute_query($query);
		return $dataBelumSelesai;
	}
	function getkurang3menit($tahun,$bulan){
		$kondisi = " and year(a.tanggal)=".$tahun."";
		if(str_replace(" ","",$bulan)!="All"){
			$kondisi = " and year(a.tanggal)=".$tahun." and month(tanggal)=".$bulan."";
		}
		$query = "select a.*,case when b.nama is null then a.dari else b.nama end as namadari,c.nama as namaditangani,
				case when datediff(minute,a.acceptwork,a.TanggalSelesai)<1 then convert(varchar(10),datediff(second,a.acceptwork,a.TanggalSelesai))+' Detik' 
				else convert(varchar(10),datediff(minute,a.acceptwork,a.TanggalSelesai))+' menit' end as waktupengerjaan,
				convert(varchar(18),a.tanggal,105)+' '+convert(varchar(8),a.tanggal,108) as tanggal2,convert(varchar(18),a.acceptwork,105)+' '+convert(varchar(8),a.acceptwork,108) as acceptwork2,convert(varchar(18),a.TanggalSelesai,105)+' '+convert(varchar(8),a.TanggalSelesai,108) as tanggalselesai2
				from missue a
				LEFT JOIN VPrev b on a.dari=b.NIK
				LEFT JOIN VPrev c on a.Ditangani=c.nik
				WHERE datediff(second,a.AcceptWork,a.TanggalSelesai)<180 and a.TanggalSelesai is not null and c.nama is not null $kondisi
				";
		$datamenit = execute_query($query);
		return $datamenit;
	}
	function getovertime($tahun,$bulan){
		$kondisi = " and year(a.tanggal)=".$tahun."";
		if(str_replace(" ","",$bulan)!="All"){
			$kondisi = " and year(a.tanggal)=".$tahun." and month(tanggal)=".$bulan."";
		}
		$query = "select a.*,case when b.nama is null then a.dari else b.nama end as namadari,c.nama as namaditangani,
				case when datediff(minute,a.acceptwork,a.TanggalSelesai)<1 then convert(varchar(10),datediff(second,a.acceptwork,a.TanggalSelesai))+' Detik' 
				else convert(varchar(10),datediff(minute,a.acceptwork,a.TanggalSelesai))+' menit' end as waktupengerjaan,
				convert(varchar(18),a.tanggal,105)+' '+convert(varchar(8),a.tanggal,108) as tanggal2,convert(varchar(18),a.acceptwork,105)+' '+convert(varchar(8),a.acceptwork,108) as acceptwork2,convert(varchar(18),a.TanggalSelesai,105)+' '+convert(varchar(8),a.TanggalSelesai,108) as tanggalselesai2
				from missue a
				LEFT JOIN VPrev b on a.dari=b.NIK
				LEFT JOIN VPrev c on a.Ditangani=c.nik
				WHERE datediff(minute,a.AcceptWork,a.TanggalSelesai)>a.EstIT and a.TanggalSelesai is not null and c.nama is not null $kondisi
				";
		$dataovertime = execute_query($query);
		return $dataovertime;
	}
	function getwaktupenanganan(){
		$query = "select b.nama as namaditangani,sum(datediff(minute,a.tanggalkonfirmasi,a.acceptwork)) as totalwaktu,count(no) as jumlahhd,
				sum(datediff(minute,a.tanggalkonfirmasi,a.acceptwork))/count(no) as avgwaktupenanganan
				from missue a
				left join VPrev b on a.ditangani=b.NIK
				where a.AcceptWork is not null and year(a.tanggal)=year(getdate()) and month(a.tanggal)=month(getdate())
				group by b.nama";
		$datawaktupenanganan = execute_query($query);
		return $datawaktupenanganan;
	}
	function FDataKomplainTerbuka(){
		$query = "SELECT b.Cabang,c.NamaCab,count(a.no) as jum
				from missue a 
				left join VPrev b on a.dari=b.NIK
				left join MCabang c on b.Cabang=c.Cab
				where a.TanggalSelesai is null and year(a.tanggal)>=2021
				group by b.Cabang,c.NamaCab
				order by b.Cabang asc";
		$data = execute_query($query);
		return $data;
	}
	function FDataHdDitangani(){
		// $query = "SELECT a.Nama,count(b.no) as jum
		// 		from VPrev a
		// 		left join (select * from missue 
		// 		where year(tanggalselesai)=year(getdate()) and month(tanggalselesai)=month(getdate()) and tanggalselesai is not null) b on a.NIK=b.Ditangani
		// 		where a.Status>=1 and cabang='P' and aktif=1
		// 		group by a.nama";
		$query = "SELECT a.nik,a.Nama,count(b.no) as jum,isnull(c.waktu,0) as waktu
				from VPrev a
				left join (select * from missue 
				where year(tanggalselesai)=year(getdate()) and month(tanggalselesai)=month(getdate()) and tanggalselesai is not null) b 
				on a.NIK=b.Ditangani
				LEFT JOIN (select ditangani,sum(waktu) as waktu from
				(select x.ditangani,DATEDIFF(minute, x.acceptwork, x.tanggalselesai)-isnull(y.totpaused,0) AS waktu
				from missue x
				left join vpause y on x.no=y.no
				where year(x.tanggalselesai)=year(getdate()) and month(x.tanggalselesai)=month(getdate()) 
				and x.tanggalselesai is not null) gg
				group by gg.ditangani) c on a.nik=c.ditangani
				where a.Status>=1 and cabang='P' and aktif=1
				group by a.nik,a.nama,c.waktu";
		$data = execute_query($query);
		return $data;
	}
	function FDataHdDitanganiFilter($jenis,$tanggalmulai,$tanggalsampai,$bulan,$tahun){
		// $query = "SELECT a.Nama,count(b.no) as jum
		// 		from VPrev a
		// 		left join (select * from missue 
		// 		where year(tanggalselesai)=year(getdate()) and month(tanggalselesai)=month(getdate()) and tanggalselesai is not null) b on a.NIK=b.Ditangani
		// 		where a.Status>=1 and cabang='P' and aktif=1
		// 		group by a.nama";
		if(str_replace(" ","",$jenis)=="bulanan"){
			if($bulan==99){			
				$kondisi = " year(tanggalselesai)=".$tahun."";
			}else{
				$kondisi = " year(tanggalselesai)=".$tahun." and month(tanggalselesai)=".$bulan."";
			}
		}else{
				// $tanggalmulai = 
				$kondisi = " (tanggalselesai between '".date_format(date_create($tanggalmulai),"Y/m/d")."' AND '".date_format(date_create($tanggalsampai),"Y/m/d")."')";
		}
		$query = "SELECT a.nik,a.Nama,count(b.no) as jum,isnull(c.waktu,0) as waktu
				from VPrev a
				left join (select * from missue 
				where $kondisi and tanggalselesai is not null) b 
				on a.NIK=b.Ditangani
				LEFT JOIN (select ditangani,sum(waktu) as waktu from
				(select x.ditangani,DATEDIFF(minute, x.acceptwork, x.tanggalselesai)-isnull(y.totpaused,0) AS waktu
				from missue x
				left join vpause y on x.no=y.no
				where $kondisi 
				and x.tanggalselesai is not null) gg
				group by gg.ditangani) c on a.nik=c.ditangani
				where a.Status>=1 and cabang='P' and aktif=1
				group by a.nik,a.nama,c.waktu";
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function FDataHdPreviFilter($nik,$jenis,$tanggalmulai,$tanggalsampai,$bulan,$tahun){
		// $query = "SELECT a.Nama,count(b.no) as jum
		// 		from VPrev a
		// 		left join (select * from missue 
		// 		where year(tanggalselesai)=year(getdate()) and month(tanggalselesai)=month(getdate()) and tanggalselesai is not null) b on a.NIK=b.Ditangani
		// 		where a.Status>=1 and cabang='P' and aktif=1
		// 		group by a.nama";
		if(str_replace(" ","",$jenis)=="bulanan"){
			if($bulan==99){			
				$kondisi = " year(a.tanggalselesai)=".$tahun."";
			}else{
				$kondisi = " year(a.tanggalselesai)=".$tahun." and month(a.tanggalselesai)=".$bulan."";
			}
		}else{
				// $tanggalmulai = 
				$kondisi = " (tanggalselesai between '".date_format(date_create($tanggalmulai),"Y/m/d")."' AND '".date_format(date_create($tanggalsampai),"Y/m/d")."')";
		}
		$query = "select a.no,convert(varchar(12),a.tanggal,105) as tanggal,b.nama as dari,c.namalaporan as jenis,d.namaaplikasi as program,
				e.nama as ditangani,a.issue as detail,a.tujuan,kategori,solusi,rating,
				DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)-isnull(f.totpaused,0) as waktu
				from missue a
				left join VPrev b on a.dari=b.nik
				left join mjlaporan c on a.jenis=c.lap
				left join maplikasi d on a.aplikasi=d.apl
				left join VPrev e on a.ditangani=e.nik
				left join vpause f on a.No=f.no
				WHERE $kondisi AND a.TanggalSelesai is not null AND a.ditangani='".$nik."'";
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function FDataJumKomplainTahun(){
		$query = "select count(no) as jum from missue where year(tanggal)=year(getdate())";
		$data = execute_query($query);
		return $data;
	}
	function FDataDetJumKomplainTahun(){
		$query = "SELECT a.No,convert(nchar(12),a.tanggal,105) as Tanggal,b.nama as Dari,a.issue as Komplain,
				a.Tujuan,a.Kategori,c.Nama as Ditangani,a.Solusi,DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)-isnull(d.totpaused,0) as 'Lama Pengerjaan'
				from missue a
				left join VPrev b on a.dari=b.NIK
				left join VPrev c on a.Ditangani=c.NIK
				left join vpause d on a.No=d.no
				where year(a.tanggal)=year(getdate())";
		$data = execute_query($query);
		return $data;
	}
	function getAlasanPJ($no){
		$query = "SELECT a.*,b.nama from MAlasanPJ a 
				LEFT JOIN VPrev b on a.dari=b.NIK where a.No='".$no."'";
		$data = execute_query($query);
		return $data;
	}
	function getAnalisisPJ($no){
		$query = "SELECT a.*,b.nama from MAnalisisPJ a 
				LEFT JOIN VPrev b on a.dari=b.NIK where a.No='".$no."'";
		$data = execute_query($query);
		return $data;
	}
	function FDataListJobInternal(){
		$query = "SELECT a.*,b.Nama as namadari,c.nama as namaditangani,
				isnull(DATEDIFF(minute,a.TanggalDitangani,a.TanggalSelesai)+isnull(d.totpaused,0),0) as waktupengerjaan
				from MJobHW a
				LEFT JOIN VPrev b on a.dari=b.NIK
				left join VPrev c on a.ditangani=c.NIK
				LEFT JOIN vpauseHW d on a.no=d.no";
		$data = execute_query($query);
		return $data;	
	}
	function getnewjobnumber(){
		$query = "select 'ITHW'+right('00000000000'+convert(varchar(11),isnull(max(right(no,11))+1,1)),11) as nomor from mjobhw";
		$data = execute_query($query);
		return $data;
	}
	function FDataEditInternalHW($nomor){
		$query = "SELECT *,case when ditangani is null then 0 else 1 end as valditangani
,case when tanggalselesai is null then 0 else 1 end as valselesai FROM mjobhw where no='".$nomor."'";
		$data = execute_query($query);
		return $data;
	}
	function getPauseJobHW($nomor){
		$query = "select * from mpauseHW where resumed is null and no='".$nomor."'";
		$data = execute_query($query);
		return $data;
	}
	function FDataListJobInternalFilter($bulan,$tahun){
		$kondisi = "";
		if($bulan=="All"){
			if($tahun=="All"){

			}else{
				$kondisi = " WHERE YEAR(a.tanggal)=".$tahun."";
			}
		}else{
			$kondisi = " WHERE MONTH(a.tanggal)=".$bulan."";
			if($tahun=="All"){

			}else{
				$kondisi .= " AND YEAR(a.tanggal)=".$tahun."";
			}
		}
		$query = "SELECT a.*,b.Nama as namadari,c.nama as namaditangani,
				isnull(DATEDIFF(minute,a.TanggalDitangani,a.TanggalSelesai)+isnull(d.totpaused,0),0) as waktupengerjaan
				,convert(varchar(12),Tanggal,105) as Tanggal2,convert(varchar(12),TanggalDitangani,105)+' '+convert(varchar(12),TanggalDitangani,108) as TanggalDitangani2
				,convert(varchar(12),TanggalSelesai,105)+' '+convert(varchar(12),TanggalSelesai,108) as TanggalSelesai2
				from MJobHW a
				LEFT JOIN VPrev b on a.dari=b.NIK
				left join VPrev c on a.ditangani=c.NIK
				LEFT JOIN vpauseHW d on a.no=d.no
				$kondisi";
		$data = execute_query($query);
		return $data;	
	}
	function FDataRatingMingguan(){
		$query = "select a.nik,a.nama,count(b.no) as jumlahissue,
				case when count(b.no)>0 then sum(case when c.NilaiRating is null then 1 else 0 end)else 0 end as belumdirating,
				sum(case when c.NilaiRating=1 then 1 else 0 end) as bintang1,
				sum(case when c.NilaiRating=2 then 1 else 0 end) as bintang2,
				sum(case when c.NilaiRating=3 then 1 else 0 end) as bintang3,
				sum(case when c.NilaiRating=4 then 1 else 0 end) as bintang4,
				sum(case when c.NilaiRating=5 then 1 else 0 end) as bintang5
				from VPrev a
				left join (select * from missue where tanggalselesai is not null and tanggal between (select tanggalmulai from vmingguterakhir) and (select tanggalsampai from vmingguterakhir)) b on a.nik=b.ditangani
				left join mrating c on b.No=c.No
				where a.status>=1 and a.aktif=1 
				group by a.nama,a.nik";
		$data = execute_query($query);
		return $data;
	}
	function FDataMingguTreakhir(){
		$query = "select convert(varchar(12),tanggalmulai,105) as tanggalmulai2,convert(varchar(12),tanggalsampai-1,105) as tanggalsampai2 from vmingguterakhir";
		$data = execute_query($query);
		return $data;
	}
	function FDataRekapHDMingguan(){
		$query = "select c.nik,c.nama,a.divisi,d.jumhd as jumhdlama,count(b.no) as jumlahhd,sum(case when b.tanggalselesai is null then 0 else 1 end) as  jumlahselesai,
			sum(case when b.tanggalselesai is null and b.no is not null then 1 else 0 end) as  jumlahbelumselesai 
			from mbagianhelpdesk a
			left join VRekapHDMingguanPusat b on a.noid=b.tanggungjawab and a.divisi=b.divisi
			left join VPrev c on a.noid=c.nik
			left join VRekapHDMingguanLamaPusat d on c.nama=d.nama and a.divisi=d.divisi
			group by c.nama,a.divisi,d.jumhd,c.nik
			order by c.nama asc";
		$data = execute_query($query);
		return $data;
	}
	function FDataRekapHDMingguanCab(){
		$query = "select c.nik,c.nama,a.cabang,d.jumhdlama,count(no) as jumlahhd,sum(case when b.tanggalselesai is not null then 1 else 0 end) as hdselesai,
			sum(case when b.tanggalselesai is null and no is not null then 1 else 0 end) as hdbelumselesai
			from MBagianHelpdeskCab a
			left join vrekaphdmingguancab b on a.noid=b.tanggungjawab and a.cabang=b.cabang
			left join VPrev c on a.noid=c.nik
			left join VRekapHDMingguanLamaCab d on c.nama=d.nama and a.cabang=d.cabang
			group by c.nama,a.cabang,d.jumhdlama,c.nik
			order by nama asc";
		$data = execute_query($query);
		return $data;
	}
	function FDataGetNoPengajuanBaru($kategori){
		//instruksi PATA : walaupun bulan berubah, hanya 3 digit belakang yg berubah
		$query = "select isnull('".$kategori."'+convert(varchar(2),right(year(getdate()),2))+right('00'+convert(varchar(2),month(getdate())),2)+right('000'+CONVERT(varchar(3),(RIGHT(max(right(no,3)),3)+1)),3),
 '".$kategori."'+convert(varchar(2),right(year(getdate()),2))+right('00'+convert(varchar(2),month(getdate())),2)+'001') as nomor
from pengajuan
where year(tanggal)=year(getdate()) and left(no,9)='".$kategori."'";
		$data = execute_query($query);
		return $data;	
	}
	function FDataLaporanHarian($mulai,$sampai){
		if($mulai!=''){
			$mulai = $mulai." 00:00:00";
			$sampai = $sampai." 23:59:59";
			$query = "select a.no,convert(varchar(12),a.tanggal,105) as tanggal,a.issue,a.tujuan,a.kategori,a.solusi,b.Nama as namadari,c.Nama as namaditangani,
				convert(varchar(12),a.TanggalKonfirmasi,105) as tanggalkonfirmasi,convert(varchar(12),a.AcceptWork,105) as acceptwork,convert(varchar(12),a.TanggalSelesai,105) as tanggalselesai,DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(d.totpaused,0) as lamapengerjaan,a.solusi
				from missue a
				left join VPrev b on a.dari=b.nik
				left join VPrev c on a.Ditangani=c.NIK
				left join vpause d on a.no=d.no
				where a.tanggalselesai between '".$mulai."' and '".$sampai."'";	
		}else{
			$query = "select a.no,convert(varchar(12),a.tanggal,105) as tanggal,a.issue,a.tujuan,a.kategori,a.solusi,b.Nama as namadari,c.Nama as namaditangani,
				convert(varchar(12),a.TanggalKonfirmasi,105) as tanggalkonfirmasi,convert(varchar(12),a.AcceptWork,105) as acceptwork,convert(varchar(12),a.TanggalSelesai,105) as tanggalselesai,DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(d.totpaused,0) as lamapengerjaan,a.solusi
				from missue a
				left join VPrev b on a.dari=b.nik
				left join VPrev c on a.Ditangani=c.NIK
				left join vpause d on a.no=d.no
				where year(a.tanggalselesai)=year(getdate()) and month(a.tanggalselesai)=month(getdate()) 
				and day(a.tanggalselesai)=day(getdate())";
		}		
		$data = execute_query($query);
		return $data;	
	}
	function FDataHDSelesaiPreview($nik){
		$query = "select a.*,convert(varchar(12),a.tanggal,105) as Tanggal2,convert(varchar(12),a.tanggalkonfirmasi,105) as TanggalKonfirmasi2,convert(varchar(12),a.tanggalselesai,105) as TanggalSelesai2,convert(varchar(12),a.acceptwork,105) as AcceptWork2,b.nama as namadari,DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(c.totpaused,0) as lamapengerjaan 
			from missue a
			left join VPrev b on a.dari=b.nik
			left join vpause c on a.no=c.no
			where a.tanggalselesai is not null and a.ditangani='".$nik."'
			and (a.tanggal between (select tanggalmulai from vmingguterakhir) and (select tanggalsampai from vmingguterakhir))";
		$data = execute_query($query);
		return $data;
	}
	function FDataPreviewHDSelesai($nohd){
		$query = "select * from missue";
		$data = execute_query($query);
		return $data;
	}
	function FDataHDSelesaiPreviewPusat($nik,$divisi){
		$query = "select a.*,convert(varchar(12),a.tanggal,105) as Tanggal2 ,convert(varchar(12),a.tanggalkonfirmasi,105) as TanggalKonfirmasi2
			,convert(varchar(12),a.acceptwork,105) as AcceptWork2,convert(varchar(12),a.TanggalSelesai,105) as TanggalSelesai2
			,isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,1 as baru
			From vrekaphdmingguanpusat a 
			left join vpause b on a.no=b.no
			where a.tanggungjawab='".$nik."' and a.divisi='".$divisi."'";	
		$data = execute_query($query);
		// echo $query;
		return $data;
	}
	function FDataHDSelesaiPreviewPusatLama($nik,$divisi){
		$query = "SELECT  convert(varchar(12),a.tanggal,105) as Tanggal2 ,convert(varchar(12),a.tanggalkonfirmasi,105) as TanggalKonfirmasi2
			,convert(varchar(12),a.acceptwork,105) as AcceptWork2,convert(varchar(12),a.acceptwork,105) as AcceptWork2,convert(varchar(12),a.TanggalSelesai,105) as TanggalSelesai2,a.solusi,d.tanggungjawab,d.divisi, a.No, a.Tanggal, a.issue, a.tujuan, 	  a.kategori, 
				b.Nama AS dari, c.Nama AS ditangani, b.Cabang, a.TanggalSelesai
				,isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(e.totpaused,0),0) as lamapengerjaan,0 as baru
				FROM    dbo.MIssue AS a LEFT OUTER JOIN
				dbo.VPrev AS b ON a.dari = b.NIK LEFT OUTER JOIN
				dbo.VPrev AS c ON a.Ditangani = c.NIK LEFT OUTER JOIN
				(SELECT x.noid AS tanggungjawab, y.noid,x.divisi
				FROM dbo.MBagianHelpdesk AS x LEFT OUTER JOIN
				dbo.VPegawaiDivisi AS y ON x.divisi = y.divisi) AS d ON a.dari = d.noid
				left join vpause e on a.no=e.no
				WHERE (b.Cabang = 'P') and a.aplikasi<>12 AND (a.Tanggal<(SELECT tanggalmulai FROM dbo.VMingguTerakhir) )
				and a.tanggalselesai is null and a.status is null and a.accPATA=1 and d.tanggungjawab='".$nik."' and divisi='".$divisi."'";
		$data = execute_query($query);
		// echo $query;
		return $data;
	}
	function FDataHDSelesaiPreviewCabang($nik,$cabang){
		$query = "select a.*,convert(varchar(12),a.tanggal,105) as Tanggal2 ,convert(varchar(12),a.tanggalkonfirmasi,105) as TanggalKonfirmasi2
			,convert(varchar(12),a.acceptwork,105) as AcceptWork2,convert(varchar(12),a.TanggalSelesai,105) as TanggalSelesai2
			,isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,1 as baru
			From vrekaphdmingguancab a 
			left join vpause b on a.no=b.no
			where a.tanggungjawab='".$nik."' and a.cabang='".$cabang."'";	
		$data = execute_query($query);
		return $data;
	}
	function FDataHDSelesaiPreviewCabangLama($nik,$cabang){
		$query = "SELECT a.tanggalkonfirmasi,a.acceptwork,a.solusi,c.tanggungjawab, a.No, a.Tanggal, a.issue, a.tujuan, 
				a.kategori, b.Nama AS dari, b.Cabang, a.TanggalSelesai,
				isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(d.totpaused,0),0) as lamapengerjaan,
				convert(varchar(12),a.tanggal,105) as Tanggal2,convert(varchar(12),a.TanggalKonfirmasi,105) as TanggalKonfirmasi2,
				convert(varchar(12),a.acceptwork,105) as AcceptWork2,convert(varchar(12),a.TanggalSelesai,105) as TanggalSelesai2
				FROM dbo.MIssue AS a LEFT OUTER JOIN
				dbo.VPrev AS b ON a.dari = b.NIK LEFT OUTER JOIN
				(SELECT y.noid AS tanggungjawab, x.NIK, x.Cabang
				FROM dbo.VPrev AS x LEFT OUTER JOIN
				dbo.MBagianHelpdeskCab AS y ON x.Cabang = y.cabang
				WHERE (x.Cabang <> 'P') AND (REPLACE(x.Cabang, ' ', '') <> '') AND (x.Cabang IS NOT NULL) AND (x.Cabang <> 'HO') AND (x.Cabang <> 'PR')) AS c ON a.dari = c.NIK
				LEFT JOIN VPause d on a.no=d.no
				WHERE (a.Tanggal<(SELECT tanggalmulai FROM dbo.VMingguTerakhir)) AND (b.Cabang='".$cabang."') and a.accpata=1 and a.tanggalselesai is null
				and a.aplikasi<>12 and c.tanggungjawab='".$nik."'";
		$data = execute_query($query);
		// echo $query;
		return $data;
	}
	function FDataListHD90($bulan,$tahun){
		$kondisibulan = "";
		$kondisitahun = "";
		if(str_replace(" ","",$bulan)!="" && strtoupper(str_replace(" ","",$bulan))!="ALL"){
			$kondisibulan = " AND month(a.tanggal)='".$bulan."'";
		}
		if(str_replace(" ","",$tahun)!="" && strtoupper(str_replace(" ","",$tahun))!="ALL"){
			$kondisitahun = " AND year(a.tanggal)='".$tahun."'";
		}
		$query = "SELECT a.*,b.nama as namadari,c.nama as namaditangani,case when datediff(minute,a.acceptwork,a.TanggalSelesai)-isnull(d.totpaused,0)<1 then convert(varchar(10),datediff(second,a.acceptwork,a.TanggalSelesai)-(isnull(d.totpaused,0)*60))+' Detik' else convert(varchar(10),datediff(minute,a.acceptwork,a.TanggalSelesai)-isnull(d.totpaused,0))+' menit' end as waktupengerjaan,
		ISNULL((
		      select case Lap
		        when Lap then NamaLaporan else '' end as Jenis2
		      	from MJLaporan where Lap=a.Jenis), a.Jenis) as Jenis2,
				case when isnull(a.tanggalselesai,0)=0 then 0 else 1 end as statusdone,
				case when isnull(a.ditangani,0)=0 then 0 else 1 end as statusditangani
				FROM missue a 
				LEFT JOIN absen_new.dbo.pegawai b on a.dari=b.noid
				LEFT JOIN absen_new.dbo.pegawai c on a.ditangani=c.noid
				LEFT JOIN vpause d on a.no=d.no 
				where a.jenis>90 $kondisibulan $kondisitahun order by a.no asc";
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
?>	