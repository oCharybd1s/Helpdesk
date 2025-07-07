<?php 
require 'config/config.php';

$file_name = isset($_GET['file_name'])? $_GET['file_name'].'.php' : '404.php';
if( file_exists( glob_page($file_name ) ) ){
	require glob_page( $file_name );
}
// dd( glob_page($file_name) );
?>