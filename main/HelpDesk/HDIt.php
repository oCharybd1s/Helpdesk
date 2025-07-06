<?php
	@include('../../action/GetData.php');
  	$systemini = read_ini_file();
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Helpdesk Dibuat Oleh IT</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">      	      	
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
	    			<option value="All" selected>All</option>
	    			<option value="<?php echo $currentYear; ?>" ><?php echo $currentYear; ?></option>
	    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
	    			<option value="<?php echo $currentYear-2; ?>"><?php echo $currentYear-2; ?></option>
			  	</select>
            </div>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>
      		Status
            <div class="form-group">
                <select id="statusselesai" name="statusselesai" class="form-control col-md-7 col-xs-12" onchange="filterHD()" >
                	<option value="All">All</option>
                	<option value="1">Langsung Selesai</option>
                	<option value="0">Input Baru</option>                
			  	</select>
            </div>
        </div>
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatableithd" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               <th>No</th>
		               <?php if($_SESSION['jabatan'] >=1){?> <th>Prior</th> <?php }?>
		               <th>Tanggal</th>
		               <th>Dari</th>
		               <th>Cabang</th>
		               <th>Jenis Laporan</th>
		               <th>Program</th>
		               <th>Detail</th>
		               <th>Tujuan</th>
		               <th>Kategori</th>
		               <th>Note PATA</th>
		               <th>Gambar</th>
		               <th>Keterangan</th>
		               <th>status</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getItHDList); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getItHDList[$i]['No']?></a></td> <!---No--->
								<?php if($_SESSION['jabatan'] >=1){?>
									<td class="mycenter"><center>
										<?php
											// echo $getItHDList[$i]['prioritas'];
		                                    if($getItHDList[$i]['prioritas']=='1'){
		                                      	echo '<img src="../resources/images/icon-prior1.png" title="Prioritas Utama" style="width:25px;height:30px;">';
		                                    }else{
		                                    	echo '<img src="../resources/images/icon-prior2.png" title="Prioritas Kedua" style="width:25px;height:30px;">';
		                                    	// echo "Mengikuti Antrian";
		                                    }
		                              	?></center>
	                              	</td> <!---Prioritas--->
                              	<?php }?>
								<td><?php echo date_format($getItHDList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
								<td><?php echo $getItHDList[$i]['dari2'];?></td> <!---Dari--->
								<td><?php echo $getItHDList[$i]['cabang'];?></td> <!---Jenis Laporan--->
								<td><?php echo $getItHDList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->								
								<td><?php echo $getItHDList[$i]['Aplikasi2'];?></td> <!---Program--->								
								<td><?php echo $getItHDList[$i]['issue']?></td> <!---Jenis Keterangan--->
								<td><?php echo $getItHDList[$i]['tujuan']?></td> <!---Tujuan--->
								<td><?php echo $getItHDList[$i]['kategori']?></td>
								<td><?php echo $getItHDList[$i]['NotePATA']?></td> <!---Kategori--->
								<td>
									<?php 
										$gambarHD = getGambarHD(str_replace("/","",$getItHDList[$i]['No']));

										for($j=0; $j<count($gambarHD); $j++){ 
											$explodean = explode(".",$gambarHD[$j]['NamaFile']);
										?>
												<a id='<?php echo $gambarHD[$j]['NamaFile'];?>'
													<?php
														if(strtolower($explodean[1])=='pdf' || strtolower($explodean[1])=='doc' || strtolower($explodean[1])=='docx' || strtolower($explodean[1])=='dbf' || strtolower($explodean[1])=='xls' || strtolower($explodean[1])=='xlsx'){
													?>
														href='<?php echo $systemini["UPLOADED"].$gambarHD[$j]['NamaFile'];?>' download
													<?php
														}else{
													?>
															onclick="previewGambar(this.id)"
													<?php
														}
													?>
												style='cursor: pointer;'><?php echo $gambarHD[$j]['NamaFile']?></a>
										<?php
										}
									?>
								</td> <!---Gambar--->
								<td><?php echo $getItHDList[$i]['statusnote']; ?></td>
								<td><?php echo $getItHDList[$i]['isselesai']; ?></td>
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
$(document).ready(function(){	
	$('#datatableithd').DataTable( {
        "responsive": true,
       	"bDestroy": true,
       	"stateSave": false,
       	"order": [[1, 'asc']],
        "columnDefs": [
        	{ orderable: false,targets: 0 },
        	{ orderable: true,targets: 1 },
        	{ orderable: false,targets: 2 },
        	{ orderable: false,targets: 3 },
        	{ orderable: false,targets: 4 },
        	{ orderable: false,targets: 5 },
        	{ orderable: false,targets: 6 },
        	{ orderable: false,targets: 7 },
        	{ orderable: false,targets: 8 },
        	{ orderable: false,targets: 9 },
        	{ orderable: false,targets: 10 },
        	{ orderable: false,targets: 11 },
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 1, targets: 2 },
            { responsivePriority: 10002, targets: 3 },
            { responsivePriority: 10002, targets: 4 },
            { responsivePriority: 1, targets: 5 },
            { responsivePriority: 1, targets: 6 },
            { responsivePriority: 10001, targets: 7 },
            { responsivePriority: 10002, targets: 8 },
            { responsivePriority: 1, targets: 9 },
            { responsivePriority: 1, targets: 10 },
            { responsivePriority: 10002, targets: 11 }
        ]
    } );
});
</script>