<?php
	@include('../../action/GetData.php');	
	echo "<script> console.log('HELPDESK : homehd') </script>";
	$jumterbuka = 0;
	$jumditangani = 0;

	for($i=0;$i<count($getKomplainTerbuka);$i++){
		$jumterbuka = $jumterbuka + ($getKomplainTerbuka[$i]["jum"]*1);
	}

	for($i=0;$i<count($getHelpdeskDitangi);$i++){
		$jumditangani = $jumditangani + ($getHelpdeskDitangi[$i]["jum"]*1);
	}
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
	// echo $_SESSION['siapanickName'];
	$displaypata = "none";
	$titlenya = "Komplain Ditangani Bulan ".$currentMonthInWord;
	if($_SESSION['jabatan']==2){ //jika pata
		$displaypata = "block";
		$titlenya = "Komplain Ditangani";
	}
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script> -->
<!-- Style Rating-->
<link rel="stylesheet" href="../resources/css/jquery.rateyo.min.css">
<!-- rating -->
<script src="../resources/js/jquery.rateyo.min.js"></script>

<script type="text/javascript">
function GiveRating(index){
	$("#FormRating").show();
	$("#FormRespon").hide();
	var NomerHD = $('#NoHD'+index).text();
	$("#myModalRating").modal();
	$('#NomorHDnya').val(NomerHD);
	$("#rateYo").rateYo({
    	onSet: function (rating, rateYoInstance) {
       		rating = Math.ceil(rating);
       		$('#NilaiRatingNya').val(rating);
    	}
  	});
}
function GiveRespon(index){
	$("#FormRating").hide();
	$("#FormRespon").show();
	var NomerHD = $('#NoHD'+index).text();
	$("#myModalRating").modal();
	$('#NomorHDResnya').val(NomerHD);
}

$('#SetRatingBtn').on('click', function() {
	var ValNomor = $('#NomorHDnya').val();
	var ValRating = $('#NilaiRatingNya').val();
  	var ValCatatan = $('#CatatanRatingNya').val();

  	$.ajax({
		async:false,
		type: "POST",
		data:{ValNomor: ValNomor,
			ValRating: ValRating,
			ValCatatan: ValCatatan},
		url:'../action/Ratinghd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				// alert(resultDalam);
				// dialog.modal('hide');
				alert("Data Telah Berhasil Disimpan.");
			  location.reload();
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});

});

$('#SetResponBtn').on('click', function() {
	var ValNomorRes = $('#NomorHDResnya').val();
	// var ValRespon = $('#NilaiRatingNya').val();
  	var ValCatatanRespon = $('#CatatanResponNya').val();

  	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menyimpan Data...</p>'
	});

  	$.ajax({
		async:false,
		type: "POST",
		data:{ValNomorRes: ValNomorRes,
			// ValRespon: ValRespon,
			ValCatatanRespon: ValCatatanRespon},
		url:'../action/Responhd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				dialog.find('.bootbox-body').html('<center>Data berhasil disimpan..</center>');
			    // dialog.modal('hide');
				// alert("Data Telah Berhasil Disimpan.");
			    dialog.modal('hide');
			    location.reload();
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});

});

</script>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  	<?php if($_SESSION['jabatan']>=1){ ?>
	    <div class="x_panel">
	    	<div class="x_title">
		        <h2>Status Helpdesk</small></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content">
		      	<div class="row top_tiles">
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(1);">
					    <div class="tile-stats terpilih" id="btnsolved">
					      <div class="icon iconCard"><i class="fa fa-wrench"></i></div>
					      <div class="count"><?php echo $countSolved[0]['jum']; ?></div>
					      <h3>Solved</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(2);">
					    <div class="tile-stats" id="btnontime">
					      <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
					      <div class="count"><?php echo $countOnTime[0]['jum']; ?></div>
					      <h3>On Time</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					   </a>
					</div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(3);">
					    <div class="tile-stats" id="btnovertime">
					      <div class="icon"><i class="fa fa-warning"></i></div>
					      <div class="count"><?php echo $countOverTime[0]['jum']; ?></div>
					      <h3>Over Time</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(4);">
					    <div class="tile-stats" id="btnonprogress">
					      <div class="icon"><i class="fa fa-hand-o-up"></i></div>
					      <div class="count"><?php echo $countOnProgress[0]['jum']; ?></div>
					      <h3>On Progress</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(5);">
					    <div class="tile-stats" id="btnterbuka">
					      <div class="icon"><i class="fa fa-anchor"></i></div>
					      <div class="count"><?php echo $jumterbuka; ?></div>
					      <h3>Terbuka</h3>
					      <p>Semua Periode</p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(6);">
					    <div class="tile-stats" id="btnditangani">
					      <div class="icon"><i class="fa fa-child"></i></div>
					      <div class="count"><?php echo $jumditangani; ?></div>
					      <h3>Ditangani</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>

					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(7);">
					    <div class="tile-stats" id="btnkomplain">
					      <div class="icon"><i class="fa fa-bug"></i></div>
					      <div class="count"><?php echo $JumKomplainTahun[0]["jum"]; ?></div>
					      <h3>Helpdesk</h3>
					      <p>Tahun <?php echo date('Y'); ?></p>
					    </div>
					  </a>
					</div>

				</div>

		      	<div class="row top_tiles" id="chartprogress">
		      		<div class="x_title">
				        <h2 id="title2">Perkembangan Pengerjaan On Time <small>Yearly progress</small></h2>
				        <div class="clearfix"></div>
				    </div>
		          	<canvas id="lineChart" width="100%" height="20"></canvas>
		        </div>
		    </div>
	    </div>
    <?php } ?>
    <?php if($_SESSION['jabatan']>=1){ ?>
    <div class="x_panel full-border" id="tblsolved">
    	<div class="x_title">
	        <h2  id="title">List Komplain Selesai</h2>
	        <ul class="nav navbar-left panel_toolbox">
	          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div>
	    <div class="x_content scroll">
		      	<div class="table-responsive">
	            <table id="datatablesolved" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
							  <thead>
								    <tr>
								      <th class="all">No</th>
								      <th class="all">Tanggal</th>
								      <th class="all">Dari</th>
								      <th class="all">Cabang</th>
								      <th class="all" >Tujuan</th>
								      <th class="all">Kategori</th>
								      <th class="all">Masalah</th>
								      <th class="all">Solusi</th>
								      <th class="all">Tanggal Konfirmasi</th>
								      <th class="all">Tanggal Dikerjakan</th>
								      <th class="all">Tanggal Selesai</th>
								      <th class="all">Lama Pengerjaan</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php for($i=0;$i<count($tabeldatasolved);$i++){ ?>
								  	<tr>
								  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldatasolved[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldatasolved[$i]["No"]; ?></a></td>
								  		<td align="left"><?php echo $tabeldatasolved[$i]["Tanggal2"]; ?></td>
								  		<td align="left"><?php echo $tabeldatasolved[$i]["dari"]; ?></td>
								  		<td align="left"><?php echo $tabeldatasolved[$i]["cabang"]; ?></td>
								  		<td align="left"><?php echo $tabeldatasolved[$i]["tujuan"]; ?></td>
								  		<td align="left"><?php echo $tabeldatasolved[$i]["kategori"]; ?></td>
								  		<td align="left"><?php echo substr($tabeldatasolved[$i]["issue"],0,50)." ..."; ?></td>
								  		<td align="left"><?php echo substr($tabeldatasolved[$i]["Solusi"],0,50)." ..."; ?></td>
								  		<td align="center"><?php echo $tabeldatasolved[$i]["TanggalKonfirmasi2"]; ?></td>
								  		<td align="center"><?php echo $tabeldatasolved[$i]["AcceptWork2"]; ?></td>
								  		<td align="center"><?php echo $tabeldatasolved[$i]["TanggalSelesai2"]; ?></td>
								  		<td align="right"><?php echo $tabeldatasolved[$i]["lamapengerjaan"]." Menit"; ?></td>
								  	</tr>
								  	<?php } ?>
								  </tbody>
							</table>
	        	</div>
		    </div>
	    </div>
	  </div>
	  <div class="x_panel full-border" id="tblontime">
    	<div class="x_title">
	        <h2  id="title">List Pekerjaan On Time</h2>
	        <ul class="nav navbar-left panel_toolbox">
	          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div>
	    <div class="x_content scroll">
		      	<div class="table-responsive">
	            <table id="datatableontime" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
							  <thead>
								    <tr>
								      <th class="all">No</th>
								      <th class="all">Tanggal</th>
								      <th class="all">Dari</th>
								      <th class="all">Cabang</th>
								      <th class="all" >Tujuan</th>
								      <th class="all">Kategori</th>
								      <th class="all">Masalah</th>
								      <th class="all">Solusi</th>
								      <th class="all">Tanggal Konfirmasi</th>
								      <th class="all">Tanggal Dikerjakan</th>
								      <th class="all">Tanggal Selesai</th>
								      <th class="all">Lama Pengerjaan</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php for($i=0;$i<count($tabeldataontime);$i++){ ?>
								  	<tr>
								  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldataontime[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldataontime[$i]["No"]; ?></a></td>
								  		<td align="left"><?php echo $tabeldataontime[$i]["Tanggal2"]; ?></td>
								  		<td align="left"><?php echo $tabeldataontime[$i]["dari"]; ?></td>
								  		<td align="left"><?php echo $tabeldataontime[$i]["cabang"]; ?></td>
								  		<td align="left"><?php echo $tabeldataontime[$i]["tujuan"]; ?></td>
								  		<td align="left"><?php echo $tabeldataontime[$i]["kategori"]; ?></td>
								  		<td align="left"><?php echo substr($tabeldataontime[$i]["issue"],0,50)." ..."; ?></td>
								  		<td align="left"><?php echo substr($tabeldataontime[$i]["Solusi"],0,50)." ..."; ?></td>
								  		<td align="center"><?php echo $tabeldataontime[$i]["TanggalKonfirmasi2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataontime[$i]["AcceptWork2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataontime[$i]["TanggalSelesai2"]; ?></td>
								  		<td align="right"><?php echo $tabeldataontime[$i]["lamapengerjaan"]." Menit"; ?></td>
								  	</tr>
								  	<?php } ?>
								  </tbody>
							</table>
	        	</div>
		    </div>
	    </div>
	  </div>
	  <div class="x_panel full-border" id="tblovertime">
    	<div class="x_title">
	        <h2  id="title">List HelpDesk Over Time</h2>
	        <ul class="nav navbar-left panel_toolbox">
	          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div>
	    <div class="x_content scroll">
		      	<div class="table-responsive">
	            <table id="datatableovertime" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
							  <thead>
								    <tr>
								      <th class="all">No</th>
								      <th class="all">Tanggal</th>
								      <th class="all">Dari</th>
								      <th class="all">Cabang</th>
								      <th class="all" >Tujuan</th>
								      <th class="all">Kategori</th>
								      <th class="all">Masalah</th>
								      <th class="all">Solusi</th>
								      <th class="all">Tanggal Konfirmasi</th>
								      <th class="all">Tanggal Dikerjakan</th>
								      <th class="all">Tanggal Selesai</th>
								      <th class="all">Lama Pengerjaan</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php for($i=0;$i<count($tabeldataovertime);$i++){ ?>
								  	<tr>
								  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldataovertime[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldataovertime[$i]["No"]; ?></a></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["Tanggal2"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["dari"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["cabang"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["tujuan"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["kategori"]; ?></td>
								  		<td align="left"><?php echo substr($tabeldataovertime[$i]["issue"],0,50)." ..."; ?></td>
								  		<td align="left"><?php echo substr($tabeldataovertime[$i]["Solusi"],0,50)." ..."; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["TanggalKonfirmasi2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["AcceptWork2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["TanggalSelesai2"]; ?></td>
								  		<td align="right"><?php echo $tabeldataovertime[$i]["lamapengerjaan"]." Menit"; ?></td>
								  	</tr>
								  	<?php } ?>
								  </tbody>
							</table>
	        	</div>
		    </div>
	    </div>
	  </div>
	  <div class="x_panel full-border" id="tblonprogress">
    	<div class="x_title">
	        <h2  style="background-color:#96beff;" id="title">On Progress</h2>
	        <ul class="nav navbar-left panel_toolbox">
	          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div>
	    <div class="x_content scroll">
		      	<div class="table-responsive">
	            <table id="datatableonprogress" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
							  <thead>
								    <tr>
								      <th class="all">No</th>
								      <th class="all">Tanggal</th>
								      <th class="all">Dari</th>
								      <th class="all">Cabang</th>
								      <th class="all" >Tujuan</th>
								      <th class="all">Kategori</th>
								      <th class="all">Masalah</th>
								      <th class="all">Solusi</th>
								      <th class="all">Tanggal Konfirmasi</th>
								      <th class="all">Tanggal Dikerjakan</th>
								      <th class="all">Tanggal Selesai</th>
								      <th class="all">Lama Pengerjaan</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php for($i=0;$i<count($tabeldataonprogress);$i++){ ?>
								  	<tr>
								  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldataonprogress[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldataonprogress[$i]["No"]; ?></a></td>
								  		<td align="left"><?php echo $tabeldataonprogress[$i]["Tanggal2"]; ?></td>
								  		<td align="left"><?php echo $tabeldataonprogress[$i]["dari"]; ?></td>
								  		<td align="left"><?php echo $tabeldataonprogress[$i]["cabang"]; ?></td>
								  		<td align="left"><?php echo $tabeldataonprogress[$i]["tujuan"]; ?></td>
								  		<td align="left"><?php echo $tabeldataonprogress[$i]["kategori"]; ?></td>
								  		<td align="left"><?php echo substr($tabeldataonprogress[$i]["issue"],0,50)." ..."; ?></td>
								  		<td align="left"><?php echo substr($tabeldataonprogress[$i]["Solusi"],0,50)." ..."; ?></td>
								  		<td align="center"><?php echo $tabeldataonprogress[$i]["TanggalKonfirmasi2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataonprogress[$i]["AcceptWork2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataonprogress[$i]["TanggalSelesai2"]; ?></td>
								  		<td align="right"><?php echo $tabeldataonprogress[$i]["lamapengerjaan"]." Menit"; ?></td>
								  	</tr>
								  	<?php } ?>
								  </tbody>
							</table>
	        	</div>
		    </div>
	    </div>
	  </div>
    <div class="x_panel full-border" id="tblkomplainterbuka">
	    	<div class="x_title">
		        <h2 id="title">Komplain Terbuka</h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>		    
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatableterbuka" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>
					    <tr>
					      <th>Kode Cabang</th>
					      <th>Nama Cabang</th>
					      <th>Jumlah Komplain</th>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getKomplainTerbuka); $i++){
					    ?>
					        <tr align="center">
					          <td><?php echo $getKomplainTerbuka[$i]["Cabang"]; ?></td>
					          <td><?php echo $getKomplainTerbuka[$i]["NamaCab"]; ?></td>
					          <td><?php echo $getKomplainTerbuka[$i]["jum"]; ?></td>
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
	    </div>
	    <div class="x_panel full-border" id="tblhdditangani">
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
	    </div>
	    <div class="x_panel full-border" id="detkomplaintahun">
	    	<div class="x_title">
		        <h2  style="background-color:#96beff;" id="title">Helpdesk Tahun <?php echo date('Y'); ?></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatabledetkomplaintahun" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>        
			        <tr>
			          <?php foreach($detKomplainTahun[0] as $key=>$value){ ?>
			          <th class='all'><?php echo $key; ?></th>              
			          <?php } ?>
			          <!-- <th>Location</th> -->
			        </tr>
			      </thead>
			      <tbody>
			      	<?php for($i=0;$i<count($detKomplainTahun);$i++){ ?>
			        <tr>
			          <?php foreach($detKomplainTahun[0] as $key=>$value){ ?>
			          	<td align="center">
			          		<?php if($key=="No"){ ?>
			          			<a href="#" onclick="showdetailhdberanda('<?php echo $detKomplainTahun[$i][$key]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')">
			          		<?php } ?>
			          			<?php echo $detKomplainTahun[$i][$key]; ?>
			          		<?php if($key=="No"){ ?>
			          			</a>
			          		<?php } ?>
			          	</td>
			          <?php } ?>
			        </tr>
			    	<?php } ?>
			      </tbody>
					</table>
              	</div>
		    </div>
	    </div>
	  <?php } ?>
    <?php if($_SESSION['jabatan']==0){ ?>
		<div class="x_panel">
		    <div class="x_content">
		      	<div class="row top_tiles">
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
					    <div class="tile-stats">
					      <div class="icon"><i class="fa fa-wrench"></i></div>
					      <div class="count"><?php echo $countTotalComplain[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Terbuka</h3>
					      <p>Tahun <?php echo $currentYear; ?></p>
					    </div>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
					    <div class="tile-stats">
					      <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
					      <div class="count"><?php echo $countComplainDone[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Selesai</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
					    <div class="tile-stats">
					      <div class="icon"><i class="fa fa-warning"></i></div>
					      <div class="count"><?php echo $countComplainRejected[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Ditolak</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					</div>
				</div>
		    </div>
	    </div>
	    <div class="x_panel full-border" >
	    	<div class="x_title">
		        <h2 id="title">Semua Komplain</small></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatableSemua" class="table table-striped table-bordered dt-responsive jambo_table">
					  <thead>
					    <tr>
					      <th class="all">No</th>
					      <th class="all">Tanggal</th>
					      <th class="all">Jenis Laporan</th>
					      <th class="all">Program</th>
					      <th class="all">PATA</th>
					      <th class="all">Detail</th>
					      <th class="all">Tujuan</th>
					      <th class="all">Kategori</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getComplainOpen); $i++){
					    ?>
					        <tr>
					          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $getComplainOpen[$i]['No']?></a></td> <!---No--->
					          <td><?php echo date_format($getComplainOpen[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
					          <td><?php echo $getComplainOpen[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
					          <td><?php echo $getComplainOpen[$i]['Aplikasi2'];?></td> <!---Program--->
					          <td>
					            <?php
					                if($getComplainOpen[$i]['accPATA']=='1'){
					                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
					                }else if($getComplainOpen[$i]['accPATA']=='0'){
					                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
					                }else if($getComplainOpen[$i]['accPATA']=='2'){
					                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
					                }
					            ?>
					          </td> <!---Konfirmasi--->
					          <td><?php echo $getComplainOpen[$i]['issue']?></td> <!---Jenis Keterangan--->
					          <td><?php echo $getComplainOpen[$i]['tujuan']?></td> <!---Tujuan--->
					          <td><?php echo $getComplainOpen[$i]['kategori']?></td> <!---Kategori--->
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
	    </div>
	    <div class="x_panel full-border">
	    	<div class="x_title">
		        <h2 >Komplain Selesai</small></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content scroll">
		      	<div class="table-responsive">
            <table id="datatableSelesai" class="table table-striped table-bordered dt-responsive nowrap">
					  <thead>
					    <tr>
					      <th class="all">No</th>
					      <th class="all">Tanggal</th>
					      <th class="all">Jenis Laporan</th>
					      <th class="all">Program</th>
					      <th class="all">Ditangani</th>
					      <th class="all">Tanggal Selesai</th>
					      <th class="all">Detail</th>
					      <th class="all">Tujuan</th>
					      <th class="all">Kategori</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getComplainDone); $i++){
					    ?>
					        <tr>
					          <td id="NoHDS<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHDS<?php echo $i;?>')"><?php echo $getComplainDone[$i]['No']?></a></td> <!---No--->
					          <td><?php echo date_format($getComplainDone[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
					          <td><?php echo $getComplainDone[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
					          <td><?php echo $getComplainDone[$i]['Aplikasi2'];?></td> <!---Program--->
					          <td><?php if($getComplainDone[$i]['DitanganiOleh']==''){echo "-";}else{echo $getComplainDone[$i]['DitanganiOleh'];}?></td>
					          <td><?php echo $getComplainDone[$i]['TanggalSelesai2']?></td> <!---Tanggal Selesai--->
					          <td><?php echo $getComplainDone[$i]['issue']?></td> <!---Jenis Keterangan--->
					          <td><?php echo $getComplainDone[$i]['tujuan']?></td> <!---Tujuan--->
					          <td><?php echo $getComplainDone[$i]['kategori']?></td> <!---Kategori--->
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
             	</div>
		    </div>
	    </div>
	    <div class="x_panel full-border" >
	    	<div class="x_title">
		        <h2>Komplain Ditolak</small></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div> 
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatableDitolak" class="table table-striped table-bordered dt-responsive nowrap">
					  <thead>
					    <tr>
					      <th class="all">No</th>
					      <th class="all">Tanggal</th>
					      <th class="all">Jenis Laporan</th>
					      <th class="all">Program</th>
					      <th class="all">Detail</th>
					      <th class="all">Tujuan</th>
					      <th class="all">Kategori</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getComplainRejected); $i++){
					    ?>
					        <tr>
					          <td id="NoHDD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHDD<?php echo $i;?>')"><?php echo $getComplainRejected[$i]['No']?></a></td> <!---No--->
					          <td><?php echo date_format($getComplainRejected[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
					          <td><?php echo $getComplainRejected[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
					          <td><?php echo $getComplainRejected[$i]['Aplikasi2'];?></td> <!---Program--->
					          <td><?php echo $getComplainRejected[$i]['issue']?></td> <!---Jenis Keterangan--->
					          <td><?php echo $getComplainRejected[$i]['tujuan']?></td> <!---Tujuan--->
					          <td><?php echo $getComplainRejected[$i]['kategori']?></td> <!---Kategori--->
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
	    </div>
  	<?php }?>
  </div>
</div>

<div id="myModalRating" class="modal fade" role="dialog">
	<div class="modal-dialog" id="FormRating">
		<div class="modal-content">
			<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
  				<h4 style="font-size: 14px" class="modal-title">Feedback / Rating Helpdesk</h4>
			</div>
			<div class="modal-body">
        		<input type="hidden" class="form-control" size="10" id="NomorHDnya"/>
				<label>Tentukan Rating:</label><br>
				<div style="display:inline-block;" id="rateYo"></div><br>
				<label>
					1. Sangat Tidak Memuaskan<br>
					2. Tidak Memuaskan<br>
					3. Cukup<br>
					4. Memuaskan<br>
					5. Sangat Memuaskan<br>
				</label>
				<br>
				<input type="hidden" name="rating" id="NilaiRatingNya"/>
				<br/>
				<!-- <button type="button" id="btnRate1" class="btn btn-info ">Approve PATA Cepat</button>
				<button type="button" id="btnRate2+" class="btn btn-info ">Penanganan Cepat</button>
				<button type="button" id="btnRate3" class="btn btn-info "></button> -->
				<label>Catatan:</label>
            	<textarea id="CatatanRatingNya" name="CatatanRatingNya" class="form-control col-md-12 col-xs-12"></textarea>
            	<br/>
            	<button type="button" id="SetRatingBtn" class="btn btn-primary">Simpan dan Tutup Helpdesk</button>
				<button type="button" id="ModalClose" class="btn btn-secondary" data-dismiss="modal">Kembali</button>	
			</div>
		</div> 
		<div class="modal-footer">
		</div>
	</div>
	<div class="modal-dialog" id="FormRespon">
		<div class="modal-content">
			<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
  				<h4 style="font-size: 14px" class="modal-title">Respon Helpdesk</h4>
			</div>
			<div class="modal-body">
        		<input type="hidden" class="form-control" size="10" id="NomorHDResnya"/>
				<label>Catatan:</label>
            	<textarea id="CatatanResponNya" name="CatatanResponNya" class="form-control col-md-12 col-xs-12"></textarea>
            	<br/>
            	<button type="button" id="SetResponBtn" class="btn btn-primary">Simpan dan Buka Helpdesk Kembali</button>
				<button type="button" id="ModalClose" class="btn btn-secondary" data-dismiss="modal">Kembali</button>	
			</div>
		</div> 
		<div class="modal-footer">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		if(localStorage.tombolterpilih===undefined){
			setDetailBeranda(1);
		}else{
			setDetailBeranda(localStorage.tombolterpilih*1);
		}		

		var tableSemua = $('#datatableSemua').DataTable();
		var tableSelesai = $('#datatableSelesai').DataTable();
		var tableDitolak = $('#datatableDitolak').DataTable();
		
	});
	document.getElementById('tanggalmulai').valueAsDate = new Date();
	document.getElementById('tanggalsampai').valueAsDate = new Date();
</script>