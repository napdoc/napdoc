<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about an invalid types (empty)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => "test",
		"@type" => ""
	]);

	testing::assert(napphp::arr_contains($errors, "Empty @type value ''."));
});

testing::case("should complain about an invalid types (invalid)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => "test",
		"@type" => "abc"
	]);

	testing::assert(napphp::arr_contains($errors, "Unknown @type value 'abc'."));
});
