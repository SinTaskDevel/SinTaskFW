<?php
	
	$thisPost = $sintaskFW->post("postDefault");
	if(isset($thisPost)) {
		echo "THIS POST : ".$thisPost;
		echo "<hr>";
	}

	$thisPostKuki = $sintaskFW->post("postCookie");
	if(isset($thisPostKuki)) {
		$sintaskKuki->set("sintaskFW", "POST COOKIE", "2 d", "/", "", false, true);
		echo "THIS POST : ".$thisPostKuki;
		echo "<hr>";
	}

	$thisPostModifKuki = $sintaskFW->post("postModifCookie");
	if(isset($thisPostModifKuki)) {
		$sintaskKuki->set("sintaskFW", "POST MODIFIED COOKIE", "2 d", "/", "", false, true);
		echo "THIS POST : ".$thisPostModifKuki;
		echo "<hr>";
	}

	$thisPostClearKuki = $sintaskFW->post("clearCookie");
	if(isset($thisPostClearKuki)) {
		$sintaskKuki->purge("sintaskFW", "/", "");
		echo "THIS POST : ".$thisPostClearKuki;
		echo "<hr>";
	}

	$thisGet = $sintaskFW->get("src");
	if(isset($thisGet)) {
		echo "SOURCE FROM : ".$thisGet;
		echo "<hr>";
	}
	
	/* Example Code From W3Schools */
	$submitFile = $sintaskFW->post("submitFile");
	$fileData = $sintaskFW->files("fileToUpload");

	$target_dir = $__DOC_ROOT__."/protected/data/download/not_direct/";
	$target_file = $target_dir . basename($fileData["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

	if(isset($submitFile)) {
	    if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}

		if ($fileData["size"] > ((1024 * 1024) * 5)) { /* Max 5MB */
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		} else {
			/* Anda tidak dapat menggunakan move_uploaded_file(), dan diganti menjadi rename() */
		    if (rename($fileData["tmp_name"], $target_file)) {
		        echo "The file ". basename( $fileData["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file (".$fileData["tmp_name"]." => ".$target_file.").";
		    }
		}

	    echo "<hr>";
	}

?>