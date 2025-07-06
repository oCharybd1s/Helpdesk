<?php
	@include('../../action/GetData.php');
	$jumlahdikerjakan = 0;
	for($i=0;$i<count($jumlahDikerjakan);$i++){
		$jumlahdikerjakan = $jumlahdikerjakan + $jumlahDikerjakan[$i]["jumlah"];
	}
?>
<html lang="en">
  <head>
  	<style type="text/css">
    .btnaktif{
    	background-color: #75ffc6;
    }
    .tabelaktif{
    	border-width: thin;
    	border-style: groove;
    }
  </style>  	
  </head>
  	<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	    	<div class="x_title">
		        <h2>DASHBOARD</h2>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content">
		      <div class="row top_tiles">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(1);">
						    <div class="tile-stats" id="btnuserlogin">
						      <div class="icon"><i class="fa fa-user"></i></div>
						      <div class="count"><?php echo count($datauserdashboard); ?></div>
						      <h3>User Login</h3>
						      <p>Hari Ini</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(2);">
						    <div class="tile-stats" id="btnpengajuanbaru">
						      <div class="icon"><i class="fa fa-file"></i></div>
						      <div class="count"><?php echo count($datapengajuandashboard); ?></div>
						      <h3>Pengajuan Baru</h3>
						      <p>Hari Ini</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(3);">
						    <div class="tile-stats" id="btnhelpdeskbaru">
						      <div class="icon"><i class="fa fa-bell"></i></div>
						      <div class="count"><?php echo count($datahelpdeskdashboard); ?></div>
						      <h3>Helpdesk Baru</h3>
						      <p>Hari Ini</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(4);">
						    <div class="tile-stats" id="btnpekerjaan">
						      <div class="icon"><i class="fa fa-building"></i></div>
						      <div class="count"><?php echo $jumlahdikerjakan; ?></div>
						      <h3>Pekerjaan</h3>
						      <p>Hari Ini</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(5);">
						    <div class="tile-stats" id="btnselesai">
						      <div class="icon"><i class="fa fa-check-square"></i></div>
						      <div class="count"><?php echo count($jumlahSelesai); ?></div>
						      <h3>Helpdesk Selesai</h3>
						      <p>Hari Ini</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(6);">
						    <div class="tile-stats" id="btnbelumselesai">
						      <div class="icon"><i class="fa fa-book"></i></div>
						      <div class="count"><?php echo count($hdbelumselesaibulan); ?></div>
						      <h3>Belum Selesai</h3>
						      <p><?php echo date('M')." ".date('Y'); ?></p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabel(7);">
						    <div class="tile-stats" id="btnovertime">
						      <div class="icon"><i class="fa fa-building"></i></div>
						      <div class="count"><?php echo count($overtime); ?></div>
						      <h3>OVER TIME</h3>
						      <p><?php echo date('M')." ".date('Y'); ?></p>
						    </div>
						  </a>
						</div>
						
						</div>
					</div>					
		    	<!-- <div class="x_title">
			        <h2  style="background-color:#96beff;">Semua Komplain</small></h2>
			        <ul class="nav navbar-left panel_toolbox">
			          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
			        </ul>
			        <div class="clearfix"></div>
			    </div> -->
			    <div id="userlogintbl" class="x_content tabelaktif">
			    	<h2>USER YANG LOGIN HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatableuserlogin" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Nama User</th>
						      <th class="all">Login Terakhir</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datauserdashboard);$i++){ ?>
						  	<tr>
						  		<td><?php echo $datauserdashboard[$i]["Nama"]; ?></td>
						  		<td><?php echo date_format($datauserdashboard[$i]["LastLogin"],"d-m-Y H:i:s"); ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
		    	<div id="pengajuantbl" class="x_content tabelaktif">
		    		<h2>PENGAJUAN BARU</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatablepengajuan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Cabang</th>
						      <th class="all">Nama Pengajuan</th>
						      <th class="all">Alasan</th>
						      <th class="all">Nilai</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datapengajuandashboard);$i++){ ?>
						  	<tr>
						  		<td><?php echo $datapengajuandashboard[$i]["No"]; ?></td>
						  		<td><?php echo date_format($datapengajuandashboard[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $datapengajuandashboard[$i]["dari"]; ?></td>
						  		<td><?php echo $datapengajuandashboard[$i]["cabang"]; ?></td>
						  		<td><?php echo $datapengajuandashboard[$i]["namainvestasi"]; ?></td>
						  		<td><?php echo $datapengajuandashboard[$i]["alasan"]; ?></td>
						  		<td><?php echo $datapengajuandashboard[$i]["biaya"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="helpdesktbl" class="x_content tabelaktif">
			    	<h2>HELPDESK BARU HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatablehelpdesk" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Tujuan</th>
						      <th class="all">Kategori</th>
						      <th class="all">Permasalahan</th>
						      <th class="all">Ditangani</th>
						      <th class="all">Tanggal Selesai</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datahelpdeskdashboard);$i++){ ?>
						  	<tr>
						  		<td><?php echo $datahelpdeskdashboard[$i]["No"]; ?></td>
						  		<td><?php echo date_format($datahelpdeskdashboard[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["namadari"]; ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["tujuan"]; ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["kategori"]; ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["issue"]; ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["namaditangani"]; ?></td>
						  		<td><?php echo $datahelpdeskdashboard[$i]["TanggalSelesai2"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="jumhelpdesktbl" class="x_content tabelaktif">
			    	<h2>JUMLAH HELPDESK BARU HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatablejumlahhelpdesk" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Jenis Helpdesk</th>
						      <th class="all">Jumlah</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($jumhelpdeskhariini);$i++){ ?>
						  	<tr>
						  		<td><?php echo $jumhelpdeskhariini[$i]["NamaLaporan"]; ?></td>
						  		<td><?php echo $jumhelpdeskhariini[$i]["jumlah"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="jumpekerjaantbl" class="x_content tabelaktif">
			    	<h2>PEKERJAAN HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatablejumlahpekerjaan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Nama</th>
						      <th class="all">Jumlah Helpdesk</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($jumlahDikerjakan);$i++){ ?>
						  	<tr>
						  		<td><?php echo $jumlahDikerjakan[$i]["nama"]; ?></td>
						  		<td><?php echo $jumlahDikerjakan[$i]["jumlah"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="jumhdselesai" class="x_content tabelaktif">
			    	<h2>HELPDESK YANG SELESAI HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatablejumlahselesai" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Komplain</th>
						      <th class="all">Ditangani</th>
						      <th class="all">Mulai</th>
						      <th class="all">Selesai</th>
						      <th class="all">Waktu</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($jumlahSelesai);$i++){ ?>
						  	<tr>
						  		<td><?php echo $jumlahSelesai[$i]["No"]; ?></td>
						  		<td><?php echo date_format($jumlahSelesai[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $jumlahSelesai[$i]["namadari"]; ?></td>
						  		<td><?php echo $jumlahSelesai[$i]["issue"]; ?></td>
						  		<td><?php echo $jumlahSelesai[$i]["namaditangani"]; ?></td>
						  		<td><?php echo date_format($jumlahSelesai[$i]["AcceptWork"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo date_format($jumlahSelesai[$i]["TanggalSelesai"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $jumlahSelesai[$i]["waktupengerjaan"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			     <div id="avgpengerjaan" class="x_content tabelaktif">
			    	<h2>RATA - RATA WAKTU PENGERJAAN HELPDESK HARI INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatableavgpekerjaan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Nama</th>
						      <th class="all">Helpdek Yang Ditangani</th>
						      <th class="all">Rata-Rata Waktu Pengerjaan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($avgwaktu);$i++){ ?>
						  	<tr>
						  		<td><?php echo $avgwaktu[$i]["nama"]; ?></td>
						  		<td><?php echo $avgwaktu[$i]["jumhd"]; ?></td>
						  		<td><?php echo $avgwaktu[$i]["avgwaktu"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="kurang3menit" class="x_content tabelaktif">
			    	<h2>HELPDESK YANG DISELESAIKAN KURANG DARI 3 MENIT</h2>
			    	<div class='col-md-2 col-sm-12 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterrepbulan()">
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
		        <div class='col-md-2 col-sm-12 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterrepbulan()">
                	<?php for($i=date('Y');$i>=date('Y')-3;$i--){ ?>
                	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                	<?php } ?>
						  	</select>
		            </div>
		        </div>
		        <div class="clearfix" style="height: 100px;"></div>
			      	<div class="table-responsive">
	                    <table id="datatablekurang3menit" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Komplain</th>
						      <th class="all">Ditangani</th>
						      <th class="all">Mulai</th>
						      <th class="all">Selesai</th>
						      <th class="all">Waktu Pengerjaan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($kurang3menit);$i++){ ?>
						  	<tr>
						  		<td><?php echo $kurang3menit[$i]["No"]; ?></td>
						  		<td><?php echo date_format($kurang3menit[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $kurang3menit[$i]["namadari"]; ?></td>
						  		<td><?php echo $kurang3menit[$i]["issue"]; ?></td>
						  		<td><?php echo $kurang3menit[$i]["namaditangani"]; ?></td>
						  		<td><?php echo date_format($kurang3menit[$i]["AcceptWork"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo date_format($kurang3menit[$i]["TanggalSelesai"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $kurang3menit[$i]["waktupengerjaan"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="jumhdselesaibulan" class="x_content tabelaktif">
			    	<h2>HELPDESK YANG SELESAI BULAN INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	            <table id="datatablejumlahselesaibulan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Komplain</th>
						      <th class="all">Ditangani</th>
						      <th class="all">Mulai</th>
						      <th class="all">Selesai</th>
						      <th class="all">Waktu</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($jumlahSelesaiBulan);$i++){ ?>
						  	<tr>
						  		<td><?php echo $jumlahSelesaiBulan[$i]["No"]; ?></td>
						  		<td><?php echo date_format($jumlahSelesaiBulan[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $jumlahSelesaiBulan[$i]["namadari"]; ?></td>
						  		<td><?php echo $jumlahSelesaiBulan[$i]["issue"]; ?></td>
						  		<td><?php echo $jumlahSelesaiBulan[$i]["namaditangani"]; ?></td>
						  		<td><?php echo date_format($jumlahSelesaiBulan[$i]["AcceptWork"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo date_format($jumlahSelesaiBulan[$i]["TanggalSelesai"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $jumlahSelesaiBulan[$i]["waktupengerjaan"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>	
			    <div id="avgpengerjaanbulan" class="x_content tabelaktif">
			    	<h2>RATA - RATA WAKTU PENGERJAAN HELPDESK <?php echo date('M')." ".date('Y'); ?></h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatableavgpekerjaanbulan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Nama</th>
						      <th class="all">Helpdek Yang Ditangani</th>
						      <th class="all">Rata-Rata Waktu Pengerjaan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($avgwaktubulan);$i++){ ?>
						  	<tr>
						  		<td><?php echo $avgwaktubulan[$i]["nama"]; ?></td>
						  		<td><?php echo $avgwaktubulan[$i]["jumhd"]; ?></td>
						  		<td><?php echo $avgwaktubulan[$i]["avgwaktu"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>		   
			    <div id="hdbelumselesai" class="x_content tabelaktif">
			    	<h2>HELPDESK BELUM SELESAI BULAN INI</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	            <table id="tblhdbelumselesaibulan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Tujuan</th>
						      <th class="all">Kategori</th>
						      <th class="all">Komplain</th>
						      <th class="all">Ditangani</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($hdbelumselesaibulan);$i++){ ?>
						  	<tr>
						  		<td><?php echo $hdbelumselesaibulan[$i]["No"]; ?></td>
						  		<td><?php echo date_format($hdbelumselesaibulan[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $hdbelumselesaibulan[$i]["namadari"]; ?></td>
						  		<td><?php echo $hdbelumselesaibulan[$i]["tujuan"]; ?></td>
						  		<td><?php echo $hdbelumselesaibulan[$i]["kategori"]; ?></td>
						  		<td><?php echo $hdbelumselesaibulan[$i]["issue"]; ?></td>
						  		<td><?php echo $hdbelumselesaibulan[$i]["namaditangani"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="hdovertime" class="x_content tabelaktif">
			    	<h2>OVER TIME</h2>
			    	<div class='col-md-2 col-sm-12 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulanover" name="bulanover" class="form-control col-md-7 col-xs-12" onchange="filterbulanover()">
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
		        <div class='col-md-2 col-sm-12 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahunover" name="tahunover" class="form-control col-md-7 col-xs-12" onchange="filterbulanover()">
                	<?php for($i=date('Y');$i>=date('Y')-3;$i--){ ?>
                	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                	<?php } ?>
						  	</select>
		            </div>
		        </div>
		        <div class="clearfix" style="height: 100px;"></div>
			      	<div class="table-responsive">
	                    <table id="datatableovertime" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">No</th>
						      <th class="all">Tanggal</th>
						      <th class="all">Dari</th>
						      <th class="all">Komplain</th>
						      <th class="all">Ditangani</th>
						      <th class="all">Mulai</th>
						      <th class="all">Selesai</th>
						      <th class="all">Estimasi</th>
						      <th class="all">Waktu Pengerjaan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($overtime);$i++){ ?>
						  	<tr>
						  		<td><?php echo $overtime[$i]["No"]; ?></td>
						  		<td><?php echo date_format($overtime[$i]["Tanggal"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $overtime[$i]["namadari"]; ?></td>
						  		<td><?php echo $overtime[$i]["issue"]; ?></td>
						  		<td><?php echo $overtime[$i]["namaditangani"]; ?></td>
						  		<td><?php echo date_format($overtime[$i]["AcceptWork"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo date_format($overtime[$i]["TanggalSelesai"],"d-m-Y H:i:s"); ?></td>
						  		<td><?php echo $overtime[$i]["EstIT"]." Menit"; ?></td>
						  		<td><?php echo $overtime[$i]["waktupengerjaan"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="avgpenangananbulan" class="x_content tabelaktif">
			    	<h2>RATA - RATA WAKTU PENANGANAN HELPDESK <?php echo date('M')." ".date('Y'); ?></h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatableavgpenangananbulan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all">Nama</th>
						      <th class="all">Helpdek Yang Ditangani</th>
						      <th class="all">Total Waktu Penanganan</th>
						      <th class="all">Rata-Rata Waktu Penanganan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($waktupenanganan);$i++){ ?>
						  	<tr>
						  		<td><?php echo $waktupenanganan[$i]["namaditangani"]; ?></td>
						  		<td><?php echo $waktupenanganan[$i]["jumlahhd"]; ?></td>
						  		<td><?php echo $waktupenanganan[$i]["totalwaktu"]; ?></td>
						  		<td><?php echo $waktupenanganan[$i]["avgwaktupenanganan"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>

		    </div>	   
  </div>
</div>
</body>
</html>
 <script type="text/javascript">
   $(document).ready(function(){
   	const d = new Date();
		let month = d.getMonth()+1;
   	$('#bulan').val(month);
   	$('#bulanover').val(month);
   		setTimeout(function(){    		
        	tampilkantabel(1);
      }, 1000);
    });
</script>