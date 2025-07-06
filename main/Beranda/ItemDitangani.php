<?php
session_start();
@include('../../action/GetData.php');	
$displaypata = "none";
$tahunfilter = [];
	$bulanfilter = [];
	$bulanfilter[0] = "Januari";
	$bulanfilter[1] = "Februai";
	$bulanfilter[2] = "Maret";
	$bulanfilter[3] = "April";
	$bulanfilter[4] = "Mei";
	$bulanfilter[5] = "Juni";
	$bulanfilter[6] = "Juli";
	$bulanfilter[7] = "Agustus";
	$bulanfilter[8] = "September";
	$bulanfilter[9] = "Oktober";
	$bulanfilter[10] = "Nopember";
	$bulanfilter[11] = "Desember";
	for($i=0;$i<3;$i++){
		$tahunfilter[$i] = date('Y')-$i;
	}
$titlenya = "Komplain Ditangani Bulan ".$currentMonthInWord;
if($_SESSION['jabatan']==2){ //jika pata
	$displaypata = "block";
	$titlenya = "Komplain Ditangani";
}
?>
<div class="x_title">
		        <h2  style="background-color:#96beff;" id="title"><?php echo $titlenya; ?></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="row" style="display:<?php echo $displaypata; ?>">
		    	<div class="item form-group">
		    		<label class="control-label col-md-1 col-sm-1 col-xs-12">Filter</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
						  <select id="jenisfilter" class="form-control" onchange="gantifilter();">
				    			<option value="bulanan">Bulanan</option>
				    			<option value="harian">Harian</option>
						  </select>
						</div>
						<div id="harian" style="display:none;">
		          <label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align: right;">Dari Tanggal</label>
		          <div class="col-md-2 col-sm-2 col-xs-12">
		            <input id="tanggalmulai" type="date" class="form-control" placeholder="Default Input" onchange="filterreport('../action/FilterKomplainBeranda')">
		          </div> 
		          <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align: right;">Sampai</label>
		          <div class="col-md-2 col-sm-2 col-xs-12">
		            <input id="tanggalsampai" type="date" class="form-control" placeholder="Default Input" onchange="filterreport('../action/FilterKomplainBeranda')">
		          </div> 
		        </div>
	      	</div>
	      	<div id="bulanan">
		          <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align: right;">Bulan</label>
		          <div class="col-md-2 col-sm-2 col-xs-12">
							  <select id="bulanfilter" class="form-control" onchange="filterreport('../action/FilterKomplainBeranda')">
							  	<?php for($i=0;$i<count($bulanfilter);$i++){ ?>
					    			<option value="<?php echo $i+1; ?>" <?php if(date('m')==($i+1)){ ?> selected <?php } ?>><?php echo $bulanfilter[$i]; ?></option>							  	
							  	<?php } ?>
							  		<option value="99">Semua</option>
							  </select>
							</div>
		          <label class="control-label col-md-1 col-sm-1 col-xs-12" style="text-align: right;" onchange="filterreport('../action/FilterKomplainBeranda')">Tahun</label>
		          <div class="col-md-2 col-sm-2 col-xs-12">
							  <select id="tahunfilter" class="form-control">
							  	<?php for($i=0;$i<count($tahunfilter);$i++){ ?>
					    			<option value="<?php echo $tahunfilter[$i]; ?>" <?php if($tahunfilter==date("Y")){ ?> selected <?php } ?>><?php echo $tahunfilter[$i]; ?></option>							  	
							  	<?php } ?>
							  </select>
							</div>
		        </div>
	      	</div>
		    </div>
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatablekomplainditangani" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>
					    <tr>
					      <th>Nama</th>
					      <th>Komplain Ditangani</th>
					      <th>Total Waktu</th>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getHelpdeskDitangi); $i++){
					    ?>
					        <tr align="center">
					          <td><?php echo $getHelpdeskDitangi[$i]["Nama"]; ?></td>
					          <td><span style="cursor: pointer;" onclick="popupdetail('Beranda/popuplisthd','<?php echo $getHelpdeskDitangi[$i]["Nama"]; ?>','<?php echo $getHelpdeskDitangi[$i]["nik"]; ?>');"><?php echo $getHelpdeskDitangi[$i]["jum"]; ?></span></td>
					          <td><span style="cursor: pointer;" onclick="popupdetail('Beranda/popuplisthd','<?php echo $getHelpdeskDitangi[$i]["Nama"]; ?>','<?php echo $getHelpdeskDitangi[$i]["nik"]; ?>');"><?php echo $getHelpdeskDitangi[$i]["waktu"]." Menit"; ?></span></td>
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
<script type="text/javascript">
	$('#datatablekomplainditangani').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>