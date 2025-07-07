<?php
/**
 * $$_POST['type_submit']
 */
class Example_module extends Encription
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

	public function getTest(){
		// $result = $this->db->execute("SELECT * FROM tes");
		$result = $this->db->getAll('tes');
		return json_encode($result);
	}

	public function newTes(){
		$message='';

		$title = $_POST['title'];
		
		$data_yang_dimasukan = [
			'title'=> $_POST['title'],
			'tes'=>'contoh',
		];
		$ins = $this->db->insert('tes', $data_yang_dimasukan);
		
		if(!$ins){
			$message='Terjadi kesalahan';
		}
		return json_encode([
			'statue' => $message==''? 'success' : 'error',
			'message' => $message==''? 'Berhasil' : $message,
		]);
	}

	public function newUpdate(){
		$message='';

		$title = $_POST['title'];
		$id = $_POST['id']??'1'; //cdek jika tidak ada post id maka id=1

		$data_yang_dimasukan = [
			'title'=> $_POST['title'],
			'tes'=>'contoh',
		];
		$ins = $this->db->insert('tes', $data_yang_dimasukan, ['id'=>$id]);
		
		if(!$ins){
			$message='Terjadi kesalahan';
		}
		return json_encode([
			'statue' => $message==''? 'success' : 'error',
			'message' => $message==''? 'Berhasil' : $message,
		]);
	}

}
?>