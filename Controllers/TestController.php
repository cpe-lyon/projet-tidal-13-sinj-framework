<?php

use Framework\Database;
use Framework\HttpRequest;

class TestController
{
    public function test(HttpRequest $request) {
        return Database::query('SELECT * FROM books WHERE id > ? OR id = ?', [10, 1]);
    }
}