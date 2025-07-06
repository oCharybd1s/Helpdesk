<?php
	echo "<script> console.log('HELPDESK : verifhd') </script>";
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Verifikasi Helpdesk</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<div class='col-md-4 col-sm-6 col-xs-12'>
            Tanggal
            <div class="form-group">
                <select id="tanggal" name="tanggal" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="All">All</option>
				  	<?php for($i=1; $i<31; $i++){ ?>
			    			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				  	<?php } ?>
			  	</select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
                	<option value="All">All</option>
	    			<option value="01">Januari</option><option value="02">Februari</option>
	    			<option value="03">Maret</option><option value="04">April</option>
	    			<option value="05">Mei</option><option value="06">Juni</option>
	    			<option value="07">Juli</option><option value="08">Agustus</option>
	    			<option value="09">September</option><option value="10">Oktober</option>
	    			<option value="11">November</option><option value="12">Desember</option>
			  	</select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="<?php echo $currentYear+1; ?>"><?php echo $currentYear+1; ?></option>
	    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
			  	</select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
      		Jenis Laporan
            <div class="form-group">
                <select id="jenisLaporan" name="jenisLaporan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
                	<option value="All">All</option>
				  	<?php for($i=0; $i<count($jenisLaporan); $i++){ ?>
			    			<option value="<?php echo $jenisLaporan[$i]['Lap']?>"><?php echo $jenisLaporan[$i]['NamaLaporan']?></option>
				  	<?php } ?>
				 </select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
      		Program yang dimaksud
            <div class="form-group">
                <select id="programYangDimaksud" name="programYangDimaksud" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
                	<option value="All">All</option>
				  	<?php for($i=0; $i<count($jenisAplikasi); $i++){ ?>
			    			<option value="<?php echo $jenisAplikasi[$i]['Apl']?>"><?php echo $jenisAplikasi[$i]['NamaAplikasi']?></option>
				  	<?php } ?>
			  	</select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
      		Status
            <div class="form-group">
                <select id="status" name="status" class="form-control col-md-7 col-xs-12"  onchange="filterHD()">
                	<option value="All">All</option>
                	<option value="Belum">Belum Ditangani</option>
                	<option value="Dalam">Dalam Penanganan</option>
                	<option value="Selesai">Selesai</option>
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
		               <th>Kategori</th>
		               <th>Jenis Laporan</th>
		               <th>Program</th>
		               <th>Waktu</th>
		               <th>Konfirm</th>
		               <th>Detail</th>		               
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
							  		<select id="kategori<?php echo $i; ?>" name="kategori<?php echo $i; ?>" class="form-control">
					                	<option value="All" <?php if(str_replace(" ","",$getHelpdesk[$i]['kategori'])!="Software" && str_replace(" ","",$getHelpdesk[$i]['kategori'])!="Hardware"){ ?> Selected <?php } ?>>All</option>
						    			<option value="Hardware" <?php if(str_replace(" ","",$getHelpdesk[$i]['kategori'])=="Hardware"){ ?> Selected <?php } ?>>Hardware</option>
						    			<option value="Software" <?php if(str_replace(" ","",$getHelpdesk[$i]['kategori'])=="Software"){ ?> Selected <?php } ?>>Software</option>
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
								<td>
									<input id="confirm" type="button" class="btn btn-success btn-confirm" value="OK" onclick="confirm('<?php echo $i;?>')" />
									<input id="reject" type="button" class="btn btn-danger btn-reject btnReject" value="REJECT" onclick="reject('<?php echo $i;?>')" />
								</td>
								<td style="word-wrap: break-word"><?php echo $getHelpdesk[$i]['issue']?></td>								
								<td><?php echo str_replace("Diinput Oleh: ","",$getHelpdesk[$i]['statusnote']); ?></td>
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
<!-- Custom Action Javascript - jQuery -->