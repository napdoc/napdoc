<?php

$validator_fn = require __DIR__."/../../src/validate.php";

testing::case("should complain about missing required tags", function() use ($validator_fn) {
	$errors = $validator_fn([]);

	testing::assert(napphp::arr_contains($errors, "Missing required tag '@module'."));
	testing::assert(napphp::arr_contains($errors, "Missing required tag '@fullname'."));
	testing::assert(napphp::arr_contains($errors, "Missing required tag '@type'."));
});
