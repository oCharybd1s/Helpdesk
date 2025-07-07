<?php

/**
 * 
 */
class Middleware
{
	function auth($path = '')
	{

		$result = true;
		$_SESSION[_session_app_id] = isset($_SESSION[_session_app_id]) ? $_SESSION[_session_app_id] : [];
		if (in_array($path, ['/login', '/register'])) {
			if (count($_SESSION[_session_app_id]) > 0) {
				direct_to(base_url);
			}
		} else {
			if (count($_SESSION[_session_app_id]) == 0) {
				direct_to(base_url . 'login');
			}
		}
		if ($result) $this->thenAuth();
	}

	function processing_auth()
	{
	}

	function thenAuth()
	{
	}
}
