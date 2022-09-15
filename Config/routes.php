<?php

use Framework\Route;

return [
    new Route('GET', '/aled', BasicController::class, 'test'),
    new Route('GET', '/json', BasicController::class, 'json'),
];