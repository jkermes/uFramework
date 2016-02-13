<?php

namespace Model;

use Model\Entity\Status;
use DateTime;

class StatusFinder implements FinderInterface
{
    private $connection;

    public function __construct(\Model\Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll()
    {
        $query = 'SELECT * FROM STATUSES';
        $res = $this->connection->query($query, Connection::FETCH_ASSOC);

        foreach ($res->fetchAll() as $status) {
            $statuses[] = new Status($status['id'], $status['message'], $status['userName'], new DateTime($status['publishDate']), $status['client']);
        }

        return $statuses;
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        $query = 'SELECT * FROM STATUSES WHERE id=:id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $status = $stmt->fetch(Connection::FETCH_ASSOC);

        return new Status($status['id'], $status['message'], $status['userName'], new DateTime($status['publishDate']), $status['client']);
    }
}