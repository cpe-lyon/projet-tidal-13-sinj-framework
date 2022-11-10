<?php

use Framework\View;
use Framework\Database;
use Framework\HttpRequest;

class RedirectController
{
    public function redirection(HttpRequest $request) {
        return new View('redirect', ['TEST_REDIRECT' => 'la redirection est OK']);
    }
}