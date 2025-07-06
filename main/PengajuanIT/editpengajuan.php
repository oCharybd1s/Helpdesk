<?php
  @include('../../action/GetData.php');
  echo "<script> console.log('HELPDESK : editpengajuan') </script>";
  $systemini = read_ini_file();
  // echo str_replace(' ','',$_GET['jenis']);
  // echo $_SESSION['halaman_terbuka'];
  $showing = 0;
  $alasan = $detailPengajuan[0]['alasan'];
  $alasanprint = $detailPengajuan[0]['alasan'];
  $analisis = $detailPengajuan[0]['analisis'];
  $analisisprint = $detailPengajuan[0]['analisis'];
  if(strlen($detailPengajuan[0]['No'])==16){ 
    $showing = 1;
    $alasan = $detailPengajuan[0]['nama']." : ".$detailPengajuan[0]['alasan'];
    // $analisis = $detailPengajuan[0]['nama']." : ".$detailPengajuan[0]['analisis'];
    $analisis = $detailPengajuan[0]['analisis'];
    $alasanprint = $detailPengajuan[0]['alasan'];
    $analisisprint = $detailPengajuan[0]['analisis'];
    $tglsampai = $totalrealisasi[0]["tgldatang"];
    if($tglsampai!=""){
      if(date_format($tglsampai,"Y-m-d")=='1900-01-01'){
        $tglsampai = "";
      }else{
        $tglsampai = date_format($tglsampai,"Y-m-d");
      }
    }else{
      $tglsampai = "";
    }    
  }
  //set disable nopr, tanggal barang sampai, no inventaris dan total realisasi
  $kunci = "";
  if(str_replace(' ','',$_GET['jenis'])=="selesai"){
    $kunci = "disabled";
  }
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Detail Pengajuan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php if(substr($detailPengajuan[0]['No'],0,7) == "OLDPENG") { ?>
        <div class='col-md-12 col-sm-3 col-xs-12'>
          <label class="control-label " for="noIssue">No Pengajuan Lama</label>
          <div class="item form-group">
              <input class="form-control col-md-7 col-xs-12" id="oldnumber" name="oldnumber" type="text" value="<?php echo $detOldNumber[0]['oldnumber']; ?>" readonly>
          </div>
        </div>
        <?php } ?>
  <!-- --------------------- -->
        <div class='col-md-3 col-sm-3 col-xs-12'>
          <label class="control-label " for="noIssue">No Permintaan</label>
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
              <input class="form-control col-md-7 col-xs-12" id="biaya" name="biaya" type="text" placeholder="Isi hanya dengan angka saja !" value="<?php echo number_format($detailPengajuan[0]['biaya'],0,'.','.'); ?>" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?>>
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
          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="alasan">KETERANGAN USER</label>
          <?php if($showing==1){ ?>
          <div class="item form-group">
            <div class="col-md-10 col-sm-10 col-xs-12">
              <input class="form-control col-md-12 col-xs-12" id="alasantxt" name="alasantxt" type="text" placeholder="Ketik disini untuk Menambah alasan">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="button" class="btn btn-success" value="Add" onclick="addalasanpj();"/>
            </div>
          </div>
          <?php } ?>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea rows="7" id="alasan" name="alasan" class="form-control col-md-12 col-xs-12" <?php if($_SESSION['jabatan'] ==0){echo "readonly";} ?> <?php if($showing==1){ ?> disabled <?php } ?>><?php echo $alasan; ?></textarea>
                <textarea rows="7" id="alasanprint" name="alasanprint" class="form-control col-md-12 col-xs-12" style="display:none;"><?php echo $alasanprint; ?></textarea>
          </div>
          
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="analisis">ANALISA IT</label>
          <?php if($showing==1){ ?>
          <div class="item form-group">
            <div class="col-md-10 col-sm-10 col-xs-12">
              <input class="form-control col-md-12 col-xs-12" id="analisistxt" name="analisistxt" type="text" placeholder="Ketik disini untuk menambah analisis">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="button" class="btn btn-success" value="Add" onclick="addanalisispj();"/>
            </div>
          </div>
          <?php } ?>
          <div class="col-md-12 col-sm-12 col-xs-12">
              <textarea rows="7" id="analisis" name="analisis" class="form-control col-md-12 col-xs-12" <?php if($_SESSION['jabatan'] ==0 || $showing==1){echo "disabled";} ?> ><?php echo $analisis; ?></textarea>
              <textarea rows="7" id="analisisprint" name="analisisprint" class="form-control col-md-12 col-xs-12" style="display:none;"><?php echo $analisisprint; ?></textarea>
          </div>
          <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="button" class="btn btn-success" value="Edit Alasan" onclick="editAnalisisPJ();"/>
              <input type="text" id="isedited_analisis" style="display:none;" class="btn btn-success" value="0" onclick="editAnalisisPJ();"/>
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
  <?php if($_GET['jenis']=="siap" || count($gambarPj)<1){ ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Upload Gambar Pengajuan</label>
          <div class="item form-group">
                <div action="../action/UploadPengajuan.php" id="myAwesomeDropzone" class="dropzone form-control col-md-7 col-xs-12 full-border" enctype="multipart/form-data" ></div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <?php } ?>
  <!-- --------------------- -->
        <?php if(strlen($detailPengajuan[0]['No'])==16 && $detailPengajuan[0]['konfirmasi']==1){ ?>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <label class="control-label col-md-12 col-sm-12 col-xs-12">Status ACC (Klik tombol dibawah untuk acc)</label>
            <div class='col-md-12 col-sm-12 col-xs-12 full-border pad-10'>
              <?php for($i=0; $i<count($accPengajuan); $i++){ ?>
                      <div class='col-md-2 col-sm-2 col-xs-12' id="<?php echo $accPengajuan[$i]['KodeACC']; ?>"> 
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
      <?php if($_GET['jenis']=="siap"){ ?>
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-12 col-sm-12 col-xs-12" for="komunikasi">Lampiran</label>
          </div>
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
                <input id="btnaddfile" type="button" class="btn btn-warning" value="+ Lampiran" onclick="kliktambahlampiran()"/>
                <input type="file" accept="image/*" class="form-control-file" id="addlampiran" onchange="addlampiranPJ();" style="display:none;">
          </div>
        </div>
      <?php } ?>
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

        <?php //if(count($gambarPj)>0){ ?>
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
        <?php //} ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
          <div class='col-md-6 col-sm-6 col-xs-12'>
            <?php if(count($gambarnota)>0){ ?>
            <div class="item form-group">
                <label class="control-label col-md-6 col-sm-6 col-xs-12">Nota Pembelian</label>
                <input class="form-control col-md-6 col-xs-12" id="gbnota" name="gbnota" type="hidden" value="<?php echo count($gambarnota); ?>" readonly>
            </div>
            <div class="item form-group">
              <table class="table table-hover">
                <tbody>
                  <?php for($i=0; $i<count($gambarnota); $i++){ ?>
                          <tr>
                            <td class='col-md-10 col-sm-10 col-xs-12'><?php echo $gambarnota[$i]['namafile']?></td>
                            <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["UPLOADNOTA"].$gambarnota[$i]['namafile'];?>' target='_blank'>Preview</a></td>
                            <td class='col-md-2 col-sm-2 col-xs-12'><a href='<?php echo $systemini["UPLOADNOTA"].$gambarnota[$i]['namafile'];?>' download>Download</a></td>
                          </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
             <?php } ?>                        
          </div>      
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <!-- TAMBAHAN DARI PATA UNTUK MENAMPILKAN NOMOR PR, TANGGAL BARANG DATANG, DAN NOMOR INVENTARIS -->
            <div class="item form-group">
              <div class='col-md-4 col-sm-4 col-xs-12'>
                <label class="control-label" for="kepada">No Purchase Request</label>
                <div class="item form-group">
                    <input  class="form-control col-md-4 col-xs-12" id="nopr" type="text" class="form-control" onkeypress="checknoprenter(event);" onchange="checknopr();" value="<?php echo $totalrealisasi[0]["nopr"]; ?>" <?php echo $kunci; ?>>
                </div>
              </div>
              <div class='col-md-4 col-sm-4 col-xs-12'>
                <label class="control-label" for="kepada">Tanggal Barang Datang</label>
                <div class="item form-group">
                    <input id="tanggaldatang" name="tanggaldatang" type="date" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo $tglsampai; ?>" onchange="updatemrealisasi();" <?php echo $kunci; ?>>
                </div>
              </div>
              <div class='col-md-4 col-sm-4 col-xs-12'>
                <label class="control-label" for="kepada">No Inventaris</label>
                <div class="item form-group">
                    <input  class="form-control col-md-4 col-xs-12" id="noinventaris" type="text" class="form-control" onchange="updatemrealisasi();"  value="<?php echo $totalrealisasi[0]["noinventaris"]; ?>" <?php echo $kunci; ?>>
                </div>
              </div>
            </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="item form-group">
              <div class='col-md-4 col-sm-4 col-xs-12'>
                <label class="control-label" for="kepada">Realisasi (Rp)</label>
                <div class="item form-group">
                    <input  class="form-control col-md-7 col-xs-12" id="realisasi" type="text" class="form-control" onkeyup="ubahformat(this.id);"  onchange="updatemrealisasi();" value="<?php echo number_format($totalrealisasi[0]["nilairealisasi"],0,",","."); ?>" <?php echo $kunci; ?>>
                </div>
              </div>
            </div> 
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <div class="item form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if($_GET['jenis']=="siap"){ ?>
              <?php if($detailPengajuan[0]['tanggalselesai']===NULL && $detailPengajuan[0]['konfirmasi']=='1' && strlen($detailPengajuan[0]['No'])==16 && ($_SESSION["jabatan"]==1 || $_SESSION["jabatan"]==2)){ ?>
                <input id="clearPengajuan" type="button" class="btn btn-success" value="Selesai" onclick="checkfiledanrealisasi()" <?php if(count($accPengajuanSudah)==count($accPengajuan)){}else{echo "disabled title='Selesaikan dulu semua ACC !\nSetelah ACC terpenuhi baru dapat melakukan selesai pengajuan.'";}?> />
                <!-- <input id="clearPengajuan" type="button" class="btn btn-success" value="Selesai" onclick="clearPengajuan()" <?php if(count($accPengajuanSudah)==count($accPengajuan)){}else{echo "disabled title='Selesaikan dulu semua ACC !\nSetelah ACC terpenuhi baru dapat melakukan selesai pengajuan.'";}?> /> -->
              <?php } ?>
              <?php } if(strlen($detailPengajuan[0]['No'])==14 && $_SESSION['jabatan']>=1){ ?>
                <input id="simpan" type="button" class="btn btn-success" value="Teruskan" onclick="simpanPengajuan()"/>
                <input id="updatebtnpengajuan" type="button" class="btn btn-success" value="Update" onclick="updateMPengajuan()"/>
              <?php } if(strlen($detailPengajuan[0]['No'])==16 && $detailPengajuan[0]['konfirmasi']=='1'){ ?>
                <input id="print" type="button" class="btn btn-success" value="Print" onclick="printPengajuan()"/>
                <?php if($_GET['jenis']=="siap"){ ?>
                <input id="upload" type="button" class="btn btn-success" value="Upload File" onclick="addAttachment()"/>
              <?php } ?>
              <?php } ?>
              <?php if(strlen($detailPengajuan[0]['No'])==16 && $getAccPata[0]["statusacc"]<1){ ?>
                <input id="updatebtn" type="button" class="btn btn-success" value="Update" onclick="UpdatePengajuanIT()"/>
              <?php } ?>
              <?php if($_SESSION["jabatan"]==2 && $detailPengajuan[0]['selesai']!=1){ ?>
                  <input id="reject" type="button" class="btn btn-danger btn-reject btnReject" value="Tolak" onclick="reject('<?php echo $detailPengajuan[0]['No']; ?>')" />
              <?php } ?>
              <?php if($_SESSION["jabatan"]==2 && strlen($detailPengajuan[0]['No'])==16 && ($detailPengajuan[0]['konfirmasi']==0 && $detailPengajuan[0]['tanggalkonfirmasi']===NULL)){ ?>
                  <input id="confirm" type="button" class="btn btn-success btn-confirm" value="Terima" onclick="confirm('<?php echo $detailPengajuan[0]['No']; ?>')" />
              <?php } ?>
              <input id="backToAllPengajuanList" type="button" class="btn btn-success" value="Kembali" onclick="backToAllPengajuanList()"/>
              <!-- <input type="button" class="btn btn-success" value="coba" onclick="getNoPengajuan()"/> -->
            <div class="col-md-12 col-sm-12 col-xs-12">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-container2">
  <div class="modal-background">
    <div class="modal">
      <div class="x_content">       
        <!-- <div class="item form-group">
          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="tanggalkembali">Realisasi (Rp)</label>
          <div class="col-md-7 col-sm-7 col-xs-12">
            <input  class="form-control col-md-7 col-xs-12" id="realisasi" type="text" class="form-control">
          </div> 
        </div>  -->
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
            <!-- <button type="button" class="btn btn-primary" id="batal" barisnya="" onclick="addAttachmentNota();clearPengajuan();" style="display:none">Simpan</button> -->
          </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var listaccpengajuan = <?php echo json_encode($accPengajuan); ?>;
  $(document).ready(function(){ 
    tampilkanalasanpj();
    tampilkananalisispj();
  });
</script>