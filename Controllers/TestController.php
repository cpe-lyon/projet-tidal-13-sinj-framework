<?php

use Framework\View;
use Framework\Database;
use Framework\HttpRequest;

class TestController
{
    public function test(HttpRequest $request) {
        return new View('all_books',['TEST_RATE' => "test"]);
    }
}