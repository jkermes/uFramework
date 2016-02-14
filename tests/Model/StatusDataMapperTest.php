<?php

namespace Model;

use Model\Entity\Status;
use Model\DataMapper\StatusDataMapper;

class StatusDataMapperTest extends \TestCase
{
    private $con;

    public function setUp()
    {
        $this->con = new Connection('sqlite::memory:');
        $this->con->setAttribute(Connection::ATTR_ERRMODE, Connection::ERRMODE_EXCEPTION);
        $this->con->exec("
            DROP TABLE IF EXISTS status;
            CREATE TABLE status (
                id INT PRIMARY KEY,
                message VARCHAR(140) NOT NULL,
                userName VARCHAR(100) NOT NULL,
                publishDate DATETIME NOT NULL,
                client varchar(256)
            );");
    }

    public function testPersist()
    {
        $statusDataMapper = new StatusDataMapper($this->con);

        $rows = $this->con->query('SELECT COUNT(*) FROM status')->fetch(Connection::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $status = new Status(null, 'Hello World!', 'Julien', new \DateTime());
        $statusDataMapper->persist($status);
        $rows = $this->con->query('SELECT COUNT(*) FROM status')->fetch(Connection::FETCH_NUM);

        $this->assertEquals(1, $rows[0]);
    }

    public function testRemove()
    {
        $statusDataMapper = new StatusDataMapper($this->con);
        $status = new Status(null, 'Hello World!', 'Julien', new \DateTime());

        $this->assertEquals(true, $statusDataMapper->persist($status));
        $this->assertEquals(true, $statusDataMapper->remove($status));
    }
}