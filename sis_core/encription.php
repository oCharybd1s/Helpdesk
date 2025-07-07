<?php
/**
 * 
 */
class Encription
{
	// function __construct($request=[])
	// {
	// 	extract($request);
	// 	unset( $_POST['type_submit'] );
	// 	foreach ($request as $key => $value) {
	// 		$this->$key = $value;
	// 	}
	// 	if( isset($type_submit) && $type_submit!='' ){
	// 		echo json_encode($this->$type_submit());
	// 	}
	// }

	function encode($text=''){
		$text = isset($this->text)? $this->text : $text;
		$return='';
		if($text!=''){
			$return = randString(5).base64_encode($text).randString(10);
			$return = base64_encode($return);
		}
		return $return;
	}

	function decode($text=''){
		$text = isset($this->text)? $this->text : $text;
		$return='';
		if($text!=''){
			$return = base64_decode($text);
			$return = substr($return,5);
			$return = substr($return,0,-10);
			$return = base64_decode($return);
		}
		return $return;
	}

	function validation($send_pass, $enc_pass){
		if( $send_pass === $this->decode($enc_pass) ){
			return true;
		}
		return false;
	}
}
?>