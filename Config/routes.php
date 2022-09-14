<?php

include_once("../Framework/Route.php");

$routes = [
    new Route('GET', '/kkk', BasicController::class, 'test')
];