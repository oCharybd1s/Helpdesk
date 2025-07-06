<?php
echo "<script> console.log('HELPDESK : verifhd_filter') </script>";
@include('../../action/GetData.php');
  $getHelpdesk = getDataHelpdesk($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter']);
?>
	        <table id="datatable" class="table table-striped table-bordered dt-responsive" style="width: 100%">
	          	<thead>
		            <tr>
		               <th>No</th>
		               <th>Tanggal</th>
		               <th>Dari</th>
		               <th>Tujuan</th>
		               <th>Jenis Laporan</th>
		               <th>Program</th>
		               <th>Waktu</th>
		               <th>Konfirm</th>
		               <th>Detail</th>
		               <th>Kategori</th>
		               <th>Diinput Oleh</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getHelpdesk); $i++){
					?>
			    			<tr>
								<td id="idhdpata<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getHelpdesk[$i]['No']?></a></td>
								<td><?php echo $getHelpdesk[$i]['Tgl2']?></td>
								<td><?php echo $getHelpdesk[$i]['dariNama']?></td>
								<td>
									<select id="kehendak<?php echo $i; ?>" name="kehendak<?php echo $i; ?>" class="form-control">
				                	<option value="All" <?php if(str_replace(" ","",$getHelpdesk[$i]['tujuan'])!="Request" && str_replace(" ","",$getHelpdesk[$i]['tujuan'])!="Komplain"){ ?> Selected <?php } ?>>All</option>
					    			<option value="Komplain" <?php if(str_replace(" ","",$getHelpdesk[$i]['tujuan'])=="Komplain"){ ?> Selected <?php } ?>>Komplain</option>
					    			<option value="Request" <?php if(str_replace(" ","",$getHelpdesk[$i]['tujuan'])=="Request"){ ?> Selected <?php } ?>>Request</option>
							  	</select>
						  	</td>
								<td>
									<select id="jenisLaporan<?php echo $i;?>" name="jenisLaporan<?php echo $i;?>" class="form-control">
									  	<?php for($j=0; $j<count($jenisLaporan); $j++){ ?>
								    			<option value="<?php echo $jenisLaporan[$j]['Lap']?>" <?php if($jenisLaporan[$j]['NamaLaporan']==$getHelpdesk[$i]['Jenis2']){?> selected <?php } ?> ><?php echo $jenisLaporan[$j]['NamaLaporan']?></option>
									  	<?php } ?>
									 </select>
								</td>
								<td>
									<select id="programYangDimaksud<?php echo $i;?>" name="programYangDimaksud<?php echo $i;?>" class="form-control">
									  	<?php for($j=0; $j<count($jenisAplikasi); $j++){ ?>
								    			<option value="<?php echo $jenisAplikasi[$j]['Apl']?>" <?php if($jenisAplikasi[$j]['Apl']==$getHelpdesk[$i]['Aplikasi']){?> selected <?php } ?> ><?php echo $jenisAplikasi[$j]['NamaAplikasi']?></option>
									  	<?php } ?>
								  	</select>
								</td>
								<td>
									<input class="form-control col-md-7 col-xs-12" size="3" id="estimasiPATA<?php echo $i;?>" name="estimasiPATA<?php echo $i;?>" type="text" value="<?php echo $getHelpdesk[$i]['EstPATA']?>">
								</td>
								<td width="50px">
									<input id="confirm" type="button" class="btn btn-success btn-confirm" value="OK" onclick="confirm('<?php echo $i;?>')" />
									<input id="reject" type="button" class="btn btn-danger btn-reject btnReject" value="REJECT" onclick="reject('<?php echo $i;?>')" />
								</td>
								<td><?php echo $getHelpdesk[$i]['issue']?></td>								
								<td><?php echo $getHelpdesk[$i]['kategori']?></td>
								<td><?php echo str_replace("Diinput Oleh: ","",$getHelpdesk[$i]['statusnote']); ?></td>
							</tr>
				  	<?php
				  		}
				  	?>
				</tbody>
	        </table>
	        <script type="text/javascript">
	        	var table = $('#datatable').DataTable({
											 	"bAutoWidth": true,
											 	"bDestroy": true,
											 	"search": true,
												"perPageSelect": true,
												"bPaginate": true,
												"bInfo": true,
											 });
	        </script>