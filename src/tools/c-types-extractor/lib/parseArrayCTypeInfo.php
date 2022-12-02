<?php

return function($type) {
	static $parseSingleArrayCTypeInfo = NULL;

	if (!$parseSingleArrayCTypeInfo) {
		$parseSingleArrayCTypeInfo = require __DIR__."/parseSingleArrayCTypeInfo.php";
	}

	if (!napphp::str_contains($type, "[")) {
		return false;
	}

	// format is: TYPE*SPACE*[]
	list($type_name, $array_info) = napphp::str_split($type, " ", 2);

	$tmp = napphp::str_split($array_info, "][");

	// if $tmp is one element format is: [X]
	if (sizeof($tmp) === 1) {
		return [
			"type_name" => $type_name,
			"dimension" => [
				$parseSingleArrayCTypeInfo($tmp[0])
			]
		];
	}

	// first and last elements are special cases

	// first element is [N
	// last element is N]
	$first = $parseSingleArrayCTypeInfo(array_shift($tmp)."]");
	$last = $parseSingleArrayCTypeInfo("[".array_pop($tmp));

	$tmp = napphp::arr_map($tmp, function($element) {
		return (int)$element;
	});

	return [
		"type_name" => $type_name,
		"dimension" => [
			$first,
			...$tmp,
			$last
		]
	];
};
