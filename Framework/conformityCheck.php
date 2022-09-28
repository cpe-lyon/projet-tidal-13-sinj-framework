<?php

echo "Checking app conformity...\n";

// Autoloader
use Framework\Route;

require(__DIR__ . '/../autoloader.php');

// Import every user controller
foreach (glob('Controllers/*.php') as $filename)
{
    include_once($filename);
}

/* === CONFIG === */
echo " ·Config\n";

require("Config/config.php");

if (APP_NAME === 'APP_NAME') {
    exit();
}
if (!is_string(APP_NAME)) {
    echo "[Error] APP_NAME must be a string\n";
    exit();
}
if (APP_NAME === 'APP_URL') {
    exit();
}
if (!is_string(APP_URL)) {
    echo "[Error] APP_URL must be a string\n";
    exit();
}
if (APP_NAME === 'APP_PORT') {
    exit();
}
if (!is_integer(APP_PORT)) {
    echo "[Error] APP_PORT must be a integer\n";
    exit();
}
echo "    OK\n";

/* === ROUTES === */
echo " ·Routes\n";

// Get every user defined route
$routes = require('Config/routes.php');

if (!is_array($routes)) {
    echo "[Error] routes.php must return an array\n";
    exit();
}

// Checking routes conformity
foreach ($routes as $index => $route) {
    if (!$route instanceof Route){
        echo "[Error] Given data is not an instance of Route for entry N°" . ($index + 1) . " in routes.php\n";
        exit();
    }
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
echo "    OK\n";

/* === VIEWS === */

/* === DATABASE === */
echo " ·Database\n";
require("Config/database.php");

if (DB_DRIVER === 'DB_DRIVER') {
    exit();
}
if (!is_string(DB_DRIVER)) {
    echo "[Error] DB_DRIVER must be either pgsql or mysql\n";
    exit();
}
if (DB_HOST === 'DB_HOST') {
    exit();
}
if (!is_string(DB_HOST)) {
    echo "[Error] DB_HOST must be a string\n";
    exit();
}
if (DB_PORT === 'DB_PORT') {
    exit();
}
if (!is_integer(DB_PORT)) {
    echo "[Error] DB_PORT must be a integer\n";
    exit();
}
if (DB_NAME === 'DB_NAME') {
    exit();
}
if (!is_string(DB_NAME)) {
    echo "[Error] DB_NAME must be a string\n";
    exit();
}
if (DB_USER === 'DB_USER') {
    exit();
}
if (!is_string(DB_USER)) {
    echo "[Error] DB_USER must be a string\n";
    exit();
}
if (DB_PASSWORD === 'DB_PASSWORD') {
    exit();
}
if (!is_string(DB_PASSWORD)) {
    echo "[Error] DB_PASSWORD must be a string\n";
    exit();
}
echo "    OK\n";


echo "The app is conform\n";