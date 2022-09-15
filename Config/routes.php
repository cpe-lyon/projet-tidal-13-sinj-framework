<?php

use Framework\Route;

return [
    new Route('POST', '/book', BookController::class, 'createBook'),
    new Route('GET', '/book/all', BookController::class, 'getAll'),
];