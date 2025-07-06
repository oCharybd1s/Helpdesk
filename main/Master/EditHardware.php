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
        <h2>Form Master Hardware (Edit)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
				<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">ID Hardware</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="idbarang" name="idbarang" type="text" value="<?php echo $nomerbarang; ?>" disabled>
				</div>
			</div>
        	<div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Nama Hardware</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="descript" name="descript" type="text" value="<?php echo $databarang[0]["descript"]; ?>">
            </div>
        	</div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Quantity</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="onhand" name="onhand" type="text" value="<?php echo $databarang[0]["onhand"]; ?>" onchange="checkbarang();">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Alocate</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="alocate" name="alocate" type="text" value="<?php echo $databarang[0]["alocate"]; ?>" readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tersedia</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="alocate" name="alocate" type="text" value="<?php echo $databarang[0]["onhand"]-$databarang[0]["alocate"]; ?>"  readonly="">
            </div>
          </div>
      </div> 
  <div class="x_content">
            <form class="form-horizontal form-label-left input_mask">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" onclick="backToAllHdList()">Batal</button>
                    <button type="button" class="btn btn-success" onclick="submithardware('../action/NewHardware',2)">Simpan</button>
                    <?php if($databarang[0]["alocate"]<1){ ?>
                    <button type="button" class="btn btn-danger" onclick="hapushardware('../action/DeleteHardware')">Hapus</button>
                  <?php } ?>
                  </div>
                </div>
            </form>
        </div>
</div>
</body>
</html>