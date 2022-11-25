<?php

use Framework\Route;

return [
    // SINJ
    new Route('GET', '/', SinjController::class, 'index'),
    new Route('GET', '/about', SinjController::class, 'about'),
    new Route('GET', '/docs', SinjController::class, 'docs'),

    // Books
    new Route('POST', '/book', BookController::class, 'createBook'),
    new Route('GET', '/book/delete', BookController::class, 'deleteBook'),
    new Route('GET', '/book/update', BookController::class, 'updateBook'),
    new Route('GET', '/book/all', BookController::class, 'getAll'),
    new Route('GET', '/book/find', BookController::class, 'find'),

    // Tests
    //new Route('GET', '/test', TestController::class, 'test'),
];