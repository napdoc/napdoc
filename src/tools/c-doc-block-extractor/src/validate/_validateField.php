<?php

return function(&$errors, $label, $value) {
	$lines = napphp::str_split($value, "\n");
	// check first line:
	// Single-Line format: <NAME> <DESC>
	// Multi-Line format: <NAME>\n<DESC>
	$tmp = napphp::str_split($lines[0], " ", 2);

	// single line
	if (sizeof($lines) === 1 && sizeof($tmp) === 1) {
		array_push($errors, "$label incomplete definition '$value'.");
	}
	// multi line
	else if (sizeof($lines) > 1 && sizeof($tmp) === 2) {
		array_push($errors, "$label too many names '$value'.");
	}
};
