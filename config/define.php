<?php 

define('base_url', protocol().$config['base_url']._DS);
// define('base_url', $config['base_url'] . _DS);

define('template', 'template/'.$config['template']._DS);

define('_glob_url', $config['glob_url']._DS);

define('glob_path', $config['glob_path']._DS);
define('glob_page', $config['glob_page']._DS);
define('glob_src', $config['glob_src']._DS);
define('glob_helper', $config['glob_helper']._DS);
define('glob_api', $config['glob_api']._DS);
define('glob_module', $config['glob_module']._DS);
define('sis_core', $config['sis_core']._DS);

define('_session_app_id', $config['session_app_id']);
foreach ($config['define'] as $key => $val) {
	define($key, $val);
}
// define('rutan_api', $config['rutan_api']._DS);
?>