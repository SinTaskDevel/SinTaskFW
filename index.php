<?php
	
	/**
	 * ---------------
	 * 	GENERAL INFO :
	 *		SinTask Framework
	 *		(c) 2016 - 2017 CV. SinTask
	 * 		SinTask, Ltd. / SinTask Web Developer / SinTask Engineering
	 *
	 *	AUTHOR :
	 *		- Aditya Wikardiyan
	 *
	 *	LICENSE :
	 *		- The MIT License
	 *
	 * 	BACK-END ENGINE REQ :
	 * 		- PHP 5.6 or above
	 * 		- Support scandir()
	 * 		- Support file_exists()
	 *		- Ekstensi PDO PHP
	 *		- Ekstensi OpenSSL PHP
	 *		- MySQL Support crudSDB() function
	 *		- Apache Web Server (.htaccess)
	 *			- Jika menggunakan NGINX coba : https://winginx.com/en/htaccess
	 *			- Atau baca dokumentasi pada https://fw.sintask.com/docs
	 *
	 * 	DOKUMENTASI SINGKAT :
	 * 	Petunjuk sebelum menggunakan framework, perhatikan langkah-langkah berikut :
	 * 		- Ubah konfigurasi DB pada /myassets/_dbconfig/my.db.config.php
	 *		- Ubah $stateSinTaskNow pada /myassets/_php/my.core.php
	 *		- $_SESSION['id'] akan berguna untuk mengaktifkan variable $__LOGIN_STATUS__
	 *
	 * 	SPA (Single Page Application)
	 *		- Untuk menggunakan SPA, direktori-direktori terkait adalah :
	 *			- /myassets/_page/spa_latecss	(CSS OPTIONAL)
	 *			- /myassets/_page/spa_template	(VIEW WEB)
	 *			- jika ingin menambahkan, copy default.404.php, agar menjadi contoh
	 *		- Perhatian ! pada setiap direktori-direktori diatas default.404.php adalah halaman 404 :
	 *			- Editable, tetapi jangan dihapus !
	 *
	 * 	NON-SPA (Non Single Page Application)
	 *		- Untuk menggunakan NORMAL / NON-SPA, direktori-direktori terkait adalah :
	 *			- /myassets/_page/general (Kode HTML, JS & PHP seperti Web pada umumnya)
	 *
	 *	Catatan SPA & NON-SPA
	 *		- Jika NON-SPA memiliki nama file yang sama dengan SPA maka diutamakan NON-SPA 
	 *
	 *	Penulisan & Penambahan Page
	 *		- [$1].[$2].php
	 *		- [$1]
	 *			- login 	: menambahkan halaman yg dapat di akses hanya saat login saja
	 *			- notlogin 	: menambahkan halaman yg dapat di akses hanya saat tidak login
	 *			- both 		: menambahkan halaman yg dapat di akses saat login/tidak.
	 * 		- [$2] 
	 *			- nama page/halaman 
	 *			- contoh 1 jika penamaan file notlogin.about.me.php :
	 *				- saat tidak login
	 *				- URL : http(s)://mydomain.tld/about/me [NotLogin State]
	 *			- contoh 2 jika penamaan file login..php :
	 *				- saat login
	 *				- URL : http(s)://mydomain.tld/ [Login State - Homepage]
	 *			- contoh 3 jika penamaan file both.page.php :
	 *				- saat login & tidak
	 *				- URL : http(s)://mydomain.tld/page [Login & NotLogin State]
	 *			- contoh 4 jika penamaan file login.id.[].php :
	 *				- saat login
	 *				- [] menandakan nama page yang dinamis
	 *				- URL : http(s)://mydomain.tld/id/1234
	 *				- anda dapat mengambil nilai 1234 dengan var $__SEGMEN__[2]
	 *				- $__SEGMEN__ :
	 *					- variable $__SEGMEN__ berupa array
	 *					- variable dimulai dari 1
	 *					- hal ini mendukung dalam hal clean URL tanpa menggunakan $_GET
	 *			- [PENTING] Menggunakan $_GET :
	 *				- URL Case : http(s)://mydomain.tld/page?no=1234
	 *				- Mengambil nilai $_GET pada JS (JavaScript)
	 *					- variable array JSPOST.no atau JSPOST['no'] akan menghasilkan 1234
	 *				- Mengambil nilao $_GET pada PHP 
	 *					- variable $_SESSION['postGET']['no'] akan menghasilkan 1234
	 *		- SPA PAGE tambahkan pada masing-masing direktori :
	 *			- /myassets/_page/spa_latecss
	 *			- /myassets/_page/spa_template
	 *		- Penulisan a href saat menggunakan SPA dengan menambahkan class = "s"
	 *		- Web Server
	 *			- Apache.
	 *					SinTaskFW menggunakan .htaccess
	 *					Sebelum menggunakan SinTaskFW, 
	 *					pastikan untuk enable mod_rewrite,
	 *					sehingga .htaccess dapat digunakan dan dibaca
	 *			- Nginx.
	 *					Buka halaman dibawah ini.
	 *					https://winginx.com/en/htaccess
	 *					Copy isi .htaccess dari /.htaccess lalu paste ke web di atas
	 * 					Konfigurasi pada Nginx anda menggunakan hasil dari web.
	 *
	 *	Prioritas
	 *		Jika file SPA tidak ditemukan maka akan beralih ke Non-SPA
	 *		- SPA (Normal Template)
	 *		- NON-SPA
	 *
	 *	Konfigurasi lanjutan terdapat pada /assets/control/my.core.php
	 *
	 * 	Download Dokumentasi Lengkap pada -> https://fw.sintask.com/docs
	 */

	/* Mulai Session */
    session_start();
    
	/* Inisialisasi untuk membuka part-part SPA */
    $__PART_CORE__ 				= 1;
	$partCoreSinTask 			= $__PART_CORE__;

	/* Inisialisasi alamat require */
	$requirePath['config'] 		= "/assets/config";
	$requirePath['controlreq'] 	= "/assets/control/require";
	$requirePath['static'] 		= "/assets/page/static";

	$requirePath['mycontrol'] 	= "/myassets/_php";
	$requirePath['myconfig'] 	= "/myassets/_dbconfig";
	$requirePath['error'] 		= "/myassets/_page/error";
	$requirePath['api'] 		= "/myassets/_page/ajaxify";
	$requirePath['api_sec']		= "/myassets/_page/ajaxify_secure";
	$requirePath['no_route']	= "/myassets/_page/no_route";
	$requirePath['general'] 	= "/myassets/_page/general";
	$requirePath['jsd'] 		= "/myassets/_page/jsd";
	$requirePath['control'] 	= "/myassets/_page/control";
	$requirePath['stay'] 		= "/myassets/_page/stay";
	$requirePath['template'] 	= "/myassets/_page/spa_template";
	$requirePath['latecss'] 	= "/myassets/_page/spa_latecss";
	$requirePath['auto_js'] 	= "/myassets/auto_js_foot";
	$requirePath['auto_css'] 	= "/myassets/auto_css_head";

	/* Inisialisasi DOCUMENT_ROOT alias */
	$__CENTER__		= preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']);
	$__BASE_DIR__	= str_replace("\\", "/", __DIR__);
	$__DOC_ROOT__	= $__BASE_DIR__;
    
	/* Daftar Inisialisasi require - urutan require tidak dapat di ubah */
	require($__DOC_ROOT__.$requirePath['controlreq']."/class.php");
	require($__DOC_ROOT__.$requirePath['controlreq']."/sec.class.php");
	require($__DOC_ROOT__.$requirePath['controlreq']."/core.php");
    require($__DOC_ROOT__.$requirePath['config']."/config.php");
	require($__DOC_ROOT__.$requirePath['controlreq']."/func.php");
	require($__DOC_ROOT__.$requirePath['controlreq']."/initial.php");

	/* Setelah ini dapat menggunakan $__DOC_ROOT__ sebagai pengganti $_SERVER['DOCUMENT_ROOT'] */
	
	$thisReqPath 			= $__DOC_ROOT__;
	$thisReqPathAdditional 	= $__DOC_ROOT__;
	$thisReqPathLoginPrefix = "notlogin";

	/* Normal Request */
	$__HTML_CORE_REQ__     	= $__DOC_ROOT__.$requirePath['static']."/static.html.core.php";
	$__404_REQ__     		= $__DOC_ROOT__.$requirePath['static']."/static.404.php";
	$__ZERO__ 				= $__DOC_ROOT__.$requirePath['static']."/static.zero.php";
	
	/* require tambahan */
	require($__DOC_ROOT__.$requirePath['mycontrol']."/my.core.class.php");
	require($__DOC_ROOT__.$requirePath['mycontrol']."/my.core.func.php");
	require($__DOC_ROOT__.$requirePath['mycontrol']."/my.page.meta.php");
	require($__DOC_ROOT__.$requirePath['mycontrol']."/my.page.setting.php");

	/* Header SinTask
		* Modifikasi Header SinTask berisi codename + versi SinTask
		* fungsi terdapat di " root > assets > control > func.php "
		*/
	
	headerSinTaskHQ();

	/* Jika tidak gangguan & maintenance */
	
	/* Halaman dinamis ditandai dengan [DYNAMIC_PAGE]
		* --
		* Halaman dibawah adalah halaman dinamis sesuai dengan nama file, misalnya :
		* terdapat file "notlogin.sistem.test.php" pada "root > assets > page > general" maka-
		* halaman akan dapat dibuka pada "[http/s]://[domain]/sistem/test"
		* --
		* Untuk Ajax request :
		* terdapat file "login.sistem.insert.php" pada "root > assets > page > ajaxify" maka-
		* halaman akan dapat dibuka pada "[http/s]://[domain]/sistem/insert"
		* --
		* [prefix]
		* terdapat prefix di setiap nama file "both", "login" atau "notlogin"
		* jika terdapat nama file [1]. "login.bla.bla.php" dan [2]. "notlogin.bla.bla.php" maka-
		* saat halaman "[http/s]://[domain]/bla/bla" dibuka dalam keadaan-
		* login akan membuka file [1] sedangkan jika tidak login akan membuka file [2] 
		* jika tidak keduanya maka langsung ke [3] "both.bla.bla.bla"
		* --
		*/

	/* Check Login */
	if($__LOGIN_STATUS__ != "" && $__LOGIN_STATUS__ != null) {
		/* Jika Login */
		$thisReqPathLoginPrefix = "login";
	} else {
		/* Jika Tidak Login */
		$thisReqPathLoginPrefix = "notlogin";
	}

	/*
	 * Perbaiki kesalahan pada $__SEGMEN__
	 */
	fixedTheSegmen($__SEGMEN__);

	/**
		* spaDynamic, ajaxDynamic, pageDynamic, metaDynamic memakai "." sebagai separator pada nama file
		* sehingga jika nama file adalah "[prefix].signin.login.php" maka dapat dibuka pada URL [domain]/signin/login
		* ----
		* templateDynamic memakai "." sebagai separator namun pada halaman URL harus berakhiran .jssintasktemplate 
		* sehingga jika nama file adalah "[prefix].signin.login.php" menjadi [domain]/signin/login.jssintasktemplate
		* ----
		* javaScriptDynamic memakai "." sebagai separator namun pada halaman URL harus berakhiran .jsd 
		* sehingga jika nama file adalah "[prefix].signin.login.php" menjadi [domain]/signin/login.jsd
		* ----
		* lateCssDynamic memakai "." sebagai separator namun pada halaman URL harus berakhiran .latecss 
		* sehingga jika nama file adalah "[prefix].signin.login.php" menjadi [domain]/signin/login.latecss
		* ----
		* nama file yang mengandung "[]" akan menjadi clean URL untuk mengambil parameter, contohnya :
		* jika terdapat nama file "[prefix].report.bug.[].php" maka akan dapat diakses melalui
		* "[domain]/report/bug/[bebas, diisi dengan id atau data lain sebagai parameter]"
		* cara penulisan yang salah adalah "[prefix].report.bug.[].[].php" sehingga tidak dapat diakses
		* darimanapun ( "[domain]/report/bug/[param]/[param]" ataupun "[domain]/report/bug/[param]" )
		*/
	$__SEGMEN_DOT_EXPLODE__ = explode(".", end($__SEGMEN__));
	$__END_SEGMEN_DOT__ 	= end($__SEGMEN_DOT_EXPLODE__);

	/**
		* -------------------------------------------------------
		* Untuk menambah halaman SPA, maka file diletakkan pada :
		* 		-> /myassets/_page/spa_template 	[ Template dari halaman ]
		* 		-> /myassets/_page/spa_latecss 		[ CSS tambahan dari halaman ]
		* -------------------------------------------------------------
		* Untuk membuat halaman biasa / general, file diletakkan pada :
		* 		-> /myassets/_page/general
		*/
	require($__DOC_ROOT__.$requirePath['controlreq']."/router.php");
?>