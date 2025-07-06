<?php
// untuk login sudah menggunakan loginglobal sari HRIS
	include_once("../modul.php");
	function cekLogin($user, $pass){
		// $query = "Select c.namacab,p.* from VPrev p, mcabang c where p.NIK='".$user."' and p.password = '".$pass."' and p.aktif = 1 and p.cabang=c.cab";
		//echo $query;
		$query = "Select c.namacab,p.*,e.nama_dept as divisi
					from VPrev p left join mcabang c on p.cabang=c.cab
					left join HRIS_MAGANG.dbo.mPegawai d on p.nik=d.emp_no
					left join HRIS_MAGANG.dbo.mDepartment e on d.id_dept=e.id_dept
					where p.NIK='".$user."' and p.aktif = 1 and p.cabang=c.cab";
		$data = execute_query($query);
		return $data;
	}

	function cekUserHelpdesk($user)
	{
		$query = "Select c.namacab,p.*,e.nama_dept as divisi
					from VPrev p left join mcabang c on p.cabang=c.cab
					left join HRIS_MAGANG.dbo.mPegawai d on p.nik=d.emp_no
					left join HRIS_MAGANG.dbo.mDepartment e on d.id_dept=e.id_dept
					where p.NIK='".$user."' and p.aktif = 1 and p.cabang=c.cab";
		$data = execute_query($query);
		return $data;
		// echo $query;
	}
	function lastLogin($user, $pass){
		$query = "update MPrev set lastlogin=getdate() where nik='".$user."' and password='".$pass."'";
		$data = execute_query($query);
		$querySebelum = str_replace("'"," ",$query);
		$queryLog = "insert into mlog ([NIK],[activity],[tanggal]) values ('".$_SESSION['siapa']."','".$querySebelum."',getdate())";
		execute_query($queryLog);
		return $data;
		// echo $queryLog;
	}

	function getDaftarBawahan($id) {
		
	}
?>