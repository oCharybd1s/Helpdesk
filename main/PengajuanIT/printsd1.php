<?php
@session_start();
$namafull = explode(" ",$_SESSION["namaPrint"]);
$header = array(
		array("label"=>"NO. DOKUMEN", "length"=>50, "align"=>"C"),
		array("label"=>"FORMULIR", "length"=>80, "align"=>"C"),
		array("label"=>"TANGGAL EFEKTIF", "length"=>50, "align"=>"C")
	);
$isiheader = array(
		array("label"=>"FM-IT-HW009", "length"=>50, "align"=>"C"),
		array("label"=>"HARDWARE REQUEST (dibawah 1 jt)", "length"=>80, "align"=>"C"),
		array("label"=>"01-Jul-2017", "length"=>50, "align"=>"C")
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

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(180, 5,"REVISI: 00", 1, '0', 'C', true);
	$pdf->Ln();
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
	$pdf->Cell(90, 8,"DARI : ".$namafull[0], 1, '0', 'L', true);

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
	$pdf->Cell(180, 5,"KETERANGAN USER : ", 1, '0', 'L', false);
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

#Isi Field
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 5,"DIBUAT", 1, '0', 'C', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 5,"DISETUJUI", 1, '0', 'C', true);	
	$pdf->Ln();	


#kosong
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(80, 0," ", 1, '0', 'C', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 20,"", 1, '0', 'C', true);

#kosong
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 20,"", 1, '0', 'C', true);	
	$pdf->Ln();

#kosong
	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(80, 0," ", 1, '0', 'C', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 5,$namafull[0], 1, '0', 'C', true);

	$pdf->SetFont('Arial','B','10');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);	
	$pdf->Cell(50, 5,"PATA", 1, '0', 'C', true);	
	$pdf->Ln();		

	if($_SESSION['printlampiran']==1){ //jika  print lampiran
		for($i=0;$i<count($_SESSION['gblampiran']);$i++){
			// $pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);

			//Judul 
		    $pdf->SetFont('Arial', 'B', 12); 
		    $pdf->SetFillColor(255, 255, 255); 
		    $pdf->SetTextColor(0); 
		    $pdf->SetDrawColor(0,0,0);    
		    // $pdf->Images('../images/logortn.ico', 50, 50);
		    // $pdf->Image('../images/logortn.ico',50,50,5,5,'ico','../images/logortn.ico');
		    $pdf->Cell(180, 20, "LAMPIRAN", 0, 0, 'L', true);
			$pdf->Ln();
			if(substr($_SESSION['gblampiran'][$i],strlen($_SESSION['gblampiran'][$i])-3,3)=='png'){
				$tipefile = 'PNG';
			}else{
				$tipefile = 'JPG';
			}
			$pdf->Image('../../uploadLampiranPJ/'.$_SESSION['gblampiran'][$i],10,30,190,250,$tipefile);
		}
	}	

$pdf->Output();

?>