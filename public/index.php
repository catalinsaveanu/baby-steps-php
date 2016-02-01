<?php
define("APP_DIR", "../app/");

require_once(APP_DIR . "Core/Autoloader.php");

$autoloader = new \Core\Autoloader();

$app = new \Core\App();
