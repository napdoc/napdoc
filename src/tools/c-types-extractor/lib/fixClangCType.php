<?php

return function($type) {
	static $parseArrayCTypeInfo = NULL;

	if (!$parseArrayCTypeInfo) {
		$parseArrayCTypeInfo = require __DIR__."/parseArrayCTypeInfo.php";
	}

	$type = napphp::str_replace($type, "_Bool", "bool");

	// parse ARRAY_TYPE [NUM_ELEMENTS][..][..]
	$array_info = $parseArrayCTypeInfo($type);

	if ($array_info === false) {
		return $type;
	}

	if (sizeof($array_info["dimension"]) > 1) {
		throw new Exception("Multidimensional array detected. Not supported yet.");
	}

	return [
		$array_info["type_name"],
		$array_info["dimension"][0]
	];
};
