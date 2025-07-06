<?php
  @include('../../action/GetData.php');
  $getItHDList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'ithd');
?>
<table id="datatableithdfilter" class="table table-striped table-bordered dt-responsive nowrap">
  <thead>
    <tr>
       <th>No</th>
       <?php if($_SESSION['jabatan'] >=1){?> <th>Prior</th> <?php }?>
       <th>Tanggal</th>
       <th>Dari</th>
       <th>Cabang</th>
       <th>Jenis Laporan</th>
       <th>Program</th>       
       <th>Detail</th>
       <th>Tujuan</th>
       <th>Kategori</th>
       <th>Note PATA</th>
       <th>Gambar</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0; $i<count($getItHDList); $i++){
    ?>
          <tr>
          <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getItHDList[$i]['No']?></a></td> <!---No--->
          <?php if($_SESSION['jabatan'] >=1){?>
            <td class="mycenter"><center>
              <?php
                  if($getItHDList[$i]['prioritas']=='1'){
                    echo '<img src="../resources/images/icon-prior1.png" title="Prioritas Utama" style="width:26px;height:30px;">';
                  }else{
                    echo '<img src="../resources/images/icon-prior2.png" title="Prioritas Kedua" style="width:26px;height:30px;">';
                    // echo "Mengikuti Antrian";
                  }
              ?>
            </center>
            </td> <!---Prioritas--->
          <?php }?>
          <td><?php echo date_format($getItHDList[$i]['tanggal'],"d-M-Y H:i:s");?></td> <!---Tanggal--->
          <td><?php echo $getItHDList[$i]['dari2'];?></td> <!---Dari--->
          <td><?php echo $getItHDList[$i]['cabang'];?></td> <!---Dari--->
          <td><?php echo $getItHDList[$i]['Jenis2'];?></td> <!---Jenis Laporan--->
          <td><?php echo $getItHDList[$i]['Aplikasi2'];?></td> <!---Program--->           
          <td><?php echo $getItHDList[$i]['issue']?></td> <!---Jenis Keterangan--->
          <td><?php echo $getItHDList[$i]['tujuan']?></td> <!---Tujuan--->
          <td><?php echo $getItHDList[$i]['kategori']?></td> <!---Kategori--->
          <td><?php echo $getItHDList[$i]['NotePATA']?></td>
          <td>
            <?php 
              $gambarHD = getGambarHD(str_replace("/","",$getItHDList[$i]['No']));
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
<script type="text/javascript">
$(document).ready(function(){ 
  $('#datatableithdfilter').DataTable( {
        "responsive": true,
        "bDestroy": true,
        "stateSave": false,
        "order": [[1, 'asc']],
        "columnDefs": [
          { orderable: false,targets: 0 },
          { orderable: false,targets: 1 },
          { orderable: false,targets: 2 },
          { orderable: false,targets: 3 },
          { orderable: false,targets: 4 },
          { orderable: false,targets: 5 },
          { orderable: false,targets: 6 },
          { orderable: false,targets: 7 },
          { orderable: false,targets: 8 },
          { orderable: false,targets: 9 },
          { orderable: false,targets: 10 },
          { orderable: false,targets: 11 },
          { responsivePriority: 1, targets: 0 },
          { responsivePriority: 1, targets: 1 },
          { responsivePriority: 1, targets: 2 },
          { responsivePriority: 10002, targets: 3 },
          { responsivePriority: 10002, targets: 4 },
          { responsivePriority: 1, targets: 5 },
          { responsivePriority: 1, targets: 6 },
          { responsivePriority: 10001, targets: 7 },
          { responsivePriority: 10002, targets: 8 },
          { responsivePriority: 1, targets: 9 },
          { responsivePriority: 1, targets: 10 },
          { responsivePriority: 10002, targets: 11 }
        ]
    } );
});
</script>