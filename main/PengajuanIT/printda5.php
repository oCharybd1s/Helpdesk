<?php
@session_start();
$namafull = substr($_SESSION["namaPrint"],0,8);
$listaccpengajuan = $_SESSION['listaccpengajuan'];
$panjangkolom = round(120/count($listaccpengajuan));
$ACCheader = array(
		array("labelACC"=>"DIBUAT", "length"=>20, "align"=>"C"),
		array("labelACC"=>"DIKETAHUI", "length"=>20, "align"=>"C"),
		array("labelACC"=>"DIPERIKSA", "length"=>20, "align"=>"C"),
		array("labelACC"=>"DISETUJUI", "length"=>120, "align"=>"C")
	);
// $ACCisiheaderKOSONG = array(
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"", "length"=>20, "align"=>"C")
// 	);
$ACCisiheaderKOSONG = array(
		array("labelACC"=>"", "length"=>20, "align"=>"C"),
		array("labelACC"=>"", "length"=>20, "align"=>"C"),
		array("labelACC"=>"", "length"=>20, "align"=>"C"),
		// array("labelACC"=>"", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"", "length"=>24, "align"=>"C")
	);

// $ACCisiheader = array(
// 		array("labelACC"=>$namafull[0], "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"KPL.BAG", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PATA", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PDS", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PDK", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PDM", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PDB", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PDL", "length"=>20, "align"=>"C"),
// 		array("labelACC"=>"PPD", "length"=>20, "align"=>"C")
// 	);
$ACCisiheader = array(
		array("labelACC"=>$namafull, "length"=>20, "align"=>"C"),
		array("labelACC"=>"KPL.BAG", "length"=>20, "align"=>"C"),
		array("labelACC"=>"PATA", "length"=>20, "align"=>"C"),
		// array("labelACC"=>"PDA", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"PDL", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"PDO", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"PVP", "length"=>24, "align"=>"C"),
		// array("labelACC"=>"PPD", "length"=>24, "align"=>"C")
	);

for($i=0;$i<count($listaccpengajuan);$i++){
	array_push($ACCisiheaderKOSONG,array("labelACC"=>"", "length"=>$panjangkolom, "align"=>"C"));
	array_push($ACCisiheader,array("labelACC"=>$listaccpengajuan[$i], "length"=>$panjangkolom, "align"=>"C"));
}

$header = array(
		array("label"=>"NO. DOKUMEN", "length"=>50, "align"=>"C"),
		array("label"=>"FORMULIR", "length"=>80, "align"=>"C"),
		array("label"=>"TANGGAL EFEKTIF", "length"=>50, "align"=>"C")
	);
$isiheader = array(
		array("label"=>"FM-IT-HW002", "length"=>50, "align"=>"C"),
		array("label"=>"PENGAJUAN BIAYA IT DIATAS 5.000.000", "length"=>80, "align"=>"C"),
		array("label"=>"21-Jan-2016", "length"=>50, "align"=>"C")
	);

require('../fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

//Judul 
    $pdf->SetFont('Arial', 'B', 20); 
    $pdf->SetFillColor(255, 255, 255); 
    $pdf->SetTextColor(0); 
    $pdf->SetDrawColor(0,0,0);    
    // $pdf->Images('../images/logortn.ico', 50, 50);
    // $pdf->Image('../images/logortn.ico',50,50,5,5,'ico','../images/logortn.ico');
    $pdf->Cell(180, 20, "PT. RUTAN", 1, 0, 'C', true);
	$pdf->Ln();

#buat header tabel
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(0);	
	foreach ($header as $kolom) {
		$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
	}
	$pdf->Ln();

#buat isiheader tabel
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);	
	foreach ($isiheader as $isikolom) {
		$pdf->Cell($isikolom['length'], 5, $isikolom['label'], 1, '0', $isikolom['align'], true);
	}
	$pdf->Ln();
	$pdf->SetFont('Arial','B','7');	
	$pdf->Cell(180, 5,"(HARDWARE REQUEST)", 1, '0', 'C', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','8');
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 5,"REVISI: 01", 1, '0', 'C', true);
	$pdf->Ln();

#kosong
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(180, 1," ", 1, '0', 'C', false);
	$pdf->Ln();

#Isi Field
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);		
	$pdf->Cell(90, 8,"NO. PENGAJUAN : ".$_SESSION["noPrint"], 1, '0', 'L', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(90, 8,"TANGGAL : ".date("d-M-Y"), 1, '0', 'L', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(90, 8,"KEPADA : ".$_SESSION["kepadaPrint"], 1, '0', 'L', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(90, 8,"UP : ".$_SESSION["upPrint"], 1, '0', 'L', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(90, 8,"DARI : ".$_SESSION["namaPrint"], 1, '0', 'L', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(90, 8,"CAB / DEPT HO : ".$_SESSION["cabangPrint"], 1, '0', 'L', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 10,"NAMA INVESTASI : ".$_SESSION["namainvestasiPrint"], 1, '0', 'L', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 10,"JUMLAH BIAYA : Rp. ".$_SESSION["biayaPrint"].",-", 1, '0', 'L', true);
	$pdf->Ln();

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 10,"JADWAL KEBUTUHAN : ".$_SESSION["jadwalPrint"], 1, '0', 'L', true);
	$pdf->Ln();	

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 5,"KETERANGAN USER: ", 1, '0', 'L', false);
	$pdf->Ln();	
	$pdf->MultiCell(180, 5,$_SESSION["alasanPrint"], 1, '0', 'J', true);
	// $pdf->MultiCell(180, 5,"ALASAN PEMBIAYAAN : ".$_POST["alasan"], 1, '0', 'J', true);
	// $pdf->Ln();	

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 5,"ANALISA IT : ", 1, '0', 'L', false);
	$pdf->Ln();	
	$pdf->MultiCell(180, 5,$_SESSION["analisisPrint"], 1, '0', 'J', true);
	$pdf->Ln();	

#kosong
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(80, 0," ", 1, '0', 'C', true);
	$pdf->Ln();	

#Isi Field
	// $pdf->SetFont('Arial','B','10');
	// $pdf->SetFillColor(255,255,255);
	// $pdf->SetTextColor(0);
	// $pdf->SetDrawColor(0,0,0);	
	// $pdf->Cell(50, 5,"DIBUAT", 1, '0', 'C', true);

	// $pdf->SetFont('Arial','B','10');
	// $pdf->SetFillColor(255,255,255);
	// $pdf->SetTextColor(0);
	// $pdf->SetDrawColor(0,0,0);	
	// $pdf->Cell(50, 5,"DISETUJUI", 1, '0', 'C', true);	
	// $pdf->Ln();

#buat ACC header tabel
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);
	foreach ($ACCheader as $kolomACC) {
		$pdf->Cell($kolomACC['length'], 5, $kolomACC['labelACC'], 1, '0', $kolomACC['align'], true);
	}
	$pdf->Ln();

#buat ACC isiheader KOSONG tabel
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);	
	foreach ($ACCisiheaderKOSONG as $isikolomACCKOSONG) {
		$pdf->Cell($isikolomACCKOSONG['length'], 25, $isikolomACCKOSONG['labelACC'], 1, '0', $isikolomACCKOSONG['align'], true);
	}
	$pdf->Ln();		

#buat ACC isiheader tabel
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);	
	foreach ($ACCisiheader as $isikolomACC) {
		$pdf->Cell($isikolomACC['length'], 5, $isikolomACC['labelACC'], 1, '0', $isikolomACC['align'], true);
	}
	$pdf->Ln();		

$pdf->Output();

?>