<?php
/**
 * $$_POST['type_submit']
 */
class Dev_protect extends Encription
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

	public function setForRollback(){

		// $data = [
		// 		'target' => "LoginGlobal",
		// 		'key' => "abUnn2e4evpP1vXmJGMa",
		// 		'iddbase' => "DB00000023",
		// 		'idapi' => "API0000150",
		// 		'emp_noAPI0000150' => $username,
		// 		'passAPI0000150' => $password,
		// 	];
		// $res = rutanApiPhp($data);
		$data = [];
		$result = [
			'status'=> !empty($data)? 'success' : 'error',
			'message'=>'',
			'data'=>[]
		];
		return $res;
	}

	public function getScanDir(){
		$path = $_POST['check_path'];
		$data = [];
		$data['file'] = [];
		$data['folder'] = [];
		foreach (scandir($path) as $key => $val) {
			$fullpath = str_replace('//', '/', "$path/$val");
			if( !in_array($val, ['.', '..']) ){
				if( is_dir($fullpath) ){
					$data['folder'][] = $fullpath;
				}else{
					$data['file'][] = [
						'path'=>$path, 
						'name'=>$val, 
						'modified_date'=> date("Y-m-d H:i:s.", filemtime($fullpath))];
				}
			}
		}
		// $data = scandir($path);
		$result = [
			'status'=> !empty($data)? 'success' : 'error',
			'message'=>'',
			'data'=>$data
		];
		return json_encode($result, true);
	}

}
?>