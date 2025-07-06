<?php
	@include('../model/Home.php');
	$dataPegawai = getDataDetailPegawai($_SESSION['siapa']);
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Halaman Profile</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
        	<div class="item form-group">
        		<center>
        			<img src="../upload/<?php echo $dataPegawai[0]['gambar'];?>" class="img-circle " width="10%" height="10%"><br>
        			<span onclick="ubahFoto()" class="label label-primary mypointer">Ubah Foto</span>
        		</center>
        	</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nik">NIK</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="nik" name="nik" type="text" value="<?php echo $dataPegawai[0]['NIK']; ?>" disabled readonly>
				</div>
			</div>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" value="<?php echo $dataPegawai[0]['Nama']; ?>" disabled>
	            </div>
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nickname">NickName</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="nickname" name="nickname" class="form-control col-md-7 col-xs-12" placeholder="Nickname" value="<?php echo $dataPegawai[0]['NickName']; ?>" > 
	            </div>
	        </div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text" id="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="Password" value="<?php echo $dataPegawai[0]['Password']; ?>"> 
	            </div>
	        </div>
	        <div class="item form-group">&nbsp;</div>
          	<div id="uploadFoto" class="item form-group" style="display:none;">
	            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="website"><center>Foto Profil</center></label>
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website"></label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <div action="../action/UploadProfile.php" id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data" ></div>
	            </div>
          	</div>
          	<div class="ln_solid"></div>
	      	<div class="form-group">
	            <div class="col-md-6 col-md-offset-3">
	              	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
	              	<input id="submitHelpdesk" type="button" class="btn btn-success" value="Simpan" onclick="simpanProfile()" />
	            </div>
	        </div>
        </div>
      </div>
    </div>
  </div>
</div>