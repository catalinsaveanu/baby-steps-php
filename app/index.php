<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");

$variables = array(
	'setInIndexDotPhp' => 'test variables in index.php'
);

renderLayoutWithContentFile("home.php", $variables);