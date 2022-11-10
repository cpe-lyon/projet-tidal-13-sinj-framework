<?php

spl_autoload_register(function ($className) {
    $filename = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', '/', $className) . '.php';
    if (file_exists($filename)) require_once($filename);
});