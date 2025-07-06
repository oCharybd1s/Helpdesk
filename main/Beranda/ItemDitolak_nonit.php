<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
		        <h2>Komplain Ditolak</small></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div> 
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatableDitolak" class="table table-striped table-bordered dt-responsive nowrap">
					  <thead>
					    <tr>
					      <th class="all">No</th>
					      <th class="all">Tanggal</th>
					      <th class="all">Jenis Laporan</th>
					      <th class="all">Program</th>
					      <th class="all">Detail</th>
					      <th class="all">Tujuan</th>
					      <th class="all">Kategori</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getComplainRejected); $i++){
					    ?>
					        <tr>
					          <td id="NoHDD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHDD<?php echo $i;?>')"><?php echo $getComplainRejected[$i]['No']?></a></td> <!---No--->
					          <td><?php echo date_format($getComplainRejected[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
					          <td><?php echo $getComplainRejected[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
					          <td><?php echo $getComplainRejected[$i]['Aplikasi2'];?></td> <!---Program--->
					          <td><?php echo $getComplainRejected[$i]['issue']?></td> <!---Jenis Keterangan--->
					          <td><?php echo $getComplainRejected[$i]['tujuan']?></td> <!---Tujuan--->
					          <td><?php echo $getComplainRejected[$i]['kategori']?></td> <!---Kategori--->
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
<script type="text/javascript">
	$('#datatableDitolak').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>