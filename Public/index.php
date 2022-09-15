<?php

// Autoloader
require(__DIR__ . '/../autoloader.php');

// Import used classes
use Framework\View;
use Framework\Route;
use Framework\HttpRequest;
include("../Config/config.php");

// Import every user controller
foreach (glob("../Controllers/*.php") as $filename)
{
    include_once($filename);
}

// Get every user defined route
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
            $view = $controller->{$route->getFunction()}($request);
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


/* Checking if the view name exists in the views mapping array. 
* If it does, it gets the html name from the views mapping, 
* gets the html string from the html file, 
* replaces the %APP_NAME% with the string "test" and then echoes the html in order to display it. 
*/
if( array_key_exists($view->getName(), $mappingViews) ) {
    $htmlName = $mappingViews[$view->getName()];
    $template = file_get_contents("../template.html");
    $content = file_get_contents("../Views/".$htmlName);
    $html = str_replace("%APP_NAME%", APP_NAME, $template);
    $html = str_replace("%DATA%",$content,$html);
    echo($html);
}


