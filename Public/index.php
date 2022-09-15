<?php

// Autoloader
require(__DIR__ . '/../autoloader.php');

// Import used classes
use Framework\View;
use Framework\Route;
use Framework\HttpRequest;

// Import every user controller
foreach (glob("../Controllers/*.php") as $filename)
{
    include_once($filename);
}

// Get every user defined route
$routes = require("../Config/routes.php");

// Get client request
$request = new HttpRequest();

// Get controller's function associated to client called route
foreach ($routes as $route) {

    // If the request URL and method exists in one controller
    if ($request->getUrl() == $route->getName()) {

        // If the requested method
        if ($request->getMethod() === $route->getMethod()) {
            // Calls the function associated with the controller that was defined by the user in routes.php
            $controllerName = $route->getController();
            $controller = new $controllerName;
            $view = $controller->{$route->getFunction()}($request);
            break;
        }
        else {
            // If the route was found but the client methods is not corresponding, loads 405 error page
            $view = new View('error', ['code' => 405 , 'message' => 'Bad method for route ' . $request->getUrl()]);
        }
    }
}

// If no view was returned, loads 404 error page
if (!isset($view)) {
    $view = new View('error', ['code' => 404 , 'message' => 'No route mapped for ' . $request->getUrl()]);
}

var_dump($view);