 <?php
	@include("../modul.php");
	function getDataLaporanAllp(){
		$query = "select i.ditangani,p.nama, sum(case when tanggalselesai is not null then 1 else 0 end ) as selesai,
			sum(case when tanggalselesai is null then 1 else 0 end ) as progress, 
			sum(case when tanggalselesai is null then 1 else 1 end ) as total
			from MISSUE i, VPrev p
			where year(i.tanggal) = 2018 and month(i.tanggal) = 11 and i.ditangani is not null and  i.ditangani !='          ' and i.ditangani = p.nik
			group by i.ditangani, p.nama
			union 
			select '999999' as ditangani, '<b>Grand Total</b>' as nama, sum(case when tanggalselesai is not null then 1 else 0 end ) as selesai,
			sum(case when tanggalselesai is null then 1 else 0 end ) as progress,  sum(case when tanggalselesai is null then 1 else 1 end ) as total
			from missue i
			where year(i.tanggal) = 2018 and month(i.tanggal) = 11 and i.ditangani is not null and  i.ditangani !='' 
			order by i.ditangani";
		$data = execute_query($query);
		return $data;
	}
?>	