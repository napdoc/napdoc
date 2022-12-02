<?php

return function($clean_doc_block) {
	//print_r($clean_doc_block);

	static $type_category_map = [
		"fn" => "function",
		"type:alias" => "type",
		"type:enum" => "type",
		"type:struct" => "type",
		"type:opaque" => "type",
		"macro:var" => "macro",
		"macro:fn" => "macro"
	];

	$processExampleCodeBlock = function($block) {
		// when $block starts with \n it means no title was specified
		if (substr($block, 0, 1) === "\n") {
			return [
				"title" => "",
				"code" => ltrim($block)
			];
		}

		$tmp = napphp::str_split($block, "\n", 2);

		return [
			"title" => $tmp[0],
			"code" => $tmp[1]
		];
	};

	$type_specific_information = require __DIR__."/convert/".napphp::str_replace($clean_doc_block["@type"], ":", "_").".php";

	return [
		"module" => $clean_doc_block["@module"],

		"fullname" => $clean_doc_block["@fullname"],
		"display_label" => $clean_doc_block["@name"] ?? $clean_doc_block["@fullname"],

		"type" => $clean_doc_block["@type"],
		"type_category" => $type_category_map[$clean_doc_block["@type"]],

		"type_specific_information" => $type_specific_information($clean_doc_block),

		"general_information" => [
			"version" => $clean_doc_block["@version"] ?? "",
			"brief" => $clean_doc_block["@brief"] ?? "",
			"description" => $clean_doc_block["@description"] ?? "",
			"notes" => napphp::arr_map(napphp::util_arrayify($clean_doc_block["@note"] ?? []), "trim"),
			"warnings" => napphp::arr_map(napphp::util_arrayify($clean_doc_block["@warning"] ?? []), "trim"),
			"examples" => napphp::arr_map(napphp::util_arrayify($clean_doc_block["@example"] ?? []), $processExampleCodeBlock)
		]
	];
};


// changelog
// version
// author
// origin
// api stability
// deprecated
// flags?

