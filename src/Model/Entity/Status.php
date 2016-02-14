<?php

namespace Model\Entity;

use DateTime;

class Status
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var DateTime
     */
    private $publishDate;

    /**
     * @var string
     */
    private $client;

    /**
     * Status constructor.
     * @param $message
     * @param $userName
     * @param null $client
     */
    public function __construct($id, $message, $userName, $publishDate, $client = null)
    {
        $this->id = $id;
        $this->message = $message;
        $this->userName = $userName;
        $this->publishDate = new DateTime($publishDate);
        $this->client = $client;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @return null|string
     */
    public function getClient()
    {
        return $this->client;
    }
}