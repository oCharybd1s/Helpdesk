<?php
	@include("../../modul.php");
	function getNoPJ($cabang){
		//berdasarkan revisi helpdesk di clickup
		//no Pengajuan diubah. menjadi dari Januari - Desember urut. Contoh : HR-ITY-1-2101001 , HR-ITY-1-2102002, HR-ITY-1-2103003. Yang sekarang kembali ke 1 pada bulan baru
		//berlaku mulai tahun 2022
		if(date('Y')>=2022){
			$query = "select top 1(SUBSTRING(no,12,3) + 1) as no from mpengajuan where substring(no,8,2)='".date('y')."' and substring(no,6,1)='".$cabang."' order by no desc";
		}else
		{
			$query = "select top 1(SUBSTRING(no,12,3) + 1) as no from mpengajuan where substring(no,8,2)='".date('y')."' and substring(no,10,2)='".date('m')."' and substring(no,6,1)='".$cabang."' order by no desc";
		}		
		$data = execute_query($query);
		return $data;
	}
?>	