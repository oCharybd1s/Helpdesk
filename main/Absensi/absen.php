<?php
	@include('../../action/GetData.php');
	$_SESSION['halaman_terbuka']='absen';

	// $_SESSION['siapa_get_absen']=$_SESSION['siapa'];
	$nama = '';

	if ($_SESSION['siapa']=='000636')
	 	$_SESSION['siapa']='000870';

	if ($_SESSION['siapa']=='000904') 
		$nama = ' MEYTA MALAYA';
	else if ($_SESSION['siapa']=='000870')
		$nama = 'MUARIF ZAKARIA';

	$_SESSION['siapanama']=$nama;


?>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
		    <div class="x_panel">
		      <div class="x_title">
		        <h2 id="title">Absen Anda</h2>
		        <div class="clearfix"></div>
		      </div>
		      <div class="x_content">
		      	<div class='col-md-4 col-sm-6 col-xs-12'>
		            Bulan
		            <div class="form-group">
		                <select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
			    			<option value="01" <?php if($currentMonth=="01"){echo "selected";}?> >Januari</option>
			    			<option value="02" <?php if($currentMonth=="02"){echo "selected";}?> >Februari</option>
			    			<option value="03" <?php if($currentMonth=="03"){echo "selected";}?> >Maret</option>
			    			<option value="04" <?php if($currentMonth=="04"){echo "selected";}?> >April</option>
			    			<option value="05" <?php if($currentMonth=="05"){echo "selected";}?> >Mei</option>
			    			<option value="06" <?php if($currentMonth=="06"){echo "selected";}?> >Juni</option>
			    			<option value="07" <?php if($currentMonth=="07"){echo "selected";}?> >Juli</option>
			    			<option value="08" <?php if($currentMonth=="08"){echo "selected";}?> >Agustus</option>
			    			<option value="09" <?php if($currentMonth=="09"){echo "selected";}?> >September</option>
			    			<option value="10" <?php if($currentMonth=="10"){echo "selected";}?> >Oktober</option>
			    			<option value="11" <?php if($currentMonth=="11"){echo "selected";}?> >November</option>
			    			<option value="12" <?php if($currentMonth=="12"){echo "selected";}?> >Desember</option>
					  	</select>
		            </div>
		        </div>
		      	<div class='col-md-4 col-sm-6 col-xs-12'>
		            Tahun
		            <div class="form-group">
		                <select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
			    			<option value="<?php echo $currentYear+1; ?>"><?php echo $currentYear+1; ?></option>
			    			<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
			    			<option value="<?php echo $currentYear-1; ?>"><?php echo $currentYear-1; ?></option>
					  	</select>
		            </div>
		        </div>
		      	<div class='col-md-12 col-sm-12 col-xs-12'>
		          	<div class="ln_solid"></div>
		      	</div>
		<div style='border:1px solid #9BABB8; border-radius: 5px; padding:5px; background-color:#dce3ab; color: #900f0f; margin: 10px;' class='col-md-12 col-sm-10 col-xs-12'>
			<span><b>NOTE </b> : SELALU PASTIKAN ANDA MELIHAT FOTO ANDA DI LAYAR MESIN ABSEN SAAT MELAKUKAN ABSENSI
		    </span>
		</div>
		<br/>
		<br/>
		<div  style='border:1px solid #A0937D; border-radius: 5px; background-color:#F9D689; color: #900f0f; margin: 10px;' class='col-md-6 col-sm-6 col-xs-12'>
			<b>	NO ID : <?php echo $_SESSION['siapa']." - ". $_SESSION['siapanama']; ?> </b>
		</div>
      	<div class='col-md-6 col-sm-6 col-xs-12' id="contentTable">
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
							            // *. Masuk sebelum jam 08.46
							            // *. Ada di Kantor 4 Jam (Termasuk jam istirahat)
							            // *. Ada Keterangan DUK di bagian KETERANGAN
							            // ============================================================
							            if (($getAbsen[$i]['jmasuk']<=$jamawal && substr($getAbsen[$i]['jamkerja'],0,2)>='04')  && $lead==0 || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUK' ) {
							                // $a = 'm2';
							                $hitHadir = '<img src="../resources/images/gentelella/icons8-fire-16.png"/>';
							                $totalkehadiran = $totalkehadiran+1;
							                
							              }

							            // ============================================================
							            // SYARAT TERIMA UANG MAKAN
							            // *. Leader selalu dapat uang makan
							            // *. Masuk sebelum jam 10.31
							            // *. Ada Keterangan DUM di bagian KETERANGAN
							            // ============================================================
							            if ($lead==1 || $getAbsen[$i]['jmasuk']<='1030' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='DUM' || substr(ltrim($getAbsen[$i]['keterangan']),0,3)=='TKH') {  
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
		      <!-- <div class='col-md-4 col-sm-4 col-xs-12'>  -->
				    	<!-- <div class='col-md-4 col-sm-4 col-xs-12'>
				    		<span>
									Target : <br />
									Realisasi : <br />
								</span>
								<br />
								<span>
									Saldo Bulan Ini : <br />
									Saldo Bulan Lalu : <br />
								</span>
								<br />
								<span>
									Saldo Akhir : <br />  
								</span>
							</div> -->
							<!-- <div class='col-md-6 col-sm-12 col-xs-12'>
			          	<div class="ln_solid"></div>
			      	</div> -->

			      	<!-- <div class='col-md-4 col-sm-4 col-xs-12'> -->
							
			      	<br/>
		      		<div style='border:1px solid #9BABB8; border-radius: 5px; padding:5px; background-color:#BBD6B8;' class='col-md-12 col-sm-12 col-xs-12'>
      					<span><b>----PERKIRAAN PERHITUNGAN BRUTO----</b></span><br/>
      					  <p style="font-size:8pt; color:#b52a2c;">Nilai Uang Makan mengikuti yang di dapat saat ini</p>
					      <span><b>
					        Perhitungan Uang Makan : <?php echo $totaluangmakan; ?> * 
					        <?php echo number_format($getUangExtra[0]['uang_makan'],0,'.','.'); ?> = 
					        <?php echo number_format($totaluangmakan * $getUangExtra[0]['uang_makan'],0,'.','.'); ?></b>  
					      </span> <br /> 
					      <span><b>
					        Perhitungan Kehadiran : <?php echo $totalkehadiran; ?> * 
					        <?php echo number_Format($getUangExtra[0]['uang_tepat_waktu'],0,'.','.'); ?> = 
					        <?php echo number_format($totalkehadiran * $getUangExtra[0]['uang_tepat_waktu'],0,'.','.'); ?></b>  
					      </span> <br/>
					</div>
					<div class='col-md-12 col-sm-12 col-xs-12'>
					  <div class="ln_solid"></div>
					</div>
				    	<!-- </div> -->
				  <!-- </div> -->
				<!-- </div> -->
				</div>
				<!-- END OF CONTENT TABLE -->


		    <div class='col-md-4 col-sm-4 col-xs-12'>
	    			<p>Kategori : <br />
							<b>A</b> &nbsp Masuk dan Pulang Tepat <br />
							<b>B</b> &nbsp Terlambat Masuk <br />
							<b>C</b> &nbsp Pulang Lebih Awal <br />
							<b>D</b> &nbsp Terlambat Masuk & Pulang Lebih Awal <br />
							<b>T</b> &nbsp Tugas <br />
							<b>S</b> &nbsp Sakit <br />
							<b>-</b> &nbsp Tidak Absen Masuk atau Pulang <br />
							<br />
							<span style="color:blue;">## Revisi Absen bulan <?php echo $currentMonth; ?> Dilayani Max tanggal 10 <? echo $currentMonth+1; ?> ##</span><br />
							<span style="color:red;font-weight:bold;">Total Keterlambatan Bulan Ini = <?php echo count($getTerlambat); ?> Kali</span>
					 	</p> 
			 	
		      	
	    	</div>	
    </div>
  </div>
</div>