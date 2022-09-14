<?php
include_once ('../Framework/HttpRequest.php');

class BasicController
{
    public static function test(HttpRequest $request) {

        echo "<h1>Titre</h1>";
    }
}