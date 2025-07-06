<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
		        <h2 id="title">Komplain Terbuka</h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>		    
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatableterbuka" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>
					    <tr>
					      <th>Kode Cabang</th>
					      <th>Nama Cabang</th>
					      <th>Jumlah Komplain</th>
					  </thead>
					  <tbody>
					    <?php
					      for($i=0; $i<count($getKomplainTerbuka); $i++){
					    ?>
					        <tr align="center">
					          <td><?php echo $getKomplainTerbuka[$i]["Cabang"]; ?></td>
					          <td><?php echo $getKomplainTerbuka[$i]["NamaCab"]; ?></td>
					          <td><?php echo $getKomplainTerbuka[$i]["jum"]; ?></td>
					        </tr>
					      <?php
					        }
					      ?>
					  </tbody>
					</table>
              	</div>
		    </div>
<script type="text/javascript">
	$('#datatableterbuka').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': false, 
		 'bInfo': false,
		 'bPaginate': false,
		 'bDestroy': true
	});
</script>