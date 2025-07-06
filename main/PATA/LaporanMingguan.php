<?php
	@include('../../action/GetData.php');
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
    .tengah{
    	text-align: center;
    }
    .no-close {
		  display: none;
		}
		.dialogku{
			max-height: 800px;
			/*max-width: 500px;*/
			overflow-y: scroll;
			overflow-x: scroll;
			display: block;
		  margin: auto;
		  width: 95%;
		}
  </style>  	
  </head>
  	<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	    	<div class="x_title">
		        <h2>LAPORAN MINGGUAN PERIODE <i style="color: red;"><?php echo $tanggalmingguakhir[0]["tanggalmulai2"]; ?></i>  s/d <i style="color: red;"><?php echo $tanggalmingguakhir[0]["tanggalsampai2"]; ?></i></h2>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content">
		      <div class="row top_tiles">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabelmingguan(1);">
						    <div class="tile-stats" id="btnrating">
						      <div class="icon"><i class="fa fa-user"></i></div>
						      <div class="count">1</div>
						      <h3>User Rating</h3>
						      <p>Mingguan</p>
						    </div>
						  </a>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a href="#" onclick="tampilkantabelmingguan(2);">
						    <div class="tile-stats" id="btnrekap">
						      <div class="icon"><i class="fa fa-user"></i></div>
						      <div class="count">1</div>
						      <h3>Rekap Helpdesk</h3>
						      <p>Mingguan</p>
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
			    <div id="userlogintbl" class="x_content">
			    	<h2>LAPORAN USER RATING</h2>
		        <div class="clearfix"></div>
			      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	                    <table id="dtuserrating" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all tengah" rowspan="2">Nama</th>
						      <th class="all tengah" rowspan="2">Helpdesk Selesai</th>
						      <th class="all tengah" colspan="6">Rating</th>
						    </tr>
						    <tr>
						      <th class="all tengah" >Belum Dirating</th>
						      <th class="all tengah">Bintang 1</th>
						      <th class="all tengah">Bintang 2</th>
						      <th class="all tengah">Bintang 3</th>
						      <th class="all tengah">Bintang 4</th>
						      <th class="all tengah">Bintang 5</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datarating);$i++){ ?>
						  	<tr>
						  		<td><a href='#' onclick="prevhd_jumlahissue('<?php echo $datarating[$i]["nik"]; ?>','<?php echo $datarating[$i]["nama"]; ?>','HELPDESK SELESAI','../main/PATA/previewlisthd')"><?php echo $datarating[$i]["nama"]; ?></a></td>
						  		<td align="right"><a href='#' onclick="prevhd_jumlahissue('<?php echo $datarating[$i]["nik"]; ?>','<?php echo $datarating[$i]["nama"]; ?>','HELPDESK SELESAI','../main/PATA/previewlisthd')"><?php echo $datarating[$i]["jumlahissue"]; ?></a></td>
						  		<td align="right"><?php echo $datarating[$i]["belumdirating"]; ?></td>
						  		<td align="right"><?php echo $datarating[$i]["bintang1"]; ?></td>
						  		<td align="right"><?php echo $datarating[$i]["bintang2"]; ?></td>
						  		<td align="right"><?php echo $datarating[$i]["bintang3"]; ?></td>
						  		<td align="right"><?php echo $datarating[$i]["bintang4"]; ?></td>
						  		<td align="right"><?php echo $datarating[$i]["bintang5"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>
			    <div id="rekapmingguantbl" class="x_content tabelaktif">
			    	<h2>REKAP HELPDESK MINGGUAN (PUSAT)</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="dtrekapmingguan" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all tengah">Nama</th>
						      <th class="all tengah">Divisi</th>
						      <th class="all tengah">Komplain Lama</th>
						      <th class="all tengah">Komplain</th>
						      <th class="all tengah">Selesai</th>
						      <th class="all tengah">Sisa</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datamingguanpusat);$i++){ ?>
						  	<tr>
						  		<td><a href='#' onclick="prevhd_jumlahissuepusat('<?php echo $datamingguanpusat[$i]["nik"]; ?>','<?php echo $datamingguanpusat[$i]["nama"]; ?>','HELPDESK SELESAI PUSAT','../main/PATA/previewlisthdpusat','<?php echo $datamingguanpusat[$i]["divisi"]; ?>')"><?php echo $datamingguanpusat[$i]["nama"]; ?></a></td>
						  		<td><?php echo $datamingguanpusat[$i]["divisi"]; ?></td>
						  		<td align="right"><?php echo $datamingguanpusat[$i]["jumhdlama"]; ?></td>
						  		<td align="right"><?php echo $datamingguanpusat[$i]["jumlahhd"]; ?></td>
						  		<td align="right"><?php echo $datamingguanpusat[$i]["jumlahselesai"]; ?></td>
						  		<td align="right"><?php echo $datamingguanpusat[$i]["jumhdlama"]+$datamingguanpusat[$i]["jumlahhd"]-$datamingguanpusat[$i]["jumlahselesai"]; ?></td>
						  	</tr>
						  	<?php } ?>
						  </tbody>
						</table>
	          </div>
			    </div>

			    <div id="rekapmingguantblcab" class="x_content tabelaktif">
			    	<h2>REKAP HELPDESK MINGGUAN (CABANG)</h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="dtrekapmingguancab" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all tengah">Nama</th>
						      <th class="all tengah">Cabang</th>
						      <th class="all tengah">Komplain Lama</th>
						      <th class="all tengah">Komplain</th>
						      <th class="all tengah">Selesai</th>
						      <th class="all tengah">Sisa</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datamingguancabang);$i++){ ?>
						  	<tr>
						  		<td><a href='#' onclick="prevhd_jumlahissuepusat('<?php echo $datamingguancabang[$i]["nik"]; ?>','<?php echo $datamingguancabang[$i]["nama"]; ?>','HELPDESK SELESAI CABANG','../main/PATA/previewlisthdcabang','<?php echo $datamingguancabang[$i]["cabang"]; ?>')"><?php echo $datamingguancabang[$i]["nama"]; ?></a></td>
						  		<td align="center"><?php echo $datamingguancabang[$i]["cabang"]; ?></td>
						  		<td align="right"><?php echo $datamingguancabang[$i]["jumhdlama"]; ?></td>
						  		<td align="right"><?php echo $datamingguancabang[$i]["jumlahhd"]; ?></td>						  		
						  		<td align="right"><?php echo $datamingguancabang[$i]["hdselesai"]; ?></td>
						  		<td align="right"><?php echo $datamingguancabang[$i]["jumhdlama"]+$datamingguancabang[$i]["jumlahhd"]-$datamingguancabang[$i]["hdselesai"]; ?></td>
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
  //  	const d = new Date();
		// let month = d.getMonth()+1;
  //  	$('#bulan').val(month);
  //  	$('#bulanover').val(month);
   		setTimeout(function(){    		
        	tampilkantabelmingguan(1);
      }, 1000);
    });
</script>