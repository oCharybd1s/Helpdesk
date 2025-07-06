<?php
	@include('../../action/GetData.php');
	$tanggalditangani = [];
	$tanggalselesai = [];
	for($i=0;$i<count($getListJob);$i++){
		if(is_null($getListJob[$i]["TanggalDitangani"])){
			$tanggalditangani[$i] = "-";
		}else{
			$tanggalditangani[$i] = date_format($getListJob[$i]["TanggalDitangani"],"d/m/Y h:i:s");
		}

		if(is_null($getListJob[$i]["TanggalSelesai"])){
			$tanggalselesai[$i] = "-";
		}else{
			$tanggalselesai[$i] = date_format($getListJob[$i]["TanggalSelesai"],"d/m/Y h:i:s");
		}
	}
?>
<!-- allpj -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Job Internal (Hardware)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<div class='col-md-3 col-sm-12 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterJob()">
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
        <div class='col-md-3 col-sm-12 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterJob()">
	    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
	    			<option value="All">All</option>
			  	</select>
            </div>
        </div>
        <?php if($_SESSION['jabatan']>1){ ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group" style="text-align:right">
                <input id="tambahData" type="button" class="btn btn-default" value="Tambah Job" onclick="addJobHW('IT Hardware/NewInternalHW');" />
            </div>
        </div>
    	<?php } ?>
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="overflow-x:auto;">
	          	<thead>
		            <tr>
		               	<th>No</th>
                        <th>Tanggal</th>
                        <th>Dari</th>                            
                        <th>Job</th>
                        <th>Ditangani</th>  
                        <th>Tanggal Ditangani</th>
                        <th>Tanggal Selesai</th>                   
                        <th>Solusi</th>
                        <th>Lama Pengerjaan</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php for($i=0;$i<count($getListJob);$i++){ ?>
					<tr>
						<td><a href="#" onclick="EditJob('<?php echo $getListJob[$i]["No"]; ?>','IT Hardware/EditInternalHW');"><?php echo $getListJob[$i]["No"]; ?></a></td>
						<td><?php echo date_format($getListJob[$i]["Tanggal"],"d/m/Y"); ?></td>
						<td><?php echo $getListJob[$i]["namadari"]; ?></td>
						<td><?php echo $getListJob[$i]["Job"]; ?></td>
						<td><?php echo $getListJob[$i]["namaditangani"]; ?></td>
						<td><?php echo $tanggalditangani[$i]; ?></td>
						<td><?php echo $tanggalselesai[$i]; ?></td>
						<td><?php echo $getListJob[$i]["Solusi"]; ?></td>
						<td><?php echo $getListJob[$i]["waktupengerjaan"]." Menit"; ?></td>
					</tr>
					<?php } ?>
				</tbody>
	        </table>
	    </div>
      </div>
    </div>
  </div>
</div>