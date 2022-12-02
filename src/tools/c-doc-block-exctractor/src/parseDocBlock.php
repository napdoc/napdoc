<?php

return function($lines) {
	$tags = [];
	$current_tag_name = "";
	$current_tag_content = "";

	$flush_current_tag = function() use (&$current_tag_name, &$current_tag_content, &$tags) {
		if (!strlen($current_tag_name)) {
			return;
		}

		if (napphp::arr_keyExists($tags, $current_tag_name)) {
			$tags[$current_tag_name] = napphp::util_arrayify($tags[$current_tag_name]);

			array_push($tags[$current_tag_name], $current_tag_content);
		} else {
			$tags[$current_tag_name] = $current_tag_content;
		}

		$current_tag_name = "";
		$current_tag_content = "";
	};

	$first_line = true;

	foreach ($lines as $line) {
		// check if first line starts with '@'
		// if not, then '@description' is assumed
		if ($first_line && substr($line, 0, 1) !== "@") {
			$current_tag_name = "@description";
		}

		// check for tag name
		if (substr($line, 0, 1) === "@") {
			$flush_current_tag();

			$tag_name = napphp::str_split($line, " ", 2)[0];

			$remainder_of_line = ltrim(substr($line, strlen($tag_name)));

			$current_tag_name = $tag_name;
			$current_tag_content = $remainder_of_line;
		} else if (strlen($current_tag_name)) {
			$current_tag_content .= $first_line ? $line : "\n$line";
		}

		$first_line = false;
	}

	$flush_current_tag();

	return $tags;
};
