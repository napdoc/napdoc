<?php

return function($doc_block_tags) {
	$parseField = require __DIR__."/_parseField.php";

	$is_variadic = napphp::arr_keyExists($doc_block_tags, "@variadic");

	$params = [];

	foreach (napphp::util_arrayify($doc_block_tags["@param"] ?? []) as $param_value) {
		list($name, $description) = $parseField($param_value);

		array_push($params, [
			"name" => $name,
			"description" => $description
		]);
	}

	if ($is_variadic) {
		array_push($params, [
			"name" => "...",
			"description" => ltrim($doc_block_tags["@variadic"])
		]);
	}

	return [
		"variadic" => $is_variadic,

		"return" => [
			"description" => ltrim(($doc_block_tags["@return"] ?? ""))
		],

		"params" => $params
	];
};
