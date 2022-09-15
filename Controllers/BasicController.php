<?php

use Framework\View;
use Framework\HttpRequest;

class BasicController
{
    public static function test(HttpRequest $request) {
        return new View('test', $request->getParams());
    }

    public static function json(HttpRequest $request) {
        return [
            [ 3 => 'mppp'],
            'Mathias'
        ];
    }
}