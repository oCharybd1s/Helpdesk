<?php
	@include('../../action/GetData.php');
	echo "<script> console.log('HELPDESK : aplikasi') </script>";
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Master Aplikasi</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class='col-md-2 col-sm-12 col-xs-12'>
            <div class="form-group">
                <input id="tambahData" type="button" class="btn btn-default" value="Tambah Aplikasi" onclick="addAplikasi();" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="hidden-top">
	        <div class='col-md-1 col-sm-12 col-xs-12'>
	            <input class="form-control" id="nomorAplikasi" name="nomorAplikasi" type="text" placeholder="No" >
	        </div>
	        <div class='col-md-4 col-sm-12 col-xs-12'>
	            <input class="form-control" id="namaAplikasi" name="namaAplikasi" type="text" placeholder="Nama Aplikasi">
	         </div>
	        <div class='col-md-2 col-sm-12 col-xs-12'>
	             <input id="submitAplikasi" type="button" class="btn btn-success" value="Simpan Data" onclick="simpanAplikasi()" />
	        </div>
	    </div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="overflow-x:auto;">
	          	<thead>
		            <tr>
		               	<th width="10%">No</th>
                        <th width="60%">Nama Aplikasi</th>
                        <th width="30%" style="text-align: center;">Action</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($jenisAplikasi); $i++){
					?>
			    			<tr>
								<td><?php echo $jenisAplikasi[$i]['Apl']?></td>
								<td>
									 <input id="tambahData-<?php echo $jenisAplikasi[$i]['Apl']; ?>" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $jenisAplikasi[$i]['NamaAplikasi'];?>"/>
								</td> 
								<td>
									<input id="hapus" type="button" class="btn btn-danger btnDelete" value="HAPUS" onclick="actionAplikasi('<?php echo $jenisAplikasi[$i]['Apl'];?>','<?php echo $jenisAplikasi[$i]['NamaAplikasi'];?>','hapus')" />
									<input id="ubah" type="button" class="btn btn-success " value="UBAH" onclick="actionAplikasi('<?php echo $jenisAplikasi[$i]['Apl'];?>','<?php echo $jenisAplikasi[$i]['NamaAplikasi'];?>','ubah')" />
								</td> 
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