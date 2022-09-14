<?php

class Route
{
    private string $method;
    private string $name;
    private string $controller;
    private string $function;

    public function __construct(string $method, string $name, string $controller, string $function) {
        $this->method = $method;
        $this->name = $name;
        $this->controller = $controller;
        $this->function = $function;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getFunction(): string
    {
        return $this->function;
    }
}