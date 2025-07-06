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
  </style>  	
  </head>
  	<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	    	<div class="x_title">
		        <h2>LAPORAN HARIAN</h2>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content">
			    <label class="control-label col-md-1 col-sm-1 col-xs-12">Mulai</label>
          <div class="col-md-2 col-sm-2 col-xs-12">
            <input type="date" class="form-control" id="mulai" onchange="getDataLaporanHarian();">
          </div>
          <label class="control-label col-md-1 col-sm-1 col-xs-12">sampai</label>
          <div class="col-md-2 col-sm-2 col-xs-12">
            <input type="date" class="form-control" id="sampai" onchange="getDataLaporanHarian();">
          </div>
			    <div id="userlogintbl" class="x_content tabelaktif">
			    	<h2>LAPORAN HELPDESK HARIAN <i id="kondisi" style="color: red;"></i></h2>
		        <div class="clearfix"></div>
			      	<div class="table-responsive">
	                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
						  <thead>
						    <tr>
						      <th class="all tengah">No</th>
						      <th class="all tengah">Tanggal</th>
						      <th class="all tengah">Dari</th>
						      <th class="all tengah" >Tujuan</th>
						      <th class="all tengah">Kategori</th>
						      <th class="all tengah">Masalah</th>
						      <th class="all tengah">Solusi</th>
						      <th class="all tengah">Tanggal Konfirmasi</th>
						      <th class="all tengah">Ditangani</th>
						      <th class="all tengah">Tanggal Dikerjakan</th>
						      <th class="all tengah">Tanggal Selesai</th>
						      <th class="all tengah">Lama Pengerjaan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php for($i=0;$i<count($datalaporanharian);$i++){ ?>
						  	<tr>
						  		<td><?php echo $datalaporanharian[$i]["no"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["tanggal"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["namadari"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["tujuan"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["kategori"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["issue"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["solusi"]; ?></td>
						  		<td align="center"><?php echo $datalaporanharian[$i]["tanggalkonfirmasi"]; ?></td>
						  		<td align="left"><?php echo $datalaporanharian[$i]["namaditangani"]; ?></td>
						  		<td align="center"><?php echo $datalaporanharian[$i]["acceptwork"]; ?></td>
						  		<td align="center"><?php echo $datalaporanharian[$i]["tanggalselesai"]; ?></td>
						  		<td align="right"><?php echo $datalaporanharian[$i]["lamapengerjaan"]." Menit"; ?></td>
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
	   	document.getElementById('mulai').valueAsDate = new Date();
	   	document.getElementById('sampai').valueAsDate = new Date();
  		setKondisiLaporanHarian();
    });
</script>