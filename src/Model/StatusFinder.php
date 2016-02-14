<?php

namespace Model;

use Model\Entity\Status;
use DateTime;

class StatusFinder implements FinderInterface
{
    private $connection;

    /**
     * StatusFinder constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll($criteria = array())
    {
        $query = 'SELECT * FROM status';

        if (isset($criteria['where'])) {
            $query .= ' WHERE :where';
        }

        if (isset($criteria['orderBy'])) {
            $query .= ' ORDER BY :orderBy';
        }

        if (isset($criteria['limit'])) {
            $query .= ' LIMIT :limit';
        }

        if (isset($criteria)) {
            $stmt = $this->connection->prepare($query);

            foreach ($criteria as $key => $value) {
                if ($key === 'limit') {
                    $stmt->bindValue(':'.$key, (int) trim($value), Connection::PARAM_INT);
                }
                else {
                    $stmt->bindValue(':'.$key, $value);
                }
            }

            $stmt->execute();
            //var_dump($stmt->errorInfo());
            $res = $stmt->fetchAll(Connection::FETCH_ASSOC);
        }
        else {
            $res = $this->connection->query($query, Connection::FETCH_ASSOC)->fetchAll();
        }

        //var_dump($stmt->queryString);


        foreach ($res as $status) {
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
        $query = 'SELECT * FROM status WHERE id=:id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $status = $stmt->fetch(Connection::FETCH_ASSOC);

        if (!isset($status[id])) {
            return null;
        }

        return new Status($status['id'], $status['message'], $status['userName'], new DateTime($status['publishDate']), $status['client']);
    }
}