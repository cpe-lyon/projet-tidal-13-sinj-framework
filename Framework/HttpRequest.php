<?php

namespace Framework;

class HttpRequest
{
    private $url;
    private $method;
    private $params = [];

    public function __construct()
    {
        $this->url = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->params = $_POST;
        }
        // Parses the GET methods params
        elseif (isset($_SERVER['QUERY_STRING']) && $_SERVER['REQUEST_METHOD'] == "GET") {
            $rawParams = explode('&', $_SERVER['QUERY_STRING']);

            foreach ($rawParams as $param) {
                $rawParam = explode('=', $param, 2);
                $this->params[$rawParam[0]] = $rawParam[1] ?? null;
            }
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }
}