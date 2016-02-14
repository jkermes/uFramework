<?php

namespace Http;

use Serializer\JsonSerializer;

class JsonResponse extends Response
{
    /**
     * JsonResponse constructor.
     *
     * @param $content
     * @param int   $statusCode
     * @param array $headers
     */
    public function __construct($content, $statusCode = 200, array $headers = [])
    {
        parent::__construct(self::serialize($content), $statusCode, array_merge(['Content-Type' => 'application/json'], $headers));
    }

    /**
     * Serialize an object into JSON.
     *
     * @param $content
     *
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    private function serialize($content)
    {
        $serializer = new JsonSerializer();
        $jsonContent = $serializer->serialize($content);

        return $jsonContent;
    }
}
