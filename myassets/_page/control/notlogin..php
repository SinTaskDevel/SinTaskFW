<?php

	$postChangeToken = $sintaskFW->post("changeToken");
	if(isset($postChangeToken)) {
		$sintaskSess->set("globalSecureToken", "");
	}
	
?>