<?php

return function($doc_block_tags) {
	$errors = [];

	if (!napphp::arr_keyExists($doc_block_tags, "@module")) {
		array_push($errors, "Missing required tag '@module'.");
	}

	if (!napphp::arr_keyExists($doc_block_tags, "@fullname")) {
		array_push($errors, "Missing required tag '@fullname'.");
	}

	if (!napphp::arr_keyExists($doc_block_tags, "@type")) {
		array_push($errors, "Missing required tag '@type'.");
	}

	return $errors;
};
