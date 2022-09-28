<?php

use Framework\Route;

return [
    new Route('POST', '/book', BookController::class, 'createBook'),
    new Route('GET', '/book/delete', BookController::class, 'deleteBook'),
    new Route('GET', '/book/update', BookController::class, 'updateBook'),
    new Route('GET', '/book/all', BookController::class, 'getAll'),
    new Route('GET', '/book/find', BookController::class, 'find'),
    new Route('GET', '/test', TestController::class, 'test'),
];