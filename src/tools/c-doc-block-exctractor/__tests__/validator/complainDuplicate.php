<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about duplicate tag (@module)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => ["a", "b"],
		"@fullname" => "test",
		"@type" => "fn"
	]);

	testing::assert(napphp::arr_contains($errors, "Tag '@module' may only appear once."));
});

testing::case("should complain about duplicate tag (@fullname)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => ["a", "b"],
		"@type" => "fn"
	]);

	testing::assert(napphp::arr_contains($errors, "Tag '@fullname' may only appear once."));
});

testing::case("should complain about duplicate tag (@type)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => "test",
		"@type" => ["a", "b"]
	]);

	testing::assert(napphp::arr_contains($errors, "Tag '@type' may only appear once."));
});

testing::case("should complain about duplicate tag (@version)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => "test",
		"@type" => "fn",
		"@version" => ["a", "b"]
	]);

	testing::assert(napphp::arr_contains($errors, "Tag '@version' may only appear once."));
});
