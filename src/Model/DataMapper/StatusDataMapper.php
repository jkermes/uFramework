<?php

namespace Model\DataMapper;

use Model\Connection;
use Model\Entity\Status;

class StatusDataMapper
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function persist(Status $status)
    {
        // TODO: Implement persist() method.
    }

    public function remove(Status $status)
    {
        // TODO: Implement remove() method.
    }
}