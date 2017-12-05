<?php

	/* INFO :
	 * Dibagi 2 HEADER & FOOTER
	 * 	# HEADER
	 *		Akan dimuat pada bagian awal HTML <HEAD> anda
	 * 	# FOOTER
	 *		Akan dimuat pada akhir dari script HTML anda sebelum penutup </BODY>
	 */

	/* JIKA BUKAN CDN/EXTERNAL LINK
	 * Direktori harus pada /myassets/css atau /myassets/js
	 * Misalnya script anda pada http(s)://mydomain.tld/myassets/js/my.js
	 * maka isi dengan /data/js/my.js
	 * atau jika gambar letakan pada direktori /images
	 * anda juga dapat menambahkan direktori sesuai keinginan anda.
	 * --
	 */

	/**
	 * 	Terbagi menjadi 2 (Khusus JS) :
	 *		- Load-Again
	 * 		- Normal
	 *
	 * 	1. Load-Again
	 *		Akan di load ulang saat halaman SPA dijalankan, atau ada interaksi- 
	 *		perpindahan halaman SPA.
	 *
	 *	2. Normal
	 *		Hanya di load sekali saat awal halaman dibuka,
	 *		selanjutnya (saat perpindahan SPA) tidak akan ada load lagi.
	 *
	 *	!! PERHATIAN !!
	 *		Jenis 'Normal' akan lebih dulu dimuat sebelum 'Load-Again'
	 */

	if($__LOGIN_STATUS__ == true) {
		/* --- SEDANG LOGIN --- */

		/* HEADER CSS & JS (Normal) */
		$__MY_CSS_HEAD__ = [
			"myassets/css/my.css"	=> "internal",
			""						=> "external",
		];
		$__MY_JS_HEAD__ = [
			""						=> "internal",
			""						=> "external",
		];
		/* FOOTER CSS & JS (Normal) */
		$__MY_CSS_FOOT__ = [
			""						=> "internal",
			""						=> "external",
		];
		$__MY_JS_FOOT__ = [
			"myassets/js/my.js"		=> "internal",
			""						=> "external",
		];

		/* HEADER JS (Load-Again) */
		$__MY_AGAIN_JS_HEAD__ = [
			""						=> "internal",
			""						=> "external",
		];
		/* FOOTER JS (Load-Again) */
		$__MY_AGAIN_JS_FOOT__ = [
			""						=> "internal",
			""						=> "external",
		];
	} else {
		/* --- TIDAK LOGIN --- */

		/* HEADER CSS & JS (Normal) */
		$__MY_CSS_HEAD__ = [
			"myassets/css/my.css"	=> "internal",
			""						=> "external",
		];
		$__MY_JS_HEAD__ = [
			""						=> "internal",
			""						=> "external",
		];
		/* FOOTER CSS & JS (Normal) */
		$__MY_CSS_FOOT__ = [
			""						=> "internal",
			""						=> "external",
		];
		$__MY_JS_FOOT__ = [
			"myassets/js/my.js"		=> "internal",
			""						=> "external",
		];

		/* HEADER JS (Load-Again) */
		$__MY_AGAIN_JS_HEAD__ = [
			"myassets/js/my-again-head.js"	=> "internal",
			""								=> "external",
		];
		/* FOOTER JS (Load-Again) */
		$__MY_AGAIN_JS_FOOT__ = [
			"myassets/js/my-again-foot.js"	=> "internal",
			""								=> "external",
		];
	}

	/* ICON FAVICON WEB ISI DENGAN FULL URL LINK ANDA */
	$__IMAGE_FAV__ = "";

	/* PESAN ERROR UNTUK INVALID TOKEN */
	$__ERROR_INVALID_MSG__ = "Token anda salah";

	/* URL DOWNLOAD SINTASKFW, FITUR UNTUK MENDOWNLOAD FILE
	 * Default /s-dl/direct & /s-dl/ndr file download prefix 
	 * Khusus NDR = Not-Direct -
	 *		- {{GenerateDownloadURL}} adalah URL Not Direct Download
	 *		- {{FileSize}} adalah info ukuran file anda
	 *		- {{FileName}} adalah nama file anda
	 *		- {{ ISI }} artinya adalah info tetap seperti : 
	 *			Nama URL 	= {{GenereateDownloadURL}}, 
	 *			Nama File 	= {{FileName}}, dan 
	 *			Ukuran File = {{FileSize}}. 
	 *		- {{ ISI }} akan berubah secara otomatis oleh sistem.
	 */
	$__SDL_SETTING__ = [
		"SDL_DIRECT_PREFIX"			=> "sdl_",
		"SDL_NDR_PREFIX"			=> "ndr_sdl_",
		"SDL_NDR_FILENOTFOUND"		=> "File tidak ditemukan",
		"SDL_NDR_HTML_TEMPLATE"		=> "
			<div class=\"sDlCenter\">
				Klik tombol di bawah untuk mengunduh
				<br>
				<div class=\"sDlButton\" onclick=\"location.assign('{{GenerateDownloadURL}}');\">
					Download <b>{{FileName}}</b> - {{FileSize}}
				</div>
			</div>
			<style>
				.sDlCenter {
					margin: 0 auto;
					width: 500px;
				}
				.sDlButton {
					margin: 5px;
					padding: 5px 20px;
					font-size: 13px;
					border: 1px solid #555;
					display: inline-block;
					cursor: pointer;
				}
				.sDlButton:hover {
					box-shadow: 0px 0px 2px #555;
				}
			</style>
		",
	];

?>