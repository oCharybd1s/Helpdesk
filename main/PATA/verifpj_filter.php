<?php
  @include('../../action/GetData.php');
  $getWaitVerifPATAPengajuan = getDataPengajuan($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'waitverifpj');
?>
	        <table id="datatablefilter" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               	<th>No</th>
                        <th>Tanggal Buat</th>
                        <th>Dari</th>                            
                        <th>Cabang</th>
                        <th>Nama Investasi</th>  
                        <th>Biaya</th>
                        <th>Jadwal</th> 
		               	<th>Konfirm</th>  
                        <th>Alasan</th>
                        <th>Analisis</th>  
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getWaitVerifPATAPengajuan); $i++){
					?>
			    			<tr>
								<td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getWaitVerifPATAPengajuan[$i]['No']?></a></td> <!---No--->
								<td><?php echo date_format($getWaitVerifPATAPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['cabang'];?></td> <!---Cabang--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
								<td><?php echo number_format($getWaitVerifPATAPengajuan[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['jadwal'];?></td> <!---Jadwal--->
								<td>
									<input id="reject" type="button" class="btn btn-danger btn-reject btnReject" value="Tolak" onclick="reject('<?php echo $i;?>')" />
									<input id="confirm" type="button" class="btn btn-success btn-confirm" value="Terima" onclick="confirm('<?php echo $i;?>')" />
								</td>
								<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
								<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['analisis'],120,"<br />") ?></td> <!---Analisis--->
							</tr>
				  	<?php
				  		}
				  	?>
				</tbody>
	        </table>
	   <script type="text/javascript">$('#datatablefilter').DataTable();</script>