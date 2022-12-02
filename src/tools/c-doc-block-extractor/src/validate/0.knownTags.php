<?php

return function($doc_block_tags) {
	$known_tags = require __DIR__."/_known_tags.php";

	$errors = [];

	foreach ($doc_block_tags as $tag_name => $tag_value) {
		$tmp = napphp::arr_filter($known_tags, function($a) use ($tag_name) {
			return $a[0] === $tag_name;
		});

		if (!sizeof($tmp)) {
			array_push($errors, "Unknown tag '$tag_name'.");

			continue;
		}

		$tag_meta_data = $tmp[0];

		$tag_line_styles = $tag_meta_data[1];
		$tag_mode  = "";

		if (sizeof($tag_meta_data) === 3) {
			$tag_mode = $tag_meta_data[2];
		}

		if ($tag_mode === "once") {
			if (is_array($tag_value)) {
				array_push($errors, "Tag '$tag_name' may only appear once.");
			}
		}

		foreach (napphp::util_arrayify($tag_value) as $value) {
			if ($tag_line_styles === "SL") {
				$number_of_lines = sizeof(napphp::str_split($value, "\n"));

				if ($number_of_lines > 1) {
					array_push($errors, "Tag '$tag_name' may not span over multiple lines.");
				}
			}
		}
	}

	return $errors;
};
