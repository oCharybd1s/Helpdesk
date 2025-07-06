<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Peminjaman Hardware</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	
      	<div class='col-md-12 col-sm-12 col-xs-12'>
          	<div class="ln_solid"></div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group" style="text-align:right">
                <input id="tambahData" type="button" class="btn btn-default" value="Buat Peminjaman" onclick="addPinjam('HelpDesk/NewPinjam');" />
            </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          	<div>&nbsp;</div>
      	</div>
      	<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
	        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
	          	<thead>
		            <tr>
		               <th>No</th>
		               <th>Tanggal Pinjam</th>
		               <th>Peminjam</th>
		               <th>Sampai Tanggal</th>
		               <th>Diserahkan Oleh</th>
		               <th>Status Kembali</th>
		               <th>Tanggal Kembali</th>
		               <th>Diterima Oleh</th>
		            </tr>
	          	</thead>
				<tbody>
					<?php
						for($i=0; $i<count($datapinjam); $i++){
					?>
			    			<tr>
								<td id="idhd<?php echo $i;?>"><a href="#" onclick="goEdit('<?php echo $i;?>')"><?php echo $datapinjam[$i]['nopinjam']?></a></td> <!---Jenis Keterangan--->
								<td><?php echo $datapinjam[$i]['tanggal2']?></td> <!---Tujuan--->
								<td><?php echo $datapinjam[$i]['nama']?></td> <!---Kategori--->
								<td><?php echo $datapinjam[$i]['duedate2']?></td>
								<td><?php echo $datapinjam[$i]['namapemberi']?></td>
								<td><?php echo $datapinjam[$i]['status2']?></td>
								<td><?php echo $datapinjam[$i]['tanggalkembali2']?></td>
								<td><?php echo $datapinjam[$i]['namapenerima']?></td>
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