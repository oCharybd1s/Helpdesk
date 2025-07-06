<?php
echo "<script> console.log('HELPDESK : edithist') </script>";
@include('../../action/GetData.php');

?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 id="title">Edit History</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class='col-md-6 col-sm-6 col-xs-12'>
					Tujuan
					<div class="form-group">
						<select id="kehendak" name="kehendak" class="form-control" onchange="filterHD()">
							<option value="All">All</option>
							<option value="Komplain">Komplain</option>
							<option value="Request">Request</option>
						</select>
					</div>
				</div>
				<div class='col-md-6 col-sm-6 col-xs-12'>
					Kategori
					<div class="form-group">
						<select id="jenis" name="jenis" class="form-control" onchange="filterHD()">
							<option value="All">All</option>
							<option value="Software">Software</option>
							<option value="Hardware">Hardware</option>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Jenis Laporan
					<div class="form-group">
						<select id="jenisLaporan" name="jenisLaporan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="All">All</option>
							<?php for ($i = 0; $i < count($jenisLaporan); $i++) { ?>
								<option value="<?php echo $jenisLaporan[$i]['Lap'] ?>"><?php echo $jenisLaporan[$i]['NamaLaporan'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Program yang dimaksud
					<div class="form-group">
						<select id="programYangDimaksud" name="programYangDimaksud" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="All">All</option>
							<?php for ($i = 0; $i < count($jenisAplikasi); $i++) { ?>
								<option value="<?php echo $jenisAplikasi[$i]['Apl'] ?>"><?php echo $jenisAplikasi[$i]['NamaAplikasi'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Status
					<div class="form-group">
						<select id="status" name="status" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="All">All</option>
							<option value="NBelum">Belum Ditangani</option>
							<option value="0">Dalam Penanganan</option>
							<option value="1">Selesai</option>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Tanggal
					<div class="form-group">
						<select id="tanggal" name="tanggal" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="All">All</option>
							<?php for ($i = 1; $i < 31; $i++) { ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Bulan
					<div class="form-group">
						<select id="bulan" name="bulan" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="All">All</option>
							<option value="01" <?php if ($currentMonth == "01") {
													echo "selected";
												} ?>>Januari</option>
							<option value="02" <?php if ($currentMonth == "02") {
													echo "selected";
												} ?>>Februari</option>
							<option value="03" <?php if ($currentMonth == "03") {
													echo "selected";
												} ?>>Maret</option>
							<option value="04" <?php if ($currentMonth == "04") {
													echo "selected";
												} ?>>April</option>
							<option value="05" <?php if ($currentMonth == "05") {
													echo "selected";
												} ?>>Mei</option>
							<option value="06" <?php if ($currentMonth == "06") {
													echo "selected";
												} ?>>Juni</option>
							<option value="07" <?php if ($currentMonth == "07") {
													echo "selected";
												} ?>>Juli</option>
							<option value="08" <?php if ($currentMonth == "08") {
													echo "selected";
												} ?>>Agustus</option>
							<option value="09" <?php if ($currentMonth == "09") {
													echo "selected";
												} ?>>September</option>
							<option value="10" <?php if ($currentMonth == "10") {
													echo "selected";
												} ?>>Oktober</option>
							<option value="11" <?php if ($currentMonth == "11") {
													echo "selected";
												} ?>>November</option>
							<option value="12" <?php if ($currentMonth == "12") {
													echo "selected";
												} ?>>Desember</option>
						</select>
					</div>
				</div>
				<div class='col-md-4 col-sm-6 col-xs-12'>
					Tahun
					<div class="form-group">
						<select id="tahun" name="tahun" class="form-control col-md-7 col-xs-12" onchange="filterHD()">
							<option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?></option>
							<option value="<?php echo $currentYear - 1; ?>"><?php echo $currentYear - 1; ?></option>
							<option value="<?php echo $currentYear - 2; ?>"><?php echo $currentYear - 2; ?></option>
						</select>
					</div>
				</div>
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<div class="ln_solid"></div>
				</div>
				<div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
					<table id="datatable" class="table table-striped table-bordered dt-responsive">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Dari</th>
								<th>Tujuan</th>
								<th>Kategori</th>
								<th>Jenis Laporan</th>
								<th>Program</th>
								<th>Detail</th>
								<th>Catatan</th>
								<th>Lama Pengerjaan</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for ($i = 0; $i < count($getHistoryHdList); $i++) {
							?>
								<tr>
									<td id="idhd<?php echo $i; ?>"><a onclick="goEdit('<?php echo $i; ?>')"><?php echo $getHistoryHdList[$i]['No'] ?></a></td>
									<td><?php echo $getHistoryHdList[$i]['Tanggal22']; ?></td>
									<!---Tanggal--->
									<td><?php echo $getHistoryHdList[$i]['dari2']; ?></td>
									<!---Dari--->
									<td>
										<select id="tujuan<?php echo $i; ?>" name="tujuan<?php echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getHistoryHdList[$i]['No'] ?>','tujuan',<?php echo $i; ?>)">
											<option value="All" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['tujuan']) == "All") {
																	echo "Selected";
																} ?>)>All</option>
											<option value="Komplain" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['tujuan']) == "Komplain") {
																			echo "Selected";
																		} ?>>Komplain</option>
											<option value="Request" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['tujuan']) == "Request") {
																		echo "Selected";
																	} ?>>Request</option>
									</td>
									<td>
										<select id="kategori<?php echo $i; ?>" name="kategori<?php echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getHistoryHdList[$i]['No'] ?>','kategori',<?php echo $i; ?>)">
											<option value="All" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['kategori']) == "All") {
																	echo "Selected";
																} ?>>All</option>
											<option value="Software" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['kategori']) == "Software") {
																			echo "Selected";
																		} ?>>Software</option>
											<option value="Hardware" <?php if (str_replace(" ", "", $getHistoryHdList[$i]['kategori']) == "Hardware") {
																			echo "Selected";
																		} ?>>Hardware</option>
										</select>
									</td>
									<td>
										<select id="jenislap<? echo $i; ?>" name="jenislap<? echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getHistoryHdList[$i]['No'] ?>','jenislap',<?php echo $i; ?>)">
											<?php for ($j = 0; $j < count($jenisLaporan); $j++) { ?>
												<option value="<?php echo $jenisLaporan[$j]['Lap']; ?>" <?php if (str_replace(" ", "", $jenisLaporan[$j]['NamaLaporan']) == str_replace(" ", "", $getHistoryHdList[$i]['Jenis2'])) {
																											echo "selected";
																										} ?>><?php echo $jenisLaporan[$j]['NamaLaporan'] ?></option>
											<?php } ?>
										</select>
									</td>
									<!---Jenis Laporan--->
									<td>
										<select id="program<?php echo $i; ?>" name="program<?php echo $i; ?>" class="form-control col-md-7 col-xs-12" onchange="simpanedit('<?php echo $getHistoryHdList[$i]['No'] ?>','program',<?php echo $i; ?>)">
											<?php for ($j = 0; $j < count($jenisAplikasi); $j++) { ?>
												<option value="<?php echo $jenisAplikasi[$j]['Apl']; ?>" <?php if (str_replace(" ", "", $jenisAplikasi[$j]['NamaAplikasi']) == str_replace(" ", "", $getHistoryHdList[$i]['Aplikasi2'])) {
													echo "selected";
												} ?>><?php echo $jenisAplikasi[$j]['NamaAplikasi']; ?></option>
											<?php } ?>
										</select>
										<!---Program--->
									</td>
									<td><?php echo $getHistoryHdList[$i]['issue'] ?></td>
									<!---Jenis Keterangan--->
									<td><?php echo $getHistoryHdList[$i]['solusi'] ?></td>
									<!---solusi-->
									<td><?php echo $getHistoryHdList[$i]['lamapengerjaan']?> Menit</td>
									<!-- lamapengerjaan -->
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

