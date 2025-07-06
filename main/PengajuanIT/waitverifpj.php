<?php
	@include('../../action/GetData.php');
	echo "<script> console.log('HELPDESK : waitverifpj') </script>";
	// echo $getWaitVerifPATAPengajuan[0]['konfirmasi'];
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Pengajuan Tunggu Verif PATA</h2>
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
	    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
	    			<option value="All">All</option>
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
                        <th>Status</th>
                        <th>Alasan</th>
                        <th>Analisis</th>
                        <th>Penjelasan</th>    
                        <th>Tanggal Konfirmasi</th>
                        <th>Tanggal Selesai</th> 
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getWaitVerifPATAPengajuan); $i++){
					?>
			    			<tr>
								<td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getWaitVerifPATAPengajuan[$i]['No']?></a></td> <!---No--->
								<td><?php echo date_format($getWaitVerifPATAPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['cabang'];?></td> <!---Cabang--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
								<td><?php echo number_format($getWaitVerifPATAPengajuan[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['jadwal'];?></td> <!---Jadwal--->
								<td class="mycenter"> 
									<?php
	                                    if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=='0'){
	                                      	echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
	                                    }else if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=="1"){
	                                        echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
	                                    }else if($getWaitVerifPATAPengajuan[$i]['konfirmasi']=="2"){
	                                        echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
	                                    }
	                              	?>
								</td>
								<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
								<td><?php echo wordwrap($getWaitVerifPATAPengajuan[$i]['analisis'],120,"<br />") ?></td> <!---Analisis--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['ket']?></td> <!---Penjelasan--->
								<td><?php echo $getWaitVerifPATAPengajuan[$i]['tanggalkonfirmasi']?></td> <!---Tanggal konfirmasi--->
								<td>
									<?php
	                                    if($getWaitVerifPATAPengajuan[$i]['tanggalselesai']==''){
	                                        echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
	                                    }else{
	                                      	echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">'.$getWaitVerifPATAPengajuan[$i]['tanggalselesai'];
	                                    }
	                              	?>
								</td> <!---Tanggal selesai--->
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