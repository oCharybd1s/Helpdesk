<?php
  @include('../../action/GetData.php');
  $getHistoryPengajuan = getDataPengajuan($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'allpj');
  echo "<script> console.log('HELPDESK : allpj_filter') </script>";
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
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
            <th>Print</th> 
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getHistoryPengajuan); $i++){
    ?>
          <tr>
          <td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getHistoryPengajuan[$i]['No']?></a></td> <!---No--->
          <td><?php echo date_format($getHistoryPengajuan[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getHistoryPengajuan[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getHistoryPengajuan[$i]['cabang'];?></td> <!---Cabang--->
          <td><?php echo $getHistoryPengajuan[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
          <td><?php echo number_format($getHistoryPengajuan[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
          <td><?php echo $getHistoryPengajuan[$i]['jadwal'];?></td> <!---Jadwal--->
          <td class="mycenter"> 
            <?php
                                if($getHistoryPengajuan[$i]['konfirmasi']=='0'){
                                    echo '<img src="../resources/images/ask.png" style="width:18px;height:18px;">';
                                }else if($getHistoryPengajuan[$i]['konfirmasi']=="1"){
                                    echo '<img src="../resources/images/good.png" style="width:18px;height:18px;">';
                                }else if($getHistoryPengajuan[$i]['konfirmasi']=="2"){
                                    echo '<img src="../resources/images/rejected.png" style="width:18px;height:18px;">';
                                }
                            ?>
          </td>
          <td><?php echo wordwrap($getHistoryPengajuan[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
          <td><?php echo wordwrap($getHistoryPengajuan[$i]['analisis'],120,"<br />") ?></td> <!---Analisis--->
          <td><?php echo $getHistoryPengajuan[$i]['ket']?></td> <!---Penjelasan--->
          <td><?php echo $getHistoryPengajuan[$i]['tanggalkonfirmasi']?></td> <!---Tanggal konfirmasi--->
          <td>
            <?php
              if($getHistoryPengajuan[$i]['konfirmasi']=="2"){
                                    echo '- <img src="../resources/images/rejected.png" style="width:18px;height:18px;"> Di Tolak';
                                }else{
                                  if($getHistoryPengajuan[$i]['tanggalselesai']==''){
                                      echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                                  }else{
                                      echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">'.$getHistoryPengajuan[$i]['tanggalselesai'];
                                  }
                                }
                            ?>
          </td> <!---Tanggal selesai--->
          <td><?php echo $getHistoryPengajuan[$i]['printed']." Kali"; ?>
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