<?php
	@include('../../action/GetData.php');
	if($_SESSION['jenisfilterlap']==""){
		$jenislap = "bulanan";
		$tglmulai = date('Y-m-d');
		$tglsampai = date('Y-m-d');
	}else{
		$jenislap = $_SESSION['jenisfilterlap'];
		$tglmulai = date_format(date_create($_SESSION['tanggalmulailap']),"Y-m-d");
		$tglsampai = date_format(date_create($_SESSION['tanggalsampailap']),"Y-m-d");
	}
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      	<div class="x_title">
        	<h2 id="title">Laporan Helpdesk Selesai</h2>
        	<div class="clearfix"></div>
      	</div>
      	<div class="x_content">
	      	<div class='col-md-6 col-sm-6 col-xs-12'>
	      		Tujuan
	            <div class="form-group">
	                <select id="kehendak" name="kehendak" class="form-control" onchange="filterHD()">
	                	<option value="All">All</option>
		    			<option value="Komplain">Komplain</option>
		    			<option value="Request">Request</option>
				  	</select>
	            </div>
	        </div>
	      	<div class='col-md-6 col-sm-6 col-xs-12'>
	      		Kategori
	            <div class="form-group">
	                <select id="jenis" name="jenis" class="form-control" onchange="filterHD()">
	                	<option value="All">All</option>
		    			<option value="Software">Software</option>
		    			<option value="Hardware">Hardware</option>
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
	                <select id="status" name="status" class="form-control col-md-7 col-xs-12" onchange="filterHD()" >
	                	<option value="All">All</option>
	                	<option value="NBelum">Belum Ditangani</option>
	                	<option value="0">Dalam Penanganan</option>
	                	<option value="1">Selesai</option>
				  	</select>
	            </div>
	        </div>
	        <div class='col-md-4 col-sm-6 col-xs-12' style="display: none;">
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
	            Filter
	            <div class="form-group">
	              <select id="jenisfilterlap" class="form-control" onchange="filterHD()">
				    			<option value="bulanan" <?php if($jenislap=="bulanan"){ ?> selected <?php } ?>>Bulanan</option>
				    			<option value="harian" <?php if($jenislap!="bulanan"){ ?> selected <?php } ?>>Harian</option>
						  	</select>
	            </div>
	        </div>
	        <div class='col-md-4 col-sm-6 col-xs-12' id="divtanggalmulai" style="display:none;">
	            Mulai Tanggal
	            <div class="form-group">
	              <input id="tanggalmulailap" type="date" class="form-control" onchange="filterHD()" value="<?php echo $tglmulai; ?>" >
	            </div>
	        </div>
	        <div class='col-md-4 col-sm-6 col-xs-12' id="divtanggalsampai" style="display:none;">
	            Sampai dengan
	            <div class="form-group">
	              <input id="tanggalsampailap" type="date" class="form-control" onchange="filterHD()" value="<?php echo $tglsampai; ?>">
	            </div>
	        </div>
	      	<div class='col-md-4 col-sm-6 col-xs-12' id="divbulan">
	            Bulan
	            <div class="form-group">
	                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	                	<option value="All">All</option>
		    			<option value="01" <?php if($currentMonth=="01"){echo "selected";}?> >Januari</option>
		    			<option value="02" <?php if($currentMonth=="02"){echo "selected";}?> >Februari</option>
		    			<option value="03" <?php if($currentMonth=="03"){echo "selected";}?> >Maret</option>
		    			<option value="04" <?php if($currentMonth=="04"){echo "selected";}?> >April</option>
		    			<option value="05" <?php if($currentMonth=="05"){echo "selected";}?> >Mei</option>
		    			<option value="06" <?php if($currentMonth=="06"){echo "selected";}?> >Juni</option>
		    			<option value="07" <?php if($currentMonth=="07"){echo "selected";}?> >Juli</option>
		    			<option value="08" <?php if($currentMonth=="08"){echo "selected";}?> >Agustus</option>
		    			<option value="09" <?php if($currentMonth=="09"){echo "selected";}?> >September</option>
		    			<option value="10" <?php if($currentMonth=="10"){echo "selected";}?> >Oktober</option>
		    			<option value="11" <?php if($currentMonth=="11"){echo "selected";}?> >November</option>
		    			<option value="12" <?php if($currentMonth=="12"){echo "selected";}?> >Desember</option>
				  	</select>
	            </div>
	        </div>	        
	      	<div class='col-md-4 col-sm-6 col-xs-12' id="divtahun">
	            Tahun
	            <div class="form-group">
	                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
		    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
		    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
		    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
				  	</select>
	            </div>
	        </div>
	      	<div class='col-md-12 col-sm-12 col-xs-12'>
	          	<div class="ln_solid"></div>
	      	</div>
	      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
		        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
		          	<thead>
			            <tr>
			               <th>No</th>
			               <th>Tanggal</th>
			               <th>Dari</th>
			               <th>Jenis Laporan</th>
			               <th>Program</th>
			               <th>Ditangani</th>
			               <th>DONE</th>
			               <th>Tanggal Selesai</th>
			               <th>Konfirmasi</th>
			               <th>Detail</th>
			               <th>Tujuan</th>
			               <th>Kategori</th>
			            </tr>
		          	</thead>
					<tbody>
						<?php
							for($i=0; $i<count($getHistoryDoneHdList); $i++){
						?>
				    			<tr>
									<td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getHistoryDoneHdList[$i]['No']?></a></td> <!---No--->
									<td><?php echo date_format($getHistoryDoneHdList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
									<td><?php echo $getHistoryDoneHdList[$i]['dari2'];?></td> <!---Dari--->
									<td><?php echo $getHistoryDoneHdList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
									<td><?php echo $getHistoryDoneHdList[$i]['Aplikasi2'];?></td> <!---Program--->
									<td><?php if($getHistoryDoneHdList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getHistoryDoneHdList[$i]['DitanganiOleh'];}?></td>
									<td class="mycenter"> 
										<?php
		                                    if($getHistoryDoneHdList[$i]['Status2']=='Selesai'){
		                                      	echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
		                                    }else if($getHistoryDoneHdList[$i]['Status2']=="Dalam Penanganan"){
		                                        echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
		                                    }else{
		                                    	echo "-";
		                                    }
		                              	?>
									</td>
									<td>
										<?php echo $getHistoryDoneHdList[$i]['TanggalSelesai2'];
											if($getHistoryDoneHdList[$i]['overtime']=="Overtime"){
		                                      	echo '<img src="../resources/images/overtime.png" style="width:18px;height:18px;">';
											}else if($getHistoryDoneHdList[$i]['overtime']=="Tepat"){
		                                      	echo '<img src="../resources/images/ontime.png" style="width:18px;height:18px;">';
											}
										?>	
									</td> <!---Tanggal Selesai--->
									<td class="mycenter">
										<?php
		                                    if($getHistoryDoneHdList[$i]['accPATA']=='1'){
		                                      	echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                                    }else if($getHistoryDoneHdList[$i]['accPATA']=='0'){
		                                        echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                                    }else if($getHistoryDoneHdList[$i]['accPATA']=='2'){
		                                        echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                                    }
		                              	?>
									</td> <!---Konfirmasi--->
									<td><?php echo $getHistoryDoneHdList[$i]['issue']?></td> <!---Jenis Keterangan--->
									<td><?php echo $getHistoryDoneHdList[$i]['tujuan']?></td> <!---Tujuan--->
									<td><?php echo $getHistoryDoneHdList[$i]['kategori']?></td> <!---Kategori--->
								</tr>
					  	<?php
					  		}
					  	?>
					</tbody>
		        </table>
		        <div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		      	<div class='col-md-12 col-sm-12 col-xs-12'>
				    <div class='col-md-6 col-sm-6 col-xs-12'>
			          	<table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap">
		                  <thead>
		                    <tr>
		                      <th>Nama</th>
		                      <th>Ontime</th>
		                      <th>Overtime</th>
		                      <th>Total</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  	<?php
								for($i=0; $i<count($getLaporanFinishNama); $i++){
							?>
				                    <tr>
				                      <td><?php echo $getLaporanFinishNama[$i]['nama']?></td>
				                      <td><?php echo $getLaporanFinishNama[$i]['ontime']?></td>
				                      <td><?php echo $getLaporanFinishNama[$i]['overtime']?></td>
				                      <td><?php echo $getLaporanFinishNama[$i]['total']?></td>
				                    </tr>
			                <?php
			            		}
		            		?>
		                  </tbody>
		                </table>
			      	</div>
					<div class='col-md-6 col-sm-6 col-xs-12'>
						<div class='col-md-12 col-sm-12 col-xs-12'>
							<center><h2 id="judulGrafikPerKaryawan"></h2></center>
			      			<canvas id="pieChart"></canvas>
						</div>
					</div>
		      	</div>
			    <div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		      	<div class='col-md-12 col-sm-12 col-xs-12'>
				    <div class='col-md-6 col-sm-6 col-xs-12'>
			          	<table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap">
		                  <thead>
		                    <tr>
		                      <th>Cabang</th>
		                      <th>Total</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  	<?php
								for($i=0; $i<count($getLaporanFinishByCabang); $i++){
							?>
				                    <tr>
				                      <td><?php echo $getLaporanFinishByCabang[$i]['namacab']?></td>
				                      <td><?php echo $getLaporanFinishByCabang[$i]['total']?></td>
				                    </tr>
			                <?php
			            		}
		            		?>	

				                    <tr>
				                      <td><?php echo $getLaporanFinishByCabangTotal[0]['namacab']?></td>
				                      <td><?php echo $getLaporanFinishByCabangTotal[0]['total']?></td>
				                    </tr>
		                  </tbody>
		                </table>
			      	</div>
					<div class='col-md-6 col-sm-6 col-xs-12'>
						<div class='col-md-12 col-sm-12 col-xs-12'>
							<center><h2 id="judulGrafikPerCabang"></h2></center>
			      			<canvas id="pieChart1"></canvas>
						</div>
					</div>
				</div>
			    <div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		      	<div class='col-md-12 col-sm-12 col-xs-12'>
				    <div class='col-md-6 col-sm-6 col-xs-12'>
			          	<table id="datatable3" class="table table-striped table-bordered dt-responsive nowrap">
		                  <thead>
		                    <tr>
		                      <th>Program</th>
		                      <th>Total</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  	<?php
								for($i=0; $i<count($getLaporanFinishByProgram); $i++){
							?>
				                    <tr>
				                      <td><?php echo $getLaporanFinishByProgram[$i]['NamaAplikasi']?></td>
				                      <td><?php echo $getLaporanFinishByProgram[$i]['total']?></td>
				                    </tr>
			                <?php
			            		}
		            		?>
				                    <tr>
				                      <td><?php echo $getLaporanFinishByProgramTotal[0]['NamaAplikasi']?></td>
				                      <td><?php echo $getLaporanFinishByProgramTotal[0]['total']?></td>
				                    </tr>
		                  </tbody>
		                </table>
			      	</div>
					<div class='col-md-6 col-sm-6 col-xs-12'>
						<div class='col-md-12 col-sm-12 col-xs-12'>
							<center><h2 id="judulGrafikPerProgram"></h2></center>
			      			<canvas id="pieChart2"></canvas>
						</div>
					</div>
				</div>
			    <div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		    </div>
     	</div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		filterHD();
	});
	// document.getElementById('tanggalmulailap').valueAsDate = new Date();
	// document.getElementById('tanggalsampailap').valueAsDate = new Date();	
</script>