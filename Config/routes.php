<?php

include_once("../Framework/Route.php");

$routes = [
    new Route('GET', '/aled', BasicController::class, 'test'),
    new Route('POST', '/mp', BasicController::class, 'mp'),
];