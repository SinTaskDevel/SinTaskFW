<?php

	/* Untuk contoh */
	$sintaskAddJs->newFileName("notlogin..php");
	$sintaskAddJs->newUrlJs($__BASE_URL__."/myassets/js/addjs.top.js");
	$sintaskAddJs->positionJs("top");
	$sintaskAddJs->addNew();

	$sintaskAddJs->newFileName("notlogin..php");
	$sintaskAddJs->newUrlJs($__BASE_URL__."/myassets/js/addjs.bottom.js");
	$sintaskAddJs->positionJs("top");
	$sintaskAddJs->addNew();

	$sintaskAddJs->newFileName("notlogin.test.php");
	$sintaskAddJs->newUrlJs($__BASE_URL__."/myassets/js/addjs.test.js");
	$sintaskAddJs->positionJs("top");
	$sintaskAddJs->addNew();

?>