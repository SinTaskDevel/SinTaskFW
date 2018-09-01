<?php

	$postChangeToken = $sintaskFW->post("changeToken");
	if(isset($postChangeToken)) {
		$sintaskSess->set("globalSecureToken", "");
	}

	/* For Example, change the Timezone */
	$sintaskFW->timezone("Asia/Jakarta");

	$welcomeText = "Welcome Coders,";
	
?>