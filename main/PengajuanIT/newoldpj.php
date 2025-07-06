<?php
	@include('../../action/GetData.php');

	$tampil = "block";
	$tampil2 = "none";
	if($_SESSION['divisi']=="IT"){
		$tampil = "none";
		$tampil2 = "block";
	}
	// echo $_SESSION['halaman_terbuka'];
?>
<!-- newpj -->
<script type="text/javascript">
	$('#tblapproval').hide();
	$('#hideCusApp').hide();
	$('#approvlevel').hide();
</script>
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
				  <input class="form-control col-md-7 col-xs-12" id="noIssue" name="noIssue" type="text" value="<?php echo $getNewNoOldPeng[0]["NoPeng"]; ?>" disabled>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPeng">No Pengajuan Lama</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="oldnumber" name="oldnumber" type="text" >
				</div>
			</div>
			<div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglPeng">Date Entry</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="dateentry" name="dateentry" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; //ini tanggal saat ini. ?>" value="<?php echo $tanggalIssue.' (mm/dd/yyyy)'; ?>" disabled>
          </div>
      </div>
    	<div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglPeng">Tanggal Pengajuan</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="date" id="tglPeng" name="tglPeng" class="form-control col-md-7 col-xs-12" tanggal="<?php echo $tanggalIssue; //ini tanggal saat ini. ?>">
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
            <input type="text" id="biaya" name="biaya" class="form-control col-md-7 col-xs-12" placeholder="Isi hanya dengan angka saja ! Contoh: 0 atau 500000" onchange="setApprovalLevel()"> 
          </div>
      </div>
      <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jadwal">Jadwal</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="jadwal" name="jadwal" class="form-control col-md-7 col-xs-12" > 
          </div>
      </div>
      <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alasan">Alasan</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="alasan" name="alasan" class="form-control col-md-7 col-xs-12" ></textarea>
          </div>
      </div>
      <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="analisis">Analisis</label>
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
      <div class="item form-group">
      	<div class="item form-group">
          <table id="datatable" class="table table-hover">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>                
              <?php for($i=0; $i<count($gambarLampiranPj); $i++){ ?>
                      <tr>
                        <td class='col-md-10 col-sm-10 col-xs-12'><?php echo $gambarLampiranPj[$i]['namafile']?></td>
                        <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["uploadLampiranPJ"].$gambarLampiranPj[$i]['namafile'];?>' target='_blank'>Preview</a></td>
                        <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["uploadLampiranPJ"].$gambarLampiranPj[$i]['namafile'];?>' download>Download</a></td>
                      </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="item form-group">
              <input id="btnaddfile" type="button" class="btn btn-warning" value="+ Lampiran" onclick="kliktambahlampiran()" />
              <input type="file" accept="image/*" class="form-control-file" id="addlampiran" onchange="addlampiranPJ();" style="display:none;">
        </div>
      </div>	        
      <div class='form-group'>
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status ACC </label>
        <div class='col-md-6 col-sm-6 col-xs-12 full-border pad-10'>
	        <div class='col-md-12 col-sm-6 col-xs-12 pad-10' id="approvlevel">        	
	        </div>
	        <div id="Custom">
	        	<input type="button" onclick="ShowCusApp()" class="col-md-12 btn btn-success" style="float:right;" id="showCusApp" value="Insert Custom Approval" >
	        	<input type="button" onclick="HideCusApp()" class="btn btn-warning" style="float:right; background-color:#EA961D;" id="hideCusApp" value="Hide Custom Approval" >
	        	<table class="table" id="tblapproval">
	        		<thead>
	        			<th>Select to delete</th>
	        			<th>Approval Name</th>
	        			<th>Approval Date</th>
	        		</thead>
	        		<tbody>
	        			<td class="col-sm-1" align="left">
	                <input type='checkbox' class='form-control caseapproval' />
	              </td>
	        			<td class="col-md-1">
	        				<input type="text" name="" id="approvalname0" class="form-control" />
	        			</td>
	        			<td class="col-md-1">
	        				<input type="date" name="" id="approvaldate0" class="form-control" />
	        			</td>
	        		</tbody>
	        		<tfoot>
	        			<tr>
	        				<td colspan="2">
	        					<button type="button" style="background-color:#F47062;" class='btn btn-default btn-warning deleteapproval' >- Delete</button>
	                  <button type="button" style="background-color:#1B91CB;" class='btn btn-default btn-info addmoreapproval'>+ Add More</button>
	        				</td>
	        			</tr>
	        		</tfoot>
	        	</table>
	        </div>
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Realisasi Biaya (Rp)</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input class="form-control col-md-7 col-xs-12" id="realisasi" type="text" class="form-control">
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Upload Nota Pembelian<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div action="../action/UploadNotaPembelianLama.php" id="notaDropzone" class="dropzone form-control full-border" enctype="multipart/form-data" ><input type="hidden" name="jumfile" id="jumfile" value="0"></div>
        </div>
      </div>
    	<div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            	<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
            	<input id="submitPengajuan" initial="newPengLama" type="button" class="btn btn-success" value="Submit" onclick="simpanPengajuanLama()" />
            	<!-- <input id="submitPengajuan" type="button" class="btn btn-success" value="Submit" onclick="checkfiledanrealisasilama()" /> -->
          </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(".deleteapproval").on('click', function() {
  $('.caseapproval:checkbox:checked').parents("tr").remove();
    $('.check_all').prop("checked", false); 
  check();
});

$(".addmoreapproval").on('click',function(){
// alert($('#dtidenpelanggan tr').length)
var i=$('#tblapproval tr').length-2;
  
  var data="<tr><td align='center'><input type='checkbox' class='form-control caseapproval'/></td>";
  data +='<td class="col-sm-1" align="left"><input type="text" id="approvalname'+i+'" class="form-control" /></td><td class="col-sm-1" align="left"><input type="date" id="approvaldate'+i+'" class="form-control" /></td></tr>';
  $('#tblapproval').append(data);
  //i++;
});
</script>
<!-- <div id="modal-container2">
  <div class="modal-background">
    <div class="modal">
      <div class="x_content">       
        <div class="item form-group">
          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="tanggalkembali">Realisasi (Rp)</label>
          <div class="col-md-7 col-sm-7 col-xs-12">
            <input  class="form-control col-md-7 col-xs-12" id="realisasi" type="text" class="form-control">
          </div> 
        </div> 
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-12 col-sm-12 col-xs-12">Upload Nota Pembelian</label>
          <div class="item form-group">
                <div action="../action/Uploadnotapembelian.php" id="notaDropzone" class="dropzone form-control col-md-7 col-xs-12 full-border" enctype="multipart/form-data" ><input type="hidden" name="jumfile" id="jumfile" value="0"></div>
          </div>
        </div>           
      </div>     
      <div class="item form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-primary" id="batal" barisnya="" onclick="tutupPopupAksesDoc2();">Batal</button>
            <button type="button" class="btn btn-primary" id="batal" barisnya="" onclick="addAttachmentNota();">Simpan</button>
          </div>
        </div>
    </div>
  </div>
</div> -->