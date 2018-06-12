<?php

	/* Untuk default 404 */
	$sintaskNewMeta->newFileNameCustom("/assets/page/static/static.zero.php");
	$sintaskNewMeta->newTitle("We are Not Found this page / C-404");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("Page is not found, this is 404 error");
	$sintaskNewMeta->newDescription("Page is not found, maybe deleted or moved");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/art/default/homie.png");
	$sintaskNewMeta->addNew();

	$sintaskNewMeta->newFileName("default.404.php");
	$sintaskNewMeta->newTitle("We are Not Found this page / A-404");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("Page is not found, this is 404 error");
	$sintaskNewMeta->newDescription("Page is not found, maybe deleted or moved");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/art/default/homie.png");
	$sintaskNewMeta->addNew();

	/* Untuk page meta */
	$sintaskNewMeta->newFileName("notlogin..php");
	$sintaskNewMeta->newTitle("SinTask Framework / SinTaskFW");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newDescription("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/logo/sintask_logo_notlogin.png");
	$sintaskNewMeta->addNew();

	/* Dynamic META, anda dapat mengambil data spesifik dari DB anda untuk dicantumkan pada Title, Description dll
	 * Contohnya, 
	 * URL : http(s)://www.domain.tld/username1
	 * DB Data dari username1 ($__SEGMEN_PURE__[2]) adalah :
	 *		- META Desc : My name is Author, My username is username1
	 * Ganti $sintaskNewMeta->newDescription("META DESC ANDA");
	 */
	$sintaskNewMeta->newFileName("notlogin.my.[].php");
	$sintaskNewMeta->newTitle("Dynamic Page / ".$__SEGMEN_PURE__[3]);
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newDescription("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/logo/sintask_logo_notlogin.png");
	$sintaskNewMeta->addNew();

	$sintaskNewMeta->newFileName("notlogin.test.php");
	$sintaskNewMeta->newTitle("Just Test");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newDescription("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/logo/sintask_logo_notlogin.png");
	$sintaskNewMeta->addNew();

	$sintaskNewMeta->newFileNameGeneral("both.general.php");
	$sintaskNewMeta->newTitle("General Page / Not SPA");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newDescription("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/logo/sintask_logo_notlogin.png");
	$sintaskNewMeta->addNew();

?>