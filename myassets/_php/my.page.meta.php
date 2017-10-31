<?php

	/* for default 404 */
	$sintaskNewMeta->newFileNameCustom("/assets/page/static/static.zero.php");
	$sintaskNewMeta->newTitle("We are Not Found this page / 404");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("Page is not found, this is 404 error");
	$sintaskNewMeta->newDescription("Page is not found, maybe deleted or moved");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/art/default/homie.png");
	$sintaskNewMeta->addNew();

	$sintaskNewMeta->newFileName("default.404.php");
	$sintaskNewMeta->newTitle("We are Not Found this page / 404");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("Page is not found, this is 404 error");
	$sintaskNewMeta->newDescription("Page is not found, maybe deleted or moved");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/art/default/homie.png");
	$sintaskNewMeta->addNew();

	/* for my page meta */
	$sintaskNewMeta->newFileName("notlogin..php");
	$sintaskNewMeta->newTitle("SinTask Framework / SinTaskFW");
	$sintaskNewMeta->newSiteName("SinTaskFW");
	$sintaskNewMeta->newKeywords("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newDescription("SinTask Framework is PHP - JS SPA Framework");
	$sintaskNewMeta->newImage($__BASE_URL__."/images/logo/sintask_logo_notlogin.png");
	$sintaskNewMeta->addNew();

	/* Dynamic META, you can get data from DB to change META with Paremeter of URL 
	 * Example, 
	 * URL : http(s)://www.domain.tld/username1
	 * DB Data of username1 ($__SEGMEN_PURE__[2]) is :
	 *		- META Desc : My name is Author, My username is username1
	 * Change the $sintaskNewMeta->newDescription("YOUR META DESC");
	 */
	$sintaskNewMeta->newFileName("both.[].php");
	$sintaskNewMeta->newTitle("Dynamic Page / ".$__SEGMEN_PURE__[2]);
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

?>