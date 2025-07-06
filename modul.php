<?php
@include("koneksi.php");
@session_start();

$IPKOMP=$_SERVER['REMOTE_ADDR'];

// function read_ini_file(){
// 	// $reader = parse_ini_file("system.ini");
// 	// $reader = parse_ini_file("system.ini");
// 	$iplokalnya = "172.18.34.2:8080";
// 	$ippublicnya = "182.16.163.206:911";
// 	$reader = ["SVRNAME"=>"172.18.34.2\SQLEXPRESS",
// 				"SVRIP"=>"172.18.34.2",
// 				"TARGETDB"=>"Helpdesk",
// 				"ABSENDB"=>"ABSEN_NEW",
// 				"HRIS"=>"HRIS",
// 				"URL"=>"http://".$iplokalnya."/@Development/helpdesk_dev/main/",
// 				"MAINURL"=>"http://".$iplokalnya."/@Development/helpdesk_dev/",
// 				"UPLOADED"=>"http://".$iplokalnya."/@Development/helpdesk_dev/upload/",
// 				"UPLOADNOTA"=>"http://".$iplokalnya."/@Development/helpdesk_dev/uploadNota/",
// 				"uploadLampiranPJ"=>"http://".$ippublicnya."/@Development/helpdesk_dev/uploadLampiranPJ/",
// 				"URLPUBLIC"=>"http://".$ippublicnya."/@Development/helpdesk_dev/main/",
// 				"MAINURLPUBLIC"=>"http://".$ippublicnya."/@Development/helpdesk_dev/",
// 				"UPLOADEDPUBLIC"=>"http://".$ippublicnya."/@Development/helpdesk_dev/upload/",
// 				"UPLOADNOTAPUBLIC"=>"http://".$ippublicnya."/@Development/helpdesk_dev/uploadNota/",
// 				"uploadLampiranPJPUBLIC"=>"http://".$ippublicnya."/@Development/helpdesk_dev/uploadLampiranPJ/",
// 				"IPPORT"=>"http://".$iplokalnya.""
// 			];	
// 	return $reader;
// }
$is_lokal=false;
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
	"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
$_SERVER['REQUEST_URI']; 
$_SERVER['REQUEST_URI']; 

if(substr($link,0,24)=="http://172.18.34.2:8080/")
{
	$is_lokal=true;
	define('_api_rutan', 'http://172.18.34.2:8088/Api/Get/index2.php');
}
else
{
	define('_api_rutan', 'https://api.rutan.cloud');
}

define('is_lokal', $is_lokal);

function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
function start_connection(){
	// ------------info------------
	$systemini = read_ini_file(); 
 	$serverName = $systemini["SVRNAME"];
	$serverLogin = "magang";
	$serverUnique = "MagangITRUTAN";
	$targetDatabase = $systemini["TARGETDB"];
	// ------------info------------
	$connectionInfo = array( "Database"=>$targetDatabase, "UID"=>$serverLogin, "PWD"=>$serverUnique);
	global $conn;
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	if( !$conn ) {
	     die( print_r( sqlsrv_errors(), true));
	}
}
function execute_query($sql){
	start_connection();
	global $conn;
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query( $conn, $sql , $params, $options );

	if( $stmt === false) {
	    die(print_r(sqlsrv_errors(),true)); //jika salah query
	}

	$field_count = sqlsrv_field_metadata($stmt); //Untuk mengambil nama field
	
	if(!$field_count){ //Jika insert atau delete, tidak ada nama field yang dikembalikan
	}else{
		$name_field = array(); //array untuk menampung nama field
		$data = array(); //array untuk menampung data
		$number = 0; //untuk indexing array pada $data

		for($i = 0; $i<count($field_count); $i++){
			array_push($name_field,$field_count[$i]['Name']); //mengisi nama field data pada array $name_field
		}
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			for($i = 0; $i<count($name_field); $i++){
				$data[$number][$name_field[$i]] = $row[$name_field[$i]]; //mengisi data pada array $data
			}
			$number += 1;
		}
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($conn);
		return $data;
	}
}

function console_log($output, $with_script_tags = true) {
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
	if ($with_script_tags) {
		$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
}
?>
