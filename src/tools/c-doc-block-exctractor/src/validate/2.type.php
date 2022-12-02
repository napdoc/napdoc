<?php

return function($doc_block_tags) {
	$valid_types = require __DIR__."/_valid_types.php";

	if (!napphp::arr_keyExists($doc_block_tags, "@type")) {
		return [];
	}

	$type_tag_value = $doc_block_tags["@type"];

	if (is_array($type_tag_value)) return [];

	$errors = [];

	if (!strlen($type_tag_value)) {
		array_push($errors, "Empty @type value ''.");
	} else if (!napphp::arr_contains($valid_types, $type_tag_value)) {
		array_push($errors, "Unknown @type value '$type_tag_value'.");
	}

	return $errors;
};
