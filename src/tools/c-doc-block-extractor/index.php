#!/usr/bin/env php
<?php

return function($file) {
	$docBlockExctractor = require __DIR__."/src/index.php";

	$results = $docBlockExctractor($file);
	$ret = [];

	foreach ($results as $result) {
		list($success, $value) = $result;

		if ($success === "error") {
			throw new Exception($error);
		}

		array_push($ret, $value);
	}

	return $ret;
};
