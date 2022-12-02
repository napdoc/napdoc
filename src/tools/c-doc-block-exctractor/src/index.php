<?php

return function($contents) {
	$parseDocBlocks = require __DIR__."/parseDocBlocks.php";
	$validate = require __DIR__."/validate.php";
	$convert = require __DIR__."/convert.php";
	$doc_blocks = $parseDocBlocks($contents);

	$results = [];

	foreach ($doc_blocks as $doc_block) {
		$errors = $validate($doc_block);

		if (sizeof($errors)) {
			array_push($results, ["error", $errors]);
		} else {
			array_push($results, ["success", $convert($doc_block)]);
		}
	}

	return $results;
};
