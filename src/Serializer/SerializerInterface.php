<?php

namespace Serializer;

interface SerializerInterface
{
    /**
     * Serialize an object.
     *
     * @param $content
     *
     * @return mixed
     */
    public function serialize($content);
}
