<?php
	@include('../../action/GetData.php');
	echo "<script> console.log('HELPDESK : newpj') </script>";

	$tampil = "block";
	$tampil2 = "none";
	if($_SESSION['divisi']=="IT"){
		$tampil = "none";
		$tampil2 = "block";
	}
	// echo $_SESSION['halaman_terbuka'];
?>
<!-- newpj -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Tulis Pengajuan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPeng">No Pengajuan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="noPeng" name="noPeng" type="text" value="Nomor akan di-generate secara otomatis saat submit pengajuan" disabled>
				</div>
			</div>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglPeng">Tanggal</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="tglPeng" name="tglPeng" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; //ini tanggal saat ini. ?>" value="<?php echo $tanggalIssue.' (mm/dd/yyyy)'; ?>" disabled>
	            </div>
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dari">Dari</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="dari" name="dari" class="form-control col-md-7 col-xs-12" nameonly="<?php echo $_SESSION['siapa']; ?>" value="<?php echo $_SESSION['siapa']." (".$_SESSION['siapanama'].")"; ?>" style="display: <?php echo $tampil; ?>" disabled> 
				  <select class="form-control" id="dari2" onchange="ubahdari()" style="display: <?php echo $tampil2; ?>">
	              	<?php for($i=0; $i<count($listuserhd); $i++){ ?>
	              		<option value="<?php echo $listuserhd[$i]["nik"]; ?>" <?php if($listuserhd[$i]["nik"]==$_SESSION['siapa']){ ?> selected="" <?php } ?>><?php echo $listuserhd[$i]["nik"]." (".$listuserhd[$i]["nama"].")"; ?></option>
	              	<?php } ?>
	              </select>
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cabang">Cabang</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
					<?php if ($_SESSION['jabatan']>0) { ?>
						<input type="text" id="cabang" name="cabang" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['namacabang']; ?>"> 
					<?php } else { ?>
	    	          	<input type="text" id="cabang" name="cabang" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['namacabang']; ?>" disabled> 
					<?php } ?>
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kepada">Kepada</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="kepada" name="kepada" class="form-control col-md-7 col-xs-12" > 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="up">UP</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="up" name="up" class="form-control col-md-7 col-xs-12" > 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="investasi">Investasi</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="investasi" name="investasi" class="form-control col-md-7 col-xs-12" > 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="biaya">Biaya</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="biaya" name="biaya" class="form-control col-md-7 col-xs-12" placeholder="Isi hanya dengan angka saja ! Contoh: 0 atau 500000" onchange="ubahNoPengajuan()"> 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jadwal">Jadwal</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="jadwal" name="jadwal" class="form-control col-md-7 col-xs-12" > 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alasan">Keterangan User</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="alasan" name="alasan" class="form-control col-md-7 col-xs-12" ></textarea>
	            </div>
	        </div>
	        <div class="item form-group" style="display:none">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="analisis">Analisa IT</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="analisis" name="analisis" class="form-control col-md-7 col-xs-12" ></textarea>
	            </div>
	        </div>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Upload gambar<span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <div action="../action/UploadPengajuan.php" id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data" ></div>
	            </div>
          	</div>
          	<div class="ln_solid"></div>
	      	<div class="form-group">
	            <div class="col-md-6 col-md-offset-3">
	              	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
	              	<input id="submitPengajuan" type="button" class="btn btn-success" value="Submit" onclick="submitPengajuan()" />
	            </div>
	        </div>
        </div>
      </div>
    </div>
  </div>
</div>