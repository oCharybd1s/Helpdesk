<?php
  @include('../../action/GetData.php');
  $getItHDList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'allp');
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
       <th>Konfirmasi PATA</th>
       <th>Detail</th>
       <th>Tujuan</th>
       <th>Kategori</th>
       <th>Solusi</th>
       <th>Rating</th>
       <th>Lama Pengerjaan</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getItHDList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getItHDList[$i]['No']?></a></td> <!---No--->
          <?php if($_SESSION['jabatan'] >=1){?>
            <td class="mycenter">
              <?php
                  if($getItHDList[$i]['prioritas']=='1'){
                      echo '<img src="../resources/images/priority.png" title="Prioritas utama dikerjakan" style="width:80px;height:80px;">';
                  }else{
                    echo "Mengikuti Antrian";
                  }
              ?>
            </td> <!---Prioritas--->
          <?php }?>
          <td><?php echo date_format($getItHDList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getItHDList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getItHDList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getItHDList[$i]['Aplikasi2'];?></td> <!---Program--->
          <td><?php if($getItHDList[$i]['DitanganiOleh']==''){echo "-";}else{echo $getItHDList[$i]['DitanganiOleh'];}?></td>
          <td class="mycenter"> 
            <?php
                if($getItHDList[$i]['Status2']=='Selesai'){
                    echo '<img src="../resources/images/done.png" style="width:18px;height:18px;"><br/>Selesai tanggal : '.$getItHDList[$i]['TanggalSelesai2'];
                }else if($getItHDList[$i]['Status2']=="Dalam Penanganan"){
                    echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                }else{
                  echo "-";
                }
            ?>
          </td>
          <td class="mycenter">
            <?php
                if($getItHDList[$i]['accPATA']=='1'){
                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">'.' Confirmed';
                }else if($getItHDList[$i]['accPATA']=='0'){
                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">'.' Waiting';
                }else if($getItHDList[$i]['accPATA']=='2'){
                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">'.' Rejected';
                }
            ?>
          </td> <!---Konfirmasi--->
          <td><?php echo $getItHDList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getItHDList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getItHDList[$i]['kategori']?></td> <!---Kategori--->
          <td><?php echo $getItHDList[$i]['Solusi']?></td>
          <?php if($getItHDList[$i]['rating']>=1){ ?>
            <td><?php for($x=0;$x<$getItHDList[$i]['rating'];$x++){ ?>
                    <span class="fa fa-star"></span>
                  <?php } ?>
                  </td>
          <?php }else{ ?>
            <td><span class="fa fa-question-circle"></span></td>
          <?php } ?>
          <td><?php echo $getItHDList[$i]['lamapengerjaan']?> Menit</td>
        </tr>
      <?php
        }
      ?>
  </tbody>
</table>
<script type="text/javascript">
  $('#datatable').dataTable({
                "bDestroy": true,
                'order': [[ 1, 'asc' ]],
                "stateSave": true,
              });
</script>