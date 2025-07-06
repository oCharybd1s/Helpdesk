<?php
	@session_start();
	@include_once('../model/Login.php'); //non aktifkan warning karena mengganggu. Tidak mempengaruhi performa.
	// if( isset( $_POST['uname'] ) ){
	// 	$user = cekLogin($_POST['uname'],$_POST['upass']);
		// echo "ffff";
		// echo $_POST['siapa'];
		if(isset($_POST['siapa'])){

			
			$user = cekUserHelpdesk($_POST['siapa']);
			if(count($user) == 1){
				$_SESSION['siapa'] = $_POST['siapa'];
				$_SESSION['siapanama'] = $_POST['siapanama'];
				$_SESSION['siapanickName'] = $_POST['siapanickName'];
				if($_POST['gambar']==''){
					$_SESSION['gambarPP'] = "user.png";
				}else{
					$_SESSION['gambarPP'] = $_POST['gambar'];
				}
				$_SESSION['cabang'] = $user[0]['Cabang'];
				$_SESSION['namacabang'] = $user[0]['namacab'];
				$_SESSION['jabatan'] = $user[0]['Status'];
				$_SESSION['nname'] = $_POST['nname'];
				$_SESSION['timeout'] = time();
				$_SESSION["divisi"] = $_POST['divisi'];

				$_SESSION['jenisfilterlap'] = "";
				$_SESSION['tanggalmulailap'] = "";
				$_SESSION['tanggalsampailap'] = "";
				lastLogin($user[0]['NIK'],$user[0]['Password']);

				// $_SESSION['cabang'] = $_POST['cabang'];
				// $_SESSION['namacabang'] = $_POST['namacabang'];
				// $_SESSION['jabatan'] = $_POST['jabatan'];
				// $_SESSION['nname'] = $_POST['nname'];
				// $_SESSION['timeout'] = time();
				// $_SESSION["divisi"] = $_POST['divisi'];

				// $_SESSION['jenisfilterlap'] = "";
				// $_SESSION['tanggalmulailap'] = "";
				// $_SESSION['tanggalsampailap'] = "";
				// lastLogin($_POST['uname'],$_POST['upass']);
			}
			echo count($user);
			// echo $user[0]['Cabang'];

		}
		
	// }
?>