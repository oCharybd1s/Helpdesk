<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  	<div class="x_panel">
      	<div class="x_title">
      		<center>
	        	<h2 id="title" style="float:none;">
	        		<center>
	        			Sisa Cuti Anda Tahun <?php echo $currentYear." adalah  ". (12-count($getCutiMassal)-count($getCutiC)) ." <br/>(12 - Cuti Bersama - Cuti Anda berkategori Cuti)"; ?>
	        		</center>
	    		</h2>
	        	<div class="clearfix"></div>
        	</center>
  		</div>
    </div>
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Cuti Bersama Tahun <?php echo $currentYear." = ".count($getCutiMassal);?> </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatableAbsen" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               <th>Tanggal</th>
		               <th>Kategori</th>
		               <th>Keterangan</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getCutiMassal); $i++){
					?>
			    			<tr>
								<td><?php echo date_format($getCutiMassal[$i]['Tgl'],"d-M-Y");?></td> <!---Tanggal--->
								<td><?php if($getCutiMassal[$i]['Alasan']=='L'){echo "Libur Nasional";}else{echo "Cuti Bersama";};?></td> <!---Dari--->
								<td><?php echo $getCutiMassal[$i]['Ket'];?></td> <!---Jenis Laporan--->
							</tr>
				  	<?php
				  		}
				  	?>
				</tbody>
	        </table>
	    </div>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Cuti Anda Tahun <?php echo $currentYear." = ".count($getCutiAnda); ?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatableAbsen" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               <th>Tanggal</th>
		               <th>Kategori</th>
		               <th>Keterangan</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getCutiAnda); $i++){
					?>
			    			<tr>
								<td><?php echo date_format($getCutiAnda[$i]['tgl'],"d-M-Y");?></td> <!---Tanggal--->
								<td><?php if($getCutiAnda[$i]['gol']=='K'){echo "Cuti Khusus";}else{echo "Cuti";};?></td> <!---Dari--->
								<td><?php echo $getCutiAnda[$i]['Ket'];?></td> <!---Jenis Laporan--->
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