<?php
	@session_start();
	@include("../../model/Home.php");
	@include("../../model/GetNewhd.php");
	@include("../../model/GetVerifPATA.php");
	@include("../../model/GetITHD.php");
	@include("../../model/GetEditHD.php");
	@include("../../model/GetITPengajuan.php");
	@include("../../model/GetEditPengajuan.php");
	@include("../../model/GetMasterPATA.php");
	@include("../../model/GetAbsen.php");
	@include("../../model/GetEditHist.php");

	date_default_timezone_set("Asia/Jakarta");
	$tanggalIssue = date('m/d/Y G:i:s');
	$currentYear = date("Y");
	$currentMonth = date("m");
	$currentMonthInWord = date("F");

	if($_SESSION['jabatan']==0 && $_SESSION['halaman_terbuka']!='homehd'){
		$countTotalComplain = getcountTotalComplain(); //function di model/Home
		$countComplainDone = getcountComplainDone(); //function di model/Home
		$countComplainRejected = getcountComplainRejected(); //function di model/Home
	}else if($_SESSION['jabatan']>=1 && $_SESSION['halaman_terbuka']!='homehd'){
		$countSolved = getcountSolved(); //function di model/Home
		$countOnTime = getcountOnTime(); //function di model/Home
		$countOverTime = getcountOverTime(); //function di model/Home
		$countOnProgress = getcountOnProgress(); //function di model/Home
		$tabeldatasolved = getdatasolved();
	}
	$listuserhd = getListUserHd2();
	if ($_SESSION['jabatan']==0 && $_SESSION['halaman_terbuka']!='homehd') {
		$jenisLaporan = getJLaporan(); // Jenis Laporan----function di model/GetNewhd
		$jenisAplikasi = getAplikasi(); // Jenis Laporan----function di model/GetNewhd
	} else {
		if($_SESSION['halaman_terbuka']!='homehd'){
			$jenisLaporan = getJLaporanIT(); // Jenis Laporan----function di model/GetNewhd
			$jenisAplikasi = getAplikasiIT(); // Jenis Laporan----function di model/GetNewhd
		}		
	}

	if($_SESSION['halaman_terbuka']=='homehd'){
		// $countSolved = getcountSolved(); //function di model/Home
		// $countOnTime = getcountOnTime(); //function di model/Home
		// $countOverTime = getcountOverTime(); //function di model/Home
		// $countOnProgress = getcountOnProgress(); //function di model/Home
		// $JumKomplainTahun = FDataJumKomplainTahun();
		// $getKomplainTerbuka = FDataKomplainTerbuka();
		// $getHelpdeskDitangi = FDataHdDitangani();
		if($_SESSION['jabatan']>=1){
			if($_POST["tombol"]==1){//solved
				$tabeldatasolved = getdatasolved();
				$getHelpdeskDitangi = FDataHdDitangani();
			}else if($_POST["tombol"]==2){ //ontime
				$tabeldataontime = getdataontime();
			}else if($_POST["tombol"]==3){ //overtime
				$countOverTime = getcountOverTime(); //function di model/Home
				$tabeldataovertime = getdataovertime();
			}else if($_POST["tombol"]==4){ //on progress
				$countOnProgress = getcountOnProgress(); //function di model/Home
				$tabeldataonprogress = getdataonprogress();
			}else if($_POST["tombol"]==5){ //terbuka
				$getKomplainTerbuka = FDataKomplainTerbuka();
				$getHelpdeskDitangi = FDataHdDitangani();
			}else if($_POST["tombol"]==6){ //ditangani
				$getHelpdeskDitangi = FDataHdDitangani();
			}else if($_POST["tombol"]==7){ //hd
				$JumKomplainTahun = FDataJumKomplainTahun();
				$detKomplainTahun = FDataDetJumKomplainTahun();
			}else{
				$countSolved = getcountSolved(); //function di model/Home
				$countOnTime = getcountOnTime(); //function di model/Home
				$countOverTime = getcountOverTime(); //function di model/Home
				$countOnProgress = getcountOnProgress(); //function di model/Home
				$JumKomplainTahun = FDataJumKomplainTahun();
				$getKomplainTerbuka = FDataKomplainTerbuka();
				$getHelpdeskDitangi = FDataHdDitangani();
				$tabeldatasolved = getdatasolved();
				$getHelpdeskDitangi = FDataHdDitangani();
			}
		}else{
			if($_POST["tombol"]==8){//terbuka
				if($_POST["tahun"]){
					$tahun = $_POST["tahun"];
				}else{
					$tahun = date('Y');
				}
				$getComplainOpen = getDataItHD('All','All',$tahun,'All','All','All','All','All','ComplainOpen');
				// $countTotalComplain = getcountTotalComplain();
			}else if($_POST["tombol"]==9){
				if($_POST["tahun"]){
					$tahun = $_POST["tahun"];
				}else{
					$tahun = date('Y');
				}
				if($_POST["bulan"]){
					$bulan = $_POST["bulan"];
				}else{
					$bulan = date('m');
				}
				$getComplainDone = getDataItHD('All',$bulan,$tahun,'All','All','All','All','All','ComplainDone');
				// $countComplainDone = getcountComplainDone(); //function di model/Home
			}else if($_POST["tombol"]==10){
				$getComplainRejected = getDataItHD('All','All',$currentYear,'All','All','All','All','All','ComplainRejected'); 
				// $countComplainRejected = getcountComplainRejected(); //function di model/Home
			}else if($_POST["tombol"]==11){
				$getComplainOpenRingkasan = getDataItHD('All','All','All','All','All','All','All','All','ComplainOpenRingkasanTerbuka');
				$getComplainRingkasanSelesai = getDataItHD('All','All','All','All','All','All','All','All','ComplainOpenRingkasanSelesai');
				$getComplainRingkasanDibuat = getDataItHD('All','All','All','All','All','All','All','All','ComplainOpenRingkasanDibuat');
			}else if($_POST["tombol"]==12){
				$ComplainTerbukaAll = getDataItHD('All','All','All','All','All','All','All','All','ComplainTerbukaAll');
				// $countComplainTerbukaAll = getcountComplainTerbukaAll(); //function di model/Home
			}else{
				if($_POST["tahun"]){
					$tahun = $_POST["tahun"];
				}else{
					$tahun = date('Y');
				}
				$getComplainOpen = getDataItHD('All','All',$tahun,'All','All','All','All','All','ComplainOpen');
				$countTotalComplain = getcountTotalComplain();
				$getKomplainTerbuka = FDataKomplainTerbuka();
				$getHelpdeskDitangi = FDataHdDitangani();
				$countComplainDone = getcountComplainDone(); //function di model/Home
				$countComplainRejected = getcountComplainRejected(); //function di model/Home
				$countComplainTerbukaAll = getcountComplainTerbukaAll();
				$countSelesaiAll = getcountComplainDoneRingkasan();
				$countTotalComplain = getcountTotalComplain();
				$countTotalComplainDibuat = getcountTotalComplainDibuat();
			}
			// $jenisLaporan = getJLaporan(); // Jenis Laporan----function di model/GetNewhd
			// $jenisAplikasi = getAplikasi(); // Jenis Laporan----function di model/GetNewhd
			// $getKomplainTerbuka = FDataKomplainTerbuka();
			// $getHelpdeskDitangi = FDataHdDitangani();
			// $tabeldatasolved = getdatasolved();
			// $getComplainOpen = getDataItHD('All','All','All','All','All','All','All','All','ComplainOpen');
			
			
		}
		
			// // Home----------------------------------------
			// $getComplainOpen = getDataItHD('All','All','All','All','All','All','All','All','ComplainOpen'); //function di model/GetITHD - $currentMonth - $currentYear
			// $getComplainDone = getDataItHD('All','All',$currentYear,'All','All','All','All','All','ComplainDone'); //function di model/GetITHD
			// $getComplainRejected = getDataItHD('All','All',$currentYear,'All','All','All','All','All','ComplainRejected'); //function di model/GetITHD
			// $yearlyProgress = getYearlyProgress(); //function di model/Home
			// //komplain terbuka
			// $getKomplainTerbuka = FDataKomplainTerbuka();
			// //helpdesk yg ditangani this month 
			// $getHelpdeskDitangi = FDataHdDitangani();
			// //jumlah komplain tahun ini
			// $JumKomplainTahun = FDataJumKomplainTahun();
			// $detKomplainTahun = FDataDetJumKomplainTahun();
			if(isset($_POST["judulP"])=="PREVIEW HD SELESAI"){
				$noHdOriginal = $_POST['nohdP'];			
				$noHdNoStrip = str_replace("/","",$_POST['nohdP']);
				$judulPageEditHD = $_POST['judulP'];
				$detailHD = getDetHD($noHdOriginal); //function di model/GetEditHD
				$gambarHD = getGambarHD($noHdNoStrip); //function di model/GetEditHD
				$chatClient = getKomcli($noHdOriginal); //function di model/GetEditHD
				$getITMemberList = getItMember(); //function di model/GetEditHD
			}
			// if($_SESSION["jabatan"]>=1){
			// 	$tabeldataontime = getdataontime();
			// 	$tabeldataovertime = getdataovertime();
			// 	$tabeldataonprogress = getdataonprogress();
			// }
			// if(isset($_POST["jenisfilter"])){
			// 	$listhdpopup = FDataHdPreviFilter($_POST["nik"],$_POST["jenisfilter"],$_POST["tanggalmulai"],$_POST["tanggalsampai"],$_POST["bulanfilter"],$_POST["tahunfilter"]);
			// }
			// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='profile'){
		// Profile ----------------------------------------	
			$getDetailPegawai = getDataDetailPegawai($_SESSION['siapa']); //function di model/GetVerifPATA
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='verifhd'){
		// Verif PATA----------------------------------------	
			$getHelpdesk = getDataHelpdesk('All','All',$currentYear,'All','All','All'); //function di model/GetVerifPATA
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='verifpj' || $_SESSION['halaman_terbuka']=='waitverifpj'){
		// Pengajuan Tunggu Verit PATA----------------------------------------
			$getWaitVerifPATAPengajuan = getDataPengajuan('All','All',$currentYear,'All','waitverifpj'); //function di model/GetITPengajuan
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='newhd'){
		// Tulis helpdesk baru----------------------------------------	
			// *Upload Screenshot / file helpdesk di action/Upload.php
			// *Remove file yang sudah diupload di action/Delete.php
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='offertodo'){
		// Offer To Do List----------------------------------------
			$getOfferToDoList = getDataItHD('All','All',$currentYear,'All','All','All','All','All','offertodo'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='todo'){
		// To Do List----------------------------------------
			$getItToDoList = getDataItHD('All','All','All','All','All','All','All','All','todo'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='ithd'){
		// IT hd List----------------------------------------
			$getItHDList = getDataItHD('All','All','All','All','All','All','All','All','ithd'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='ithdSAP'){
		// IT hd SAP List----------------------------------------
			$getItHDListSAP = getDataItHD('All','All','All','All','All','All','All','All','ithdSAP'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='ithdJOB'){
		// IT hd JOB List----------------------------------------
			$getItHDListJOB = getDataItHD('All','All','All','All','All','All','All','All','ithdJOB'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='allp'){
		// History Helpdesk List----------------------------------------
			$getHistoryHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','allp'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='edithist'){
		// History Helpdesk List----------------------------------------
			$getHistoryHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','allp'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='newpj'){

	}else if($_SESSION['halaman_terbuka']=='dashboard'){
		$datauserdashboard = getDataUserDashboard();
		$datapengajuandashboard = getDataPengajuanDashboard();
		$datahelpdeskdashboard = getDataHelpdeskDashboard();
		$jumhelpdeskhariini = getJenisHelpdeskHariIini();
		$jumlahDikerjakan = getJumlahDikerjakan();
		$jumlahSelesai = getJumlahHelpdeskSelesai();
		$jumlahSelesaiBulan = getJumlahHelpdeskSelesaiBulan();
		$hdbelumselesaibulan = getbelumselesaibulan();
		$avgwaktu = waktupengerjaanavg();
		$kurang3menit = getkurang3menit(date('Y'),date('m'));
		$overtime = getovertime(date('Y'),date('m'));
		$avgwaktubulan = waktupengerjaanavgbulan();
		$waktupenanganan = getwaktupenanganan();
	}else if($_SESSION['halaman_terbuka']=='waiteditpj'){
		// List Pengajuan Baru----------------------------------------
			// $getWaitPengajuan = getDataPengajuan('All','All',$currentYear,'All','waiteditpj'); //function di model/GetITPengajuan
			$getWaitPengajuan = getDataPengajuan('All','All','All','All','waiteditpj'); //function di model/GetITPengajuan
			$getCabang = getAllCabang();
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='itpj'){
		// IT Pengajuan----------------------------------------
			$getPengajuanIT = getDataPengajuan('All','All',$currentYear,'All','itpj'); //function di model/GetITPengajuan
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='pjberjalan'){
			$getPengajuanIT = getDataPengajuanBerjalan('All','All',$currentYear,'All','pjberjalan');
	}else if($_SESSION['halaman_terbuka']=='pjselesai'){
			$getPengajuanIT = getDataPengajuanSelesai('All','All',$currentYear,'All','pjberjalan');
	}else if($_SESSION['halaman_terbuka']=='allpj'){
		// History Pengajuan----------------------------------------
			$getHistoryPengajuan = getDataPengajuan('All','All',$currentYear,'All','allpj'); //function di model/GetITPengajuan
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='edithd'){
		// Edit HD----------------------------------------
			$noHdOriginal = $_GET['nohd'];
			$noHdNoStrip = str_replace("/","",$_GET['nohd']);
			$judulPageEditHD = $_GET['jdlPage'];
			$detailHD = getDetHD($noHdOriginal); //function di model/GetEditHD
			$gambarHD = getGambarHD($noHdNoStrip); //function di model/GetEditHD
			$chatClient = getKomcli($noHdOriginal); //function di model/GetEditHD
			$getITMemberList = getItMember(); //function di model/GetEditHD
			//update sudah dilihat
			updateSudahLihatHD($noHdOriginal);
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='editpengajuan'){
		// Edit Pengajuan----------------------------------------		
			$noPj = $_GET['nopengajuan'];
			$panjangPengajuan = strlen($noPj);
			// echo $panjangPengajuan; 
			
			if (substr_count($noPj, "-")==2) {			//HR-ITP-2202005
				$detailPengajuan = getDetMPj($noPj);	//function di model/GetEditPengajuan
			} else {  //HR-ITP-1-2202005
				$detailPengajuan = getDetPj($noPj);	 	//function di model/GetEditPengajuan
			}
			// if($panjangPengajuan==14){
			// 	$detailPengajuan = getDetMPj($noPj);	//function di model/GetEditPengajuan			
			// }else if($panjangPengajuan==16){
			// 	$detailPengajuan = getDetPj($noPj);		//function di model/GetEditPengajuan
			// }

			$detOldNumber = getOldNumber($noPj);
			$getAccPata = getAccPengPATA($noPj);
			$chatClientPengajuan = getKomcliPj($noPj); //function di model/GetEditPengajuan
			$gambarPj = getGambarHPj($noPj); //function di model/GetEditPengajuan
			$gambarLampiranPj = getGambarLampiranPj($noPj); //function di model/GetEditPengajuan
			$accPengajuan = getAccPeng($noPj); //function di model/GetEditPengajuan
			$accPengajuanSudah = getAccPengSudah($noPj); //function di model/GetEditPengajuan
			$gambarnota = getGambarNota($noPj);
			$totalrealisasi = getTotalRealisasi($noPj);
			//update sudah dilihat
			
			updateSudahLihat($noPj);
		// --------------------------------------------------------------------------------
	}
	else if($_SESSION['halaman_terbuka']=='newoldpj')
	{
		$gambarLampiranPj = getGambarLampiranPj($noPj); //function di model/GetEditPengajuan
		$getNewNoOldPeng = GetNewNoOldPeng();
	}
	else if($_SESSION['halaman_terbuka']=='hakadmin'){
		// Edit HD----------------------------------------
			$getITMemberList = getItMember(); //function di model/GetEditHD
			$getSemuaPegawai = getPegawai(); //function di model/GetMasterPATA
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='absen'){
		// Absen----------------------------------------
			$getAbsen = getDataAbsen($_SESSION['siapa'],$currentMonth,$currentYear); //function di model/GetAbsen
			$getTerlambat = getDataTerlambat($_SESSION['siapa']); 
			$getUangExtra = getUangExtra($_SESSION['siapa']);
			//function di model/GetAbsen
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='cuti_massal'){
		// Cuti Massal----------------------------------------
			$getCutiMassal = getDataCutiMassal($currentYear); //function di model/GetAbsen
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='cuti_anda'){
		// Cuti anda----------------------------------------
			$getCutiMassal = getDataCutiBersama($currentYear); //function di model/GetAbsen
			$getCutiAnda = getDataCutiAnda($_SESSION['siapa'],$currentYear); //function di model/GetAbsen
			$getCutiC = getDataCutiC($_SESSION['siapa'],$currentYear); //function di model/GetAbsen
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='rejectedhd'){
		// Rejected Helpdesk List----------------------------------------
			$getRejectHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','rejectedhd'); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='rejectedpj'){
		// Rejected IT Pengajuan----------------------------------------
			$getRejectedPengajuanIT = getDataPengajuan('All','All',$currentYear,'All','rejectedpj'); //function di model/GetITPengajuan
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='lallp'){
		// Rejected IT Pengajuan----------------------------------------
			$getHistoryHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','allp'); //function di model/GetITHD
			$getLaporanAllp = getDataLaporanAllp($currentMonth,$currentYear); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='mpinjam'){
		// Rejected IT Pengajuan----------------------------------------
			if(isset($_GET['idpinjam'])){
				$datapinjam = getDataPinjamEdit($_GET['idpinjam']); //
				$datapinjamdetail = getDataPinjamEditDetail($_GET['idpinjam']); //
				$nomerpinjam = $_GET['idpinjam'];
			}else{
				$datapinjam = getDataPinjam(); //
				$nomerpinjam = getNoPinjam();
			}
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='MBarang'){
		// Rejected IT Pengajuan----------------------------------------
			if(isset($_GET['idbarang'])){
				$nomerbarang = $_GET['idbarang'];
				$databarang = getDatahardwareEdit($_GET['idbarang']);
			}else{
				$databarang = getDatahardware();
				$nomerbarang = getNomerBarang();
			}
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='lapfinish'){
		// Rejected IT Pengajuan----------------------------------------
			$getHistoryDoneHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','lapfinish'); //function di model/GetITHD
			$getLaporanFinishNama = getDataLaporanFinishByNama($currentMonth,$currentYear,"","",""); //function di model/GetITHD
			$getLaporanFinishByCabang = getDataLaporanFinishByCabang($currentMonth,$currentYear,"","",""); //function di model/GetITHD
			$getLaporanFinishByCabangTotal = getDataLaporanFinishByCabangTotal($currentMonth,$currentYear); //function di model/GetITHD
			$getLaporanFinishByProgram = getDataLaporanFinishByProgram($currentMonth,$currentYear,"","",""); //function di model/GetITHD
			$getLaporanFinishByProgramTotal = getDataLaporanFinishByProgramTotal($currentMonth,$currentYear); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='lappengajuan'){
		// History Pengajuan----------------------------------------
			$getHistoryPengajuan = getDataPengajuan('All','All',$currentYear,'All','allpj'); //function di model/GetITPengajuan
			$getLaporanPengajuan = getDataLaporanPengajuan(); //function di model/GetITHD
			$getLaporanPengajuanTotal = getDataLaporanPengajuanTotal(); //function di model/GetITHD
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='lapdata'){
		// Laporan All Helpdesk----------------------------------------
			
			$getDataHelpdeskByAplikasicurrentYear = getDataHelpdeskByAplikasi($currentYear);
			$getDataHelpdeskByAplikasilastYear = getDataHelpdeskByAplikasi($currentYear-1);
			$getDataHelpdeskByAplikasilasttwoYear = getDataHelpdeskByAplikasi($currentYear-2);

			$getDataHelpdeskByJenisLaporancurrentYear = getDataHelpdeskByJenisLaporan($currentYear);
			$getDataHelpdeskByJenisLaporanlastYear = getDataHelpdeskByJenisLaporan($currentYear-1);
			$getDataHelpdeskByJenisLaporanlasttwoYear = getDataHelpdeskByJenisLaporan($currentYear-2);

			$getDataHelpdeskSelesaicurrentYear = getDataHelpdeskSelesai($currentYear);
			$getDataHelpdeskSelesailastYear = getDataHelpdeskSelesai($currentYear-1);
			$getDataHelpdeskSelesailasttwoYear = getDataHelpdeskSelesai($currentYear-2);

			$getDataHelpdeskBelumDitanganicurrentYear = getDataHelpdeskBelumDitangani($currentYear);
			$getDataHelpdeskBelumDitanganilastYear = getDataHelpdeskBelumDitangani($currentYear-1);
			$getDataHelpdeskBelumDitanganilasttwoYear = getDataHelpdeskBelumDitangani($currentYear-2);
			
			$getDataHelpdeskSedangDitanganicurrentYear = getDataHelpdeskSedangDitangani($currentYear);
			$getDataHelpdeskSedangDitanganilastYear = getDataHelpdeskSedangDitangani($currentYear-1);
			$getDataHelpdeskSedangDitanganilasttwoYear = getDataHelpdeskSedangDitangani($currentYear-2);

			$getTotalHelpdeskcurrentYear = getTotalHelpdesk($currentYear);
			$getTotalHelpdesklastYear = getTotalHelpdesk($currentYear-1);
			$getTotalHelpdesklasttwoYear = getTotalHelpdesk($currentYear-2);

			$getDataHelpdeskDitolakcurrentYear = getDataHelpdeskDitolak($currentYear);
			$getDataHelpdeskDitolaklastYear = getDataHelpdeskDitolak($currentYear-1);
			$getDataHelpdeskDitolaklasttwoYear = getDataHelpdeskDitolak($currentYear-2);
		// --------------------------------------------------------------------------------
	}else if($_SESSION['halaman_terbuka']=='edithdlist'){
		$getHistoryHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','allp');
	// }else if($_SESSION['halaman_terbuka']=='edithist'){
	// 	$getHistoryHdList = getDataItHD('All',$currentMonth,$currentYear,'All','All','All','All','All','allp');
	}else if($_SESSION['halaman_terbuka']=="InternalHW"){
		$getListJob = FDataListJobInternal();
		$newNumber = getnewjobnumber();
		if(isset($_POST["editP"])==1){
			$nomor = $_POST['nomorP'];
			$dataEdit = FDataEditInternalHW($_POST['nomorP']);
			$getPaused = getPauseJobHW($_POST['nomorP']);
		}
	}else if($_SESSION['halaman_terbuka']=="LaporanMingguan" ){
		$datarating = FDataRatingMingguan();
		$tanggalmingguakhir = FDataMingguTreakhir();
		$datamingguanpusat = FDataRekapHDMingguan();
		$datamingguancabang = FDataRekapHDMingguanCab();
		//untuk preview detail
		if(isset($_POST['judulP'])=="HELPDESK SELESAI"){
			$dataselesaimingguan = FDataHDSelesaiPreview($_POST["nikP"]);
		}
		if(isset($_POST['judulP'])=="PREVIEW HD SELESAI"){
			$noHdOriginal = $_POST['nohdP'];			
			$noHdNoStrip = str_replace("/","",$_POST['nohdP']);
			$judulPageEditHD = $_POST['judulP'];
			$detailHD = getDetHD($noHdOriginal); //function di model/GetEditHD
			$gambarHD = getGambarHD($noHdNoStrip); //function di model/GetEditHD
			$chatClient = getKomcli($noHdOriginal); //function di model/GetEditHD
			$getITMemberList = getItMember(); //function di model/GetEditHD
		}
		if(isset($_POST['judulP'])=="HELPDESK SELESAI PUSAT"){
			$datamingguanpusatprev = FDataHDSelesaiPreviewPusat($_POST["nikP"],$_POST["divisiP"]);
			$datamingguanpusatprevlama = FDataHDSelesaiPreviewPusatLama($_POST["nikP"],$_POST["divisiP"]);
		}
		if(isset($_POST['judulP'])=="HELPDESK SELESAI CABANG"){
			$datamingguancabangprev = FDataHDSelesaiPreviewCabang($_POST["nikP"],$_POST["divisiP"]);
			$datamingguancabangprevlama = FDataHDSelesaiPreviewCabangLama($_POST["nikP"],$_POST["divisiP"]);
		}
	}else if($_SESSION['halaman_terbuka']=="LaporanHarian"){
		$datalaporanharian = FDataLaporanHarian('','');		
	}else if($_SESSION['halaman_terbuka']=="HDIt"){
		$getItHDList = getDataItHD('All','All','All','All','All','All','All','All','HDIt');
	}else if($_SESSION['halaman_terbuka']=='ListLebih90'){
		$getListHD90 = FDataListHD90('All',date('Y'));
	}
	// echo isset($_POST['judulP']);
	// echo $_SESSION['halaman_terbuka'];

?>