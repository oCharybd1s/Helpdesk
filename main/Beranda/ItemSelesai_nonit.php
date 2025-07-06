<?php
session_start();
@include('../../action/GetData.php');	
if(isset($_POST["tahun"])){
	$tahun = $_POST['tahun'];
}else{
	$tahun = date('Y');
}
$bulan = [];
$bulan[0] = "Januari";
$bulan[1] = "Februari";
$bulan[2] = "Maret";
$bulan[3] = "April";
$bulan[4] = "Mei";
$bulan[5] = "Juni";
$bulan[6] = "Juli";
$bulan[7] = "Agustus";
$bulan[8] = "September";
$bulan[9] = "Oktober";
$bulan[10] = "Nopember";
$bulan[11] = "Desember";
if(isset($_POST["bulan"])){
	$bulan_now = $_POST['bulan'];
}else{
	$bulan_now = date('m');
}
?>
<div class="x_title">
    <h2  id="title">Komplain Selesai</small></h2>
    <ul class="nav navbar-left panel_toolbox">
      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="item form-group">
	<label class="control-label col-md-1 col-sm-1 col-xs-12">Bulan</label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    	<select class="form-control" id="bulanselesai_nonit" onchange="filterhomehd(9);">
    	<?php for($i=0;$i<count($bulan);$i++){ ?>
      	<option value="<?php echo $i+1; ?>" <?php if(($i*1)+1==$bulan_now*1){ ?> selected <?php } ?>><?php echo $bulan[$i]; ?></option>
      	<?php } ?>
      </select>
    </div>
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Tahun</label>
    <div class="col-md-2 col-sm-2 col-xs-12">
      <select class="form-control" id="tahunselesai_nonit" onchange="filterhomehd(9);">
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
<table id="datatableSelesai" class="table table-striped table-bordered dt-responsive nowrap">
		  <thead>
		    <tr>
		      <th class="all">No</th>
		      <th class="all">Tanggal</th>
		      <th class="all">Jenis Laporan</th>
		      <th class="all">Program</th>
		      <th class="all">Ditangani</th>
		      <th class="all">Tanggal Selesai</th>
		      <th class="all">Detail</th>
		      <th class="all">Tujuan</th>
		      <th class="all">Kategori</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php
		      for($i=0; $i<count($getComplainDone); $i++){
		    ?>
		        <tr>
		          <td id="NoHDS<?php echo $i; ?>"><a href='#' onclick="goEdit('NoHDS<?php echo $i;?>')"><?php echo $getComplainDone[$i]['No']?></a></td> <!---No--->
		          <td><?php echo date_format($getComplainDone[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
		          <td><?php echo $getComplainDone[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
		          <td><?php echo $getComplainDone[$i]['Aplikasi2'];?></td> <!---Program--->
		          <td><?php if($getComplainDone[$i]['DitanganiOleh']==''){echo "-";}else{echo $getComplainDone[$i]['DitanganiOleh'];}?></td>
		          <td><?php echo $getComplainDone[$i]['TanggalSelesai2']?></td> <!---Tanggal Selesai--->
		          <td><?php echo $getComplainDone[$i]['issue']?></td> <!---Jenis Keterangan--->
		          <td><?php echo $getComplainDone[$i]['tujuan']?></td> <!---Tujuan--->
		          <td><?php echo $getComplainDone[$i]['kategori']?></td> <!---Kategori--->
		        </tr>
		      <?php
		        }
		      ?>
		  </tbody>
		</table>
 	</div>
</div>
<script type="text/javascript">
	$('#datatableSelesai').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>