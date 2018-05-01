<?php

	$postChangeToken = $sintaskFW->post("changeToken");
	if(isset($postChangeToken)) {
		$sintaskSess->set("globalSecureToken", "");
	}

	$postAnother = $sintaskFW->post("another");
	if(isset($postAnother)) {
		echo "ANOTHER POSTED : ".$postAnother."<hr>";
	}

	/* Example Code From W3Schools */
	$submitFile = $sintaskFW->post("submitFile");
	$fileToUpload = $sintaskFW->files("fileToUpload");

	$target_dir = $__DOC_ROOT__."/protected/data/download/not_direct/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

	if(isset($submitFile)) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }

	    $check2 = getimagesize($fileToUpload["tmp_name"]);
	    if($check2 !== false) {
        	echo "File is an image - " . $check2["mime"] . ".";
        	$uploadOk = 1;
        } else {
        	echo "Tmp Sess " . $fileToUpload["tmp_name"].".";
        	$uploadOk = 0;
        }

	    if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}

		if ($_FILES["fileToUpload"]["size"] > ((1024 * 1024) * 5)) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		} else {
		    if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
		        echo "The file ". basename( $fileToUpload["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

	    echo "<hr>";
	}

?>