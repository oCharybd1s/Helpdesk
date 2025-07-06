<?php
  @include('../../action/GetData.php');
  $getRejectedPengajuanIT = getDataPengajuan($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'rejectedpj');
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="overflow-x:auto;">
  <thead>
    <tr>
        <th>No</th>
        <th>Tanggal Buat</th>
        <th>Dari</th>                            
        <th>Cabang</th>
        <th>Nama Investasi</th>  
        <th>Biaya</th>
        <th>Jadwal</th>                   
        <th>Status</th>
        <th>Alasan</th>
        <th>Analisis</th>
        <th>Penjelasan</th>    
        <th>Tanggal Konfirmasi</th>
        <th>Tanggal Selesai</th> 
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getRejectedPengajuanIT); $i++){
    ?>
          <tr>
          <td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getRejectedPengajuanIT[$i]['No']?></a></td> <!---No--->
          <td><?php echo date_format($getRejectedPengajuanIT[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getRejectedPengajuanIT[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getRejectedPengajuanIT[$i]['cabang'];?></td> <!---Cabang--->
          <td><?php echo $getRejectedPengajuanIT[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
          <td><?php echo number_format($getRejectedPengajuanIT[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
          <td><?php echo $getRejectedPengajuanIT[$i]['jadwal'];?></td> <!---Jadwal--->
          <td class="mycenter"> 
            <?php
                if($getRejectedPengajuanIT[$i]['konfirmasi']=='0'){
                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                }else if($getRejectedPengajuanIT[$i]['konfirmasi']=="1"){
                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                }else if($getRejectedPengajuanIT[$i]['konfirmasi']=="2"){
                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                }
            ?>
          </td>
          <td><?php echo wordwrap($getRejectedPengajuanIT[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
          <td><?php echo wordwrap($getRejectedPengajuanIT[$i]['analisis'],120,"<br />") ?></td> <!---Analisis--->
          <td><?php echo $getRejectedPengajuanIT[$i]['ket']?></td> <!---Penjelasan--->
          <td><?php echo $getRejectedPengajuanIT[$i]['tanggalkonfirmasi']?></td> <!---Tanggal konfirmasi--->
          <td>
            <?php
                if($getRejectedPengajuanIT[$i]['konfirmasi']=="2"){
                    echo '- <img src="../resources/images/rejected.png" style="width:18px;height:18px;"> Di Tolak';
                }else{
                  if($getRejectedPengajuanIT[$i]['tanggalselesai']==''){
                      echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                  }else{
                      echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">'.$getRejectedPengajuanIT[$i]['tanggalselesai'];
                  }
                }
            ?>
          </td> <!---Tanggal selesai--->
        </tr>
      <?php
        }
      ?>
  </tbody>
</table>