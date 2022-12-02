<?php

return function($path) {
	$entries = napphp::fs_scandir($path);
	$steps = [];

	foreach ($entries as $entry) {
		if (!napphp::str_endsWith($entry, ".php")) continue;

		$tmp = napphp::str_split($entry, ".");
		$no = (int)$tmp[0];

		$steps["step-$no"] = require __DIR__."/steps/$entry";
	}

	uksort($steps, function($a, $b) {
		$a = (int)substr($a, strlen("step-"));
		$b = (int)substr($b, strlen("step-"));

		return ($a > $b) ? 1 : -1;
	});

	return $steps;
};
