<?php
	@include('../../action/GetData.php');

	$tampil = "block";
	$tampil2 = "none";
	if($_SESSION['divisi']=="IT"){
		$tampil = "none";
		$tampil2 = "block";
	}
?>
<!-- newpj -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Job Hardware</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPeng">No</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="no" name="no" type="text" value="<?php echo $newNumber[0]["nomor"]; ?>" disabled>
				</div>
			</div>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglPeng">Tanggal</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="tanggal" name="tanggal" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; //ini tanggal saat ini. ?>" value="<?php echo $tanggalIssue.' (mm/dd/yyyy)'; ?>" disabled>
	            </div>
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dari">Dari</label>
	            <div class="col-md-6 col-sm-6 col-xs-12"> 
				  <select class="form-control" id="dari" style="display: <?php echo $tampil2; ?>">
	              	<?php for($i=0; $i<count($listuserhd); $i++){ ?>
	              		<option value="<?php echo $listuserhd[$i]["nik"]; ?>" <?php if($listuserhd[$i]["nik"]==$_SESSION['siapa']){ ?> selected="" <?php } ?>><?php echo $listuserhd[$i]["nik"]." (".$listuserhd[$i]["nama"].")"; ?></option>
	              	<?php } ?>
	              </select>
	            </div>
	        </div>	        
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alasan">Deskripsi</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="job" name="job" class="form-control col-md-7 col-xs-12" rows="15"></textarea>
	            </div>
	        </div>
          	<div class="ln_solid"></div>
	      	<div class="form-group">
	            <div class="col-md-6 col-md-offset-3">
	              	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
	              	<button type="button" class="btn btn-primary" onclick="location.reload(true);">Kembali</button>
	              	<input id="submitPengajuan" type="button" class="btn btn-success" value="Submit" onclick="submitJobHW(1)" />
	            </div>
	        </div>
        </div>
      </div>
    </div>
  </div>
</div>