<?php
	@include('../../action/GetData.php');
	// @include("../../model/GetAbsen.php");

	// $_SESSION['siapa_get_absen']=$_SESSION['siapa'];
	
	$getAbsen = getDataAbsenGdg('02','2024');
?>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
		    <div class="x_panel">
		      <!-- <div class="x_title">
		        <h2 id="title">Absen Anda</h2>
		        <div class="clearfix"></div>
		      </div> -->
		      <div class="x_content">
		      	<div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		<br/>
		<br/>
      	<div class='col-md-6 col-sm-6 col-xs-12' id="contentTable">
      		<table id="datatableAbsen" class="table table-striped table-bordered dt-responsive nowrap" style='border:1px solid #9BABB8;'>
	          	<thead  style='border:1px solid #9BABB8;'>
		            <tr style='border:1px solid #9BABB8;'>
		               <th width="15%">NOID</th>
		               <th width="15%">NAMA</th>
		               <th width="15%">Tanggal</th>
		               <th width="10%">Masuk</th>
		               <th width="10%">Keluar</th>
		               <th width="10%">Total Jam</th>
		               <th width="5%">KAT</th>
		               <th>Keterangan</th>
		               <th width="5%">UANG MAKAN</th>
		               <th width="5%">UANG HADIR</th>		               
		            </tr>
	          	</thead>
				<tbody  style='border:1px solid #9BABB8;'>
					<?php
				      	$totaluangmakan=0;
				      	$totalkehadiran=0;
				        $kategori_include = array('A','B','C','D');
				        $kategori_lead_include = array('A','B','C','D','-');
				        $kondisi_khusus = array('TKH', 'DUK', 'DUM');
				        

				        for($i=0; $i<count($getAbsen); $i++){
				          $getUangExtra = getUangExtra($getAbsen[$i]['noid']);
				          $hitMakan = '';
				          $hitHadir = '';

				          $uangMakan = 0;
				          $uangHadir = 0;

				          $jamawal = '0845';
				          $lead = 0;

				          if (($getAbsen[$i]['uang_tepat_waktu']==0 && $getAbsen[$i]['uang_makan']>18000 && in_array($getAbsen[$i]['ket'], $kategori_lead_include))) {
				              $lead=1;
				            }
				          // =========================================================================
				          // SYARAT TERIMA UANG MAKAN & UANG KEHADIRAN
				          // -----ALL----
				          // jam masuk tidak kosong
				          // jam keluar tidak kosong
				          // kategori absen -> A,B,C,D untuk staf
				          // kategori absen -> A,B,C,D,'-' untuk leader
				          // ada keterangan TKH (Tugas Khusus - data UM dan UK), DUK (Dapat Uang Kehadiran), DUM (Dapat Uang Makan)
				          // =========================================================================
				          // $a = 'm';
				          if ((trim($getAbsen[$i]['jmasuk'])!='' && trim($getAbsen[$i]['jkeluar'])!='' && in_array($getAbsen[$i]['ket'], $kategori_include)) ||
				            ($lead==1 && in_array($getAbsen[$i]['ket'], $kategori_lead_include)) ||
				            in_array(substr(ltrim($getAbsen[$i]['keterangan']),0,3),$kondisi_khusus)) {
				            // $a = 'm1';
				            // ============================================================
				            // SYARAT TERIMA UANG KEHADIRAN
				            // *. Hanya Staf (Lead=0)
				            // *. Masuk sebelum jam 08.45
				            // *. Ada di Kantor 4 Jam (Termasuk jam istirahat) -- Tidak jadi dipakai KOnfirmasi Pak Pil 6 Juli 2023
				            // *. Ada Keterangan DUK di bagian KETERANGAN
				            // ============================================================
				            if (($getAbsen[$i]['jmasuk']<=$jamawal && $lead==0 && in_array($getAbsen[$i]['ket'], $kategori_include)) || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUK' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='TKH' ) {
				                // $a = 'm2';
				                // $hitHadir = '<img src="../../resources/images/gentelella/icons8-fire-16.png"/>';
				                // $totalkehadiran = $totalkehadiran+1;
				                $uangHadir = $getAbsen[$i]['uang_tepat_waktu'];
				              }

				            // ============================================================
				            // SYARAT TERIMA UANG MAKAN
				            // *. Leader selalu dapat uang makan
				            // *. Masuk sebelum jam 11.01
				            // *. Ada Keterangan DUM di bagian KETERANGAN
							// *. Ada di Kantor 4 Jam (Termasuk jam istirahat) -- Konfirmasi Pak Pil 6 Juli 2023
				            // ============================================================
				            if ($lead==1 || ($getAbsen[$i]['jmasuk']<='1030' && substr($getAbsen[$i]['jamkerja'],0,2)>='04') || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUM' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='TKH' ) {  
				                // $a = 'm3';
				                // $hitMakan = '<img src="../../resources/images/gentelella/icons8-cafe-16.png"/>';
				                // $totaluangmakan = $totaluangmakan+1;
				                $uangMakan = $getAbsen[$i]['uang_makan'];
				              }
				          }
			    ?>
			    		<tr <?php if($getAbsen[$i]['jmasuk']>$jamawal) {echo "style='background-color:#F2BED1'; class='my-red'";} ?>>
								<td><?php echo $getAbsen[$i]['noid'];?></td> 
								<td><?php echo $getAbsen[$i]['first_name'];?></td> 
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
								<td><?php echo $uangMakan;?></td>
								<td><?php echo $uangHadir;?></td>
							</tr>
				  	<?php
				  		}
				  	?>
				</tbody>
	        </table>
		</div>
		<!-- END OF CONTENT TABLE -->
    </div>
  </div>
</div>