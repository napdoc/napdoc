<?php

return function ($qual_type) {
	static $fixClangCType = NULL;

	if (!$fixClangCType) {
		$fixClangCType = require __DIR__."/fixClangCType.php";
	}

	// because format is:
	// RETURN_TYPE ( PARAM_1, PARAM_2, PARAM_n ... )
	$type = trim(substr($qual_type, 0, strpos($qual_type, "(")));

	return $fixClangCType($type);
};
