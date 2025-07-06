<?php
	@include('../../action/GetData.php');
	echo "<script> console.log('HELPDESK : newhd') </script>";

	$tampil = "block";
	$tampil2 = "none";
	if($_SESSION['divisi']=="IT"){
		$tampil = "none";
		$tampil2 = "block";
	}
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Tulis Helpdesk</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">No Issue</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="noIssue" name="noIssue" type="text" value="Nomor akan di-generate secara otomatis saat submit helpdesk" disabled>
				</div>
			</div>
			<?php if($_SESSION['divisi']=="IT"){ ?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Helpdesk</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select id="jenishd" name="jenishd" class="form-control" onchange="gantijenishd();">
		    			<option value="1" selected>Helpdesk Baru</option>
		    			<option value="2">Helpdesk Selesai</option>
				  </select>
				</div>
			</div>
			<?php } ?>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglIssue">Tanggal Issue</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	            	<?php if($_SESSION['divisi']!="IT"){ ?>
	              <!-- <input type="text" id="tglIssue" name="tglIssue" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; ?>" value="<?php echo $tanggalIssue.' (mm/dd/yyyy)'; ?>" readonly> -->
	              <input id="tglIssue" name="tglIssue" type="datetime-local" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo Date('Y-m-d\TH:i',time()); ?>" disabled>
	              <?php }else{ ?>	              
	              <input id="tglIssue" name="tglIssue" type="datetime-local" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo Date('Y-m-d\TH:i',time()); ?>">
	            	<?php } ?>
	            </div>
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dari">Dari</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="dari" name="dari" class="form-control col-md-7 col-xs-12" nameonly="<?php echo $_SESSION['siapa']; ?>" value="<?php echo $_SESSION['siapa']." (".$_SESSION['siapanama'].")"; ?>" style="display: <?php echo $tampil; ?>" disabled> 
	              <select class="form-control" id="dari2" name="dari2" onchange="ubahdari()" style="display: <?php echo $tampil2; ?>">
	              	<?php for($i=0; $i<count($listuserhd); $i++){ ?>
	              		<option value="<?php echo $listuserhd[$i]["nik"]; ?>" <?php if($listuserhd[$i]["nik"]==$_SESSION['siapa']){ ?> selected="" <?php } ?>><?php echo $listuserhd[$i]["nik"]." (".$listuserhd[$i]["nama"].")"; ?></option>
	              	<?php } ?>
	              </select>
	            </div>
	        </div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select id="kehendak" name="kehendak" class="form-control" onchange="gantiTujuan();">
		    			<option id="defaultKehendak" value="0" selected disabled>Silahkan Pilih Tujuan</option>
		    			<option value="Komplain">Komplain</option>
		    			<option value="Request">Request</option>
				  </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select id="jenis" name="jenis" class="form-control" onchange="gantiKategori();" disabled>
		    			<option id="defaultKategori" value="0" selected disabled>Silahkan Pilih Kategori </option>
		    			<option value="Software">Software</option>
		    			<option value="Hardware">Hardware</option>
				  </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Laporan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select id="jenisLaporan" name="jenisLaporan" class="form-control" onchange="gantiJenisLaporan();" disabled>
		    			<option id="defaultLaporan" value="0" selected disabled>Silahkan Pilih Jenis Laporan</option>
				  	<?php 
				  		$bag = substr($jenisLaporan[0]['NamaLaporan'],0,1);
				  		$bts=0;
				  		for($i=0; $i<count($jenisLaporan); $i++){ 
				  			if ($bag == substr($jenisLaporan[$i]['NamaLaporan'],0,1)) {
				  	?>
						  	<?php 
						  		if ($_SESSION['jabatan'] != 2 &&  substr($jenisLaporan[$i]['NamaLaporan'],0,2)=='IT') {}
						  		else { ?>
					    			<option id="jenisLaporan<?php echo $jenisLaporan[$i]['Lap']?>" value="<?php echo $jenisLaporan[$i]['Lap']?>"><?php echo $jenisLaporan[$i]['NamaLaporan']?></option>
					    		<?php } ?>
						  	<?php 
				  			} else { ?>
				  					<?php 
							  		if ($_SESSION['jabatan'] != 2 &&  substr($jenisLaporan[$i]['NamaLaporan'],0,2)=='IT') {}
							  		else { ?>
							  			<option id="bts<?php echo $bts; ?>" disabled>-------------</option>
							  			<?php $bts=$bts+1; ?>
						    			<option id="jenisLaporan<?php echo $jenisLaporan[$i]['Lap']?>" value="<?php echo $jenisLaporan[$i]['Lap']?>"><?php echo $jenisLaporan[$i]['NamaLaporan']?></option>
					    		<?php } ?>
				  	<?php 
				  			} 
				  			$bag = substr($jenisLaporan[$i]['NamaLaporan'],0,1);
				  		}
				  	?>
				  </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Program yang dimaksud</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select id="programYangDimaksud" name="programYangDimaksud" class="form-control" onchange="openDeskripsi();" disabled>
		    			<option id="defaultProgramYangDimaksud" value="0" selected disabled>Silahkan Pilih Program Yang Dimaksud</option>
				  	<?php 
				  			$bag = substr($jenisAplikasi[0]['NamaAplikasi'],0,1);
				  			for($i=0; $i<count($jenisAplikasi); $i++){ 
				  					if ($bag == substr($jenisAplikasi[$i]['NamaAplikasi'],0,1)) {
				  	?>
			    			<option value="<?php echo $jenisAplikasi[$i]['Apl']?>"><?php echo $jenisAplikasi[$i]['NamaAplikasi']?></option>
				  	<?php
				  			} else { ?>
				  					<option disabled>-------------</option>
				  					<option id="jenisLaporan<?php echo $jenisAplikasi[$i]['Apl']?>" value="<?php echo $jenisAplikasi[$i]['Apl']?>"><?php echo $jenisAplikasi[$i]['NamaAplikasi']?></option>
				  	<?php
				  				}
				  				$bag = substr($jenisAplikasi[$i]['NamaAplikasi'],0,1);
				  			}
				  	?>
				  </select>
				</div>
			</div>

	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deskripsi</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="deskripsi" required="required" name="deskripsi" class="form-control col-md-7 col-xs-12" disabled></textarea>
	            </div>
	        </div>
	        <?php if($_SESSION['divisi']=="IT"){ ?>
	        <div class="item form-group" id="divtanggaldikerjakan">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Tanggal Dikerjakan</label>
	            <div class="col-md-3 col-sm-3 col-xs-12">
	              <input id="tanggaldikerjakan" name="tanggaldikerjakan" type="datetime-local" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo Date('Y-m-d\TH:i',time()); ?>">
	            </div>
	        </div>	
	        <div class="item form-group" id="divtanggalselesai">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Tanggal Selesai</label>
	            <div class="col-md-3 col-sm-3 col-xs-12">
	              <input id="tanggalselesai" name="tanggalselesai" type="datetime-local" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo Date('Y-m-d\TH:i',time()); ?>">
	            </div>
	        </div>
	        <div class="item form-group" id="estimasi">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi" hidden>Estimasi Pengerjaan</label>
	            <div class="col-md-2 col-sm-2 col-xs-12" hidden>
	              <input class="form-control col-md-2 col-xs-12" id="perkiraanwaktu" name="perkiraanwaktu" type="text" onchange="setmenitformat();" value="0 - Menit">
	            </div>
	        </div>
	        <div class="item form-group" id="catatan">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Catatan Penyelesaian</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="catatan1" name="catatan1" class="form-control col-md-7 col-xs-12" ></textarea>
	            </div>
	        </div>
	      	<?php } ?>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Upload gambar<span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <div action="../action/Upload.php" id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data" disabled></div>
	            </div>
          	</div>
          	<div class="ln_solid"></div>
	      	<div class="item form-group">
	            <div class="col-md-6 col-md-offset-3">
	              	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
	              	<input id="submitHelpdesk" type="button" class="btn btn-success" value="Submit" onclick="submitHD(0)" disabled/>
	            <!-- </div>
	            <div class="col-md-6 col-md-offset-3"> -->
	              	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
	              	<?php if(str_replace(" ","",$_SESSION['divisi'])=="IT"){ ?>
	              	<input id="submitSelesaiHelpdesk" type="button" class="btn btn-success" value="Selesai" onclick="submitHD(1)" disabled/>
	              	<?php } ?>
	            </div>
	        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){	
		// $('#dari2').select2();
		gantijenishd();
	});
</script>