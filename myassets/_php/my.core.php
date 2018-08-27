<?php

	/* 	My Core 
		-------
		EXPOSE_PHP 				- Jika 'true' menampilkan data PHP pada Header
		MAINTENANCE 			- Jika 'true' menampilkan halaman Maintenance
		HIDE_WARNING_NOTICE 	- Jika 'true' akan menyembunyikan Notice (Warning PHP)
		DISPLAY_PHP_ERROR		- Jika 'true' akan menampilkan Error Notice
								  Note: Fatal Error tetap tampil walau 'false'
		AES_SECURE_SPA_TRANSF	- Khusus halaman SPA jika 'true' akan mengenkripsi request Halaman
								  Note: Tidak semua, tetapi hanya HTML halaman yang dibuka saat itu.
		USE_DB					- Jika web menggunakan DB/BasisData ubah menjadi 'true'
		FORCE_HTTPS 			- Jika ingin tetap mengakses HTTPS ubah menjadi 'true'
		FORCE_WWW				- Jika ingin Web anda diakses harus dari WWW ubah menjadi 'true'
		FORCE_NOT_WWW			- Jika ingin Web anda diakses harus tidak menggunakan WWW 
								  ubah menjadi 'true'
		MAX_EXEC_TIME_PHP		- Nilai maksimum eksekusi script PHP, nilai dalam Detik
								  Note: Anda mungkin juga harus mengubah PHP.INI/Konfigurasi PHP
		TIMEZONE 				- Nilai timezone untuk server saat ini (Default WITA/UTC+08 - Asia/Makassar)
		DEFAULT_CHARSET			- Charset untuk encoding HTML Web anda
		UPLOAD_MAX_FILESIZE		- Maksimal ukuran upload (Nilai dalam MByte)
								  Note: Anda mungkin juga harus mengubah PHP.INI/Konfigurasi PHP
		POST_UPLOAD_MAX_SIZE	- Maksimal ukuran metode POST upload (Nilai dalam MByte)
								  Note: Anda mungkin juga harus mengubah PHP.INI/Konfigurasi PHP
		MAX_FILE_UPLOADS		- Maksimal upload multi file dalam satu waktu (Nilai dalam MByte)
								  Note: Anda mungkin juga harus mengubah PHP.INI/Konfigurasi PHP
		CUSTOM_BASE_URL			- Kami menggunakan URL AutoDetection, jika anda merasa ada yang salah
								  silahkan isi dengan Full URL anda. (Mempengaruhi $__BASE_URL__)
								  Note: Isi dengan HTTP/S (Protokol)
	 */
	$__MY_CORE__ = [
		"EXPOSE_PHP"			=> false,
		"MAINTENANCE"			=> false,
		"HIDE_WARNING_NOTICE" 	=> true,
		"DISPLAY_PHP_ERROR"		=> true,
		"AES_SECURE_SPA_TRANSF"	=> true,
		"USE_DB"				=> false,
		"FORCE_HTTPS"			=> false,
		"FORCE_WWW"				=> false,
		"FORCE_NOT_WWW"			=> false,
		"MAX_EXEC_TIME_PHP"		=> 300,
		"TIMEZONE" 				=> "Asia/Makassar",
		"DEFAULT_CHARSET"		=> "UTF-8",
		"UPLOAD_MAX_FILESIZE"	=> "60",
		"POST_UPLOAD_MAX_SIZE"	=> "60",
		"MAX_FILE_UPLOADS" 		=> "200",
		"CUSTOM_BASE_URL"		=> "",
		"MIGRATION_SCRIPT"		=> false,
	];
	/* 
		NOTE: 	Jika FORCE_WWW dan FORCE_NOT_WWW keduanya bernilai 'true' maka 
				yang akan berlaku adalah FORCE_NOT_WWW
	 */

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
		"HTML_META_VIEWPORT"	=> "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0",
		"HTML_META_CUSTOM"		=> [
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