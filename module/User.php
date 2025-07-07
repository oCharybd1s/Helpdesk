<?php
/**
 * $$_POST['type_submit']
 */
class User extends Encription
{
	public $type_submit='';
	public $db='';
	function __construct($db='', $request=[])
	{
		unset( $_POST['type_submit'] );
		extract($request);
		unset( $_POST['target'] );
		$this->db=$db;
		$this->type_submit=$type_submit;
		if( isset($type_submit) && $type_submit!='' ){
			echo $this->$type_submit();
		}
	}

	public function addUser(){
		$result = [
			'status'=>'error',
			'message'=>'Gagal Menyimpan',
			'data'=>$_POST
		];

		if( $_POST['password'] == $_POST['password2'] ){
			$cek = $this->db->getAll('user', ['username'=>$_POST['username']]);
			if( count($cek)>0 ){
				$result = [
					'status'=>'error',
					'message'=>'Gagal Menyimpan, Username sudah dipakai',
					'data'=>$_POST
				];
			}else{
				$data = [
					'username' => $_POST['username'],
					'password' => $this->encode($_POST['password']),
					'nama' => $_POST['nama'],
				];
				$this->db->insert('user', $data);
				$result = [
					'status'=>'success',
					'message'=>'User Berhasil Ditambahkan',
					'data'=>$_POST
				];
			}
		}else{
			$result = [
				'status'=>'error',
				'message'=>'Gagal Menyimpan, password tidak sama',
				'data'=>$_POST
			];

		}

		return json_encode($result);
	}

	public function editUser(){
		$data = [
			'nama' => $_POST['nama'],
		];
		if( $_POST['password']!=''){
			if( $_POST['password']==$_POST['password'] ){
				$data['password'] = $this->encode($_POST['password']);
				$this->db->update('user', $data, ['id'=>$_POST['id']]);
				$result = [
					'status'=>'success',
					'message'=>'User Berhasil Dirubah',
					'data'=>$_POST
				];
			}else{
				$result = [
					'status'=>'error',
					'message'=>'Password tidak sama',
					'data'=>$_POST
				];
			}
		}else{
			$this->db->update('user', $data, ['id'=>$_POST['id']]);
			$result = [
				'status'=>'success',
				'message'=>'User Berhasil Dirubah',
				'data'=>$_POST
			];
		}
		return json_encode($result);
	}

	function dropUser(){
		if( $this->db->delete('user', ['id'=>$_POST['id']]) ){
			$result = [
				'status'=>'success',
				'message'=>'User Berhasil Dihapus',
				'data'=>[]
			];
		}else{
			$result = [
				'status'=>'error',
				'message'=>'Terjadi Kesalahan, gagal menghapus user!',
				'data'=>[]
			];
		}
		return json_encode($result);
	}
}
?>