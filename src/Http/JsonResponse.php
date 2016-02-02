<?php

namespace Http;

class JsonResponse extends Response {
    
    public function __construct($content, $statusCode = 200, array $headers = [])
    {
        parent::__construct(json_encode($content), $statusCode, array_merge([ 'Content-Type' => 'application/json' ], $headers));
    }
}