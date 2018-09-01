<?php

	/* Parth of jsd/both.srvtime.php */
	$response = [
		"status"        => 200,
		"timeupdate"	=> microTimeStamp(),
	];

	echo json_encode($response, JSON_PRETTY_PRINT);

?>