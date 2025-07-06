<?php
	@include('../../action/GetData.php');
?>
<!-- allpj -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">List Pekerjaan IT</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<div class='col-md-3 col-sm-12 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
                	<option value="All" selected>All</option>
	    			<option value="01">Januari</option>
	    			<option value="02">Februari</option>
	    			<option value="03">Maret</option>
	    			<option value="04">April</option>
	    			<option value="05">Mei</option>
	    			<option value="06">Juni</option>
	    			<option value="07">Juli</option>
	    			<option value="08">Agustus</option>
	    			<option value="09">September</option>
	    			<option value="10">Oktober</option>
	    			<option value="11">November</option>
	    			<option value="12">Desember</option>
			  	</select>
            </div>
        </div>
        <div class='col-md-3 col-sm-12 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
	    			<option value="All">All</option>
			  	</select>
            </div>
        </div>
        
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
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
		               <th>Selesai</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getListHD90); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getListHD90[$i]['No']?></a></td>
								<td><?php echo date_format($getListHD90[$i]["Tanggal"],"d/m/Y"); ?></td>
								<td><?php echo $getListHD90[$i]['namadari']?></td>
								<td>
								<select id="kehendak<?php echo $i; ?>" name="kehendak<?php echo $i; ?>" class="form-control">
				                	<option value="All" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])!="Request" && str_replace(" ","",$getListHD90[$i]['tujuan'])!="Komplain"){ ?> Selected <?php } ?>>All</option>
					    			<option value="Komplain" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])=="Komplain"){ ?> Selected <?php } ?>>Komplain</option>
					    			<option value="Request" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])=="Request"){ ?> Selected <?php } ?>>Request</option>
							  	</select>
							  	</td>
								<td>
									<select id="jenisLaporan<?php echo $i; ?>" name="jenisLaporan<?php echo $i; ?>" class="form-control" onchange="simpantmpjenislap(this,<?php echo $i; ?>);">
									  	<?php for($j=0; $j<count($jenisLaporan); $j++){ ?>
								    			<option value="<?php echo $jenisLaporan[$j]['Lap']?>" <?php if($jenisLaporan[$j]['NamaLaporan']==$getListHD90[$i]['Jenis2']){?> Selected <?php } ?> ><?php echo $jenisLaporan[$j]['NamaLaporan']; ?></option>
									  	<?php } ?>
									 </select>
								</td>
								<td>
									<select id="programYangDimaksud<?php echo $i; ?>" name="programYangDimaksud<?php echo $i; ?>" class="form-control col-md-7 col-xs-12" onchange="simpantmpprogram(this,<?php echo $i; ?>)">
					                	<option value="All">All</option>
									  	<?php for($j=0; $j<count($jenisAplikasi); $j++){ ?>
								    			<option value="<?php echo $jenisAplikasi[$j]['Apl']?>" <?php if($jenisAplikasi[$j]['Apl']==$getListHD90[$i]['Aplikasi']){?> Selected <?php } ?>><?php echo $jenisAplikasi[$j]['NamaAplikasi']?></option>
									  	<?php } ?>
								  	</select>
								</td>
								<td>
									<input type="text" class="form-control" id="estimasiPATA<?php echo $i; ?>" onkeyup="simpantemp(this,<?php echo $i; ?>);" name="estimasiPATA<?php echo $i; ?>" value="<?php echo $getListHD90[$i]['EstPATA']; ?>">
								</td>
								<td>
									<?php if($getListHD90[$i]['Konfirmasi']!=1){ ?>
									<input id="confirm<?php echo $i;?>" type="button" class="btn btn-success btn-confirm" value="OK" onclick="confirm('<?php echo $i;?>')" />
									<input id="reject<?php echo $i;?>" type="button" class="btn btn-danger btn-reject btnReject" value="REJECT" onclick="reject('<?php echo $i;?>')" />
									<?php }else{ ?>
										<?php if($getListHD90[$i]['accPATA']==1){ ?>
											Approved
										<?php }else{ ?>
											Rejected
										<?php } ?>
									<?php } ?>
								</td>
								<td style="word-wrap: break-word"><?php echo $getListHD90[$i]['issue']?></td>								
								<td><?php echo $getListHD90[$i]['kategori']?></td>
								<td><?php echo str_replace("Diinput Oleh: ","",$getListHD90[$i]['StatusNote']); ?></td>
								<td>
									<?php if($getListHD90[$i]['Konfirmasi']==1 && $getListHD90[$i]['statusdone']!=1 && $getListHD90[$i]['accPATA']!=2){ ?>
										<?php if($getListHD90[$i]['statusditangani']==1 && str_replace(" ","",$getListHD90[$i]['Ditangani'])==str_replace(" ","",$_SESSION['siapa'])){ ?>
											<input id="confirm<?php echo $i;?>" type="button" class="btn btn-success btn-confirm" value="Set Selesai" onclick="setselesai('<?php echo $getListHD90[$i]['No']; ?>')" />	
										<?php }else{ ?>
											<?php if($getListHD90[$i]['statusditangani']!=1){ ?>
											<input id="acceptWork<?php echo $i;?>" type="button" class="btn btn-success" value="Kerjakan" onclick="setkerjakan(<?php echo $i; ?>,'<?php echo $getListHD90[$i]['No']?>')" />
											<?php }else{ ?>
												<?php echo 'Ditangani '.$getListHD90[$i]['namaditangani']; ?>
											<?php } ?>
										<?php } ?>																	
									<?php }else{ ?>
										done - approved
									<?php } ?>
								</td>
							</tr>
				  	<?php
				  		}
				  	?>
				</tbody>
	        </table>
	    </div>
      </div>
    </div>
  </div>
</div>
<script language="javascript">
	var tmpwaktu = {'idwaktu':'',
				'value':'',
				'jenislap':'',
				'program':''
};
</script>