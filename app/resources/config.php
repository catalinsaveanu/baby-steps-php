<?php

$config = array(
	"db" => array(
		"dbname" => "database1",
		"username" => "dbUser",
		"password" => "pa$$",
		"host" => "localhost"
	),
	"urls" => array(
		"baseUrl" => "http://example.com"
	),
	"paths" => array(
		"resources" => "/resources/",
		"images" => $_SERVER["DOCUMENT_ROOT"] . "/assets/img"
	)
);

defined("APP_DIR")
or define('APP_DIR', dirname(__FILE__));

defined("LIBRARY_PATH")
or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("TEMPLATES_PATH")
or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
