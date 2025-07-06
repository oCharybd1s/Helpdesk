<?php
	@include('../../action/GetData.php');
	echo "<script> console.log('HELPDESK : waiteditpj') </script>";
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Pengajuan Baru</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class='col-md-3 col-sm-12 col-xs-12'>
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
      	<div class='col-md-3 col-sm-12 col-xs-12'>
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
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
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="<?php echo $currentYear; ?>"><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
	    			<option value="All" selected>All</option>
			  	</select>
            </div>
        </div>
        <div class='col-md-3 col-sm-12 col-xs-12'>
            Cabang
            <div class="form-group">
                <select id="cabang" name="cabang" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="All">All</option>
				  	<?php for($i=1; $i<count($getCabang); $i++){ ?>
			    			<option value="<?php echo $getCabang[$i]['NamaCab']?>"><?php echo $getCabang[$i]['NamaCab']; ?></option>
				  	<?php } ?>
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
                        <th>Tanggal Buat</th>
                        <th>Dari</th>                            
                        <th>Cabang</th>
                        <th>Nama Investasi</th>  
                        <th>Biaya</th>
                        <th>Jadwal</th>                   
                        <th>Alasan</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getWaitPengajuan); $i++){
					?>
			    			<tr>
								<td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getWaitPengajuan[$i]['No']?></a></td> <!---No--->
								<td><?php echo date_format($getWaitPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getWaitPengajuan[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getWaitPengajuan[$i]['cabang'];?></td> <!---Cabang--->
								<td><?php echo $getWaitPengajuan[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
								<td><?php echo number_format($getWaitPengajuan[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
								<td><?php echo $getWaitPengajuan[$i]['jadwal'];?></td> <!---Jadwal--->
								<td><?php echo wordwrap($getWaitPengajuan[$i]['alasan'],120,"<br />") ?></td> <!---Alasan---><!---Tanggal selesai--->
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