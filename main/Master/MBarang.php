<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Master Hardware</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group" style="text-align:right">
                <input id="tambahData" type="button" class="btn btn-default" value="Tambah Hardware" onclick="addhardware('Master/NewHardware');" />
            </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          	<div>&nbsp;</div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               <th>ID Hardware</th>
		               <th>Nama Hardware</th>
		               <th>Jumlah</th>
		               <th>Dipinjam</th>
		               <th>Tersedia</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($databarang); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a href="#" onclick="goEdit('<?php echo $i;?>')"><?php echo $databarang[$i]['idbarang']?></a></td> <!---Jenis Keterangan--->
								<td><?php echo $databarang[$i]['descript']; ?></td> <!---Tujuan--->
								<td align="right"><?php echo $databarang[$i]['onhand']; ?></td> <!---Kategori--->
								<td align="right"><?php echo $databarang[$i]['alocate']; ?></td>
								<td align="right"><?php echo $databarang[$i]['onhand']-$databarang[$i]['alocate']; ?></td>
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