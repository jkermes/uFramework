<?php

namespace Http;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class JsonResponse extends Response {

    /**
     * JsonResponse constructor.
     *
     * @param $content
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($content, $statusCode = 200, array $headers = [])
    {
        parent::__construct(self::serialize($content), $statusCode, array_merge([ 'Content-Type' => 'application/json' ], $headers));
    }

    /**
     * Serialize an object into JSON
     *
     * @param $content
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    private function serialize($content)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($content, 'json');

        return $jsonContent;
    }
}