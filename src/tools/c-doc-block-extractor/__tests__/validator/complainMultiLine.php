<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about tag value that spans over multiple lines (@brief)", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@module" => "test",
		"@fullname" => "test",
		"@type" => "fn",
		"@brief" => "a\nb"
	]);

	testing::assert(napphp::arr_contains($errors, "Tag '@brief' may not span over multiple lines."));
});
