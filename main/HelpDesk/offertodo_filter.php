<?php
  @include('../../action/GetData.php');
  $getOfferToDoList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'offertodo');
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
  <thead>
    <tr>
       <th>No</th>
        <?php if($_SESSION['jabatan'] >=1){?> <th>Prioritas</th> <?php }?>
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
       <th>Gambar</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getOfferToDoList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getOfferToDoList[$i]['No']?></a></td> <!---No--->
           <?php if($_SESSION['jabatan'] >=1){?>
            <td class="mycenter">
              <?php
                  if($getOfferToDoList[$i]['prioritas']=='1'){
                      echo '<img src="../resources/images/priority.png" title="Prioritas utama dikerjakan" style="width:80px;height:80px;">';
                  }else{
                    echo "Mengikuti Antrian";
                  }
              ?>
            </td> <!---Prioritas--->
          <?php }?>
          <td><?php echo date_format($getOfferToDoList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getOfferToDoList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getOfferToDoList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getOfferToDoList[$i]['Aplikasi2'];?></td> <!---Program--->
          <td><?php if($getOfferToDoList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getOfferToDoList[$i]['DitanganiOleh'];}?></td>
          <td class="mycenter"> 
            <?php
                if($getOfferToDoList[$i]['Status2']=='Selesai'){
                    echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">';
                }else if($getOfferToDoList[$i]['Status2']=="Dalam Penanganan"){
                    echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                }else{
                  echo "-";
                }
            ?>
          </td>
          <td><?php echo $getOfferToDoList[$i]['TanggalSelesai2']?></td> <!---Tanggal Selesai--->
          <td class="mycenter">
            <?php
                                if($getOfferToDoList[$i]['accPATA']=='1'){
                                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                                }else if($getOfferToDoList[$i]['accPATA']=='0'){
                                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                                }else if($getOfferToDoList[$i]['accPATA']=='2'){
                                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                                }
                            ?>
          </td> <!---Konfirmasi--->
          <td><?php echo $getOfferToDoList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getOfferToDoList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getOfferToDoList[$i]['kategori']?></td> <!---Kategori--->
          <td>
            <?php 
              $gambarHD = getGambarHD(str_replace("/","",$getOfferToDoList[$i]['No']));
              for($j=0; $j<count($gambarHD); $j++){ 
              ?>
                  <a id='<?php echo $gambarHD[$j]['NamaFile'];?>' onclick="previewGambar(this.id)"><?php echo $gambarHD[$j]['NamaFile']?></a>
              <?php
              }
            ?>
          </td> <!---Gambar--->
        </tr>
      <?php
        }
      ?>
  </tbody>
</table>