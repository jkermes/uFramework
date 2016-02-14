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
        $action = 'INSERT';

        if (is_null($status->getId())) {
            $action = 'UPDATE';
        }

        $query = $action . ' INTO STATUS (message, userName, publishDate) VALUES (:message, :user, :publishDate)';

        return $this->con->executeQuery($query, array(
                'message' => $status->getMessage(),
                'userName' => $status->getUserName(),
                'publishDate' => $status->getPublishDate(),
            )
        );
    }

    public function remove(Status $status)
    {
        // TODO: Implement remove() method.
    }
}