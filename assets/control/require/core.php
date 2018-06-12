<?php
	
	/* ### FUNCTION CORE ### */
	
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
	
	/*
	 * str_replace hanya untuk awal hasil
	 */
	function strReplaceFirst($from, $to, $subject) {
		$from = '/'.preg_quote($from, '/').'/';
		return preg_replace($from, $to, $subject, 1);
	}
	
	/* ### END FUNCTION CORE ### */
	
	/* ### VARIABLE & SETTING CORE ### */

	/* Deteksi otomatis Protokol */
	$__BASE_PROTOCOL__ 	= isset($_SERVER["HTTPS"]) ? 'https' : 'http';
	$__RBASE_PROTOCOL__ = $__BASE_PROTOCOL__;
	$__RBASE_URI__ 		= $_SERVER['REQUEST_URI'];
	
	/* Inisialisasi awal login status */
	$__LOGIN_STATUS__ 	= false;

	/* Include Core dari Pengguna */
	include($__DOC_ROOT__.$requirePath['mycontrol']."/my.core.php");

	/* Force HTTPS - memaksakan protokol, jika tidak terbaca Deteksi otomatis */
	if(isset($__MY_CORE__["FORCE_HTTPS"]) && $__MY_CORE__["FORCE_HTTPS"] == true) {
		$__BASE_PROTOCOL__	= "https";
	}
	
	/* Deteksi otomatis URL */
	$__TMP_BASE_URL__	= preg_replace("!^${__CENTER__}!", '', $__BASE_DIR__);
	$__BASE_PORT__		= $_SERVER['SERVER_PORT'];
	$__DISPLAY_PORT__ 	= ($__BASE_PROTOCOL__ == 'http' && $__BASE_PORT__ == 80 || $__BASE_PROTOCOL__ == 'https' && $__BASE_PORT__ == 443) ? '' : ":$__BASE_PORT__";
	$__BASE_DOMAIN__	= $_SERVER['SERVER_NAME'];
	$__BASE_URL_PORT__  = "${__BASE_PROTOCOL__}://${__BASE_DOMAIN__}${__DISPLAY_PORT__}${__TMP_BASE_URL__}";
	$__BASE_URL__  		= "${__BASE_PROTOCOL__}://${__BASE_DOMAIN__}${__TMP_BASE_URL__}";
	
	/* $__BASE_URL__ Custom, sehingga dapat diganti menjadi manual */
	if(
		isset($__MY_CORE__["CUSTOM_BASE_URL"]) && 
		$__MY_CORE__["CUSTOM_BASE_URL"] != null && 
		$__MY_CORE__["CUSTOM_BASE_URL"] != ""
	) {
		$__TBASE_URL_PROTOCOL__ 	= strtoupper(substr($__MY_CORE__["CUSTOM_BASE_URL"], 0, 5));
		$__TBASE_URL_HOST__			= parse_url($__MY_CORE__["CUSTOM_BASE_URL"], PHP_URL_HOST);

		if($__TBASE_URL_PROTOCOL__ == "HTTPS") {
			$__MY_CORE__["CUSTOM_BASE_URL"] = strtolower($__TBASE_URL_PROTOCOL__)."://".$__TBASE_URL_HOST__;
			
			/* Custom URL (HTTPS) + FORCE_WWW */
			if(isset($__MY_CORE__["FORCE_WWW"]) && $__MY_CORE__["FORCE_WWW"] == true) {
				if(strtoupper(substr($__MY_CORE__["CUSTOM_BASE_URL"], 8, 3)) != "WWW") {
					$__MY_CORE__["CUSTOM_BASE_URL"] = strtolower($__TBASE_URL_PROTOCOL__)."://www.".$__TBASE_URL_HOST__;
				} else {
					$__MY_CORE__["CUSTOM_BASE_URL"] = strtolower($__TBASE_URL_PROTOCOL__)."://".$__TBASE_URL_HOST__;
				}
			}
			/* Custom URL (HTTPS) + FORCE_NOT_WWW */
			if(isset($__MY_CORE__["FORCE_NOT_WWW"]) && $__MY_CORE__["FORCE_NOT_WWW"] == true) {
				if(strtoupper(substr($__BASE_URL__, 8, 3)) == "WWW" && $__BASE_PROTOCOL__ == "http") {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;

					$__VAL1__ = substr($__MY_CORE__["CUSTOM_BASE_URL"], 0, 8);
					$__VAL2__ = substr($__MY_CORE__["CUSTOM_BASE_URL"], (8+4), strlen($__MY_CORE__["CUSTOM_BASE_URL"]));

					$__MY_CORE__["CUSTOM_BASE_URL"] = $__VAL1__.$__VAL2__;
				} else {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;
				}
			}
		} else {
			$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;

			/* Custom URL (HTTP) + FORCE_WWW */
			if(isset($__MY_CORE__["FORCE_WWW"]) && $__MY_CORE__["FORCE_WWW"] == true) {
				if(strtoupper(substr($__MY_CORE__["CUSTOM_BASE_URL"], 7, 3)) != "WWW") {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://www.".$__TBASE_URL_HOST__;
				} else {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;
				}
			}
			/* Custom URL (HTTP) + FORCE_NOT_WWW */
			if(isset($__MY_CORE__["FORCE_NOT_WWW"]) && $__MY_CORE__["FORCE_NOT_WWW"] == true) {
				if(strtoupper(substr($__BASE_URL__, 7, 3)) == "WWW" && $__BASE_PROTOCOL__ == "http") {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;

					$__VAL1__ = substr($__MY_CORE__["CUSTOM_BASE_URL"], 0, 7);
					$__VAL2__ = substr($__MY_CORE__["CUSTOM_BASE_URL"], (7+4), strlen($__MY_CORE__["CUSTOM_BASE_URL"]));

					$__MY_CORE__["CUSTOM_BASE_URL"] = $__VAL1__.$__VAL2__;
				} else {
					$__MY_CORE__["CUSTOM_BASE_URL"] = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;
				}
			}
		}

		$__BASE_URL__ = $__MY_CORE__["CUSTOM_BASE_URL"];
	/* Deteksi Force WWW pada URL AutoDetection */
	} else {
		/* URL AutoDetection & FORCE_WWW */
		if(isset($__MY_CORE__["FORCE_WWW"]) && $__MY_CORE__["FORCE_WWW"] == true) {
			$__TBASE_URL_HOST__	= parse_url($__BASE_URL__, PHP_URL_HOST);

			if(strtoupper(substr($__BASE_URL__, 7, 3)) != "WWW" && $__BASE_PROTOCOL__ == "http") {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://www.".$__TBASE_URL_HOST__;
			} else if(strtoupper(substr($__BASE_URL__, 8, 3)) != "WWW" && $__BASE_PROTOCOL__ == "https") {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://www.".$__TBASE_URL_HOST__;
			} else {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;
			}
		}
		/* AutoDetection & FORCE_NOT_WWW */
		if(isset($__MY_CORE__["FORCE_NOT_WWW"]) && $__MY_CORE__["FORCE_NOT_WWW"] == true) {
			$__TBASE_URL_HOST__	= parse_url($__BASE_URL__, PHP_URL_HOST);

			if(strtoupper(substr($__BASE_URL__, 7, 3)) == "WWW" && $__BASE_PROTOCOL__ == "http") {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;

				$__VAL1__ = substr($__BASE_URL__, 0, 7);
				$__VAL2__ = substr($__BASE_URL__, (7+4), strlen($__BASE_URL__));

				$__BASE_URL__ = $__VAL1__.$__VAL2__;
			} else if(strtoupper(substr($__BASE_URL__, 8, 3)) == "WWW" && $__BASE_PROTOCOL__ == "https") {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;

				$__VAL1__ = substr($__BASE_URL__, 0, 8);
				$__VAL2__ = substr($__BASE_URL__, (8+4), strlen($__BASE_URL__));

				$__BASE_URL__ = $__VAL1__.$__VAL2__;
			} else {
				$__BASE_URL__ = $__BASE_PROTOCOL__."://".$__TBASE_URL_HOST__;
			}
		}
	}
	
	/* Variabel GLOBALS $__BASE_URL__ */
	$__DYN_ACTUAL_URL__			= $__BASE_URL__.$_SERVER["REQUEST_URI"];
	$__ACTUAL_URL__ 			= $__DYN_ACTUAL_URL__;
	$GLOBALS["__BASE_URL__"] 	= $__BASE_URL__;
	
	/* Hapus SEGMEN berlebih (Pertama saja) */
	$_SERVER["REQUEST_URI"] 	= strReplaceFirst($__TMP_BASE_URL__, "", $_SERVER["REQUEST_URI"]); 

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

	/* Blocking
	 */
	$__BLOCKING__ 		= false;
	$__BLOCKING_STATE__	= 0;
	$__EXPLODING_BASE__ = explode("://", $__BASE_URL__);

	/* FOR PROTOCOL */
	if($__EXPLODING_BASE__[0] != $__RBASE_PROTOCOL__) {
		$__BLOCKING__ 		= true;
		$__BLOCKING_STATE__ = 1;
	}

	/* DETECTION FOR SUBDIR URL ROOT */
	$__EXPLODING_BASE_1__ 	= explode("/", $__EXPLODING_BASE__[1]);
	$__EBL1__ 				= count($__EXPLODING_BASE_1__);
	$__SEGMEN_ADD__ 		= ["Sfw"];

	if($__EBL1__ > 1) {
		$__EXPLODING_RBASE_URI__ 	= explode("/", $__RBASE_URI__);
		$__EXPLODING_RBASE_URI__ 	= array_reverse($__EXPLODING_RBASE_URI__);

		for($__A__ = 0; $__A__ < $__EBL1__; $__A__++) {
			array_pop($__EXPLODING_RBASE_URI__);
			array_push($__SEGMEN_ADD__, "Sfw");
		}

		$__EXPLODING_RBASE_URI__ 	= array_reverse($__EXPLODING_RBASE_URI__);
		$__RBASE_URI__ 				= "/".implode("/", $__EXPLODING_RBASE_URI__);
	}

	/* REMOVE SUBDIR */
	$__REMOVE_SUBDIR__ = explode("/", $__EXPLODING_BASE__[1]);

	/* FOR HOST */
	if($__REMOVE_SUBDIR__[0] != $__BASE_DOMAIN__) {
		$__BLOCKING__ 		= true;
		$__BLOCKING_STATE__ = 2;
	}

	$GLOBALS["SEGMEN_ADD"] = "Sfw/".$_SERVER["REQUEST_URI"];

	if($__BLOCKING__ == true) {
		echo "MOVED 301";
		echo "<br>";
		echo $__RBASE_URI__." | ".$GLOBALS["SEGMEN_ADD"]." | BS:".$__BLOCKING_STATE__;
		echo "<br>";
		echo $__EXPLODING_BASE__[1]." | ".$__BASE_DOMAIN__;
		echo "<br>";
		echo $__BASE_URL__.$__RBASE_URI__;
		echo "<br>";
		echo "MOVED 301";
		die();

		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: ".$__BASE_URL__.$__RBASE_URI__);

		die();
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
	
	/* URL Encode */
	define("THIS_URL_ENCODE", urlencode($__BASE_URL__));

	/* Global Secure Token - Semua user mempunyai token ini (login/tidak login) */
	if($_SESSION['globalSecureToken'] == "" || $_SESSION['globalSecureToken'] == null) {
		$_SESSION['globalSecureToken'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890'), 0, 170 );
		$_SESSION['verIncludeCode'] = $_SESSION['globalSecureToken'];
	}
	
	/* ### END VARIABLE & SETTING CORE ### */
?>