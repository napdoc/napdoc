<?php

return function($value) {
	$lines = napphp::str_split($value, "\n");
	$tmp = napphp::str_split($lines[0], " ", 2);

	if (sizeof($lines) === 1) {
		return [$tmp[0], $tmp[1]];
	}

	// remove first line
	array_shift($lines);

	return [$tmp[0], napphp::arr_join($lines, "\n")];
};
