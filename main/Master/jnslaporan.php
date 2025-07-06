<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Master Jenis Laporan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class='col-md-2 col-sm-12 col-xs-12'>
            <div class="form-group">
                <input id="tambahData" type="button" class="btn btn-default" value="Tambah Laporan" onclick="addAplikasi();" />
            </div>
        </div>
        <div class='col-md-1 col-sm-12 col-xs-12 hidden-top'>
            <input class="form-control hidden-top" id="nomorAplikasi" name="nomorAplikasi" type="text" placeholder="No" disabled >
        </div>
        <div class='col-md-4 col-sm-12 col-xs-12 hidden-top'>
            <input class="form-control hidden-top" id="namaAplikasi" name="namaAplikasi" type="text" placeholder="Nama Laporan" disabled >
         </div>
        <div class='col-md-2 col-sm-12 col-xs-12 hidden-top'>
             <input id="submitAplikasi" type="button" class="btn btn-success hidden-top" value="Simpan Data" onclick="simpanAplikasi()" disabled/>
        </div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               	<th>No</th>
                        <th>Nama Laporan</th>
                        <th>Action</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($jenisLaporan); $i++){
					?>
			    			<tr>
								<td><?php echo $jenisLaporan[$i]['Lap']?></td>
								<td>
									 <input id="tambahData-<?php echo $jenisLaporan[$i]['Lap']; ?>" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $jenisLaporan[$i]['NamaLaporan'];?>"/>
								</td> 
								<td>
									<input id="hapus" type="button" class="btn btn-danger btnDelete" value="Hapus" onclick="actionAplikasi('<?php echo $jenisLaporan[$i]['Lap'];?>','<?php echo $jenisLaporan[$i]['NamaLaporan'];?>','hapus')" />
									<input id="ubah" type="button" class="btn btn-success " value="Ubah" onclick="actionAplikasi('<?php echo $jenisLaporan[$i]['Lap'];?>','<?php echo $jenisLaporan[$i]['NamaLaporan'];?>','ubah')" />
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