<?php

require_once __DIR__."/../../../load-napphp.php";

return function($file) {
	static $loadSteps = NULL;

	if (!$loadSteps) {
		$loadSteps = require __DIR__."/loadSteps.php";
	}

	$steps = $loadSteps(__DIR__."/steps/");

	$context = [

	];

	foreach ($steps as $step_name => $step_fn) {
		$step_fn([], $context);
	}
};

//var_dump($context);

// report undefined symbols from doc-blocks:
// @fullname napc_printf -> error because 'napc_printf' C-symbol does not exist
// report if function is variadic but not marked as such
