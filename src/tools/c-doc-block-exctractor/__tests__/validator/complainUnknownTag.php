<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about an unknown tag", function() use ($validator_fn) {
	$errors = $validator_fn([
		"@unknown_tag" => ""
	]);

	testing::assert(napphp::arr_contains($errors, "Unknown tag '@unknown_tag'."));
});

