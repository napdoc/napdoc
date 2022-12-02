<?php

$validator_fn = require __DIR__."/../../src/validate.php";

$reference_input = function($type) {
	return [
		"@module" => "testing",
		"@fullname" => "testing",
		"@type" => $type,

		"@enum" => "",
		"@field" => "",
		"@param" => "",
		"@variadic" => "",
		"@return" => ""
	];
};

testing::case("should complain about unneccessary tags for a given @type (type=fn)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("fn"));

	testing::assert( napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'fn'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@field' for @type 'fn'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@param' for @type 'fn'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'fn'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@return' for @type 'fn'."));
});

testing::case("should complain about unneccessary tags for a given @type (type=type:alias)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("type:alias"));

	testing::assert(napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'type:alias'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@field' for @type 'type:alias'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@param' for @type 'type:alias'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'type:alias'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@return' for @type 'type:alias'."));
});

testing::case("should complain about unneccessary tags for a given @type (type=type:enum)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("type:enum"));

	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'type:enum'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@field' for @type 'type:enum'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@param' for @type 'type:enum'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'type:enum'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@return' for @type 'type:enum'."));
});

testing::case("should complain about unneccessary tags for a given @type (type=type:struct)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("type:struct"));

	testing::assert( napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'type:struct'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@field' for @type 'type:struct'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@param' for @type 'type:struct'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'type:struct'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@return' for @type 'type:struct'."));
});

testing::case("should complain about unneccessary tags for a given @type (type=macro:var)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("macro:var"));

	testing::assert(napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'macro:var'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@field' for @type 'macro:var'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@param' for @type 'macro:var'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'macro:var'."));
	testing::assert(napphp::arr_contains($errors, "Invalid tag '@return' for @type 'macro:var'."));
});

testing::case("should complain about unneccessary tags for a given @type (type=macro:fn)", function() use ($validator_fn, $reference_input) {
	$errors = $validator_fn($reference_input("macro:fn"));

	testing::assert( napphp::arr_contains($errors, "Invalid tag '@enum' for @type 'macro:fn'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@field' for @type 'macro:fn'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@param' for @type 'macro:fn'."));
	testing::assert(!napphp::arr_contains($errors, "Invalid tag '@variadic' for @type 'macro:fn'."));
	testing::assert( napphp::arr_contains($errors, "Invalid tag '@return' for @type 'macro:fn'."));
});
