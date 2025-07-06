<?php
  @include('../../action/GetData.php');
  $getHistoryHdList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'allp');
  $getLaporanAllp = getDataLaporanAllp($_SESSION['bulanFilter'],$_SESSION['tahunFilter']);
?>
<div class='col-md-12 col-sm-12 col-xs-12' >
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
      for($i=0; $i<count($getHistoryHdList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getHistoryHdList[$i]['No']?></a></td> <!---No--->
          <td><?php echo date_format($getHistoryHdList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getHistoryHdList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getHistoryHdList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getHistoryHdList[$i]['Aplikasi2'];?></td> <!---Program--->
          <td><?php if($getHistoryHdList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getHistoryHdList[$i]['DitanganiOleh'];}?></td>
          <td class="mycenter"> 
            <?php
                                if($getHistoryHdList[$i]['Status2']=='Selesai'){
                                    echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
                                }else if($getHistoryHdList[$i]['Status2']=="Dalam Penanganan"){
                                    echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                                }else{
                                  echo "-";
                                }
                            ?>
          </td>
          <td>
            <?php echo $getHistoryHdList[$i]['TanggalSelesai2'];
              if($getHistoryHdList[$i]['overtime']=="Overtime"){
                                    echo '<img src="../resources/images/overtime.png" style="width:18px;height:18px;">';
              }else if($getHistoryHdList[$i]['overtime']=="Tepat"){
                                    echo '<img src="../resources/images/ontime.png" style="width:18px;height:18px;">';
              }
            ?>  
          </td> <!---Tanggal Selesai--->
          <td class="mycenter">
            <?php
                                if($getHistoryHdList[$i]['accPATA']=='1'){
                                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                                }else if($getHistoryHdList[$i]['accPATA']=='0'){
                                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                                }else if($getHistoryHdList[$i]['accPATA']=='2'){
                                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                                }
                            ?>
          </td> <!---Konfirmasi--->
          <td><?php echo $getHistoryHdList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getHistoryHdList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getHistoryHdList[$i]['kategori']?></td> <!---Kategori--->
        </tr>
      <?php
        }
      ?>
  </tbody>
    </table>
</div>
<div class='col-md-12 col-sm-12 col-xs-12'>
      <div class="ln_solid"></div>
  </div>

<div class='col-md-6 col-sm-6 col-xs-12'>
      <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Done</th>
            <th>Progress</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
              for($i=0; $i<count($getLaporanAllp); $i++){
            ?>
              <tr>
                <td><?php echo $getLaporanAllp[$i]['nama']?></td>
                <td><?php echo $getLaporanAllp[$i]['selesai']?></td>
                <td><?php echo $getLaporanAllp[$i]['progress']?></td>
                <td><?php echo $getLaporanAllp[$i]['total']?></td>
              </tr>
            <?php
            }
          ?>
        </tbody>
        </table>
  </div>
<div class='col-md-6 col-sm-6 col-xs-12'>
<div class='col-md-12 col-sm-12 col-xs-12'>
  <center><h2 id="judulGrafikPengerjaan"></h2></center>
      <canvas id="pieChart"></canvas>
</div>
<div class='col-md-12 col-sm-12 col-xs-12'>
  <center><h2 id="judulGrafikTotal"></h2></center>
      <canvas id="pieChart1"></canvas>
</div>
</div>