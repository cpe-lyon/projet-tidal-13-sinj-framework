<?php
include_once ('../Framework/HttpRequest.php');

class BasicController
{
    public static function test(HttpRequest $request) {
        return new View('test', $request->getParams());
    }
}