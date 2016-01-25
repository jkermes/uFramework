<?php

namespace Http;

class Request
{
    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';

    private $method;
    private $uri;

    public function __construct()
    {
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
        $this->uri    = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        if ($pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUri() {
        return $this->uri;
    }

    public static function createFromGlobals()
    {
        return new self();
    }
}