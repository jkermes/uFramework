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
    private $parameters;

    public function __construct(array $query = array(), array $request = array())
    {
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
        $this->uri    = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        if ($pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }

        $this->parameters = array_merge($query, $request);
    }

    public function getMethod()
    {
        if (self::POST === $this->method) {
            return $this->getParameter('_method');
        }

        return $this->method;
    }

    public function getUri() {
        return $this->uri;
    }

    public static function createFromGlobals()
    {
        return new self($_GET, $_POST);
    }

    public function getParameter($name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }
}