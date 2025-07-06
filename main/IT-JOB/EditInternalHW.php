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
				  <input class="form-control col-md-7 col-xs-12" id="no" name="no" type="text" value="<?php echo $nomor; ?>" disabled>
				</div>
			</div>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglPeng">Tanggal</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="tanggal" name="tanggal" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; //ini tanggal saat ini. ?>" value="<?php echo date_format($dataEdit[0]["Tanggal"],"m/d/Y").' (mm/dd/yyyy)'; ?>" disabled>
	            </div>
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dari">Dari</label>
	            <div class="col-md-6 col-sm-6 col-xs-12"> 
				  <select class="form-control" id="dari" style="display: <?php echo $tampil2; ?>">
	              	<?php for($i=0; $i<count($listuserhd); $i++){ ?>
	              		<option value="<?php echo $listuserhd[$i]["nik"]; ?>" <?php if($listuserhd[$i]["nik"]==str_replace(" ","",$dataEdit[0]["Dari"])){ ?> selected="" <?php } ?>><?php echo $listuserhd[$i]["nik"]." (".$listuserhd[$i]["nama"].")"; ?></option>
	              	<?php } ?>
	              </select>
	            </div>
	        </div>	        
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alasan">Deskripsi</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="job" name="job" class="form-control col-md-7 col-xs-12" rows="10"><?php echo $dataEdit[0]["Job"]; ?></textarea>
	            </div>
	        </div>
	        <div class="item form-group" id="grpsolusi">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alasan">Solusi</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="solusi" name="solusi" class="form-control col-md-7 col-xs-12" rows="10"><?php echo $dataEdit[0]["Solusi"]; ?></textarea>
	            </div>
	        </div>
          	<div class="ln_solid"></div>
	      	<div class="form-group">
	            <div class="col-md-6 col-md-offset-3">
	              	<button type="button" class="btn btn-primary" onclick="location.reload(true);">Kembali</button>
	              	<input id="btnpause" type="button" class="btn btn-success" value="Pause" onclick="pauseJob()" />
	              	<input id="btnresume" type="button" class="btn btn-success" value="Resume" onclick="resumejob()" />
	              	<input id="btnkerjakan" type="button" class="btn btn-success" value="Kerjakan" onclick="kerjakanJobHW()" />
	              	<input id="btnselesai" type="button" class="btn btn-success" value="Selesai" onclick="SelesaiJobHW(0)" />
	              	<input id="btnupdate" type="button" class="btn btn-success" value="Update" onclick="submitJobHW(0)" />
	            </div>
	        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		var leveluser = <?php echo json_encode($_SESSION['jabatan']); ?>;
		var ditangani = <?php echo json_encode($dataEdit[0]["valditangani"]); ?>;
		var selesai = <?php echo json_encode($dataEdit[0]["valselesai"]); ?>;
		var ispaused = <?php echo json_encode(count($getPaused)); ?>;
		var userditangani = <?php echo json_encode($dataEdit[0]["Ditangani"]); ?>;
		var useraktif = <?php echo json_encode($_SESSION['siapa']); ?>;
		settingdisplay(ditangani,selesai,leveluser,ispaused,userditangani,useraktif);
	});
</script>