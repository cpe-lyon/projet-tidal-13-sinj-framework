<?php

namespace Framework;

final class HttpRequest
{
    private $url;
    private $method;
    private $params = [];

    public function __construct()
    {
        $this->url = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->method = $_SERVER['REQUEST_METHOD'];

        // Parses the POST method params
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->params = $_POST;
        }
        // Parses the GET method params
        elseif (isset($_SERVER['QUERY_STRING']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $rawParams = explode('&', $_SERVER['QUERY_STRING']);

            foreach ($rawParams as $param) {
                $rawParam = explode('=', $param, 2);
                $this->params[$rawParam[0]] = $rawParam[1] ?? null;
            }
        }
    }

    /**
     * Returns request URL
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns request method
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Returns every request param
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Returns request's param for specific key, null if not found
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->params[$key];
    }
}