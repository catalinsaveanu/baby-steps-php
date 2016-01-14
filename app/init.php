<?php

function __autoload($className) {
    $classPath = explode("\\", $className);
    if(!count($classPath)) {
        require_once("Core/" . $className . ".php");
        return;
    }

    require_once (implode("/", $classPath) . ".php");
}

//require_once 'core/App.php';
