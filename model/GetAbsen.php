<?php
	@include("../modul.php");
	function getDataAbsen($idhd,$currentMonth,$currentYear){
		$systemini = read_ini_file();
		// $query = "select *, 
		// 			LEFT(CAST(DATEADD(minute,(CASE
		// 				WHEN (CAST(right(jkeluar,2) AS integer)-CAST(right(jmasuk,2) AS integer)) < 0 
		// 				THEN
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)-1) * 60) + (CAST(right(jkeluar,2) as integer)+60 - CAST(right(jmasuk,2) as integer))
		// 				ELSE 
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)) * 60) + (CAST(right(jkeluar,2) as integer) - CAST(right(jmasuk,2) as integer))
		// 			END),114) as TIME),5) as jamkerja, jamstandartmasuk
		// 			from ".$systemini["ABSENDB"].".dbo.absensi left join ".$systemini["ABSENDB"].".dbo.AA_StandartMasuk on date = datestandart 
		// 			where noid='".$idhd."' and Month(date)=".$currentMonth." and Year(date)=".$currentYear." order by date";

		//di disable karna ada parameter cabang yang tidak terkirim
		// $query = "EXEC ".$systemini["ABSENDB"].".dbo.GetDataAbsensiALL '".$idhd."',".$currentMonth.",".$currentYear;
		$query = "EXEC ".$systemini["ABSENDB"].".dbo.NewGetDataAbsensiALL '".$idhd."',".$currentMonth.",".$currentYear;
		$data = execute_query($query);
		return $data;
	}

	function getDataAbsenP($idhd,$currentMonth,$currentYear){
		$systemini = read_ini_file();
		// $query = "select *, 
		// 			LEFT(CAST(DATEADD(minute,(CASE
		// 				WHEN (CAST(right(jkeluar,2) AS integer)-CAST(right(jmasuk,2) AS integer)) < 0 
		// 				THEN
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)-1) * 60) + (CAST(right(jkeluar,2) as integer)+60 - CAST(right(jmasuk,2) as integer))
		// 				ELSE 
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)) * 60) + (CAST(right(jkeluar,2) as integer) - CAST(right(jmasuk,2) as integer))
		// 			END),114) as TIME),5) as jamkerja, jamstandartmasuk
		// 			from ".$systemini["ABSENDB"].".dbo.absensi left join ".$systemini["ABSENDB"].".dbo.AA_StandartMasuk on date = datestandart 
		// 			where noid='".$idhd."' and Month(date)=".$currentMonth." and Year(date)=".$currentYear." order by date";
		$query = "EXEC ".$systemini["ABSENDB"].".dbo.GetDataAbsensi '".$idhd."',".$currentMonth.",".$currentYear;
		$data = execute_query($query);
		return $data;
	}

	function getDataAbsenGdg($currentMonth, $currentYear) {
		$systemini = read_ini_file();
		// $query = "select *, 
		// 			LEFT(CAST(DATEADD(minute,(CASE
		// 				WHEN (CAST(right(jkeluar,2) AS integer)-CAST(right(jmasuk,2) AS integer)) < 0 
		// 				THEN
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)-1) * 60) + (CAST(right(jkeluar,2) as integer)+60 - CAST(right(jmasuk,2) as integer))
		// 				ELSE 
		// 					((CAST(left(jkeluar,2) AS integer)-CAST(left(jmasuk,2) AS integer)) * 60) + (CAST(right(jkeluar,2) as integer) - CAST(right(jmasuk,2) as integer))
		// 			END),114) as TIME),5) as jamkerja, jamstandartmasuk
		// 			from ".$systemini["ABSENDB"].".dbo.absensi left join ".$systemini["ABSENDB"].".dbo.AA_StandartMasuk on date = datestandart 
		// 			where noid='".$idhd."' and Month(date)=".$currentMonth." and Year(date)=".$currentYear." order by date";
		$query = "EXEC ".$systemini["ABSENDB"].".dbo.GetDataAbsensiGdg ".$currentMonth.",".$currentYear;
		$data = execute_query($query);
		return $data;
	}

	function getUangExtra($id) {
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["HRIS"].".dbo.mUangExtra where emp_no='".$id."'";
		$data = execute_query($query);
		return $data;
	}

	function getDataTerlambat($idhd){
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["ABSENDB"].".dbo.absensi where noid='".$idhd."' and ket='B' and Month(date)=Month(getdate()) and Year(date)=Year(getdate())";
		$data = execute_query($query);
		return $data;
	}
	function getDataCutiMassal($tahunini){
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["ABSENDB"].".dbo.cutinas where tahun='".$tahunini."' order by tgl asc";
		$data = execute_query($query);
		return $data;
	}
	function getDataCutiBersama($tahunini){
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["ABSENDB"].".dbo.cutinas where tahun='".$tahunini."' and alasan='C' order by tgl asc";
		$data = execute_query($query);
		return $data;
	}
	function getDataCutiAnda($noid,$tahunini){
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["ABSENDB"].".dbo.cuti where tahun='".$tahunini."' and noid='".$noid."' order by tgl asc";
		$data = execute_query($query);
		return $data;
	}
	function getDataCutiC($noid,$tahunini){
		$systemini = read_ini_file();
		$query = "select * from ".$systemini["ABSENDB"].".dbo.cuti where tahun='".$tahunini."' and noid='".$noid."' and gol='C' order by tgl asc";
		$data = execute_query($query);
		return $data;
	}
?>	