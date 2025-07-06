<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
    <h2 id="title">Semua Komplain</small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content scroll">
  	<div class="table-responsive">
        <table id="datatableSemua" class="table table-striped table-bordered dt-responsive jambo_table">
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
		      for($i=0; $i<count($ComplainTerbukaAll); $i++){
		    ?>
		        <tr>
		          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $ComplainTerbukaAll[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($ComplainTerbukaAll[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $ComplainTerbukaAll[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $ComplainTerbukaAll[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td>
		            <?php
		                if($ComplainTerbukaAll[$i]['accPATA']=='1'){
		                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                }else if($ComplainTerbukaAll[$i]['accPATA']=='0'){
		                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                }else if($ComplainTerbukaAll[$i]['accPATA']=='2'){
		                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                }
		            ?>
		          </td> <!---Konfirmasi--->
		          <td><?php echo $ComplainTerbukaAll[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $ComplainTerbukaAll[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $ComplainTerbukaAll[$i]['kategori']?></td> <!---Kategori--->
		        </tr>
		      <?php
		        }
		      ?>
		  </tbody>
		</table>
  	</div>
</div>
<script type="text/javascript">
	$('#datatableSemua').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>