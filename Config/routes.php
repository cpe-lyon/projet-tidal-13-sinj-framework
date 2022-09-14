<?php

use Framework\Route;

return [
    new Route('GET', '/aled', BasicController::class, 'test'),
    new Route('POST', '/mp', BasicController::class, 'mp'),
];