<?php
	@include_once('../modul.php'); 
	@include_once('../model/Home.php'); //non aktifkan warning karena mengganggu. Tidak mempengaruhi performa.
	$menu = getMenu($_SESSION['jabatan']);
	$menuSub = getSubMenu($_SESSION['jabatan']);
	$jumDimintaDikerjakan = getjumDimintaDikerjakan();
	$jumSedangDikerjakan = getjumSedangDikerjakan();
	$jumBelumDitangani = getjumBelumDitangani();
	$jumBelumDitanganiSAP = getjumBelumDitanganiSAP();
	$jumBelumDitanganiJOB = getjumBelumDitanganiJOB();
	$jumPengajuanBaru = getjumPengajuanBaru();
	$jumTungguAccPATA = getjumTungguAccPATA();
	$jumPengajuanBerjalan = getjumPengajuanBerjalan();
	$jumPengajuanSiap = getjumPengajuanSiap();
	$jumPengajuanSelesai = getjumPengajuanSelesai();
	$jumpinjamhardware = getjumjumpinjamhardware();
	if($_SESSION['jabatan']>=1){
		$totalPengajuan = $jumPengajuanBaru[0]['jumlah'] + $jumTungguAccPATA[0]['jumlah'] + $jumPengajuanSiap[0]['jumlah'] + $jumPengajuanBerjalan[0]['jumlah'];
		$totalHelpdesk = $jumDimintaDikerjakan[0]['jumlah'] + $jumSedangDikerjakan[0]['jumlah'] + $jumBelumDitangani[0]['jumlah']+ $jumBelumDitanganiSAP[0]['jumlah'] + $jumBelumDitanganiJOB[0]['jumlah'];
		if($_SESSION['jabatan']==2){
			$jumverifHD = getjumjumverifHD();
			$jumverifPeng = getjumjumverifPeng();
			$totalPATA= $jumverifHD[0]['jum'] + $jumverifPeng[0]['jum'];
		}
	}else if($_SESSION['jabatan']==0){
		$totalPengajuanx = getcountPengajuan();
		$totalPengajuan = $totalPengajuanx[0]['jum'];
		$totalHelpdeskx = getcountTotalComplain();
		$totalHelpdesk = $totalHelpdeskx[0]['jum'];
	}
	$statusPATA =  getStatsPATA();
	$_SESSION['autoPilotx'] = $statusPATA[0]['MPATA'];
	$systemini = read_ini_file();
	if( isset( $_POST['logout'] ) ){
		echo "Confirm";
	}
	if( isset( $_POST['halaman'] ) ){
		$_SESSION['halaman_terbuka'] = $_POST['halaman'];
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"].$_POST['subhalaman']."/".$_POST['halaman'].".php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"].$_POST['subhalaman']."/".$_POST['halaman'].".php";
		}
		$_SESSION['pageOpen'] = $location;
		header($location); die();
	}
	if( isset( $_POST['generatemenu'] ) ){
		$arr_total[0]['jumDimintaDikerjakan'] = $jumDimintaDikerjakan[0]['jumlah'];
		$arr_total[1]['jumSedangDikerjakan'] = $jumSedangDikerjakan[0]['jumlah'];
		$arr_total[2]['jumBelumDitangani'] = $jumBelumDitangani[0]['jumlah'];
		$arr_total[3]['jumBelumDitanganiSAP'] = $jumBelumDitanganiSAP[0]['jumlah'];
		$arr_total[4]['jumPengajuanBaru'] = $jumPengajuanBaru[0]['jumlah'];
		$arr_total[5]['jumTungguAccPATA'] = $jumTungguAccPATA[0]['jumlah'];
		$arr_total[6]['jumPengajuanSiap'] = $jumPengajuanSiap[0]['jumlah'];
		$arr_total[7]['totalHelpdesk'] = $totalHelpdesk;
		$arr_total[8]['totalPengajuan'] = $totalPengajuan;
		if($_SESSION['jabatan']==2){
			$arr_total[9]['jumverifHD'] = $jumverifHD[0]['jum'];
			$arr_total[10]['jumverifPeng'] = $jumverifPeng[0]['jum'];
			$arr_total[11]['totalPATA'] = $totalPATA;
		}
		echo json_encode($arr_total);
	}
	if( isset( $_POST['statusPATA'] ) ){
		changePATA($_POST['statusPATA']);
	}
	if( isset( $_POST['yearlyProgress'] ) ){
		$yearlyProgress = getYearlyProgress();
		echo json_encode($yearlyProgress);
	}
	if(isset($_POST['profile'])){
		$_SESSION['halaman_terbuka'] = 'profile';
		if(url()==$systemini["IPPORT"]){
			$location = "Location: ".$systemini["URL"]."/profile.php";
		}else{
			$location = "Location: ".$systemini["URLPUBLIC"]."/profile.php";
		}
		header($location); die();
	}
	if( isset( $_POST['nicknameEdit'] ) ){
		updateProfile($_POST['nik'],$_POST['nicknameEdit'],$_POST['paswotEdit'],'Belum');
	}
	if( isset( $_POST['cekTimeOut'] ) ){
		if ($_SESSION['timeout'] + 10 * 60 < time()) {
		    echo "confirm";
	  	} else {
		    echo "session ok";
	  	}
	}
?>