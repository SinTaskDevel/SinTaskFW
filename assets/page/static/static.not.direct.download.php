<?php
	
	/* Not - Direct Download Feature */

	$param 			= $__SEGMEN__[4];
	$param2			= $__SEGMEN__[5];
	$fileLocation 	= $__DOC_ROOT__."/protected/data/download/not_direct/";

	$fileName 		= $param;
	$path 			= $fileLocation.$param;

	$checkDlSess 	= $sintaskSess->status("NDR_DOWNLOAD");
	if($checkDlSess == false) {
		$generateRandom = getRandomPlusDate(25);
		$sintaskSess->set("NDR_DOWNLOAD", $generateRandom);
	}
	$dlSess 		= $sintaskSess->get("NDR_DOWNLOAD"); 

	$fSize = (string)(filesize($path));

	if(!ctype_space($param2) && $param2 != "" && $param2 != null && $param2 == $dlSess) {
		if(is_readable($path)) {
			header("Pragma: public");
		    header("Expires: 0");
		    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		    header("Content-Description: File Transfer");
		    header("Content-Type: ".mime_content_type($path));
		    header("Content-Length: " .$fSize);
		    header("Content-Disposition: attachment; filename=".$__SDL_SETTING__["SDL_NDR_PREFIX"].$fileName);
		    header("Content-Transfer-Encoding: binary\n");

		    readfile($path);
		} else {
			echo $__SDL_SETTING__["SDL_NDR_FILENOTFOUND"];
			die();
		}
	}

	$getFileLoc = $__BASE_URL__."/s-dl/ndr/".$param."/".$dlSess;
	
	if(is_readable($path)) {
		$thisFileSize = fileSizeFrByToAll($fSize);

		$htmlTemplate = $__SDL_SETTING__["SDL_NDR_HTML_TEMPLATE"];
		
		$htmlTemplate = str_replace("{{FileName}}", $fileName, $htmlTemplate);
		$htmlTemplate = str_replace("{{FileSize}}", $thisFileSize, $htmlTemplate);
		$htmlTemplate = str_replace("{{GenerateDownloadURL}}", $getFileLoc, $htmlTemplate);

		header('HTTP/1.1 200', TRUE, 200);
		echo $htmlTemplate;
	} else {
		header("Location: ".$__BASE_URL__);
	}
?>