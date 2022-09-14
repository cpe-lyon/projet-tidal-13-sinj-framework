<?php

include_once("../Framework/HttpRequest.php");
include_once("../Framework/Route.php");
include_once("../Framework/View.php");
include_once("../Config/routes.php");

foreach (glob("../Controllers/*.php") as $filename)
{
    include_once($filename);
}

$request = new HttpRequest();

foreach ($routes as $route) {
    // If the request URL and method exists in one controller
    if ($request->getUrl() == $route->getName()) {

        if ($request->getMethod() === $route->getMethod()) {
            // Calls the function associated with the cont  roller
            $controllerName = $route->getController();
            $controller = new $controllerName;
            $view = $controller->{$route->getFunction()}($request);
        }
        else {
            $view = new View('error', ['code' => 405 , 'message' => 'Bad method for route ' . $request->getUrl()]);
        }
    }
}

if (!isset($view)) {
    $view = new View('error', ['code' => 404 , 'message' => 'No route mapped for ' . $request->getUrl()]);
}

var_dump($view);