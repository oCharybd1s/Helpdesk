<?php
	@include('../../action/GetData.php');
  	$systemini = read_ini_file();
?>
<div class="row">
	<!-- todo -->
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Helpdesk Yang Anda Ambil</h2>
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
      	<div class='col-md-6 col-sm-6 col-xs-12'>
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
      	<div class='col-md-6 col-sm-6 col-xs-12'>
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
		               <th>Status</th>
		               <!-- <th>Tanggal Selesai</th> -->
		               <th>Konfirmasi</th>
		               <th>Detail</th>
		               <th>Tujuan</th>
		               <th>Kategori</th>
		               <th>Gambar</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getItToDoList); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getItToDoList[$i]['No']?></a></td> <!---No--->
								<?php if($_SESSION['jabatan'] >=1){?>
						            <td class="mycenter">
						              <?php
						                  if($getItToDoList[$i]['prioritas']=='1'){
						                      echo '<img src="../resources/images/priority.png" title="Prioritas utama dikerjakan" style="width:80px;height:80px;">';
						                  }else{
						                    echo "Antrian";
						                  }
						              ?>
						            </td> <!---Prioritas--->
						         <?php }?>
								<td><?php echo date_format($getItToDoList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getItToDoList[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getItToDoList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
								<td><?php echo $getItToDoList[$i]['Aplikasi2'];?></td> <!---Program--->
								<td><?php if($getItToDoList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getItToDoList[$i]['DitanganiOleh'];}?></td>
								<td class="mycenter"> 
									<?php
	                                    if($getItToDoList[$i]['Status2']=='Selesai'){
	                                      	echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
	                                    }else if($getItToDoList[$i]['Status2']=="Dalam Penanganan"){
	                                        echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
	                                    }else{
	                                    	echo "-";
	                                    }
	                              	?>
								</td>
								<!--<td><?php //echo $getItToDoList[$i]['TanggalSelesai2']?></td>--> <!---Tanggal Selesai- -->
								<td class="mycenter">
									<?php
	                                    if($getItToDoList[$i]['accPATA']=='1'){
						                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
						                }else if($getItToDoList[$i]['accPATA']=='0'){
						                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
						                }else if($getItToDoList[$i]['accPATA']=='2'){
						                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
						                }
	                              	?>
								</td> <!---Konfirmasi--->
								<td><?php echo $getItToDoList[$i]['issue']?></td> <!---Jenis Keterangan--->
								<td><?php echo $getItToDoList[$i]['tujuan']?></td> <!---Tujuan--->
								<td><?php echo $getItToDoList[$i]['kategori']?></td> <!---Kategori--->
								<td>
									<?php 
										$gambarHD = getGambarHD(str_replace("/","",$getItToDoList[$i]['No']));
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