<?php

return function($doc_block_tags) {
	$parseField = require __DIR__."/_parseField.php";

	$enum_values = [];

	foreach (napphp::util_arrayify($doc_block_tags["@enum"] ?? []) as $enum_value) {
		list($name, $description) = $parseField($enum_value);

		array_push($enum_values, [
			"name" => $name,
			"description" => $description
		]);
	}

	return [
		"kind" => "enum",

		"kind_specific_information" => [
			"values" => $enum_values
		]
	];
};
