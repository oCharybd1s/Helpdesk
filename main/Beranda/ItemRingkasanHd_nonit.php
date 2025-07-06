<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
    <h2 id="title">Komplain Terbuka Tahun <?php echo date('Y'); ?></small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content scroll">
  	<div class="table-responsive">
        <table id="datatableringkasanterbuka" class="table table-striped table-bordered dt-responsive jambo_table">
		  <thead>
		    <tr>
		      <th class="all">No</th>
		      <th class="all">Tanggal</th>
		      <th class="all">Jenis Laporan</th>
		      <th class="all">Program</th>
		      <th class="all">PATA</th>
		      <th class="all">Detail</th>
		      <th class="all">Tujuan</th>
		      <th class="all">Kategori</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php
		      for($i=0; $i<count($getComplainOpenRingkasan); $i++){
		    ?>
		        <tr>
		          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $getComplainOpenRingkasan[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($getComplainOpenRingkasan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $getComplainOpenRingkasan[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $getComplainOpenRingkasan[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td>
		            <?php
		                if($getComplainOpenRingkasan[$i]['accPATA']=='1'){
		                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                }else if($getComplainOpenRingkasan[$i]['accPATA']=='0'){
		                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                }else if($getComplainOpenRingkasan[$i]['accPATA']=='2'){
		                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                }
		            ?>
		          </td> <!---Konfirmasi--->
		          <td><?php echo $getComplainOpenRingkasan[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $getComplainOpenRingkasan[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $getComplainOpenRingkasan[$i]['kategori']?></td> <!---Kategori--->
		        </tr>
		      <?php
		        }
		      ?>
		  </tbody>
		</table>
  	</div>
</div>
<div class="x_title">
    <h2 id="title">Komplain Selesai Tahun <?php echo date('Y'); ?></small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content scroll">
  	<div class="table-responsive">
        <table id="datatableringkasanselesai" class="table table-striped table-bordered dt-responsive jambo_table">
		  <thead>
		    <tr>
		      <th class="all">No</th>
		      <th class="all">Tanggal</th>
		      <th class="all">Jenis Laporan</th>
		      <th class="all">Program</th>
		      <th class="all">PATA</th>
		      <th class="all">Detail</th>
		      <th class="all">Tujuan</th>
		      <th class="all">Kategori</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php
		      for($i=0; $i<count($getComplainRingkasanSelesai); $i++){
		    ?>
		        <tr>
		          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $getComplainRingkasanSelesai[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($getComplainRingkasanSelesai[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $getComplainRingkasanSelesai[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $getComplainRingkasanSelesai[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td>
		            <?php
		                if($getComplainRingkasanSelesai[$i]['accPATA']=='1'){
		                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                }else if($getComplainRingkasanSelesai[$i]['accPATA']=='0'){
		                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                }else if($getComplainRingkasanSelesai[$i]['accPATA']=='2'){
		                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                }
		            ?>
		          </td> <!---Konfirmasi--->
		          <td><?php echo $getComplainRingkasanSelesai[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $getComplainRingkasanSelesai[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $getComplainRingkasanSelesai[$i]['kategori']?></td> <!---Kategori--->
		        </tr>
		      <?php
		        }
		      ?>
		  </tbody>
		</table>
  	</div>
</div>
<div class="x_title">
    <h2 id="title">Komplain Dibuat Tahun <?php echo date('Y'); ?></small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content scroll">
  	<div class="table-responsive">
        <table id="datatableringkasandibuat" class="table table-striped table-bordered dt-responsive jambo_table">
		  <thead>
		    <tr>
		      <th class="all">No</th>
		      <th class="all">Tanggal</th>
		      <th class="all">Jenis Laporan</th>
		      <th class="all">Program</th>
		      <th class="all">PATA</th>
		      <th class="all">Detail</th>
		      <th class="all">Tujuan</th>
		      <th class="all">Kategori</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php
		      for($i=0; $i<count($getComplainRingkasanDibuat); $i++){
		    ?>
		        <tr>
		          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $getComplainRingkasanDibuat[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($getComplainRingkasanDibuat[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $getComplainRingkasanDibuat[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $getComplainRingkasanDibuat[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td>
		            <?php
		                if($getComplainRingkasanDibuat[$i]['accPATA']=='1'){
		                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                }else if($getComplainRingkasanDibuat[$i]['accPATA']=='0'){
		                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                }else if($getComplainRingkasanDibuat[$i]['accPATA']=='2'){
		                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                }
		            ?>
		          </td> <!---Konfirmasi--->
		          <td><?php echo $getComplainRingkasanDibuat[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $getComplainRingkasanDibuat[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $getComplainRingkasanDibuat[$i]['kategori']?></td> <!---Kategori--->
		        </tr>
		      <?php
		        }
		      ?>
		  </tbody>
		</table>
  	</div>
</div>
<script type="text/javascript">
	$('#datatableringkasanterbuka').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': true, 
		 'bInfo': true,
		 'bPaginate': true,
		 'stateSave': false,
		 'bDestroy': true
	});
	$('#datatableringkasanselesai').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': true, 
		 'bInfo': true,
		 'bPaginate': true,
		 'stateSave': false,
		 'bDestroy': true
	});
	$('#datatableringkasandibuat').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': true, 
		 'bInfo': true,
		 'bPaginate': true,
		 'stateSave': false,
		 'bDestroy': true
	});
</script>