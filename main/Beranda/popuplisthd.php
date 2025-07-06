<?php
	@include('../../action/GetData.php');

if(str_replace(" ","",$_POST['jenisfilter'])=="bulanan"){
	$str = " ( ".$_POST['namabulan'].", ".$_POST["tahunfilter"]." )";
}else{
	$str = " ( Mulai ".date_format(date_create($_POST['tanggalmulai']),"d-m-Y")." Sampai ".date_format(date_create($_POST['tanggalsampai']),"d-m-Y")." )";
}


?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title"><?php echo $_POST['nama'].$str; ?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable" style="overflow:scroll; max-height: 400px;">
	        <table id="datatablepopup" class="table table-striped table-bordered dt-responsive">
	          	<thead>
		            <tr>
		               <th>No</th>
		               <th>Tanggal</th>
		               <th>Dari</th>
		               <th>Jenis Laporan</th>
		               <th>Program</th>
		               <th>Ditangani</th>		               
		               <th>Tujuan</th>
		               <th>Kategori</th>
		               <th width="400px">Detail</th>
		               <th width="400px">Solusi</th>
		               <th>Rating</th>
		               <th>Lama Pengerjaan</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($listhdpopup); $i++){
					?>
			    			<tr>
								<td><?php echo $listhdpopup[$i]["no"]; ?></td>
								<td><?php echo $listhdpopup[$i]["tanggal"]; ?></td>
								<td><?php echo $listhdpopup[$i]["dari"]; ?></td>
								<td><?php echo $listhdpopup[$i]["jenis"]; ?></td>
								<td><?php echo $listhdpopup[$i]["program"]; ?></td>
								<td><?php echo $listhdpopup[$i]["ditangani"]; ?></td>								
								<td><?php echo $listhdpopup[$i]["tujuan"]; ?></td>
								<td><?php echo $listhdpopup[$i]["kategori"]; ?></td>
								<td><?php echo $listhdpopup[$i]["detail"]; ?></td>
								<td><?php echo $listhdpopup[$i]["solusi"]; ?></td>
								<td><?php echo $listhdpopup[$i]["rating"]; ?></td>
								<td><?php echo $listhdpopup[$i]["waktu"]." Menit"; ?></td>
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
<script type="text/javascript">
$('#datatablepopup').DataTable();
</script>