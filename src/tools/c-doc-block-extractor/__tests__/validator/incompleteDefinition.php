<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about incomplete definition (@param)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "Test",
		"@fullname" => "test",
		"@type" => "fn",
		"@param" => ""
	]);

	testing::assert(napphp::arr_contains($errors, "@param incomplete definition ''."));
});

testing::case("should complain about too many names (@param)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "Test",
		"@fullname" => "test",
		"@type" => "fn",
		"@param" => "a b\n"
	]);

	testing::assert(napphp::arr_contains($errors, "@param too many names 'a b\n'."));
});
