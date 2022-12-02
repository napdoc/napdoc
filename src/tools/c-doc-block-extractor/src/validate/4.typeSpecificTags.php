<?php

return function($doc_block_tags) {
	if (!napphp::arr_keyExists($doc_block_tags, "@type")) {
		return [];
	}

	$errors = [];

	$validateField = require __DIR__."/_validateField.php";

	switch ($doc_block_tags["@type"]) {
		case "fn":
		case "macro:fn": {
			$fn_params = [];

			if (napphp::arr_keyExists($doc_block_tags, "@param")) {
				$fn_params = napphp::util_arrayify($doc_block_tags["@param"]);
			}

			foreach ($fn_params as $fn_param) {
				$validateField($errors, "@param", $fn_param);
			}
		} break;

		case "type:enum": {
			$enums = [];

			if (napphp::arr_keyExists($doc_block_tags, "@enum")) {
				$enums = napphp::util_arrayify($doc_block_tags["@enum"]);
			}

			foreach ($enums as $enum) {
				$validateField($errors, "@enum", $enum);
			}
		} break;

		case "type:struct": {
			$fields = [];

			if (napphp::arr_keyExists($doc_block_tags, "@field")) {
				$fields = napphp::util_arrayify($doc_block_tags["@field"]);
			}

			foreach ($fields as $field) {
				$validateField($errors, "@field", $field);
			}
		} break;
	}

	return $errors;
};
