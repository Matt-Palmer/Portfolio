<?php

	$db = ["db_host" => "localhost", "db_username" => "root", "db_password" => "", "db_name" => "cakes"];

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

?>