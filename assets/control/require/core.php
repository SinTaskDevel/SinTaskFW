<?php

	/* URL Encode */
	define("THIS_URL_ENCODE", urlencode($_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]));

	/* Global Secure Token - Semua user mempunyai token ini (login/tidak login) */
	if($_SESSION['globalSecureToken']=="" || $_SESSION['globalSecureToken']==null) {
		$_SESSION['globalSecureToken'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890'), 0, 170 );
		$_SESSION['verIncludeCode'] = $_SESSION['globalSecureToken'];
	}

	/* 
	 * Debuging Function
	 */
	function preErrorShow($array) {
		$arrayResult = "\n";
		foreach($array as $key => $value) {
			$arrayResult = $arrayResult."[ ".$key." ] \t\t=> ".$value."\n";
		}

		echo "<pre>ERROR SHOW -> preErrorShow() -> CORE SINTASK SYSTEM\n
			".$arrayResult."
		</pre>";
	}

	/* Deteksi otomatis URL */
	$__BASE_PROTOCOL__ 	= isset($_SERVER["HTTPS"]) ? 'https' : 'http';
	$__BASE_HOST__		= $_SERVER['HTTP_HOST']; 
	$__BASE_URL__ 		= $__BASE_PROTOCOL__."://".$__BASE_HOST__; 
	
	$__LOGIN_STATUS__ 	= false;

	/* Include Core dari Pengguna */
	include($__DOC_ROOT__.$requirePath['mycontrol']."/my.core.php");

	/* Force HTTPS - memaksakan protokol, jika tidak terbaca Deteksi otomatis */
	if($__MY_CORE__["FORCE_HTTPS"] == true) {
		$__BASE_PROTOCOL__	= "https";
		$__BASE_HOST__		= $_SERVER['HTTP_HOST']; 
		$__BASE_URL__ 		= $__BASE_PROTOCOL__."://".$__BASE_HOST__; 
	}

	if($__MY_CORE__["CUSTOM_BASE_URL"] != null && $__MY_CORE__["CUSTOM_BASE_URL"] != "") {
		if(filter_var($__MY_CORE__["CUSTOM_BASE_URL"], FILTER_VALIDATE_URL) === true) {
		    $__BASE_URL__ = $__MY_CORE__["CUSTOM_BASE_URL"];
		}
	}

	/* Global Secure Token jika login lebih complex & panjang 
	 * $_SESSION['verIncludeCode'] dicocokan / disamakan dengan $_SESSION['globalSecureToken']
	 * penggunaan $_SESSION['verIncludeCode'] hanya dapat dilakukan saat login saja.
	 */
	if($__MY_SESSION__!="" && $__MY_SESSION__!=null) {
		if($_SESSION['verIncludeCode'] != $_SESSION['globalSecureToken']) {
			$_SESSION['verIncludeCode'] 	= $_SESSION['globalSecureToken'].$__MY_SESSION__.$_SESSION['codeSecure'];
			$_SESSION['globalSecureToken'] 	= $_SESSION['verIncludeCode'];
		}
	}
	
	/* Error reporting
	 * -
	 */
	if($__MY_CORE__["HIDE_WARNING_NOTICE"] == true) {
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	/* Timezone
	 * Silahkan ubah menjadi timezone pilihan anda
	 * default GMT+8 (Asia/Makassar) - GMT+8/WITA
	 */
	date_default_timezone_set($__MY_CORE__["TIMEZONE"]);

	/* PHP Ini set
	 * Jika ini tidak berjalan, silahkan ubah pada PHP.ini anda
	 */
	ini_set('max_execution_time', 	$__MY_CORE__["MAX_EXEC_TIME_PHP"]);
	ini_set('display_errors', 		($__MY_CORE__["DISPLAY_PHP_ERROR"] == true ? "On" : "Off")); 
	ini_set('default_charset', 		$__MY_CORE__["DEFAULT_CHARSET"]);
	ini_set('upload_max_filesize', 	$__MY_CORE__["UPLOAD_MAX_FILESIZE"]."M");
	ini_set('post_max_size', 		$__MY_CORE__["POST_UPLOAD_MAX_SIZE"]."M"); 
	ini_set('max_file_uploads', 	$__MY_CORE__["MAX_FILE_UPLOADS"]);
	ini_set('expose_php', 			($__MY_CORE__["EXPOSE_PHP"] == true ? "On" : "Off"));

	/* Definisikan ukuran maksimal upload */
	define("MAXSIZE_PICTURE", 				1024*1024*10);
	define("MAXSIZE_FILE", 					1024*1024*25);
	define("MAXSIZE_MEDIA", 				1024*1024*60);
	
	/* Status Maintenance */
	define("MAINTENANCE", $__MY_CORE__["MAINTENANCE"]); /* Boolean Value */
?>