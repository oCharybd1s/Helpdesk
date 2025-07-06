<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_panel full-border" id="tblsolved">
	<div class="x_title">
	    <h2  id="title">List Komplain Selesai</h2>
	    <ul class="nav navbar-left panel_toolbox">
	      <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
	    </ul>
	    <div class="clearfix"></div>
	</div>
	<div class="x_content scroll">
	      	<div class="table-responsive">
	        <table id="datatablesolved" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
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
							  	<?php for($i=0;$i<count($tabeldatasolved);$i++){ ?>
							  	<tr>
							  		<td><a href="#" onclick="showdetailhdberanda('<?php echo $tabeldatasolved[$i]["No"]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')"><?php echo $tabeldatasolved[$i]["No"]; ?></a></td>
							  		<td align="left"><?php echo $tabeldatasolved[$i]["Tanggal2"]; ?></td>
							  		<td align="left"><?php echo $tabeldatasolved[$i]["dari"]; ?></td>
							  		<td align="left"><?php echo $tabeldatasolved[$i]["cabang"]; ?></td>
							  		<td align="left"><?php echo $tabeldatasolved[$i]["tujuan"]; ?></td>
							  		<td align="left"><?php echo $tabeldatasolved[$i]["kategori"]; ?></td>
							  		<td align="left"><?php echo substr($tabeldatasolved[$i]["issue"],0,50)." ..."; ?></td>
							  		<td align="left"><?php echo substr($tabeldatasolved[$i]["Solusi"],0,50)." ..."; ?></td>
							  		<td align="center"><?php echo $tabeldatasolved[$i]["TanggalKonfirmasi2"]; ?></td>
							  		<td align="center"><?php echo $tabeldatasolved[$i]["AcceptWork2"]; ?></td>
							  		<td align="center"><?php echo $tabeldatasolved[$i]["TanggalSelesai2"]; ?></td>
							  		<td align="right"><?php echo $tabeldatasolved[$i]["lamapengerjaan"]." Menit"; ?></td>
							  	</tr>
							  	<?php } ?>
							  </tbody>
						</table>
	    	</div>
	    </div>
	</div>
	<div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatablekomplainditangani" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>
					    <tr>
					      <th>Nama</th>
					      <th>Komplain Ditangani</th>
					      <th>Total Waktu</th>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getHelpdeskDitangi); $i++){
					    ?>
					        <tr align="center">
					          <td><?php echo $getHelpdeskDitangi[$i]["Nama"]; ?></td>
					          <td><span style="cursor: pointer;" onclick="popupdetail('Beranda/popuplisthd','<?php echo $getHelpdeskDitangi[$i]["Nama"]; ?>','<?php echo $getHelpdeskDitangi[$i]["nik"]; ?>');"><?php echo $getHelpdeskDitangi[$i]["jum"]; ?></span></td>
					          <td><span style="cursor: pointer;" onclick="popupdetail('Beranda/popuplisthd','<?php echo $getHelpdeskDitangi[$i]["Nama"]; ?>','<?php echo $getHelpdeskDitangi[$i]["nik"]; ?>');"><?php echo $getHelpdeskDitangi[$i]["waktu"]." Menit"; ?></span></td>
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
<script type="text/javascript">
	$('#datatablesolved').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': true, 
		 'bInfo': true,
		 'bPaginate': true,
		 'stateSave': true,
		 'bDestroy': true
	});
	$('#datatablekomplainditangani').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>