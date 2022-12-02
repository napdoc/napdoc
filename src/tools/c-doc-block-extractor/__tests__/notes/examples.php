<?php

$convert_fn = require __DIR__."/../../src/index.php";

testing::case("should work as expected", function() use ($convert_fn) {

	$input = <<<STR
/*!
 * @module Test
 * @fullname full_definition_name
 * @type fn
 * @example Hello World
 * const char *str = "Hello, World!";
 * printf("%s\\n", str);
 * @example
 * printf("Hello, World!\\n");
 */
STR;

	$result = $convert_fn($input);

	$expected = [
		[
			"success", [
				"module" => "Test",
				"fullname" => "full_definition_name",
				"display_label" => "full_definition_name",
				"type_category" => "function",
				"type" => "fn",
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
					"notes" => [],
					"warnings" => [],
					"examples" => [[
						"title" => "Hello World",
						"code" => "const char *str = \"Hello, World!\";\nprintf(\"%s\\n\", str);"
					], [
						"title" => "",
						"code" => "printf(\"Hello, World!\\n\");"
					]]
				]
			]
		]
	];

	testing::assert(testing::arrayEqual($result, $expected));
});
