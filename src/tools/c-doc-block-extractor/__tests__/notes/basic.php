<?php

$convert_fn = require __DIR__."/../../src/index.php";

testing::case("should work as expected", function() use ($convert_fn) {

	$input = <<<STR
/*!
 * @module Test
 * @fullname full_definition_name
 * @type fn
 * @note This is a test note.
 * @note
 * This is a second note.
 * With a new line in between.
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
						"description" => "",
						"type" => ""
					],
					"params" => []
				],
				"general_information" => [
					"version" => "",
					"brief" => "",
					"description" => "",
					"notes" => [
						"This is a test note.",
						"This is a second note.\nWith a new line in between."
					],
					"warnings" => [],
					"examples" => []
				]
			]
		]
	];

	testing::assert(testing::arrayEqual($result, $expected));
});
