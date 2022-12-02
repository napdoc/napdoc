<?php

return function($doc_block_tags) {
	$parseField = require __DIR__."/_parseField.php";

	$struct_fields = [];

	foreach (napphp::util_arrayify($doc_block_tags["@field"] ?? []) as $field_value) {
		list($name, $description) = $parseField($field_value);

		array_push($struct_fields, [
			"name" => $name,
			"type" => "",
			"description" => $description
		]);
	}

	return [
		"kind" => "struct",

		"kind_specific_information" => [
			"fields" => $struct_fields
		]
	];
};
