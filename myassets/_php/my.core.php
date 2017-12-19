<?php

	/* My Core */
	$__MY_CORE__ = [
		"EXPOSE_PHP"			=> false,
		"MAINTENANCE"			=> false,
		"HIDE_WARNING_NOTICE" 	=> false,
		"DISPLAY_PHP_ERROR"		=> true,
		"AES_SECURE_SPA_TRANSF"	=> true,
		"USE_DB"				=> false,
		"FORCE_HTTPS"			=> false,
		"MAX_EXEC_TIME_PHP"		=> 300,
		"TIMEZONE" 				=> "Asia/Makassar",
		"DEFAULT_CHARSET"		=> "UTF-8",
		"UPLOAD_MAX_FILESIZE"	=> "60",
		"POST_UPLOAD_MAX_SIZE"	=> "60",
		"MAX_FILE_UPLOADS" 		=> "200",
		"CUSTOM_BASE_URL"		=> "",
	];

	/* SinTaskFW Auto Update Page
	 * --------------------------
	 * Halaman ini berguna untuk mempermudah anda mengupdate versi SinTaskFW dari server anda
	 * --------------------------
	 * Nonaktifkan Halaman Auto Update (setelah melakukan update) saat anda menggunakan Server Production
	 * Halaman Auto Update anda berada pada http(s)://domain.anda/s-update/AUTO_UPDATE_SECRET_KEY
	 * --------------------------
	 * Disarankan AUTO_UPDATE_SECRET_KEY berupa kombinasi acak angka & huruf
	 */
	$__MY_AUTO_UPDATE__ = [
		"AUTO_UPDATE_PAGE"			=> true,
		"AUTO_UPDATE_SECRET_KEY"	=> "ABC_MY_SECRET_KEY_123",
	];

	/* HTML Header & Meta Setting */
	$__HTML_SETTING__ = [
		"HTML_HEADER_TAG"			=> "lang='id-ID'",
		"HTML_META_CHARSET"			=> "UTF-8",
		"HTML_META_CONTENT_TYPE"	=> "text/html; charset=UTF-8",
		"HTML_META_VIEWPORT"		=> "width=device-width, initial-scale=1",
		"HTML_META_CUSTOM"			=> [
			"http-equiv='pragma' content='no-cache'",
			"http-equiv='X-UA-Compatible' content='IE=edge'",
		],
	];

	/* GENERAL META */
	$__HTML_META_GENERAL__ = [
		"DEFAULT_META" 				=> true,
		"EXPECT_META_LIST"			=> [
			"",
		],
	];

	/* CUSTOM HTML CODE - HTML Struktur Bawaan SinTaskFW
	 * Anda dapat menambahkan Custom Kode HTML
	 * ----------------
	 * 	H-HTML berada pada setelah tag HTML 			: <HTML>{{ Disini }} 
	 *	H-HEAD berada pada setelah tag HEAD 			: <HEAD>{{ Disini }}
	 * 	M-HEAD berada pada pertengahan antara tag HEAD 	: <HEAD> ... {{ Disini }} <SCRIPT> ... </SCRIPT> ... </HEAD>
	 *	H-BODY berada pada setelah tag BODY 			: <BODY>{{ Disini }}
	 *	F-BODY berada pada sebelum tag BODY 			: {{ Disini }}</BODY>
	 *	F-HTML berada pada sebelum tag HTML 			: {{ Disini }}</HTML>
	 */
	$__HTML_CUSTOM__ = [
		"H-HTML"	=> "",
		"H-HEAD"	=> "",
		"M-HEAD"	=> "",
		"H-BODY"	=> "",
		"F-BODY"	=> "",
		"F-HTML"	=> "",
	];

	/* My Session - 
	 * Sangat penting karena akan menjadi Core dan Patokan dari state 'notlogin' & 'login'
	 * Jika $__MY_SESSION__ tepat maka $__LOGIN_STATUS__ akan berjalan normal 
	 */
	$__MY_SESSION__ = $sintaskSess->get("id");

?>