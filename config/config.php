<?php
// define('_DS', DIRECTORY_SEPARATOR);
define('_DS', '/');
$servername = $_SERVER['SERVER_NAME']=='172.18.34.2'? '172.18.34.2:8080' : '182.16.163.206:911';
$lokasi_serverapi = $_SERVER['SERVER_NAME']=='172.18.34.2'? 'http://172.18.34.2:8088/Api/Get/index2.php' : 'https://api.rutan.cloud/index.php';
$config=[
	// default Domain Name
	'base_url' => "$servername/@Development/newHelpDesk_magang",

	// template Name
	'template' => 'materialize',

	// use for developer mode
	'debug' => false,

	'sis_core' => 'sis_core',

	// session APP ID
	'session_app_id' => 'newHelpdesk',

	// Path For global Default System
	// 'glob_path' => '..'._DS.'..',
	'glob_path' => '.',

	// Path For global Page View
	'glob_page' => 'page',

	// Path For global Resorce
	'glob_src' => 'src',

	// Path For global default Function
	'glob_helper' => 'helper',

	// Path For global default Function
	'glob_module' => 'module',

	// Path For api
	// 'rutan_api' => 'https://api.rutan.tech',
	'glob_api' => '',
	'glob_url' => '',
	'used_helper' => ['debug', 'function']
];

$is_lokal = $config['base_url'] == "$servername/@Development/newHelpDesk_magang" ? true : false;

$config['mysql'] = $is_lokal ? [
	'servername' => "172.18.34.2",
	'username' => "gigih",
	'password' => "123",
	'dbname' => "framework_dev",
] : [
	'servername' => "172.18.34.2",
	'username' => "gigih",
	'password' => "123",
	'dbname' => "framework_dev",
];

$config['sql'] = $is_lokal ? [
	'servername' => "172.18.34.2\SQLEXPRESS",
	'username' => "itteam",
	'password' => "Black25Snake$",
	'dbname' => "Helpdesk_magang",
] : [
	'servername' => "172.18.34.2\SQLEXPRESS",
	'username' => "itteam",
	'password' => "Black25Snake$",
	'dbname' => "Helpdesk_magang",
];

$config['define'] = [];
$config['define']['is_lokal'] = $is_lokal;

$config['define']['namadb'] = $config['base_url'] == "$servername/@Development/podhub_dev" ? 'podhub_dev' : 'podhub';
$config['define']['db_translatorglobal'] = $is_lokal ? 'DB00000028' : 'DB00000028';
$config['define']['db_wefun'] = $is_lokal ? 'DB00000004' : 'DB00000004';
$config['define']['db_tps'] = $is_lokal ? 'DB00000021' : 'DB00000021';
$config['define']['db_sap'] = $is_lokal ? 'DB00000055' : 'DB00000001';
$config['define']['db_podhub'] = $is_lokal ? 'DB00000052' : 'DB00000049';
$config['define']['api_sap'] = $is_lokal ? 'http://172.18.34.2:8088/ApiSap/index.php' : 'http://172.18.34.2:8088/apisap/index.php';
$config['define']['api_wefun'] = $is_lokal ? 'http://172.18.34.2:8080/@Development/wefun_dev/main/v1.php' : 'https://rutan.cloud/wefun/main/v1.php';
$config['define']['api_rutan'] = $is_lokal ? 'http://172.18.34.2:8088/api/Get/index2.php' : $lokasi_serverapi;

function rootDir(){
	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('/',$url);
	$root_dir='';
	foreach ($parts as $key => $val) {
		if( count($parts)==($key+1) || $key==0 )
			continue;

		$root_dir .= '../';
	}
	return $root_dir;
}

function protocol(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }else{
        $protocol = 'http';
    }
    return $protocol . "://";
}

require "url.php";
require "define.php";
// panggil global helper 

foreach ($config['used_helper'] as $key => $val) {
	require glob_helper."/$val.php";
}

if( !$config['debug'] ){
	error_reporting(0);
}

?>