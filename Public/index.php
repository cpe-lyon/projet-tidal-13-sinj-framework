<?php

include_once("../Framework/HttpRequest.php");
include_once("../Framework/Route.php");
include_once("../Controllers/BasicController.php");
include_once("../Config/routes.php");


$request = new HttpRequest();

foreach ($routes as $route) {
    // If the request URL and method exists in one controller
    if ($request->getUrl() == $route->getName() && $request->getMethod() === $route->getMethod()) {
        // Calls the function associated with the cont  roller
        $controllerName = $route->getController();
        $controller = new $controllerName;
        return $controller->{$route->getFunction()}($request);
    }
}
