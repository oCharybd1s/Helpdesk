<?php
/**
 * $$_POST['type_submit']
 */
class Auth extends Encription
{
	public $type_submit='';
	public $db='';
	function __construct($db='', $request=[])
	{
		extract($request);
		unset( $_POST['submit'] );
		$this->db=$db;
		$this->type_submit=$type_submit;
		if( isset($type_submit) && $type_submit!='' ){
			echo $this->$type_submit();
		}
	}

	public function cekLogin($username = "", $password = ""){

		$data = [
				'target' => "LoginGlobal",
				'key' => "abUnn2e4evpP1vXmJGMa",
				'iddbase' => "DB00000023",
				'idapi' => "API0000150",
				'emp_noAPI0000150' => $username,
				'passAPI0000150' => $password,
			];
		$res = rutanApiPhp($data);
		return $res;
	}

	public function login(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		// $username = "000000";
		// $password = "gotothemoon";
		$data = $this->cekLogin($username, $password);
		if( !empty($data) ){
			$data = $data[0];
			unset($data['pass']);
			$_SESSION[_session_app_id] = $data;
			$emp_no = $session['emp_no'];
			$_SESSION[_session_app_id]['id'] = $emp_no;
			$_SESSION[_session_app_id]['menu'] = json_decode($this->getMenu(), true);
		}

		if (isset($_SESSION[_session_app_id]) && !empty($_SESSION[_session_app_id])) {
			echo json_encode(['status' => 'success', 'message' => 'Berhasil', 'data' => $_SESSION[_session_app_id]]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Login Gagal', 'data' => $_SESSION[_session_app_id]]);
		}
		// return json_encode($result);
	}

	public function getMenu(){

		$emp_no = $_SESSION[_session_app_id]['emp_no'];
		$default_access = $_SESSION[_session_app_id]['emp_no'] == '009263' ? 'ADMIN' : 'all';
		$kode_jabatan = $_SESSION[_session_app_id]['kode_jabatan'];
					// if($session['kode_jabatan']=='CCO') {
		$menu = $this->db->execute("SELECT a.nik, b.*
			FROM makses a
			LEFT JOIN tmenu b ON a.idmenu = b.id
			WHERE a.nik = '$emp_no'
			and b.parent_id= '0' and a.granted='1'
			GROUP BY a.idmenu");
		foreach ($menu as $key => $row) {
			$id_menu = $row['id'];
			$menu[$key]['submenu'] = $this->db->execute("SELECT a.nik, b.*
				FROM makses a
				LEFT JOIN tmenu b ON a.idmenu = b.id
				WHERE a.nik = '$emp_no'
				and b.parent_id= '$id_menu' and a.granted='1'
				GROUP BY a.idmenu");
		}
		return json_encode($menu);
	}

	// public function checkSession(){
	// 	$result = [
	// 		'status'=>isset($_SESSION['login'])? 'success' : 'error',
	// 		'message'=>'',
	// 		'data'=>$_SESSION['login']
	// 	];
	// 	return json_encode($result);
	// }

	// public function login(){
	// 	$result = [
	// 		'status'=>'error',
	// 		'message'=>'user Tidak Ditemukan',
	// 		'data'=>[],
	// 	];
	// 	$user = $this->db->getOne('user', ['username'=>$_POST['username']]);
	// 	if( isset($user['id']) ){
	// 		if( $this->validation( $_POST['password'], $user['password'] ) ){
	// 			$result = [
	// 				'status'=>'success',
	// 				'message'=>'Selamat Datang',
	// 				'data'=>'ok'
	// 			];
	// 			$_SESSION['login'] = [
	// 				'id' => $user['id'],
	// 				'username' => $user['username'],
	// 				'nama' => $user['nama'],
	// 				'akses_id' => $user['akses_id'],
	// 				'created_at' => $user['created_at'],
	// 			];
	// 		}else{
	// 			$result = [
	// 				'status'=>'error',
	// 				'message'=>'Password yang anda masukan salah, silahkan coba lagi',
	// 				'data'=>[],
	// 			];
	// 		}
	// 	}
	// 	return json_encode($result);
	// }

	// public function register(){
	// 	$result = [
	// 		'status'=>'error',
	// 		'message'=>'user Tidak Ditemukan',
	// 		'data'=>[$_POST, $_FILES],
	// 	];
	// 	if( $_POST['kode_otp']=='A1B2' ){
	// 		$storeFolder = glob_src('upload/user_report');
	// 		$nama_file = uploadFile($_FILES['foto_ktp'], $storeFolder , date('Ymdhis'), $allow_type=['jpg','jpeg','png','gif']);
	// 		$data=[
	// 			'alamat' => $_POST['alamat'],
	// 			'nama' => $_POST['nama'],
	// 			'nohp' => $_POST['nohp'],
	// 			'password' => $_POST['password'],
	// 			'sebagai' => $_POST['sebagai'],
	// 			'foto_ktp' => $nama_file,
	// 		];
	// 		$data = $this->db->insert('user_report', $data);
	// 		$result = [
	// 			'status'=>'success',
	// 			'message'=>'register Berhasil',
	// 			'data'=>$data,
	// 		];
	// 		$result['data'] = $data;
	// 		$this->checkUser($_POST['nohp'], $_POST['password']);
	// 	}
	// 	return json_encode($result);
	// }

	// private function checkUser($username, $password){
	// 	$type_login = '';
	// 	if( substr($username, -6)=='_trial' ){
	// 		$type_login = 'trial';
	// 		$username = substr($username, 0, -6);
	// 	}

	// 	$user = $this->db->execute("SELECT * FROM user_report WHERE (nohp='$username' OR username='$username') AND password='$password'");
	// 	$result=['status'=>false, 'user'=>[]];
	// 	if( count($user)>0 ){
	// 		unset($user[0]['password']);
	// 		$result['status'] = true;
	// 		$result['user'] = $user[0];
	// 		$result['user']['type_user'] = 'user_report';
	// 		$result['user']['type_login'] = $type_login;

	// 	}
	// 	return $result;
	// }
}
?>