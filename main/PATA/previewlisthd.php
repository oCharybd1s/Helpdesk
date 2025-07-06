<?php
	@include('../../action/GetData.php');
?>
<html lang="en">
  <head>
  	<style type="text/css">
  		html, body {
		    height:100%; 
		    margin: 0 !important; 
		    padding: 0 !important;
		    /*overflow: hidden;*/
		  }
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
		        <h2><?php echo $_POST['judulP']; ?> PERIODE <i style="color: red;">asdsd</i>  s/d <i style="color: red;">aaaaaa</i></h2>
		        <div class="x_content">
				        <h6>( <?php echo $_POST["namaP"]; ?> )</h6>
				    </div>
		        <div class="clearfix"></div>
		    </div>
		    <div class="form-group" id="bdpreview">
		      <div class="row top_tiles">
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
							      <th class="all tengah">Tanggal Dikerjakan</th>
							      <th class="all tengah">Tanggal Selesai</th>
							      <th class="all tengah">Lama Pengerjaan</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php for($i=0;$i<count($dataselesaimingguan);$i++){ ?>
							  	<tr>
							  		<td><a href="#" onclick="showdetailhd('<?php echo $dataselesaimingguan[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/PATA/previewhd')"><?php echo $dataselesaimingguan[$i]["No"]; ?></a></td>
							  		<td align="left"><?php echo $dataselesaimingguan[$i]["Tanggal2"]; ?></td>
							  		<td align="left"><?php echo $dataselesaimingguan[$i]["namadari"]; ?></td>
							  		<td align="left"><?php echo $dataselesaimingguan[$i]["tujuan"]; ?></td>
							  		<td align="left"><?php echo $dataselesaimingguan[$i]["kategori"]; ?></td>
							  		<td align="left"><?php echo substr($dataselesaimingguan[$i]["issue"],0,50)." ..."; ?></td>
							  		<td align="left"><?php echo substr($dataselesaimingguan[$i]["Solusi"],0,50)." ..."; ?></td>
							  		<td align="center"><?php echo $dataselesaimingguan[$i]["TanggalKonfirmasi2"]; ?></td>
							  		<td align="center"><?php echo $dataselesaimingguan[$i]["AcceptWork2"]; ?></td>
							  		<td align="center"><?php echo $dataselesaimingguan[$i]["TanggalSelesai2"]; ?></td>
							  		<td align="right"><?php echo $dataselesaimingguan[$i]["lamapengerjaan"]." Menit"; ?></td>
							  	</tr>
							  	<?php } ?>
							  </tbody>
							</table>			
				</div>
			</div>
			<div class="form-group">
          <div class="col-md-12" style="text-align: center;">
            	<input type="button" id="btnback" class="btn btn-danger" value="Kembali" onclick="kembalipreviewhd();" style="display:none;" />
            	<input type="button" id="btnclose" class="btn btn-danger" value="Tutup" onclick="tutuppreviewhd();"/>
          </div>
      </div>
		</div>
	</div>
</div>
</body>
</html>							
<!-- <script type="text/javascript">
	// $(document).ready(function(){	
	// 	$('#dtuserrating22').DataTable({
	//  	"bAutoWidth": true,
	//  	"bDestroy": true,
	//  	"search": true,
	// 	"perPageSelect": true,
	// 	"bPaginate": true,
	// 	"bInfo": true,
	// });
	// $("#btnclose").click(function(e) {
	//     // $(this).closest('.ui-dialog-content').dialog('close');
	//     $(this).closest('.dialog').dialog('close');
	// });
</script> -->