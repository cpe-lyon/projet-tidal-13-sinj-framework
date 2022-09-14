<?php

use Framework\View;
use Framework\HttpRequest;

class BasicController
{
    public static function test(HttpRequest $request) {
        return new View('test', $request->getParams());
    }
}