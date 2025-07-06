<?php
  @include('../../action/GetData.php');
  echo "<script> console.log('HELPDESK : waitverifpj_filter') </script>";
  $getWaitVerifPATAPengajuan = getDataPengajuan($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'waitverifpj');
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
              <th>Status</th>
              <th>Alasan</th>
              <th>Analisis</th>
              <th>Penjelasan</th>    
              <th>Tanggal Konfirmasi</th>
              <th>Tanggal Selesai</th> 
      </tr>
  	</thead>
	<tbody>
		<?php
			for($i=0; $i<count($getWaitVerifPATAPengajuan); $i++){
		?>
	  			<tr>
					<td id="idpj<?php echo $i;?>"><a href="#" onclick="goEdit('<?php echo $i;?>')"><?php echo $getWaitVerifPATAPengajuan[$i]['No']?></a></td> <!---No--->
					<td><?php echo date_format($getWaitVerifPATAPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['dari2'];?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['cabang'];?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['namainvestasi'];?></td>
					<td><?php echo number_format($getWaitVerifPATAPengajuan[$i]['biaya'],0,'.','.');?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['jadwal'];?></td>
					<td class="mycenter"> 
						<?php
	                              if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=='0'){
	                                	echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
	                              }else if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=="1"){
	                                  echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
	                              }else if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=="2"){
	                                  echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
	                              }
	                        	?>
					</td>
					<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['alasan'],120,"<br />") ?></td>
					<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['analisis'],120,"<br />") ?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['ket']?></td>
					<td><?php echo $getWaitVerifPATAPengajuan[$i]['tanggalkonfirmasi']?></td>
					<td>
						<?php
	                              if($getWaitVerifPATAPengajuan[$i]['tanggalselesai']==''){
	                                  echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
	                              }else{
	                                	echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">'.$getWaitVerifPATAPengajuan[$i]['tanggalselesai'];
	                              }
	                        	?>
					</td>
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