<?php

use Framework\View;
use Framework\HttpRequest;

class AccessibilityController
{
    public function accessibility(HttpRequest $request) {
        return new View("accessibility",["test"]);
    }
}