<?php

return function ($element) {
	$tmp = substr($element, 1);

	return (int)substr($tmp, 0, strlen($tmp) - 1);
};
