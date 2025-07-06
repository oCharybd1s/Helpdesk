<?php
  session_start();
  @include('../../action/GetData.php');
  $systemini = read_ini_file();
  $_SESSION['noHelpdesk'] = $detailHD[0]['No'];
?>
<!-- <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel"> -->
    <?php 
    for($i=0;$i<10+(count($gambarHD));$i++){
      echo "</br>";
    }
    ?>
      <div class="x_title">
        <h2 id="title">Detail Helpdesk</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <?php if($detailHD[0]['accPATA']=='2'){?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12 myred" for="deskripsi">Alasan Tolak</label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea rows="7" id="alasanTolak" name="alasanTolak" class="form-control col-md-12 col-xs-12 myred" readonly><?php echo $detailHD[0]['AlTolak']; ?></textarea>
              </div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
      <?php } ?>
  <!-- --------------------- -->
      	<div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dari">Dari</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="dari" name="dari" type="text" value="<?php echo preg_replace('/\s+/', '', $detailHD[0]['dari'])." [".$detailHD[0]['nama']."]"; ?>" readonly>
            </div>
          </div>
        </div>
  <!-- --------------------- -->
      	<div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cabang">Cabang</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="cabang" name="cabang" type="text" value="<?php echo $detailHD[0]['namacab']; ?>" readonly>
            </div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
      	<div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">No Issue</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="noIssue" name="noIssue" type="text" value="<?php echo $detailHD[0]['No']; ?>" readonly>
            </div>
          </div>
        </div>
  <!-- --------------------- -->
      	<div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglIssue">Tanggal Issue</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" id="tglIssue" name="tglIssue" type="text" value="<?php echo $detailHD[0]['tanggal2']; ?>" readonly>
            </div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">Tujuan</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select disabled id="kehendak" name="kehendak" class="form-control" <?php if($_SESSION['jabatan']==2){}else{if(!empty($detailHD[0]['Status']) || $detailHD[0]['accPATA']=='2' ||$_SESSION['jabatan']==0){echo " disabled ";}}?> >
                  <option id="defaultKehendak" value="0" selected  disabled >Silahkan Pilih Tujuan</option>
                  <option value="Komplain" <?php if($detailHD[0]['tujuan']=="Komplain"){ echo "Selected";} ?> >Komplain</option>
                  <option value="Request" <?php if($detailHD[0]['tujuan']=="Request"){ echo "Selected";} ?> >Request</option>
              </select>
            </div>
          </div>
        </div>
  <!-- --------------------- -->
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglIssue">Kategori</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select disabled id="jenis" name="jenis" class="form-control" <?php if($_SESSION['jabatan']==2){}else{if(!empty($detailHD[0]['Status']) || $detailHD[0]['accPATA']=='2' ||$_SESSION['jabatan']==0){echo " disabled ";}} ?> >
                  <option id="defaultKategori" value="0" selected  disabled >Silahkan Pilih Kategori </option>
                  <option value="Software" <?php if($detailHD[0]['kategori']=="Software"){ echo "Selected";} ?> >Software</option>
                  <option value="Hardware" <?php if($detailHD[0]['kategori']=="Hardware"){ echo "Selected";} ?> >Hardware</option>
              </select>
            </div>
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <div class='col-md-6 col-sm-6 col-xs-12'> 
          <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenislaporan">Jenis Laporan</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select disabled id="jenislaporan" name="jenislaporan" class="form-control" <?php if($_SESSION['jabatan']==2){}else{if(!empty($detailHD[0]['Status']) || $detailHD[0]['accPATA']=='2' ||$_SESSION['jabatan']==0){echo " disabled ";}}?> >
                    <option id="defaultjenislaporan" value="0" selected  disabled >Silahkan Pilih Jenis Laporan Yang Dimaksud</option>
                    <?php for($i=0; $i<count($jenisLaporan); $i++){ ?>
                      <option value="<?php echo $jenisLaporan[$i]['Lap']?>" <?php if($jenisLaporan[$i]['Lap']==$detailHD[0]['Jenis']){ echo "Selected";} ?> ><?php echo $jenisLaporan[$i]['NamaLaporan']?></option>
                    <?php } ?>
                </select>
              </div>
          </div>
        </div>
  <!-- --------------------- -->
      	<div class='col-md-6 col-sm-6 col-xs-12'>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="programYangDimaksud">Program Yang Dimaksud</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select disabled id="programYangDimaksud" name="programYangDimaksud" class="form-control" <?php if($_SESSION['jabatan']==2){}else{if(!empty($detailHD[0]['Status']) || $detailHD[0]['accPATA']=='2' ||$_SESSION['jabatan']==0){echo " disabled ";}}?> >
                      <option id="defaultProgramYangDimaksud" value="0" selected  disabled >Silahkan Pilih Program Yang Dimaksud</option>
                    <?php for($i=0; $i<count($jenisAplikasi); $i++){ ?>
                        <option value="<?php echo $jenisAplikasi[$i]['Apl']?>" <?php if($jenisAplikasi[$i]['Apl']==$detailHD[0]['Aplikasi']){ echo "Selected";} ?> ><?php echo $jenisAplikasi[$i]['NamaAplikasi']?></option>
                    <?php } ?>
                  </select>
                </div>
            </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
  <!-- UNTUK PATA DAPAT MERUBAH YANG MENGERJAKAN -->
  <?php
    if ($_SESSION['jabatan']==2) {
  ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userIT">User yang Manangani : </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                <input id="ITLama" value="<?php echo $detailHD[0]['Ditangani']; ?>" hidden/>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select disabled id="userIT" name="userIT" class="form-control" >
                    <option id="defuserIT" value="0" selected  disabled >-----------Team IT------------</option>
                    <?php for($i=0; $i<count($getITMemberList); $i++){ ?>
                        <option value="<?php echo $getITMemberList[$i]['NIK']?>" <?php if(trim($getITMemberList[$i]['NIK'])==trim($detailHD[0]['Ditangani'])){ echo "selected";} ?> >
                        <?php echo $getITMemberList[$i]['NIK']." - ".$getITMemberList[$i]['Nama']?></option>
                    <?php } ?>
                  </select>
                <!-- </div>
                  <input id="ubahPersonil" type="button" class="btn btn-success" value="UBAH Personil" onclick="ubahPersonil()"/>
                </div> -->
            </div>
        </div>
        
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <?php
    }
  ?>
  <!-- ----------------NOTE PATA------------------------- -->
  <?php
    if ($_SESSION['jabatan'] >=1) {
  ?>
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-12 col-sm-12 col-xs-12" for="notepata">NOTE PATA</label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea style="resize:none" disabled rows="2" id="notepata" name="notepata" class="col-md-12 col-xs-12"><?php echo $detailHD[0]['NotePATA']; ?></textarea>
              </div>
          </div>
        </div>
  <?php
    }
  ?>
  <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- ----------------- DESKRIPSI HELPDESK ---------------- -->
        <div class='col-md-12 col-sm-12 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-12 col-sm-12 col-xs-12" for="deskripsi">Deskripsi ( Tambahkan deskripsi pada bagian paling bawah dari deskripsi aslinya )</label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea disabled rows="7" id="deskripsi" name="deskripsi" onclick="eidturl()" class="form-control col-md-12 col-xs-12"><?php echo $detailHD[0]['issue'].'&#10Tambahkan deskripsi disini'; ?></textarea>
                <textarea disabled rows="7" id="deskripsi2" name="deskripsi2" class="form-control col-md-12 col-xs-12" readonly style="display: none;"><?php echo $detailHD[0]['issue']; ?></textarea>
              </div>
              <!-- <input id="page_name_field" type="text" onclick="eidturl()" name="app_name" value="70101002" size="50" />
            <input id="page_name_field_hidden" type="hidden" value="70101002" size="50" /> -->
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
  <!-- --------------------- -->
        <?php if($_SESSION['jabatan']==2 && $detailHD[0]['Status']===NULL && $detailHD[0]['accPATA']!='2'){ ?>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itmemberlist">Beri Tugas</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <select id="itmemberlist" name="itmemberlist" class="form-control" <?php if($detailHD[0]['Status'] === NULL){}else{echo " disabled ";} if($_SESSION['jabatan']==0){echo " disabled ";}?> >
                        <option value="0" selected>-</option>
                        <?php for($i=0; $i<count($getITMemberList); $i++){ ?>
                            <option value="<?php echo $getITMemberList[$i]['NIK']?>" <?php if($getITMemberList[$i]['NIK']==$detailHD[0]['OfferDitangani']){ echo "selected ";} ?>><?php echo $getITMemberList[$i]['Nama']?></option>
                        <?php } ?>
                      </select>
                    </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <input id="tugaskan" type="button" class="btn btn-success" value="Tugaskan" onclick="beriTugas()" />
                      </div>
                  </div>
                </div>
        <?php } ?>
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-6" for="estWaktu">Perkiraan Waktu</label>
            <?php if($detailHD[0]['Status']==1 ) {?> 
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">
                      <span class="label label-primary">Selesai</span><?php echo " Tanggal ".date_format($detailHD[0]['TanggalSelesai'],"d-m-Y H:i:s"); ?>
                    </label>
            <?php } ?>
            <?php if($detailHD[0]['Status']===NULL){}else if($detailHD[0]['Status']<1){ ?>
              <label class="control-label col-md-8 col-sm-8 col-xs-12">
                <?php echo $detailHD[0]['EstIT']; ?><b> Menit dari </b><?php echo date_format($detailHD[0]['AcceptWork'],"d-m-Y H:i:s"); ?>
                <?php 
                  $now = strtotime(date('M d Y g:iA',time()));
                  $aw = strtotime(date_format($detailHD[0]['AcceptWork'],"d-m-Y H:i:s"));
                  $selisih = $now - $aw;
                  $bedamnt = floor($selisih/60);
                  if($bedamnt>$detailHD[0]['EstIT']){
                ?>
                    <span class="label label-danger">Time Out</span>
                <?php 
                  }
                ?>
              </label>
            <?php } ?>
            <?php if($_SESSION['jabatan']==0){}else if($detailHD[0]['accPATA']!='2'){?>
              <?php if ($detailHD[0]['Status']===NULL) {?>
              <div class="col-md-3 col-sm-3 col-xs-6 <?php if($detailHD[0]['Status'] === NULL){}else{echo "param";}?> ">
                <input class="form-control col-md-12 col-xs-12" id="estWaktu" name="estWaktu" type="text" value="<?php echo $detailHD[0]['EstPATA']."-Menit"; ?>" onfocusout="estimasiMenit();" >
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 <?php if($detailHD[0]['Status'] === NULL){}else{echo "param";}?>">
                <input id="acceptWork" type="button" class="btn btn-success" value="Kerjakan" onclick="acceptWork()" />
              </div>
            <?php }}else{echo "-";} ?>
            
          </div>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'><div class="x_title"></div></div>
  <!-- --------------------- -->
        <?php if($_SESSION["divisi"]=="IT"){ ?>
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <div class="item form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="solusi">Catatan</label>
              <!-- -----------------SIMPAN CATATAN---------------- -->
              <?php
                // if ($_SESSION['jabatan']==2) {
              ?>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input id="submitHelpdesk" type="button" cursor="pointer" style="height:25px; font-size:11px; padding:0px 2px 2px 2px"value="SIMPAN Catatan" onclick="simpanCatatan();" <?php if($detailHD[0]['Status']==1){echo " disabled ";}?>/>
                </div>
              <? //} ?>
              <!-- ------------------------------------------------ -->
              <div class="col-md-12 col-sm-11 col-xs-12">
                <textarea rows="7" id="solusi" name="solusi" class="form-control col-md-12 col-xs-12" <?php if($detailHD[0]['Status']=='1'){echo " disabled ";}?> disabled ><?php echo $detailHD[0]['Solusi']; ?></textarea>
              </div>
          </div>
        </div>
      <?php } ?>
        <div class='col-md-6 col-sm-6 col-xs-12'>
          <?php if($_SESSION['jabatan']>=1 && $detailHD[0]['Status']=='0'){?>
            <div class='col-md-12 col-sm-12 col-xs-12'>
              <div class="item form-group">
                  <label class="control-label col-md-12 col-sm-12 col-xs-12" for="programTerkait">Program Terkait&nbsp;&nbsp;*Pisahkan nama program dengan tanda koma ','</label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input id="tags_1" class="form-control col-md-12 col-xs-12" data-role="tagsinput" type="text">
                  </div>
              </div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12'><div class="x_title"></div></div>
          <?php } ?>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="komunikasi">Komunikasi Client</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input class="form-control col-md-12 col-xs-12" id="komunikasi" name="komunikasi" type="text" placeholder="Ketik disini untuk chat"  <?php if($detailHD[0]['Status']==1){echo " disabled ";}?>>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input id="submitHelpdesk" type="button" class="btn btn-success" value="Send" onclick="komcli('helpdesk');" <?php if($detailHD[0]['Status']==1){echo " disabled ";}?>/>
                </div>
                <div class='col-md-12 col-sm-12 col-xs-12'>&nbsp;</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <textarea rows="4" id="chatClient" class="form-control col-md-12 col-xs-12" style="font-size:12px;" readonly><?php if(count($chatClient)==0){}else{for($i=0; $i<count($chatClient); $i++){echo "•".$chatClient[$i]['Dari']." : ".$chatClient[$i]['Isi']."\n";} }?></textarea>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 param">
                  <input class="form-control col-md-12 col-xs-12 " id="jumlahKomunikasi" name="jumlahKomunikasi" type="text" value="<?php if(count($chatClient)==0){echo "0";}else{echo $chatClient[count($chatClient)-1]['No'];} ?>" readonly>
                </div>
            </div>
          </div>
        </div>
        <?php if(count($gambarHD)>0){ ?>
          <div class='col-md-6 col-sm-6 col-xs-6'>
            <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12">Attachment</label>
            </div>
            <div class="item form-group">
              <table class="table table-hover" id="tblgambar">
                <thead>
                  <tr style="display: none;">
                    <th>a</th>
                    <th>b</th>
                    <th>c</th>
                    <th>d</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for($i=0; $i<count($gambarHD); $i++){ ?>
                          <tr>
                            <td class='col-md-9 col-sm-9 col-xs-12'><?php echo $gambarHD[$i]['NamaFile']?></td>
                            <td class='col-md-1 col-sm-1 col-xs-12'><a href='<?php echo $systemini["UPLOADED"].$gambarHD[$i]['NamaFile'];?>' target='_blank'>Preview</a></td>
                            <td class='col-md-1 col-sm-1 col-xs-12'><a href='<?php echo $systemini["UPLOADED"].$gambarHD[$i]['NamaFile'];?>' download>Download</a></td>
                          </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
      </div>
    <!-- </div>
  </div> -->