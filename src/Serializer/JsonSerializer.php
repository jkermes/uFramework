<?php

namespace Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class JsonSerializer implements SerializerInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * JsonSerializer constructor.
     */
    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @param $content
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    public function serialize($content)
    {
        return $this->serializer->serialize($content, 'json');
    }
}