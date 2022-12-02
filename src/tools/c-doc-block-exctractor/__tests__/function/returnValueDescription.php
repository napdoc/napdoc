<?php

$convert_fn = require __DIR__."/../../src/index.php";

testing::case("should ", function() use ($convert_fn) {

	$input = <<<STR
/*!
 * @module Test
 * @fullname full_definition_name
 * @type fn
 * @return
 * This function returns something.
 */
STR;

	$result = $convert_fn($input);

	$expected = [
		[
			"success", [
				"module" => "Test",
				"fullname" => "full_definition_name",
				"display_label" => "full_definition_name",
				"type" => "fn",
				"type_category" => "function",
				"type_specific_information" => [
					"variadic" => false,
					"return" => [
						"description" => "This function returns something.",
						"type" => ""
					],
					"params" => []
				],
				"general_information" => [
					"version" => "",
					"brief" => "",
					"description" => "",
					"notes" => [],
					"warnings" => [],
					"examples" => []
				]
			]
		]
	];

	testing::assert(testing::arrayEqual($result, $expected));
});
