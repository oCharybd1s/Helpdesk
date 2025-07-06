<?php
	@include('../../action/GetData.php');
	$namefile = "waiteditpj_filter";
	echo "<script> console.log('HELPDESK : ".$namefile."'); </script>";
  	$getWaitPengajuan = getDataPengajuan($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'waiteditpj');
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
  	<thead>
        <tr>
           	<th>No</th>
            <th>Tanggal Buat</th>
            <th>Dari</th>                            
            <th>Cabang</th>
            <th>Nama Investasi</th>  
            <th>Biaya</th>
            <th>Jadwal</th>   
            <th>Alasan</th>
        </tr>
  	</thead>
	<tbody>
		<?php
			for($i=0; $i<count($getWaitPengajuan); $i++){
		?>
    			<tr>
					<td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getWaitPengajuan[$i]['No']?></a></td> <!---No--->
					<td><?php echo date_format($getWaitPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
					<td><?php echo $getWaitPengajuan[$i]['dari2'];?></td> <!---Dari--->
					<td><?php echo $getWaitPengajuan[$i]['cabang'];?></td> <!---Cabang--->
					<td><?php echo $getWaitPengajuan[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
					<td><?php echo number_format($getWaitPengajuan[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
					<td><?php echo $getWaitPengajuan[$i]['jadwal'];?></td> <!---Jadwal--->
					<td><?php echo wordwrap($getWaitPengajuan[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
				</tr>
	  	<?php
	  		}
	  	?>
	</tbody>
</table>
<script type="text/javascript">
	$('#datatable').dataTable({
		"bDestroy": true,
		'order': [[ 1, 'asc' ]],
		"stateSave": true,
	});
</script>