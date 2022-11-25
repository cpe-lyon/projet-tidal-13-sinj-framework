<?php

use Framework\View;

class SinjController
{
    public function index() {
        return new View('index');
    }

    public function about() {
        return new View('about');
    }

    public function docs() {
        return new View('docs');
    }
}