<?php

// Autoloader
require(__DIR__ . '/../autoloader.php');

// Get every user defined route
$routes = require("Config/routes.php");

// Import every user controller
foreach (glob("Controllers/*.php") as $filename)
{
    include_once($filename);
}

// Checking routes conformity
foreach ($routes as $index => $route) {
    if (empty($route->getMethod())) {
        echo "[Error] Route method can't be empty for route N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
    if ($route->getMethod() != 'GET' && $route->getMethod() != 'POST') {
        echo "[Error] The method " . $route->getMethod() . " cannot be used for route N°" . ($index + 1) . " in routes.php. It's either GET or POST\n";
        exit();
    }
    if (empty($route->getName())) {
        echo "[Error] Route name can't be empty for route N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
    if (empty($route->getController())) {
        echo "[Error] Controller can't be empty for route N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
    if (empty($route->getFunction())) {
        echo "[Error] Controller's function can't be empty for route N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
    if (!method_exists($route->getController(), $route->getFunction())) {
        echo "[Error] The function " . $route->getFunction() . " does not exist in controller " . $route->getController() . " for route N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
}