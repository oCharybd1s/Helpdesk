<?php
session_start();
@include('../../action/GetData.php');	
?>
<div class="x_title">
		        <h2  style="background-color:#96beff;" id="title">Helpdesk Tahun <?php echo date('Y'); ?></h2>
		        <ul class="nav navbar-left panel_toolbox">
		          <li><a class="collapse-link" onclick="collapseOnly(this);"><i class="fa fa-chevron-up"></i></a></li>
		        </ul>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content scroll">
		      	<div class="table-responsive">
                    <table id="datatabledetkomplaintahun" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
					  <thead>        
			        <tr>
			          <?php foreach($detKomplainTahun[0] as $key=>$value){ ?>
			          <th class='all'><?php echo $key; ?></th>              
			          <?php } ?>
			          <!-- <th>Location</th> -->
			        </tr>
			      </thead>
			      <tbody>
			      	<?php for($i=0;$i<count($detKomplainTahun);$i++){ ?>
			        <tr>
			          <?php foreach($detKomplainTahun[0] as $key=>$value){ ?>
			          	<td align="left">
			          		<?php if($key=="No"){ ?>
			          			<a href="#" onclick="showdetailhdberanda('<?php echo $detKomplainTahun[$i][$key]; ?>','PREVIEW HD SELESAI','../main/beranda/previewhd')">
			          		<?php } ?>
			          			<?php if($key=="Komplain" || $key=="Solusi"){ echo substr($detKomplainTahun[$i][$key],0,60)." ..."; }else{ echo $detKomplainTahun[$i][$key]; } ?>
			          		<?php if($key=="No"){ ?>
			          			</a>
			          		<?php } ?>
			          	</td>
			          <?php } ?>
			        </tr>
			    	<?php } ?>
			      </tbody>
					</table>
              	</div>
		    </div>
<script type="text/javascript">
	$('#datatabledetkomplaintahun').DataTable({
		'order': [[ 1, 'desc' ]],
		 'bFilter': true, 
		 'bInfo': true,
		 'bPaginate': true,
		 'stateSave': true,
		 'bDestroy': true
	});
</script>