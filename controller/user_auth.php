<?php
/**
 * $$_POST['type_submit']
 */
class User_auth
{
	public $type_submit='';
	public $db='';
	function __construct($db='', $request=[])
	{
		extract($request);
		unset( $_POST['type_submit'] );
		$this->db=$db;
		$this->type_submit=$type_submit;
		if( isset($type_submit) && $type_submit!='' ){
			echo $this->$type_submit();
		}
	}

	public function checkSession(){
		$result = [
			'status'=>isset($_SESSION['login'])? 'success' : 'error',
			'message'=>'',
			'data'=>$_SESSION['login']
		];
		return json_encode($result);
	}

	public function login(){
		$result = [
			'status'=>'error',
			'message'=>'user Tidak Ditemukan',
			'data'=>[],
		];

		if($_POST['username']=='developer' && $_POST['password']=='developer'){
			$result = [
				'status'=>'success',
				'message'=>'Selamat Datang',
				'data'=>'ok'
			];
			$_SESSION['login'] = ['ok'];
		}
		return json_encode($result);
	}

	public function register(){
		$result = [
			'status'=>'error',
			'message'=>'user Tidak Ditemukan',
			'data'=>[$_POST, $_FILES],
		];
		if( $_POST['kode_otp']=='A1B2' ){
			$storeFolder = glob_src('upload/user_report');
			$nama_file = uploadFile($_FILES['foto_ktp'], $storeFolder , date('Ymdhis'), $allow_type=['jpg','jpeg','png','gif']);
			$data=[
				'alamat' => $_POST['alamat'],
				'nama' => $_POST['nama'],
				'nohp' => $_POST['nohp'],
				'password' => $_POST['password'],
				'sebagai' => $_POST['sebagai'],
				'foto_ktp' => $nama_file,
			];
			$data = $this->db->insert('user_report', $data);
			$result = [
				'status'=>'success',
				'message'=>'register Berhasil',
				'data'=>$data,
			];
			$result['data'] = $data;
			$this->checkUser($_POST['nohp'], $_POST['password']);
		}
		return json_encode($result);
	}

	private function checkUser($username, $password){
		$type_login = '';
		if( substr($username, -6)=='_trial' ){
			$type_login = 'trial';
			$username = substr($username, 0, -6);
		}

		$user = $this->db->execute("SELECT * FROM user_report WHERE (nohp='$username' OR username='$username') AND password='$password'");
		$result=['status'=>false, 'user'=>[]];
		if( count($user)>0 ){
			unset($user[0]['password']);
			$result['status'] = true;
			$result['user'] = $user[0];
			$result['user']['type_user'] = 'user_report';
			$result['user']['type_login'] = $type_login;

		}
		return $result;
	}
}
?>