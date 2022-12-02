<?php

require_once __DIR__."/load-napphp.php";

$getPath = require __DIR__."/.dependencies/getPath.php";

require_once $getPath("napphp-test-runner")."/index.php";

$tests_paths = [
	__DIR__."/src/tools/c-doc-block-exctractor/__tests__"
];

foreach ($tests_paths as $path) {
	runLoadedTests(loadTestsFromDirectory($path));
}
