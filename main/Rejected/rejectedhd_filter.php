<?php
  @include('../../action/GetData.php');
  $getRejectHdList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'rejectedhd');
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
      for($i=0; $i<count($getRejectHdList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getRejectHdList[$i]['No']?></a></td> <!---No--->
          <td><?php echo date_format($getRejectHdList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getRejectHdList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getRejectHdList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getRejectHdList[$i]['Aplikasi2'];?></td> <!---Program--->
          <td><?php if($getRejectHdList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getRejectHdList[$i]['DitanganiOleh'];}?></td>
          <td class="mycenter"> 
            <?php
                if($getRejectHdList[$i]['Status2']=='Selesai'){
                    echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
                }else if($getRejectHdList[$i]['Status2']=="Dalam Penanganan"){
                    echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                }else{
                  echo "-";
                }
            ?>
          </td>
          <td><?php echo $getRejectHdList[$i]['TanggalSelesai2']?></td> <!---Tanggal Selesai--->
          <td class="mycenter">
            <?php
                if($getRejectHdList[$i]['accPATA']=='1'){
                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                }else if($getRejectHdList[$i]['accPATA']=='0'){
                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                }else if($getRejectHdList[$i]['accPATA']=='2'){
                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                }
            ?>
          </td> <!---Konfirmasi--->
          <td><?php echo $getRejectHdList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getRejectHdList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getRejectHdList[$i]['kategori']?></td> <!---Kategori--->
        </tr>
      <?php
        }
      ?>
  </tbody>
</table>