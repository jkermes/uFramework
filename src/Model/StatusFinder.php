<?php

namespace Model;

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

        return $res->fetchAll();
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
        $res = $stmt->execute(array('id' => $id));

        return $stmt->fetch();
    }
}