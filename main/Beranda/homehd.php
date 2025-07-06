<?php
	@include('../../action/GetData.php');	
	$jumterbuka = 0;
	$jumditangani = 0;
	$jabatan = $_SESSION['jabatan'];

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
	    <div class="x_panel full-border" id="isitabel">

    	</div> 
    <?php } ?>    
    <?php if($_SESSION['jabatan']==0){ ?>
		<div class="x_panel">
		    <div class="x_content">
		      	<div class="row top_tiles">
		      <div class="animated flipInY col-lg-8 col-md-8 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(11);">
					    <div class="tile-stats" id="btnringkasan_nonit">
					      <div class="icon">&nbsp;</div>
					      <div class="count" style="font-size:35px;">Ringkasan Helpdesk <?php echo $currentYear; ?> : <?php echo $countTotalComplain[0]['jum']; ?> / <?php echo $countSelesaiAll[0]["jum"]; ?> / <?php echo $countTotalComplainDibuat[0]["jum"]; ?></div>
					      <h3 style="color:black;">Komplain Terbuka / Komplain Selesai / Total Komplain Dibuat</h3>
					      <p>&nbsp;</p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(12);">
					    <div class="tile-stats" id="btnterbukaall_nonit">
					      <div class="icon"><i class="fa fa-wrench"></i></div>
					      <div class="count"><?php echo $countComplainTerbukaAll[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Terbuka Seluruhnya</h3>
					      <!-- <p>Tahun <?php echo $currentYear; ?></p> -->
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(8);">
					    <div class="tile-stats" id="btnterbuka_nonit">
					      <div class="icon"><i class="fa fa-wrench"></i></div>
					      <div class="count"><?php echo $countTotalComplain[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Terbuka</h3>
					      <p>Tahun <?php echo $currentYear; ?></p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(9);">
					    <div class="tile-stats" id="btnselesai_nonit">
					      <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
					      <div class="count"><?php echo $countComplainDone[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Selesai</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<a href="#" onclick="setDetailBeranda(10);">
					    <div class="tile-stats" id="btnditolak_nonit">
					      <div class="icon"><i class="fa fa-warning"></i></div>
					      <div class="count"><?php echo $countComplainRejected[0]['jum']; ?></div>
					      <h3 style="color:black;">Komplain Ditolak</h3>
					      <p>Bulan <?php echo $currentMonthInWord; ?></p>
					    </div>
					  </a>
					</div>
				</div>
		    </div>
	    </div>
	    <div class="x_panel full-border" id="isitabel_nonit">

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
		var jabatan_menuhd = JSON.parse('<?php echo json_encode($jabatan); ?>');
		if(jabatan_menuhd>=1){
			if(localStorage.tombolterpilih===undefined){
				setDetailBeranda(1);
			}else{
				setDetailBeranda(localStorage.tombolterpilih*1);
			}		
		}else{
			if(localStorage.tombolterpilih===undefined){
				setDetailBeranda(8);
			}else{
				setDetailBeranda(localStorage.tombolterpilih*1);
			}		
		}
		

		// var tableSemua = $('#datatableSemua').DataTable({
		// 	'bDestroy': true
		// });
		// var tableSelesai = $('#datatableSelesai').DataTable({
		// 	'bDestroy': true
		// });
		// var tableDitolak = $('#datatableDitolak').DataTable({
		// 	'bDestroy': true
		// });
		
	});
	// document.getElementById('tanggalmulai').valueAsDate = new Date();
	// document.getElementById('tanggalsampai').valueAsDate = new Date();
</script>