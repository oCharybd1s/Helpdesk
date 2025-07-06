<?php
  @include('../../action/GetData.php');
  echo "<script> console.log('HELPDESK : itpjselesai_filter') </script>";
  $getPengajuanIT = getDataPengajuanSelesai($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['cabangFilter'],'itpj');
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="overflow-x:auto;">
  <thead>
    <tr>
        <th>No</th>
        <th>Tanggal Buat</th>
        <th>Tanggal Selesai</th> 
        <th>Dari</th>                            
        <th>Cabang</th>
        <th>Nama Investasi</th>  
        <th>Biaya</th>
        <th>Jadwal</th>             
        <th>Alasan</th>
        <th>Analisis</th>
        <th>Penjelasan</th>    
        <th>Tanggal Konfirmasi</th>
        <th>Print</th> 
    </tr>
  </thead>
  <tbody>
          <?php
            for($i=0; $i<count($getPengajuanIT); $i++){
          ?>
                <tr>
                <td id="idpj<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getPengajuanIT[$i]['No']?></a></td> <!---No--->
                <td><?php echo date_format($getPengajuanIT[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
                <td>
                  <?php
                    if($getPengajuanIT[$i]['konfirmasi']=="2"){
                                          echo '- <img src="../resources/images/rejected.png" style="width:18px;height:18px;"> Di Tolak';
                                      }else{
                                        if($getPengajuanIT[$i]['tanggalselesai']==''){
                                            echo '<img src="../resources/images/wait2k.jpg" style="width:18px;height:18px;">';
                                        }else{
                                            echo '<img src="../resources/images/done.png" style="width:18px;height:18px;">'.$getPengajuanIT[$i]['tanggalselesai'];
                                        }
                                      }
                                  ?>
                </td> <!---Tanggal selesai--->
                <td><?php echo $getPengajuanIT[$i]['dari2'];?></td> <!---Dari--->
                <td><?php echo $getPengajuanIT[$i]['cabang'];?></td> <!---Cabang--->
                <td><?php echo $getPengajuanIT[$i]['namainvestasi'];?></td> <!---Nama Investasi--->
                <td><?php echo number_format($getPengajuanIT[$i]['biaya'],0,'.','.');?></td> <!---Biaya--->
                <td><?php echo $getPengajuanIT[$i]['jadwal'];?></td> <!---Jadwal--->
                <td><?php echo wordwrap($getPengajuanIT[$i]['alasan'],120,"<br />") ?></td> <!---Alasan--->
                <td><?php echo wordwrap($getPengajuanIT[$i]['analisis'],120,"<br />") ?></td> <!---Analisis--->
                <td><?php echo $getPengajuanIT[$i]['ket']?></td> <!---Penjelasan--->
                <td><?php echo $getPengajuanIT[$i]['tanggalkonfirmasi']?></td> <!---Tanggal konfirmasi--->
                <td><?php echo $getPengajuanIT[$i]['printed']." Kali"; ?>
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