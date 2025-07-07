<?php 
	if (!function_exists('dd')) {
	    function dd($variable, $exit=true)
	    {
	        echo "<pre>";
	        array_map(function ($arg) {
	            print_r($arg);
	        }, func_get_args());
	        echo "</pre>";
	        if($exit)
	            exit(1);
	    }
	}

	if (!function_exists('dj')) {
	    function dj($variable, $exit=true)
	    {
	        echo json_encode($variable, JSON_PRETTY_PRINT);
	        if($exit)
	            exit(1);
	    }
	}

	if (!function_exists('console_log')) {
		// debug To Console
	    function console_log($variable)
	    {
	        echo "<script> console.log(JSON.parse(".json_encode($variable).")); </script>";
	    }
	}

	if (!function_exists('vd')) {
	    function vd($variable, $exit=true)
	    {
	        echo "<pre>";
	        array_map(function ($arg) {
	            var_dump($arg);
	        }, func_get_args());
	        echo "</pre>";
	        if($exit)
	            exit(1);
	    }
	}

	if (!function_exists('direct_to')) {
	    function direct_to($url)
	    {
	        header("location: ".$url);
	    }
	}

	if (!function_exists('master_code')) {
	    function master_code($code='')
	    {
	    	$m_code = [
	    		100 => ['error', 'Continue'],
	    		101 => ['error', 'Switching Protocols'],
			    102 => ['error', 'Processing'], // WebDAV; RFC 2518
			    103 => ['error', 'Early Hints'], // RFC 8297
			    200 => ['success', 'OK'],
			    201 => ['success', 'Created'],
			    202 => ['success', 'Accepted'],
			    203 => ['success', 'Non-Authoritative Information'], // since HTTP/1.1
			    204 => ['success', 'No Content'],
			    205 => ['success', 'Reset Content'],
			    206 => ['success', 'Partial Content'], // RFC 7233
			    207 => ['success', 'Multi-Status'], // WebDAV; RFC 4918
			    208 => ['success', 'Already Reported'], // WebDAV; RFC 5842
			    226 => ['success', 'IM Used'], // RFC 3229
			    300 => ['error', 'Multiple Choices'],
			    301 => ['error', 'Moved Permanently'],
			    302 => ['error', 'Found'], // Previously "Moved temporarily"
			    303 => ['error', 'See Other'], // since HTTP/1.1
			    304 => ['error', 'Not Modified'], // RFC 7232
			    305 => ['error', 'Use Proxy'], // since HTTP/1.1
			    306 => ['error', 'Switch Proxy'],
			    307 => ['error', 'Temporary Redirect'], // since HTTP/1.1
			    308 => ['error', 'Permanent Redirect'], // RFC 7538
			    400 => ['error', 'Bad Request'],
			    401 => ['error', 'Unauthorized'], // RFC 7235
			    402 => ['error', 'Payment Required'],
			    403 => ['error', 'Forbidden'],
			    404 => ['error', 'Not Found'],
			    405 => ['error', 'Method Not Allowed'],
			    406 => ['error', 'Not Acceptable'],
			    407 => ['error', 'Proxy Authentication Required'], // RFC 7235
			    408 => ['error', 'Request Timeout'],
			    409 => ['error', 'Conflict'],
			    410 => ['error', 'Gone'],
			    411 => ['error', 'Length Required'],
			    412 => ['error', 'Precondition Failed'], // RFC 7232
			    413 => ['error', 'Payload Too Large'], // RFC 7231
			    414 => ['error', 'URI Too Long'], // RFC 7231
			    415 => ['error', 'Unsupported Media Type'], // RFC 7231
			    416 => ['error', 'Range Not Satisfiable'], // RFC 7233
			    417 => ['error', 'Expectation Failed'],
			    418 => ['error', 'I\'m a teapot'], // RFC 2324, RFC 7168
			    421 => ['error', 'Misdirected Request'], // RFC 7540
			    422 => ['error', 'Unprocessable Entity'], // WebDAV; RFC 4918
			    423 => ['error', 'Locked'], // WebDAV; RFC 4918
			    424 => ['error', 'Failed Dependency'], // WebDAV; RFC 4918
			    425 => ['error', 'Too Early'], // RFC 8470
			    426 => ['error', 'Upgrade Required'],
			    428 => ['error', 'Precondition Required'], // RFC 6585
			    429 => ['error', 'Too Many Requests'], // RFC 6585
			    431 => ['error', 'Request Header Fields Too Large'], // RFC 6585
			    451 => ['error', 'Unavailable For Legal Reasons'], // RFC 7725
			    500 => ['error', 'Internal Server Error'],
			    501 => ['error', 'Not Implemented'],
			    502 => ['error', 'Bad Gateway'],
			    503 => ['error', 'Service Unavailable'],
			    504 => ['error', 'Gateway Timeout'],
			    505 => ['error', 'HTTP Version Not Supported'],
			    506 => ['error', 'Variant Also Negotiates'], // RFC 2295
			    507 => ['error', 'Insufficient Storage'], // WebDAV; RFC 4918
			    508 => ['error', 'Loop Detected'], // WebDAV; RFC 5842
			    510 => ['error', 'Not Extended'], // RFC 2774
			    511 => ['error', 'Network Authentication Required'], // RFC 6585
			];
			return $code==''? $m_code : (isset($m_code[$code])? $m_code[$code] : '');
	    }
	}

?>