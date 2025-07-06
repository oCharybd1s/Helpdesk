<?php
  @include('../../action/GetData.php');
  // if(isset($_POST['bulanHelpdesk'])){
    echo "<script> console.log('HELPDESK : ".$_SESSION['siapa']."') </script>";
    $getAbsen = getDataAbsen($_SESSION['siapa'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter']);
    $getUangExtra = getUangExtra($_SESSION['siapa']);

    if ($_SESSION['siapa']=='000904') {
      $getUangExtra[0]['uang_tepat_waktu']=13000;
      $getUangExtra[0]['uang_makan']=18000;
    }
    else if ($_SESSION['siapa']=='000870') {
      $getUangExtra[0]['uang_tepat_waktu']=13000;
      $getUangExtra[0]['uang_makan']=18000;
    }
  // }
?>
<table id="datatableAbsen" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
      <tr>
         <th width="15%">Tanggal</th>
         <th width="10%">Masuk</th>
         <th width="10%">Keluar</th>
         <th width="10%">Total Jam</th>
         <th width="5%">KAT</th>
         <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $totaluangmakan=0;
        $totalkehadiran=0;
        $kategori_include = array('A','B','C','D');
        $kategori_lead_include = array('A','B','C','D','-');
        $kondisi_khusus = array('TKH', 'DUK', 'DUM');
        $lead = 0;

        for($i=0; $i<count($getAbsen); $i++){
          $hitMakan = '';
          $hitHadir = '';

          if ($getAbsen[$i]['jamstandartmasuk']==null)
            $jamawal = '0845';
          else
            $jamawal = $getAbsen[$i]['jamstandartmasuk']+15;

          if (($getUangExtra[0]['uang_tepat_waktu']==0 && $getUangExtra[0]['uang_makan']>18000 && in_array($getAbsen[$i]['ket'], $kategori_lead_include))) {
              $lead=1;
            }
          // =========================================================
          // SYARAT TERIMA UANG MAKAN & UANG KEHADIRAN
          // -----ALL----
          // jam masuk tidak kosong
          // jam keluar tidak kosong
          // kategori absen -> A,B,C,D untuk staf
          // kategori absen -> A,B,C,D,'-' untuk leader
          // ada keterangan TKH (Tugas Khusus - data UM dan UK), DUK (Dapat Uang Kehadiran), DUM (Dapat Uang Makan)
          // =========================================================
          // $a = 'm';
          if ((trim($getAbsen[$i]['jmasuk'])!='' && trim($getAbsen[$i]['jkeluar'])!='' && in_array($getAbsen[$i]['ket'], $kategori_include)) ||
            ($lead==1 && in_array($getAbsen[$i]['ket'], $kategori_lead_include)) ||
            in_array(substr(ltrim($getAbsen[$i]['keterangan']),0,3),$kondisi_khusus)) {
            // $a = 'm1';
            // =======================================================
            // SYARAT TERIMA UANG KEHADIRAN
            // *. Hanya Staf (Lead=0)
            // *. Masuk sebelum jam 09.16
            // *. Ada di Kantor 4 Jam (Termasuk jam istirahat) -- Tidak jadi dipakai KOnfirmasi Pak Pil 6 Juli 2023
            // *. Ada Keterangan DUK di bagian KETERANGAN
            // =======================================================
            if (($getAbsen[$i]['jmasuk']<=$jamawal && $lead==0 && in_array($getAbsen[$i]['ket'], $kategori_include)) || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUK' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='TKH' ) {
                // $a = 'm2';
                $hitHadir = '<img src="../resources/images/gentelella/icons8-fire-16.png"/>';
                $totalkehadiran = $totalkehadiran+1;
                
              }

            // =======================================================
            // SYARAT TERIMA UANG MAKAN
            // *. Leader selalu dapat uang makan
            // *. Masuk sebelum jam 11.01
            // *. Ada Keterangan DUM di bagian KETERANGAN
            // *. Ada di Kantor 4 Jam (Termasuk jam istirahat) -- Konfirmasi Pak Pil 6 Juli 2023
            // =======================================================
            if ($lead==1 || ($getAbsen[$i]['jmasuk']<='1100' && substr($getAbsen[$i]['jamkerja'],0,2)>='04') || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUM' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='TKH' ) {  
                // $a = 'm3';
                $hitMakan = '<img src="../resources/images/gentelella/icons8-cafe-16.png"/>';
                $totaluangmakan = $totaluangmakan+1;
              }
          }
      ?>
        <tr <?php if($getAbsen[$i]['jmasuk']>$jamawal) {echo "style='background-color:#F2BED1'; class='my-red'";} ?>>
            <td><?php echo date_format($getAbsen[$i]['date'],"d-M-Y");?></td> <!---Tanggal--->
            <td><?php echo $getAbsen[$i]['jmasuk'];?></td> <!---Dari--->
            <td><?php echo $getAbsen[$i]['jkeluar'];?></td> <!---Jenis Laporan--->
            <td><?php echo $getAbsen[$i]['jamkerja'];?></td> <!---jamkerja--->
            <td><?php echo $getAbsen[$i]['ket']?></td> <!---Tujuan--->
            <td>
              <?php echo $hitHadir." ";?>
              <?php echo $hitMakan." ";?>
              <?php echo $getAbsen[$i]['keterangan']?>
            </td> <!---Kategori--->
          </tr>
        <?php
          }
        ?>
    </tbody>
  </table>

<br/>
<div style='border:1px solid #9BABB8; border-radius: 5px; padding:5px; background-color:#BBD6B8;' class='col-md-12 col-sm-12 col-xs-12'>
      <span><b>----PERKIRAAN PERHITUNGAN----</b></span><br/>
      <p style="font-size:8pt; color:#b52a2c;">Pengali Uang Makan mengikuti yang di dapat saat ini</p>
      <span><b>
        Perhitungan Uang Makan : <?php echo $totaluangmakan; ?> * 
        <?php echo number_format($getUangExtra[0]['uang_makan'],0,'.','.'); ?> = 
        <?php echo number_format($totaluangmakan * $getUangExtra[0]['uang_makan'],0,'.','.'); ?></b>  
      </span> <br /> 
      <span><b>
        Perhitungan Kehadiran : <?php echo $totalkehadiran; ?>* 
        <?php echo number_Format($getUangExtra[0]['uang_tepat_waktu'],0,'.','.'); ?> = 
        <?php echo number_format($totalkehadiran * $getUangExtra[0]['uang_tepat_waktu'],0,'.','.'); ?></b>  
      </span> <br/>
</div>
<div class='col-md-12 col-sm-12 col-xs-12'>
  <div class="ln_solid"></div>
</div>
