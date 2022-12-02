<?php

return function($doc_block_tags) {
	static $validators = NULL;
	static $validator_fns = [];

	if ($validators === NULL) {
		$validators = napphp::fs_scandir(__DIR__."/validate");
		$validators = napphp::arr_filter($validators, function($validator) {
			return !napphp::str_startsWith($validator, "_");
		});

		usort($validators, function($a, $b) {
			$a = (int)napphp::str_split($a, ".", 2)[0];
			$b = (int)napphp::str_split($b, ".", 2)[0];

			return ($a > $b) ? 1 : -1;
		});

		foreach ($validators as $validator) {
			array_push($validator_fns, require __DIR__."/validate/$validator");
		}
	}

	$errors = [];

	foreach ($validator_fns as $validator_fn) {
		foreach ($validator_fn($doc_block_tags) as $error) {
			array_push($errors, $error);
		}
	}

	return $errors;
};
