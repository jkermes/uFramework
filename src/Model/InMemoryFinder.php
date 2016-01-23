<?php

namespace Model;

class InMemoryFinder implements FinderInterface
{
    private $store;

    public function __construct()
    {
        $this->store = array(
            '1' => array(
                'id' => '1',
                'message' => 'Hi! This is my first tweet!',
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'authorName' => 'Julien K.',
                'client' => 'Android 5.0'
            ),
            '2' => array(
                'id' => '2',
                'message' => 'Hello! This is my second tweet!',
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'authorName' => 'Julien K.',
                'client' => 'Android 5.0'
            )
        );
    }

    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->store;
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        if (!array_key_exists($id, $this->store)) {
            return $this->store[$id];
        }


    }
}