<?php

function libnapc_docExtract_parseSingleArrayCTypeInfo($element) {
	$tmp = substr($element, 1);

	return (int)substr($tmp, 0, strlen($tmp) - 1);
}

function libnapc_docExtract_parseArrayCTypeInfo($type) {
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
				libnapc_docExtract_parseSingleArrayCTypeInfo($tmp[0])
			]
		];
	}

	// first and last elements are special cases

	// first element is [N
	// last element is N]
	$first = libnapc_docExtract_parseSingleArrayCTypeInfo(array_shift($tmp)."]");
	$last = libnapc_docExtract_parseSingleArrayCTypeInfo("[".array_pop($tmp));

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
}

function libnapc_docExtract_fixClangCType($type) {
	$type = napphp::str_replace($type, "_Bool", "bool");

	// parse ARRAY_TYPE [NUM_ELEMENTS][..][..]
	$array_info = libnapc_docExtract_parseArrayCTypeInfo($type);

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
}

function libnapc_docExtract_getFunctionReturnType($qual_type) {
	// because format is:

	// RETURN_TYPE ( PARAM_1, PARAM_2, PARAM_n ... )
	$type = trim(substr($qual_type, 0, strpos($qual_type, "(")));

	return libnapc_docExtract_fixClangCType($type);
}

require_once "/home/nap-software/Desktop/nap-software-org/napphp/src/__loadAsClass.php";

function loadSteps() {
	$dir = napphp::fs_scandir(__DIR__."/steps/");
	$steps = [];

	foreach ($dir as $entry) {
		if (!napphp::str_endsWith($entry, ".php")) continue;

		$tmp = napphp::str_split($entry, ".");
		$no = (int)$tmp[0];

		$steps["step-$no"] = require __DIR__."/steps/$entry";
	}

	uksort($steps, function($a, $b) {
		$a = (int)substr($a, strlen("step-"));
		$b = (int)substr($b, strlen("step-"));

		return ($a > $b) ? 1 : -1;
	});

	return $steps;
}

$steps = loadSteps();
$context = [
	"clang-ast" => napphp::fs_readFileJSON(__DIR__."/input.json")["inner"],
	"output-file" => "/tmp/output.json"
];

foreach ($steps as $step_name => $step_fn) {
	$step_fn([], $context);
}


//var_dump($context);

// report undefined symbols from doc-blocks:
// @fullname napc_printf -> error because 'napc_printf' C-symbol does not exist

// report if function is variadic but not marked as such
