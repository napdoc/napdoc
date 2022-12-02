<?php

$convert_fn = require __DIR__."/../../src/index.php";

testing::case("should ", function() use ($convert_fn) {

	$input = <<<STR
/*!
 * @module Test
 * @fullname full_definition_name
 * @type fn
 * @param name1 This is a description about the first parameter.
 * @param name2
 * This is a description about the second parameter.
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
					"params" => [
						[
							"name" => "name1",
							"type" => "",
							"description" => "This is a description about the first parameter."
						],
						[
							"name" => "name2",
							"type" => "",
							"description" => "This is a description about the second parameter."
						]
					]
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
