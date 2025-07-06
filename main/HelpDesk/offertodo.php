<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Helpdesk Yang Ditugaskan PATA</h2>
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
        <div class='col-md-4 col-sm-6 col-xs-12'>
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
            Bulan
            <div class="form-group">
                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
                	<option value="All">All</option>
	    			<option value="01">Januari</option><option value="02">Februari</option>
	    			<option value="03">Maret</option><option value="04">April</option>
	    			<option value="05">Mei</option><option value="06">Juni</option>
	    			<option value="07">Juli</option><option value="08">Agustus</option>
	    			<option value="09">September</option><option value="10">Oktober</option>
	    			<option value="11">November</option><option value="12">Desember</option>
			  	</select>
            </div>
        </div>
      	<div class='col-md-4 col-sm-6 col-xs-12'>
            Tahun
            <div class="form-group">
                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
	    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear+2; ?>"><?php echo $currentYear-2; ?></option>
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
		               <?php if($_SESSION['jabatan'] >=1){?> <th>Prioritas</th> <?php }?>
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
		               <th>Gambar</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getOfferToDoList); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getOfferToDoList[$i]['No']?></a></td> <!---No--->
								<?php if($_SESSION['jabatan'] >=1){?>
						            <td class="mycenter">
						              <?php
						                  if($getOfferToDoList[$i]['prioritas']=='1'){
						                      echo '<img src="../resources/images/priority.png" title="Prioritas utama dikerjakan" style="width:80px;height:80px;">';
						                  }else{
						                    echo "Mengikuti Antrian";
						                  }
						              ?>
						            </td> <!---Prioritas--->
						         <?php }?>
								<td><?php echo date_format($getOfferToDoList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getOfferToDoList[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getOfferToDoList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
								<td><?php echo $getOfferToDoList[$i]['Aplikasi2'];?></td> <!---Program--->
								<td><?php if($getOfferToDoList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getOfferToDoList[$i]['DitanganiOleh'];}?></td>
								<td class="mycenter"> 
									<?php
	                                    if($getOfferToDoList[$i]['Status2']=='Selesai'){
	                                      	echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
	                                    }else if($getOfferToDoList[$i]['Status2']=="Dalam Penanganan"){
	                                        echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
	                                    }else{
	                                    	echo "-";
	                                    }
	                              	?>
								</td>
								<td><?php echo $getOfferToDoList[$i]['TanggalSelesai2']?></td> <!---Tanggal Selesai--->
								<td class="mycenter">
									<?php
	                                    if($getOfferToDoList[$i]['accPATA']=='1'){
	                                      	echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
	                                    }else if($getOfferToDoList[$i]['accPATA']=='0'){
	                                        echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
	                                    }else if($getOfferToDoList[$i]['accPATA']=='2'){
	                                        echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
	                                    }
	                              	?>
								</td> <!---Konfirmasi--->
								<td><?php echo $getOfferToDoList[$i]['issue']?></td> <!---Jenis Keterangan--->
								<td><?php echo $getOfferToDoList[$i]['tujuan']?></td> <!---Tujuan--->
								<td><?php echo $getOfferToDoList[$i]['kategori']?></td> <!---Kategori--->
								<td>
									<?php 
										$gambarHD = getGambarHD(str_replace("/","",$getOfferToDoList[$i]['No']));
										for($j=0; $j<count($gambarHD); $j++){ 
										?>
												<a id='<?php echo $gambarHD[$j]['NamaFile'];?>' onclick="previewGambar(this.id)"><?php echo $gambarHD[$j]['NamaFile']?></a>
										<?php
										}
									?>
								</td> <!---Gambar--->
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