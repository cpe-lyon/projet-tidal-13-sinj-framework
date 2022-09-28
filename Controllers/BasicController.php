<?php

use Framework\View;
use Framework\HttpRequest;

class BasicController
{
    public static function test(HttpRequest $request) {
        return new View('test', ["USERS"=>["Tanguy","François","Julien","Mathias"],"TEST1"=>"Lorem","TEST2"=>"Ipsum"]);
    }

    public static function json(HttpRequest $request) {
        return [
            [ 3 => 'mppp'],
            'Mathias'
        ];
    }
}