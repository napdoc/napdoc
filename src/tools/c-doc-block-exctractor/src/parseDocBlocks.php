<?php

return function($contents) {
	$extractComments = require __DIR__."/extractComments.php";
	$parseDocBlock = require __DIR__."/parseDocBlock.php";

	$doc_blocks = $extractComments($contents);

	return napphp::arr_map(
		$doc_blocks, $parseDocBlock
	);
};
