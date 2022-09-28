<?php

// Application configuration files
require('../Config/database.php');
require("../Config/config.php");

// Autoloader
require(__DIR__ . '/../autoloader.php');

// Import used classes
use Framework\View;
use Framework\Route;
use Framework\HttpRequest;
use Framework\TemplateMotor;

// Import every user controller
foreach (glob("../Controllers/*.php") as $filename)
{
    include_once($filename);
}

// Get every user defined route & view
$routes = require("../Config/routes.php");
$mappingViews = require("../Config/views.php");

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
            $result = $controller->{$route->getFunction()}($request);
            break;
        }
        else {
            // If the route was found but the client methods is not corresponding, loads 405 error page
            $result = new View('error', ['code' => 405 , 'message' => 'Bad method for route ' . $request->getUrl()]);
        }
    }
}

// If no view was returned, loads 404 error page
if (!isset($result)) {
    $result = new View('error', ['code' => 404 , 'message' => 'No route mapped for ' . $request->getUrl()]);
}

// If the returned data from the controller is a View
if ($result instanceof View) {

    $templateMotor = new TemplateMotor($mappingViews);
    $html = $templateMotor->HTMLrendering($result);
    echo($html);

} // Otherwise it will be returned as JSON data
else {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($result);
}