<?php
	include_once("../modul.php");
	function getMenu($statusLogin){
		if($statusLogin==0){ //Non IT
			$query = "Select * from MMenu where (status = 1 or status = 9) and level = 1 order by idmenu*1 asc";
		}else if($statusLogin==1){ //Staff IT
			$query = "Select * from MMenu where (status = 1 or status = 9) and levelIT = 1 order by idmenu*1 asc";
		}else if($statusLogin==2){ //PATA
			$query = "Select * from MMenu where (status = 1 or status = 9) and levelPATA = 1 order by idmenu*1 asc";
		}
		$data = execute_query($query);
		return $data;
	}
	function getSubMenu($statusLogin){
		if($statusLogin==0){ //Non IT
			$query = "Select * from MMenu where status = 2 and level = 1";
		}else if($statusLogin==1){ //Staff IT
			$query = "Select * from MMenu where status = 2 and levelIT = 1";
		}else if($statusLogin==2){ //PATA
			$query = "Select * from MMenu where status = 2 and levelPATA = 1";
		}
		$query .= " order by case when len(idmenu)<4 then replace(idmenu,'.','.0') else cast(idmenu as numeric(10,2)) end asc";
		$data = execute_query($query);
		return $data;
	}
	function getDataDetailPegawai($nik){
		$query = "select * from VPrev where nik='".$nik."'";
		$data = execute_query($query);
		return $data;
	}
	function getjumDimintaDikerjakan(){
		$query = "Select count(no) as jumlah from missue where status is null and accPATA = 1 and OfferDitangani = '".$_SESSION['siapa']."' and TanggalSelesai is null and (ditangani is null or ditangani = '')";
		$data = execute_query($query);
		return $data;
	}
	function getjumSedangDikerjakan(){
		if($_SESSION['jabatan']==2){
			$query = "Select count(no) as jumlah from missue where status = '0' and tanggalselesai is null and accPATA=1 and offerditangani is null";
		}else {
			$query = "Select count(no) as jumlah from missue where status = '0' and tanggalselesai is null and accPATA=1 and ditangani ='".$_SESSION['siapa']."'";
		}
		$data = execute_query($query);
		return $data;
	}
	function getjumBelumDitangani(){
		// $query = "Select count(no) as jumlah from missue where status is null and accpata=1  and (ditangani='' or ditangani is null)";
		$query = "Select count(no) as jumlah from missue where Aplikasi<>12 and status is null and accpata=1  and (ditangani='' or ditangani is null)";
		$data = execute_query($query);
		return $data;
	}
	function getjumBelumDitanganiSAP(){
		// Khusus SAP
		$query = "Select count(no) as jumlah from missue where Aplikasi=12 and status is null and accpata=1  and (ditangani='' or ditangani is null)";
		$data = execute_query($query);
		return $data;
	}

	function getjumBelumDitanganiJOB() {
		// Khusus JOB IT
		$query = "Select count(no) as jumlah from missue where Jenis>90 and status is null and accpata=1  and (ditangani='' or ditangani is null)";
		$data = execute_query($query);
		return $data;
	}

	function getcountSolved(){
		if($_SESSION['jabatan']==2){
			$query = "select count(No) as jum from MIssue where Month(TanggalSelesai)=Month(getdate()) and Year(TanggalSelesai)=Year(getdate())";
		}else {
			$query = "select count(No) as jum from MIssue where Month(TanggalSelesai)=Month(getdate()) and Year(TanggalSelesai)=Year(getdate()) and Ditangani='".$_SESSION['siapa']."'";
		}
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function getdatasolved(){
		if($_SESSION['jabatan']==2){
			$query ="select a.*,convert(varchar(12),tanggal,105) as Tanggal2,convert(varchar(12),tanggalkonfirmasi,105) as TanggalKonfirmasi2
				,convert(varchar(12),acceptwork,105) as AcceptWork2
				,convert(varchar(12),TanggaLSelesai,105) as TanggalSelesai2
				,isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,c.cabang
				from missue a
				left join vpause b on a.no=b.no
				left join VPrev c on a.dari=c.nik 
				where year(TanggalSelesai)=year(getdate()) and month(TanggalSelesai)=month(getdate())";
		}else{
			$query ="select a.*,convert(varchar(12),tanggal,105) as Tanggal2,convert(varchar(12),tanggalkonfirmasi,105) as TanggalKonfirmasi2
			,convert(varchar(12),acceptwork,105) as AcceptWork2
			,convert(varchar(12),TanggaLSelesai,105) as TanggalSelesai2
			,isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,c.cabang
			from missue a
			left join vpause b on a.no=b.no
			left join VPrev c on a.dari=c.nik
			where year(TanggalSelesai)=year(getdate()) and month(TanggalSelesai)=month(getdate()) and Ditangani='".$_SESSION['siapa']."'";
		}
		// echo $query;
		$data = execute_query($query);
		return $data;
	}
	function getdataontime(){
		if($_SESSION['jabatan']==2){
			$kondisi = "";
		}else{
			$kondisi = " AND a.ditangani='".$_SESSION['siapa']."'";
		}
		$query = "select a.*,convert(varchar(12),tanggal,105) as Tanggal2,convert(varchar(12),tanggalkonfirmasi,105) as TanggalKonfirmasi2 ,
			convert(varchar(12),acceptwork,105) as AcceptWork2 ,convert(varchar(12),TanggaLSelesai,105) as TanggalSelesai2 ,
			isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,c.cabang 
			from missue a left join 
			vpause b on a.no=b.no left join 
			VPrev c on a.dari=c.nik 
			where year(TanggalSelesai)=year(getdate()) and month(TanggalSelesai)=month(getdate())
			and a.estit>=isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) $kondisi";
		$data = execute_query($query);
		return $data;
	}
	function getdataovertime(){
		if($_SESSION['jabatan']==2){
			$kondisi = "";
		}else{
			$kondisi = " AND a.ditangani='".$_SESSION['siapa']."'";
		}
		$query = "select a.*,convert(varchar(12),tanggal,105) as Tanggal2,convert(varchar(12),tanggalkonfirmasi,105) as TanggalKonfirmasi2 ,
			convert(varchar(12),acceptwork,105) as AcceptWork2 ,convert(varchar(12),TanggaLSelesai,105) as TanggalSelesai2 ,
			isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,c.cabang 
			from missue a left join 
			vpause b on a.no=b.no left join 
			VPrev c on a.dari=c.nik 
			where year(TanggalSelesai)=year(getdate()) and month(TanggalSelesai)=month(getdate())
			and a.estit<isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) and a.status=1 $kondisi";
		$data = execute_query($query);
		return $data;
	}
	function getdataonprogress(){
		if($_SESSION['jabatan']==2){
			$kondisi = "";
		}else{
			$kondisi = " AND a.ditangani='".$_SESSION['siapa']."'";
		}
		$query = "select a.*,convert(varchar(12),tanggal,105) as Tanggal2,convert(varchar(12),tanggalkonfirmasi,105) as TanggalKonfirmasi2 ,
			convert(varchar(12),acceptwork,105) as AcceptWork2 ,convert(varchar(12),TanggaLSelesai,105) as TanggalSelesai2 ,
			isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0) as lamapengerjaan,c.cabang 
			from missue a left join 
			vpause b on a.no=b.no left join 
			VPrev c on a.dari=c.nik 
			where  a.TanggalSelesai is NULL and a.accPata = 1 and a.ditangani is not null and a.status = 0 $kondisi";
		$data = execute_query($query);
		return $data;
	}
	function getcountOnTime(){
		if($_SESSION['jabatan']==2){
			$query = "select count(a.No) as jum from MIssue a left join vpause b  on a.no=b.no
					where Month(TanggalSelesai)=Month(getdate()) and Year(TanggalSelesai)=Year(getdate()) 
					and isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0)<=EstIT and status = 1";
		}else {
			$query = "select count(a.No) as jum from Missue a left join vpause b  on a.no=b.no 
					where Month(TanggalSelesai)=Month(getdate()) and Year(TanggalSelesai)=Year(getdate()) 
					and isnull(DATEDIFF(minute,a.AcceptWork,a.TanggalSelesai)+isnull(b.totpaused,0),0)<=EstIT and Ditangani='".$_SESSION['siapa']."' and status = 1";
		}
		$data = execute_query($query);
		return $data;
	}
	function getcountOverTime(){
		if($_SESSION['jabatan']==2){
			$query = "select count(No) as jum from MIssue where Month(TanggalSelesai)=Month(getdate()) and year(TanggalSelesai)=year(getdate()) and datediff(minute,AcceptWork,TanggalSelesai)>EstIT and status = 1";
		}else {
			$query = "select count(No) as jum from MIssue where Month(TanggalSelesai)=Month(getdate()) and year(TanggalSelesai)=year(getdate()) and datediff(minute,AcceptWork,TanggalSelesai)>EstIT and Ditangani='".$_SESSION['siapa']."' and status = 1";
		}
		$data = execute_query($query);
		// echo $query;
		return $data;
	}
	function getcountOnProgress(){
		if($_SESSION['jabatan']==2){
			$query = "select count(No) as jum from MIssue where TanggalSelesai is NULL and accPata = 1 and ditangani is not null and status = 0";
		}else {
			$query = "select count(No) as jum from MIssue where TanggalSelesai is NULL and accPata = 1 and Ditangani='".$_SESSION['siapa']."'";
		}
		$data = execute_query($query);
		return $data;
	}
	function getcountTotalComplain(){
		$query = "select count(No) as jum from MIssue where TanggalSelesai is null and Konfirmasi !=2 and Year(Tanggal)=Year(getdate()) and dari='".$_SESSION['siapa']."'";
		$data = execute_query($query);
		return $data;
	}
	function getcountTotalComplainDibuat(){
		$query = "select count(No) as jum from MIssue where dari='".$_SESSION['siapa']."' AND year(tanggal)='".date('Y')."'";
		$data = execute_query($query);
		return $data;
	}
	function getcountComplainDone(){
		$query = "select count(No) as jum from MIssue where Month(Tanggal)=Month(getdate()) and Year(Tanggal)=Year(getdate()) and tanggalselesai is not null and dari='".$_SESSION['siapa']."'";
		$data = execute_query($query);
		return $data;
	}
	function getcountComplainDoneRingkasan(){
		$query = "select count(No) as jum from MIssue where Year(Tanggal)='".date('Y')."' and tanggalselesai is not null and dari='".$_SESSION['siapa']."'";
		$data = execute_query($query);
		return $data;
	}
	function getcountComplainTerbukaAll(){
		$query = "select count(No) as jum from MIssue where tanggalselesai is null and dari='".$_SESSION['siapa']."'  and accPATA != 2";
		$data = execute_query($query);
		return $data;
	}
	function getcountComplainRejected(){
		$query = "select count(No) as jum from MIssue where Month(Tanggal)=Month(getdate()) and year(Tanggal)=year(getdate()) and accPATA='2' and  dari='".$_SESSION['siapa']."'";
		$data = execute_query($query);
		return $data;
	}
	function getcountPengajuan(){
		$query = "select count(nomor) as jum from (select no as nomor from mpengajuan where konfirmasi = 0 and year(Tanggal)=year(getdate()) and dari = '".$_SESSION['siapa']."' union select no as nomor from pengajuan where  year(Tanggal)=year(getdate()) and dari = '".$_SESSION['siapa']."') as jumlahPengajuan";
		$data = execute_query($query);
		return $data;
	}
	function getjumjumverifHD(){
		$query = "select count(No) as jum from MIssue where accPATA='0'";
		$data = execute_query($query);
		return $data;
	}
	function getjumjumverifPeng(){
		$query = "select count(No) as jum from pengajuan where konfirmasi = 0 and tanggalkonfirmasi is null";;
		$data = execute_query($query);
		return $data;
	}
	
	function getYearlyProgress(){
		$tsqlgf = "select '01' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='1' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '02' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='2' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '03' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='3' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '04' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='4' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '05' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='5' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '06' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='6' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '07' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='7' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '08' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='8' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '09' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='9' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '10' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='10' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '11' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='11' and thn=year(getdate()) union ";
	    $tsqlgf .= "select '12' as bln, case count(jum) when 0 then 0 else sum(jum) end as juml from VGraf where bln='12' and thn=year(getdate()) ";
	    $data = execute_query($tsqlgf);
		return $data;
	}
	function getjumPengajuanBaru(){
		$query = "select count(No) as jumlah from mpengajuan where tanggalkonfirmasi is null and konfirmasi=0";
		$data = execute_query($query);
		return $data;
	}
	function getjumTungguAccPATA(){
		$query = "select count(No) as jumlah from pengajuan where tanggalkonfirmasi is null and konfirmasi=0";
		$data = execute_query($query);
		return $data;
	}
	function getjumPengajuanSiap(){
		$query = "select count(No) as jumlah from pengajuan where tanggalkonfirmasi is not null and konfirmasi=1 and tanggalselesai is null and no in (select nopeng from vpengajuansiap)";
		$data = execute_query($query);
		return $data;
	}
	function getjumPengajuanBerjalan(){
		$kondisi = "";
		if($_SESSION["divisi"]!="IT"){
			$kondisi = " AND dari='".$_SESSION['siapa']."'";
		}
		$query = "select count(No) as jumlah from pengajuan where tanggalkonfirmasi is not null and konfirmasi=1 and tanggalselesai is null and no in (select nopeng from vpengajuanberjalan) $kondisi";
		$data = execute_query($query);
		return $data;
	}
	function getjumPengajuanSelesai(){
		$query = "select count(No) as jumlah from pengajuan where tanggalkonfirmasi is not null and konfirmasi=1 and tanggalselesai is not null";
		$data = execute_query($query);
		return $data;
	}
	function getjumjumpinjamhardware(){
		$query = "select count(nopinjam) as jumlah from thpinjam where isnull(idpemberipinjaman,'')<>''";
		$data = execute_query($query);
		return $data;
	}
	function getjumVerifikasiHD(){
		
	}
	function getjumVerifikasiPengajuan(){
		
	}
	function getStatsPATA(){
		$query = "Select MPATA from MAtP";
		$data = execute_query($query);
		return $data;
	}
	function changePATA($status){
		if($status==0){
			$query = "update MMenu set icon='fa fa-toggle-off' where nmmenu='Auto Pilot'";
			execute_query($query);
		}else if($status==1){
			$query = "update MMenu set icon='fa fa-toggle-on' where nmmenu='Auto Pilot'";
			execute_query($query);
		}
		$query = "update MAtP set MPATA=".$status;
		execute_query($query);
	}
	function updateProfile($id,$nickname,$paswot,$gambar){
		if($gambar =='Belum'){
			$query = "update VPrev set nickname='".$nickname."', password='".$paswot."' where nik='".$id."'";
			execute_query($query);
		}else{
			$query = "update VPrev set gambar='".$gambar."' where nik='".$id."'";
			execute_query($query);
		}
		
	}
?>