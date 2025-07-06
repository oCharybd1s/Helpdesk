<?php
session_start();
@include('../../action/GetData.php');	
if(isset($_POST["tahun"])){
	$tahun = $_POST['tahun'];
}else{
	$tahun = date('Y');
}
?>
<div class="x_title">
    <h2 id="title">Semua Komplain</small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="item form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Tahun</label>
    <div class="col-md-2 col-sm-2 col-xs-12">
      <select class="form-control" id="tahuntebuka_nonit" onchange="filterhomehd(8);">
      	<option value="<?php echo date('Y')-5; ?>" <?php if(date('Y')-5==$tahun){ ?> selected <?php } ?>><?php echo date('Y')-5; ?></option>
      	<option value="<?php echo date('Y')-4; ?>" <?php if(date('Y')-4==$tahun){ ?> selected <?php } ?>><?php echo date('Y')-4; ?></option>
      	<option value="<?php echo date('Y')-3; ?>" <?php if(date('Y')-3==$tahun){ ?> selected <?php } ?>><?php echo date('Y')-3; ?></option>
      	<option value="<?php echo date('Y')-2; ?>" <?php if(date('Y')-2==$tahun){ ?> selected <?php } ?>><?php echo date('Y')-2; ?></option>
      	<option value="<?php echo date('Y')-1; ?>" <?php if(date('Y')-1==$tahun){ ?> selected <?php } ?>><?php echo date('Y')-1; ?></option>
      	<option value="<?php echo date('Y'); ?>" <?php if(date('Y')==$tahun){ ?> selected <?php } ?>><?php echo date('Y'); ?></option>
      </select>
    </div>
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
		      for($i=0; $i<count($getComplainOpen); $i++){
		    ?>
		        <tr>
		          <td id="NoHD<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHD<?php echo $i;?>')"><?php echo $getComplainOpen[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($getComplainOpen[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $getComplainOpen[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $getComplainOpen[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td>
		            <?php
		                if($getComplainOpen[$i]['accPATA']=='1'){
		                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
		                }else if($getComplainOpen[$i]['accPATA']=='0'){
		                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
		                }else if($getComplainOpen[$i]['accPATA']=='2'){
		                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
		                }
		            ?>
		          </td> <!---Konfirmasi--->
		          <td><?php echo $getComplainOpen[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $getComplainOpen[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $getComplainOpen[$i]['kategori']?></td> <!---Kategori--->
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