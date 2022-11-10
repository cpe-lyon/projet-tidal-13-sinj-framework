<?php

use Framework\Route;

return [
    // Books
    new Route('POST', '/book', BookController::class, 'createBook'),
    new Route('POST', '/book/delete', BookController::class, 'deleteBook'),
    new Route('POST', '/book/update', BookController::class, 'updateBook'),
    new Route('GET', '/book/all', BookController::class, 'getAll'),
    new Route('GET', '/book/find', BookController::class, 'find'),

    // Tests
    new Route('GET', '/test', TestController::class, 'test'),
    new Route('GET', '/accessibility', AccessibilityController::class,'accessibility'),
];