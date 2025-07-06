<?php
@include('../../action/GetData.php');
echo "<script> console.log('HELPDESK : edithist_filter') </script>";
$getItHDList = getDataItHD($_SESSION['tanggalFilter'],$_SESSION['bulanFilter'],$_SESSION['tahunFilter'],$_SESSION['tujuanFilter'],$_SESSION['kategoriFilter'],$_SESSION['jenisFilter'],$_SESSION['programFilter'],$_SESSION['statusFilter'],'allp');
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive" style="width:100%">
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
		for ($i = 0; $i < count($getItHDList); $i++) {
		?>
			<tr>
				<td id="idhd<?php echo $i; ?>"><a onclick="goEdit('<?php echo $i; ?>')"><?php echo $getItHDList[$i]['No'] ?></a></td>
				<td><?php echo $getItHDList[$i]['Tanggal22']; ?></td>
				<!---Tanggal--->
				<td><?php echo $getItHDList[$i]['dari2']; ?></td>
				<!---Dari--->
				<td>
					<select id="tujuan<?php echo $i; ?>" name="tujuan<?php echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getItHDList[$i]['No'] ?>','tujuan',<?php echo $i; ?>)">
						<option value="All" <?php if (str_replace(" ", "", $getItHDList[$i]['tujuan']) == "All") {
												echo "Selected";
											} ?>)>All</option>
						<option value="Komplain" <?php if (str_replace(" ", "", $getItHDList[$i]['tujuan']) == "Komplain") {
														echo "Selected";
													} ?>>Komplain</option>
						<option value="Request" <?php if (str_replace(" ", "", $getItHDList[$i]['tujuan']) == "Request") {
													echo "Selected";
												} ?>>Request</option>
				</td>
				<td>
					<select id="kategori<?php echo $i; ?>" name="kategori<?php echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getItHDList[$i]['No'] ?>','kategori',<?php echo $i; ?>)">
						<option value="All" <?php if (str_replace(" ", "", $getItHDList[$i]['kategori']) == "All") {
												echo "Selected";
											} ?>>All</option>
						<option value="Software" <?php if (str_replace(" ", "", $getItHDList[$i]['kategori']) == "Software") {
														echo "Selected";
													} ?>>Software</option>
						<option value="Hardware" <?php if (str_replace(" ", "", $getItHDList[$i]['kategori']) == "Hardware") {
														echo "Selected";
													} ?>>Hardware</option>
					</select>
				</td>
				<td>
					<select id="jenislap<? echo $i; ?>" name="jenislap<? echo $i; ?>" class="form-control" onchange="simpanedit('<?php echo $getItHDList[$i]['No'] ?>','jenislap',<?php echo $i; ?>)">
						<?php for ($j = 0; $j < count($jenisLaporan); $j++) { ?>
							<option value="<?php echo $jenisLaporan[$j]['Lap']; ?>" <?php if (str_replace(" ", "", $jenisLaporan[$j]['NamaLaporan']) == str_replace(" ", "", $getItHDList[$i]['Jenis2'])) {
																						echo "selected";
																					} ?>><?php echo $jenisLaporan[$j]['NamaLaporan'] ?></option>
						<?php } ?>
					</select>
				</td>
				<!---Jenis Laporan--->
				<td>
					<select id="program<?php echo $i; ?>" name="program<?php echo $i; ?>" class="form-control col-md-7 col-xs-12" onchange="simpanedit('<?php echo $getItHDList[$i]['No'] ?>','program',<?php echo $i; ?>)">
						<?php for ($j = 0; $j < count($jenisAplikasi); $j++) { ?>
							<option value="<?php echo $jenisAplikasi[$j]['Apl']; ?>" <?php if (str_replace(" ", "", $jenisAplikasi[$j]['NamaAplikasi']) == str_replace(" ", "", $getItHDList[$i]['Aplikasi2'])) {
																							echo "selected";
																						} ?>><?php echo $jenisAplikasi[$j]['NamaAplikasi']; ?></option>
						<?php } ?>
					</select>
					<!---Program--->
				</td>
				<td><?php echo $getItHDList[$i]['issue'] ?></td>
				<!---Jenis Keterangan--->
				<td><?php echo $getItHDList[$i]['solusi'] ?></td>
				<td><?php echo $getItHDList[$i]['lamapengerjaan']?> Menit</td>
				<!---solusi-->
			</tr>
		<?php
		}
		?>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){ 
  $('#datatable').DataTable( {
        "responsive": true,
        "bDestroy": true,
        "stateSave": false,
        "order": [[1, 'asc']],
        "columnDefs": [
          { responsivePriority: 1, targets: 0 },
          { responsivePriority: 1000, targets: 1 },
          { responsivePriority: 1000, targets: 2 },
          { responsivePriority: 1, targets: 3 },
          { responsivePriority: 1, targets: 4 },
          { responsivePriority: 1, targets: 5 },
          { responsivePriority: 1, targets: 6 },
          { responsivePriority: 10001, targets: 7 },
          { responsivePriority: 10002, targets: 8 },
        ]
    } );
});
</script>