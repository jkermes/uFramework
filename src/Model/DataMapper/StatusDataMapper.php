<?php

namespace Model\DataMapper;

use Model\Connection;
use Model\Entity\Status;

class StatusDataMapper
{
    /**
     * @var Connection
     */
    private $con;

    /**
     * StatusDataMapper constructor.
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Persists a status into database
     *
     * @param Status $status
     * @return bool
     */
    public function persist(Status $status)
    {
        $action = 'INSERT';

        if (!is_null($status->getId())) {
            $action = 'UPDATE';
        }

        $query = $action . ' INTO status (message, userName, publishDate, client) VALUES (:message, :userName, :publishDate, :client)';

        return $this->con->executeQuery($query, array(
                'message' => $status->getMessage(),
                'userName' => $status->getUserName(),
                'publishDate' => $status->getPublishDate()->format('Y-m-d H:i'),
                'client' => $status->getClient()
            )
        );
    }

    /**
     * Remove a status from database
     *
     * @param Status $status
     * @return bool
     */
    public function remove(Status $status)
    {
        $query = 'DELETE FROM status WHERE id=:id';

        return $this->con->executeQuery($query, array('id' => $status->getId()));
    }
}