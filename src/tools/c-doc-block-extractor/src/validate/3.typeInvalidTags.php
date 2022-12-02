<?php

return function($doc_block_tags) {
	if (!napphp::arr_keyExists($doc_block_tags, "@type")) {
		return [];
	}

	$type_tag_value = $doc_block_tags["@type"];

	if (is_array($type_tag_value)) return [];

	$known_tags = require __DIR__."/_known_tags.php";
	$known_tag_names = napphp::arr_map($known_tags, function($tag) {
		return $tag[0];
	});

	$valid_types = require __DIR__."/_valid_types.php";

	$valid_tags_for_type = napphp::arr_filter($known_tag_names, function($tag_name) use ($type_tag_value) {
		if ($type_tag_value === "fn") {
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@field") return false;
		} else if ($type_tag_value === "type:alias") {
			if ($tag_name === "@param") return false;
			if ($tag_name === "@field") return false;
			if ($tag_name === "@variadic") return false;
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@return") return false;
		} else if ($type_tag_value === "type:enum") {
			if ($tag_name === "@param") return false;
			if ($tag_name === "@field") return false;
			if ($tag_name === "@variadic") return false;
			if ($tag_name === "@return") return false;
		} else if ($type_tag_value === "type:struct") {
			if ($tag_name === "@param") return false;
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@variadic") return false;
			if ($tag_name === "@return") return false;
		} else if ($type_tag_value === "type:opaque") {
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@param") return false;
			if ($tag_name === "@field") return false;
			if ($tag_name === "@variadic") return false;
			if ($tag_name === "@return") return false;
		} else if ($type_tag_value === "macro:var") {
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@param") return false;
			if ($tag_name === "@field") return false;
			if ($tag_name === "@variadic") return false;
			if ($tag_name === "@return") return false;
		} else if ($type_tag_value === "macro:fn") {
			if ($tag_name === "@enum") return false;
			if ($tag_name === "@field") return false;
			if ($tag_name === "@return") return false;
		}

		return true;
	});

	$errors = [];

	foreach ($doc_block_tags as $tag_name => $tag_value) {
		// skip invalid tags
		if (!napphp::arr_contains($known_tag_names, $tag_name)) continue;

		if (!napphp::arr_contains($valid_tags_for_type, $tag_name)) {
			array_push($errors, "Invalid tag '$tag_name' for @type '$type_tag_value'.");
		}
	}

	return $errors;
};
