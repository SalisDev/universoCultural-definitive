<?php
	session_start();
	// session_destroy();

	date_default_timezone_set('America/Sao_Paulo');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	ini_set('error_log', 'logs/php_error_log'); 

	$autoload = function($class) {
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH', 'http://localhost/universo-cultural/');
	define('HOST', 'localhost:3307');
	define('USER', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'universo_cultural');

