<?php
  @include('../../action/GetData.php');
  $getHistoryDoneHdList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'lapfinish');
  $getLaporanFinishNama = getDataLaporanFinishByNama($_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['jenisfilterlap'],$_SESSION['tanggalmulailap'],$_SESSION['tanggalsampailap']); 
  $getLaporanFinishByCabang = getDataLaporanFinishByCabang($_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['jenisfilterlap'],$_SESSION['tanggalmulailap'],$_SESSION['tanggalsampailap']); 
  $getLaporanFinishByCabangTotal = getDataLaporanFinishByCabangTotal($_SESSION['bulanFilter'],$_SESSION['tahunFilter']); 
  $getLaporanFinishByProgram = getDataLaporanFinishByProgram($_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['jenisfilterlap'],$_SESSION['tanggalmulailap'],$_SESSION['tanggalsampailap']); 
  $getLaporanFinishByProgramTotal = getDataLaporanFinishByProgramTotal($_SESSION['bulanFilter'],$_SESSION['tahunFilter']); 
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
  <thead>
    <tr>
       <th>No</th>
       <th>Tanggal</th>
       <th>Dari</th>
       <th>Jenis Laporan</th>
       <th>Program</th>
       <th>Ditangani</th>
       <th>DONE</th>
       <th>Tanggal Selesai</th>
       <th>Konfirmasi</th>
       <th>Detail</th>
       <th>Tujuan</th>
       <th>Kategori</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getHistoryDoneHdList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getHistoryDoneHdList[$i]['No']?></a></td> <!---No--->
          <td><?php echo date_format($getHistoryDoneHdList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getHistoryDoneHdList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getHistoryDoneHdList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getHistoryDoneHdList[$i]['Aplikasi2'];?></td> <!---Program--->
          <td><?php if($getHistoryDoneHdList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getHistoryDoneHdList[$i]['DitanganiOleh'];}?></td>
          <td class="mycenter"> 
            <?php
                                if($getHistoryDoneHdList[$i]['Status2']=='Selesai'){
                                    echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
                                }else if($getHistoryDoneHdList[$i]['Status2']=="Dalam Penanganan"){
                                    echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                                }else{
                                  echo "-";
                                }
                            ?>
          </td>
          <td>
            <?php echo $getHistoryDoneHdList[$i]['TanggalSelesai2'];
              if($getHistoryDoneHdList[$i]['overtime']=="Overtime"){
                                    echo '<img src="../resources/images/overtime.png" style="width:18px;height:18px;">';
              }else if($getHistoryDoneHdList[$i]['overtime']=="Tepat"){
                                    echo '<img src="../resources/images/ontime.png" style="width:18px;height:18px;">';
              }
            ?>  
          </td> <!---Tanggal Selesai--->
          <td class="mycenter">
            <?php
                                if($getHistoryDoneHdList[$i]['accPATA']=='1'){
                                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                                }else if($getHistoryDoneHdList[$i]['accPATA']=='0'){
                                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                                }else if($getHistoryDoneHdList[$i]['accPATA']=='2'){
                                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                                }
                            ?>
          </td> <!---Konfirmasi--->
          <td><?php echo $getHistoryDoneHdList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getHistoryDoneHdList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getHistoryDoneHdList[$i]['kategori']?></td> <!---Kategori--->
        </tr>
      <?php
        }
      ?>
  </tbody>
</table>
            <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class="ln_solid"></div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class='col-md-6 col-sm-6 col-xs-12'>
                  <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Ontime</th>
                          <th>Overtime</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                for($i=0; $i<count($getLaporanFinishNama); $i++){
              ?>
                            <tr>
                              <td><?php echo $getLaporanFinishNama[$i]['nama']?></td>
                              <td><?php echo $getLaporanFinishNama[$i]['ontime']?></td>
                              <td><?php echo $getLaporanFinishNama[$i]['overtime']?></td>
                              <td><?php echo $getLaporanFinishNama[$i]['total']?></td>
                            </tr>
                      <?php
                      }
                    ?>
                      </tbody>
                    </table>
              </div>
          <div class='col-md-6 col-sm-6 col-xs-12'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
              <center><h2 id="judulGrafikPerKaryawan"></h2></center>
                  <canvas id="pieChart"></canvas>
            </div>
          </div>
            </div>
          <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class="ln_solid"></div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class='col-md-6 col-sm-6 col-xs-12'>
                  <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Cabang</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                for($i=0; $i<count($getLaporanFinishByCabang); $i++){
              ?>
                            <tr>
                              <td><?php echo $getLaporanFinishByCabang[$i]['namacab']?></td>
                              <td><?php echo $getLaporanFinishByCabang[$i]['total']?></td>
                            </tr>
                      <?php
                      }
                    ?>  

                            <tr>
                              <td><?php echo $getLaporanFinishByCabangTotal[0]['namacab']?></td>
                              <td><?php echo $getLaporanFinishByCabangTotal[0]['total']?></td>
                            </tr>
                      </tbody>
                    </table>
              </div>
          <div class='col-md-6 col-sm-6 col-xs-12'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
              <center><h2 id="judulGrafikPerCabang"></h2></center>
                  <canvas id="pieChart1"></canvas>
            </div>
          </div>
        </div>
          <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class="ln_solid"></div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class='col-md-6 col-sm-6 col-xs-12'>
                  <table id="datatable3" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Program</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                for($i=0; $i<count($getLaporanFinishByProgram); $i++){
              ?>
                            <tr>
                              <td><?php echo $getLaporanFinishByProgram[$i]['NamaAplikasi']?></td>
                              <td><?php echo $getLaporanFinishByProgram[$i]['total']?></td>
                            </tr>
                      <?php
                      }
                    ?>
                            <tr>
                              <td><?php echo $getLaporanFinishByProgramTotal[0]['NamaAplikasi']?></td>
                              <td><?php echo $getLaporanFinishByProgramTotal[0]['total']?></td>
                            </tr>
                      </tbody>
                    </table>
              </div>
          <div class='col-md-6 col-sm-6 col-xs-12'>
            <div class='col-md-12 col-sm-12 col-xs-12'>
              <center><h2 id="judulGrafikPerProgram"></h2></center>
                  <canvas id="pieChart2"></canvas>
            </div>
          </div>
        </div>
          <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class="ln_solid"></div>
            </div>