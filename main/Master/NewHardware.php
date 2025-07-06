<?php
	@include('../../action/GetData.php');
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Modal Animations</title>
  

    <!-- <script src="./resources/Popup/js/prefixfree.min.js"></script> -->

</head>

<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Master Hardware</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
				<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">ID Hardware</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="idbarang" name="idbarang" type="text" value="<?php echo $nomerbarang[0]["nomer"]; ?>" disabled>
				</div>
			</div>
        	<div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Nama Hardware</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="descript" name="descript" type="text">
            </div>
        	</div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Quantity</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="onhand" name="onhand" type="text">
            </div>
          </div>
      </div> 
  <div class="x_content">
            <form class="form-horizontal form-label-left input_mask">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" onclick="backToAllHdList()">Batal</button>
                    <button type="button" class="btn btn-success" onclick="submithardware('../action/NewHardware',1)">Simpan</button>
                  </div>
                </div>
            </form>
        </div>
</div>
<div id="modal-container2">
  <div class="modal-background">
    <div class="modal">
      <div class="x_content">       
        <div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
          <table id="listproduct" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
            <thead>
              <tr>
                <th class='col-md-1 col-sm-12 col-xs-12'>ID BARANG</th>
                <th class='col-md-1 col-sm-12 col-xs-12'>DESKRIPSI</th>
                <th class='col-md-1 col-sm-12 col-xs-12'>TERSEDIA</th>           
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0; $i<0; $i++){
              ?>
                <tr id="pilihprod">
                  <td>&nbsp;</td> <!---No--->
                  <td>&nbsp;</td> <!---No--->
                  <td>&nbsp;</td> <!---No--->
                </tr>
              <?php
                }
              ?>
            </tbody>
          </table>                
        </div>    
        <div class="col-md-12 col-sm-12 col-xs-12">
          <button type="button" class="btn btn-primary" id="batal" barisnya="" onclick="HapusDetailBarang();tutupPopupAksesDoc2();">Batal</button>
        </div>
      </div>     
    </div>
  </div>
</div>
</body>
</html>