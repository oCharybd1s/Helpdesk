<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
	        <h2  id="title">List HelpDesk Over Time</h2>
	        <ul class="nav navbar-left panel_toolbox">
	          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div>
	    <div class="x_content scroll">
		      	<div class="table-responsive">
	            <table id="datatableovertime" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
							  <thead>
								    <tr>
								      <th class="all">No</th>
								      <th class="all">Tanggal</th>
								      <th class="all">Dari</th>
								      <th class="all">Cabang</th>
								      <th class="all" >Tujuan</th>
								      <th class="all">Kategori</th>
								      <th class="all">Masalah</th>
								      <th class="all">Solusi</th>
								      <th class="all">Tanggal Konfirmasi</th>
								      <th class="all">Tanggal Dikerjakan</th>
								      <th class="all">Tanggal Selesai</th>
								      <th class="all">Lama Pengerjaan</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php for($i=0;$i<count($tabeldataovertime);$i++){ ?>
								  	<tr>
								  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldataovertime[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldataovertime[$i]["No"]; ?></a></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["Tanggal2"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["dari"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["cabang"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["tujuan"]; ?></td>
								  		<td align="left"><?php echo $tabeldataovertime[$i]["kategori"]; ?></td>
								  		<td align="left"><?php echo substr($tabeldataovertime[$i]["issue"],0,50)." ..."; ?></td>
								  		<td align="left"><?php echo substr($tabeldataovertime[$i]["Solusi"],0,50)." ..."; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["TanggalKonfirmasi2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["AcceptWork2"]; ?></td>
								  		<td align="center"><?php echo $tabeldataovertime[$i]["TanggalSelesai2"]; ?></td>
								  		<td align="right"><?php echo $tabeldataovertime[$i]["lamapengerjaan"]." Menit"; ?></td>
								  	</tr>
								  	<?php } ?>
								  </tbody>
							</table>
	        	</div>
		    </div>
	    </div>
<script type="text/javascript">
	$('#datatableovertime').DataTable({
		"bDestroy": true
	});
</script>