<?php
	
	/* Fitur s-dl Direct Download */

	$param 			= $__SEGMEN__[4];
	$fileLocation 	= $__DOC_ROOT__."/protected/data/download/direct/";

	$fileName 		= $param;
	$path 			= $fileLocation.$param;

	if(is_readable($path)) {
		header("Pragma: public");
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Content-Description: File Transfer");
	    header("Content-Type: ".mime_content_type($path));
	    header("Content-Length: " .(string)(filesize($path)) );
	    header("Content-Disposition: attachment; filename=".$__SDL_SETTING__["SDL_DIRECT_PREFIX"].$fileName);
	    header("Content-Transfer-Encoding: binary\n");

	    readfile($path);
	} else {
		header("Location: ".$__BASE_URL__);
	}

?>