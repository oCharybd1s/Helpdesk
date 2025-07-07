<?php
session_start();
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin: *');
header('Pragma: no-cache');
date_default_timezone_set("Asia/Jakarta");
require 'config/config.php';
// require glob_api('database.php');
require sis_core('middleware.php');
// require sis_core('mysql_database.php');
require sis_core('mssql_database.php');
require sis_core('encription.php');
require('controller/page.php');


function getChild($data, $id_parent)
{
	$dt = [];
	foreach ($data as $key => $row) {
		if ($row['parent'] == $id_parent) {
			$row['submenu'] = getChild($data, $row['idmenu']);
			$dt[] = $row;
		}
	}
	return $dt;
}

// $db = new Mysql($config['mysql']['servername'], $config['mysql']['username'], $config['mysql']['password'], $config['mysql']['dbname']);
$db = new Mssql($config['sql']['servername'], $config['sql']['username'], $config['sql']['password'], $config['sql']['dbname']);


$middleware = new Middleware();
$page = new Page();
// $encript = new Encription();
foreach ($_GET as $key => $value) {
	$_POST[$key] = isset($_POST[$key]) ? $_POST[$key] : $value;
}
// dd([ $encript->encode('admin'), $encript->decode('ZGZjZzJZV1J0YVc0PVVPTEltbnZRMjQ='), $encript->validation('admin', 'c2xldDNZV1J0YVc0PW1idnFNaUJZSVo=')] );

// if( protocol()=='http://' ){
// 	direct_to(base_url);
// }

if (!function_exists('myErrorHandler')) {
	function myErrorHandler($errno, $errstr, $errfile, $errline)
	{
		if (filesize('error_log.txt') > 10000) {
			file_put_contents('error_log.txt',  '');
		}
		$error =  json_encode([
			'status' => 'error',
			'error_code' => $errno,
			'message' => $errstr,
			'file' => $errfile,
			'at_line' => $errline,
			'at_time' => date('Y-m-d H:i:s'),
			'client_ip' => $_SERVER['REMOTE_ADDR'],
			'url' => $_SERVER['HTTP_HOST'],
		]);
		file_put_contents('error_log.txt',  PHP_EOL . $error . ';;', FILE_APPEND);
		echo $error;
		exit(1);
		// echo "<b>Terra ERROR Handler</b>:<br>
		// [$errno] $errstr<br>
		// Error on line $errline in $errfile<br>";
	}
}

$path = '/';
if (isset($_SERVER['ORIG_PATH_INFO'])) {
	$path = $_SERVER['ORIG_PATH_INFO'];
} else if (isset($_SERVER['PATH_INFO'])) {
	$path = $_SERVER['PATH_INFO'];
}
if ($path != '/') {
	$path = substr($path, -1) == '/' ? substr($path, 0, -1) : $path;
}
try {
	switch ($path) {
		case '/':
			$middleware->auth($path);
			$page->layout($config['template'], 'index');
			$page->init();

			break;

		case '/login':
			$middleware->auth($path);
			// $page = new Page();
			$page->layout($config['template'], 'login');
			$page->init();
			break;

		case '/logout':
			$_SESSION[_session_app_id] = [];
			direct_to(base_url());
			break;

		case '/post':
			header('Content-Type: application/json');
			$target = $_POST['target'] ?? '';
			switch ($target) {
				case 'forpdf':
					// require glob_module("forpdf.php");
					// $post = new Forpdf($db, $_POST, $_FILES);
					break;
				case 'setLoginSession':
					$session = isset($_POST['login']) ? $_POST['login'] : [];
					$session = is_array($session) ? $session : [];
					if (!empty($session)) {
						$_SESSION[_session_app_id] = $session;
						$_SESSION[_session_app_id]['menu'] = [];
						$emp_no = $session['emp_no'];
						$id_dept = $session['id_dept'];
						$arr = array(
							'target' => 'GetMenuNewHelpdesk',
							'key' => 'efDFM47lJNN6o1QumleM',
							'iddbase' => 'DB00000059',
							'idapi' => 'API0000736',
							'emp_noAPI0000736' => $emp_no,
						);
						$hasil = rutanApiPhp($arr);
						if (count($hasil) > 0) {
							$_SESSION[_session_app_id]['menu'] = getChild($hasil, 0);

							if (isset($_SESSION[_session_app_id]) && !empty($_SESSION[_session_app_id])) {
								echo json_encode(['status' => 'success', 'message' => 'Berhasil', 'data' => $_SESSION[_session_app_id]]);
							} else {
								echo json_encode(['status' => 'error', 'message' => 'Gagal Membuata session', 'data' => $_SESSION[_session_app_id]]);
							}
						} else {
							echo json_encode(['status' => 'error', 'message' => 'ID Tersebut tidak punya akses', 'data' => $_SESSION[_session_app_id]]);
						}
					} else {
						if (isset($_SESSION[_session_app_id]) && !empty($_SESSION[_session_app_id])) {
							echo json_encode(['status' => 'success', 'message' => 'Berhasil', 'data' => $_SESSION[_session_app_id]]);
						} else {
							echo json_encode(['status' => 'error', 'message' => 'Gagal Membuata session', 'data' => $_SESSION[_session_app_id]]);
						}
					}
					break;
				case 'loginworkspace':
					$arr = array(
						'target' => 'LoginGlobal',
						'key' => 'abUnn2e4evpP1vXmJGMa',
						'iddbase' => 'DB00000023',
						'idapi' => 'API0000150',
						'emp_noAPI0000150' => $_POST['usr'],
						'passAPI0000150' => $_POST['psswd']
					);
					$hasildept = rutanApiPhp($arr);
					$_SESSION[_session_app_id] = $hasildept[0];
					$_SESSION[_session_app_id]['id'] =  $hasildept[0]['emp_no'];
					/////
					$_SESSION[_session_app_id]['menu'] = [];
					// $emp_no = $session['emp_no'];
					$arr = array(
						'target' => 'GetMenuNewHelpdesk',
						'key' => 'efDFM47lJNN6o1QumleM',
						'iddbase' => 'DB00000059',
						'idapi' => 'API0000736',
						'emp_noAPI0000736' => $_POST['usr'],
					);
					$hasil = rutanApiPhp($arr);
					$menu = [];
					$menu = array_filter($hasil, function ($row) {
						return $row["parent"] == "0";
					});
					$_SESSION[_session_app_id]['menu'] = $menu;
					foreach ($menu as $key => $row) {
						$id_menu = $row['idmenu'];
						$submenu = [];
						$submenu = array_filter($hasil, function ($row) use ($id_menu) {
							return $row["parent"] == $id_menu;
						});
						$_SESSION[_session_app_id]['menu'][$key]['submenu'] = $submenu;
					}

					direct_to(base_url());
					break;
				case 'getLoginSession':
					echo json_encode(['status' => 'success', 'message' => 'data session', 'data' => $_SESSION[_session_app_id]]);
					break;
				default:
					if (isset($_POST['type_submit']) && $_POST['type_submit'] != '') {
						if (file_exists(glob_module($_POST['target'] . '.php'))) {
							$mudule = true;
							require glob_module($_POST['target'] . '.php');
							$module_name = $_POST['target'];
							unset($_POST['target']);
							if ($_POST['type_submit'] == 'test') {
								$header = apache_request_headers();
								echo json_encode([$header]);
							} else {
								$post = new $module_name($db, $_POST);
							}
						}
					}
					if (!$mudule) {
						echo json_encode(['status' => 'error', 'message' => 'unknown request!']);
					}
					// echo json_encode(['status' => 'error', 'message' => 'unknown request!']);
					break;
			}
			break;

		case '/secure_development':
			// dd( scandir('./template/') );

		// dd( $db->getAll('table_dev') );
			// require glob_path('template/testing.php');
			break;

		case '/getPage':
			if (!isset($_GET['file_name'])) {
				direct_to('/');
			} else {
				$file_name = $_GET['file_name'] . '.php';
			}
			if (file_exists(glob_page($file_name))) {
				require glob_page($file_name);
			} else {
				require glob_page('404.php');
			}
			break;

		default:
			require glob_page('404.php');
			break;
	}
} catch (\Error $t) {
	myErrorHandler('500', $t->getMessage(), $t->getFile(), $t->getLine());
}
