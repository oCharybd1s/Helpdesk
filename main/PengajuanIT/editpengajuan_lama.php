<?php
	@include('../../action/GetData.php');
  $systemini = read_ini_file();
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Detail Pengajuan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label " for="noIssue">No Pengajuan</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="noIssue" name="noIssue" type="text" value="<?php echo $detailPengajuan[0]['No']; ?>" readonly>
              <input class="form-control col-md-7 col-xs-12" id="noIssueLama" name="noIssueLama" type="hidden" value="<?php echo $detailPengajuan[0]['No']; ?>" readonly>
          </div>
        </div>
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label">Tanggal Pengajuan</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="tglPengajuan" name="tglPengajuan" tanggal="<?php echo date_format($detailPengajuan[0]['tanggal'],"Y/m/d H:i:s"); ?>" type="text" value="<?php echo $detailPengajuan[0]['tanggal2']; ?>" readonly>
          </div>
        </div>
  <!-- --------------------- -->
      	<div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="dari">Dari</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="dari" name="dari" idonly="<?php echo $detailPengajuan[0]['dari']; ?>" nameonly="<?php echo $detailPengajuan[0]['nama']; ?>" type="text" value="<?php echo preg_replace('/\s+/', '', $detailPengajuan[0]['dari'])." [".$detailPengajuan[0]['nama']."]"; ?>" readonly>
          </div>
        </div>
  <!-- --------------------- -->
      	<div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="cabang">Cabang</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="cabang" name="cabang" type="text" value="<?php echo $detailPengajuan[0]['cabang']; ?>" readonly>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
       <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="kepada">Kepada</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="kepada" name="kepada" type="text" value="<?php echo $detailPengajuan[0]['kepada']; ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> >
          </div>
        </div>
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="up">UP</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="up" name="up" type="text" value="<?php echo $detailPengajuan[0]['up']; ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?>>
          </div>
        </div>
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="biaya">Biaya</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="biaya" name="biaya" type="text" placeholder="Isi hanya dengan angka saja !" value="<?php echo number_format($detailPengajuan[0]['biaya'],0,'.','.'); ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> onfocusout="ubahNoPengajuan()">
          </div>
        </div>
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label" for="jadwal">Jadwal</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="jadwal" name="jadwal" type="text" value="<?php echo $detailPengajuan[0]['jadwal']; ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?>>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
    <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label" for="investasi">Nama Investasi</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="investasi" name="investasi" type="text" value="<?php echo $detailPengajuan[0]['namainvestasi']; ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> >
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="alasan">Alasan</label>
          <div class="item form-group">
                <textarea rows="7" id="alasan" name="alasan" class="form-control col-md-12 col-xs-12" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> ><?php echo $detailPengajuan[0]['alasan']; ?></textarea>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="analisis">Analisis</label>
          <div class="item form-group">
              <textarea rows="7" id="analisis" name="analisis" class="form-control col-md-12 col-xs-12" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> ><?php echo $detailPengajuan[0]['analisis']; ?></textarea>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
      <?php if($detailPengajuan[0]['konfirmasi']==2){?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="analisis">Alasan Tolak</label>
          <div class="item form-group">
              <textarea rows="7" id="keteranganTolak" name="keteranganTolak" class="form-control col-md-12 col-xs-12" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> ><?php echo $detailPengajuan[0]['ket']; ?></textarea>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
      <?php }?>
  <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Upload Gambar</label>
          <div class="item form-group">
                <div action="../action/UploadPengajuan.php" id="myAwesomeDropzone" class="dropzone form-control col-md-7 col-xs-12 full-border" enctype="multipart/form-data" ></div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <?php if(strlen($detailPengajuan[0]['No'])==16 && $detailPengajuan[0]['konfirmasi']==1){ ?>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <label class="control-label col-md-12 col-sm-12 col-xs-12">Status ACC</label>
            <div class='col-md-12 col-sm-12 col-xs-12 full-border pad-10'>
              <?php for($i=0; $i<count($accPengajuan); $i++){ ?>
                      <div class='col-md-3 col-sm-3 col-xs-12' id="<?php echo $accPengajuan[$i]['KodeACC']; ?>"> 
                          <?php 
                            if($accPengajuan[$i]['tanggal2']===NULL){
                          ?>
                              <a class="btn btn-app" id="acc-<?php echo $accPengajuan[$i]['KodeACC'];?>" <?php if($_SESSION['jabatan']>=1){echo "onclick='clickACC(this,".count($accPengajuan).")'";}else{echo "disabled";}?>>
                                <i class="fa fa-thumbs-o-up"></i> <?php echo $accPengajuan[$i]['KodeACC'];?>
                              </a>
                          <?php
                            }else{
                              echo "<a class='btn btn-app' disabled><p style='display:inline;'>".$accPengajuan[$i]['KodeACC']. " : </p> <br /><p style='color:green;display:inline;'>".$accPengajuan[$i]['tanggal2']."</p></a>";
                            }
                          ?>
                      </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
  <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-12 col-sm-12 col-xs-12" for="komunikasi">Komunikasi Client</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input class="form-control col-md-12 col-xs-12" id="komunikasi" name="komunikasi" type="text" placeholder="Ketik disini untuk chat">
              </div>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input id="submitHelpdesk" type="button" class="btn btn-success" value="Send" onclick="komcli('pengajuan');"/>
              </div>
              <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea rows="4" id="chatClientPJ" class="form-control col-md-12 col-xs-12" style="font-size:12px;" readonly><?php if(count($chatClientPengajuan)==0){}else{for($i=0; $i<count($chatClientPengajuan); $i++){echo "•".$chatClientPengajuan[$i]['Dari']." : ".$chatClientPengajuan[$i]['Isi']."\n";} }?></textarea>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 param">
                <input class="form-control col-md-12 col-xs-12 " id="jumlahKomunikasi" name="jumlahKomunikasi" type="text" value="<?php if(count($chatClientPengajuan)==0){echo "0";}else{echo count($chatClientPengajuan);} ?>" readonly>
              </div>
          </div>
        </div>

        <?php if(count($gambarPj)>0){ ?>
          <div class='col-md-6 col-sm-6 col-xs-12'>
            <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12">Attachment</label>
                <input class="form-control col-md-7 col-xs-12" id="ctrGambar" name="ctrGambar" type="hidden" value="<?php echo count($gambarPj); ?>" readonly>
            </div>
            <div class="item form-group">
              <table class="table table-hover">
                <tbody>
                  <?php for($i=0; $i<count($gambarPj); $i++){ ?>
                          <tr>
                            <td class='col-md-10 col-sm-10 col-xs-12'><?php echo $gambarPj[$i]['NamaFile']?></td>
                            <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["UPLOADED"].$gambarPj[$i]['NamaFile'];?>' target='_blank'>Preview</a></td>
                            <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["UPLOADED"].$gambarPj[$i]['NamaFile'];?>' download>Download</a></td>
                          </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <div class="item form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if($detailPengajuan[0]['tanggalselesai']===NULL && $detailPengajuan[0]['konfirmasi']=='1' && strlen($detailPengajuan[0]['No'])==16 && ($_SESSION["jabatan"]==1 || $_SESSION["jabatan"]==2)){ ?>
                <input id="clearPengajuan" type="button" class="btn btn-success" value="Selesai" onclick="clearPengajuan()" <?php if(count($accPengajuanSudah)==count($accPengajuan)){}else{echo "disabled title='Selesaikan dulu semua ACC !\nSetelah ACC terpenuhi baru dapat melakukan selesai pengajuan.'";}?> />
              <?php } if(strlen($detailPengajuan[0]['No'])==14 && $_SESSION['jabatan']>=1){ ?>
                <input id="simpan" type="button" class="btn btn-success" value="Simpan" onclick="simpanPengajuan()"/>
              <?php } if(strlen($detailPengajuan[0]['No'])==16 && $detailPengajuan[0]['konfirmasi']=='1'){ ?>
                <input id="print" type="button" class="btn btn-success" value="Print" onclick="printPengajuan()"/>
                <input id="upload" type="button" class="btn btn-success" value="Upload File" onclick="addAttachment()"/>
              <?php } if($_SESSION["jabatan"]==2 && strlen($detailPengajuan[0]['No'])==16 && ($detailPengajuan[0]['konfirmasi']==0 && $detailPengajuan[0]['tanggalkonfirmasi']===NULL)){ ?>
                  <input id="reject" type="button" class="btn btn-danger btn-reject btnReject" value="Tolak" onclick="reject('<?php echo $i;?>')" />
                  <input id="confirm" type="button" class="btn btn-success btn-confirm" value="Terima" onclick="confirm('<?php echo $i;?>')" />
              <?php } ?>
              <input id="backToAllPengajuanList" type="button" class="btn btn-success" value="Kembali" onclick="backToAllPengajuanList()"/>
            <div class="col-md-12 col-sm-12 col-xs-12">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>