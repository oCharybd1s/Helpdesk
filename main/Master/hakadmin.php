<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Hak Admin</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class='col-md-2 col-sm-12 col-xs-12 btnTambah'>
            <div class="form-group btnTambah">
                <input id="tambahData" type="button" class="btn btn-default" value="Tambah Orang IT" onclick="addAplikasi();" />
            </div>
        </div>

        <div class='col-md-2 col-sm-6 col-xs-12 hidden-top' hidden>
            <select id="idpegawai" name="idpegawai" class="form-control col-md-7 col-xs-12 hidden-top" onchange="gantiNama()" disabled>
            	<option value="All" selected disabled>Silahkan pilih</option>
			  	<?php for($i=0; $i<count($getSemuaPegawai); $i++){ ?>
		    			<option value="<?php echo $getSemuaPegawai[$i]['nik']?>"><?php echo $getSemuaPegawai[$i]['nik']?></option>
			  	<?php } ?>
			 </select>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 hidden-top' hidden>
            <select id="namapegawai" name="namapegawai" class="form-control col-md-7 col-xs-12 hidden-top" onchange="gantiID()" disabled>
            	<option value="All" selected disabled>Silahkan pilih</option>
			  	<?php for($i=0; $i<count($getSemuaPegawai); $i++){ ?>
		    			<option value="<?php echo $getSemuaPegawai[$i]['nik']?>"><?php echo $getSemuaPegawai[$i]['nama']?></option>
			  	<?php } ?>
			 </select>
        </div>
        <div class='col-md-2 col-sm-12 col-xs-12 hidden-top' hidden>
             <input id="submitTambahOrangIT" type="button" class="btn btn-success hidden-top" value="Simpan Data" onclick="tambahOrangIT()" disabled/>
        </div>

      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="overflow-x:auto;">
	          	<thead>
		            <tr>
		               	<th>NIK</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Password</th>
                        <th>Action</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($getITMemberList); $i++){
					?>
			    			<tr>
								<td><?php echo $getITMemberList[$i]['NIK']?></td>
								<td><?php echo $getITMemberList[$i]['Nama'];?></td>
								<td>
									<select id="statusData-<?php echo $getITMemberList[$i]['NIK']; ?>" class="form-control col-md-7 col-xs-12">
						            	<option value="1" <?php if($getITMemberList[$i]['Status']==1){echo "selected";} ?> >1 </option>
						            	<option value="2" <?php if($getITMemberList[$i]['Status']==2){echo "selected";} ?> >2 </option>
									 </select>
								</td> 
								<td><?php echo $getITMemberList[$i]['Password'];?></td> 
								<td>
									<input id="hapus" type="button" class="btn btn-danger " value="Hapus" onclick="actionHakAdmin('<?php echo $getITMemberList[$i]['NIK'];?>','<?php echo $getITMemberList[$i]['Status'];?>','hapus')" />
									<input id="ubah" type="button" class="btn btn-success " value="Ubah" onclick="actionHakAdmin('<?php echo $getITMemberList[$i]['NIK'];?>','<?php echo $getITMemberList[$i]['Status'];?>','ubah')" />
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