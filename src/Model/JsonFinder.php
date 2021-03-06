<?php

namespace Model;

class JsonFinder implements FinderInterface
{
    private $filePath;

    private $store;

    public function __construct()
    {
        $this->filePath = __DIR__.'/../../app/storage.json';
        $this->store = json_decode(file_get_contents($this->filePath), true);
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
     * @param mixed $id
     *
     * @return null|mixed
     */
    public function findOneById($id)
    {
        return $this->store[$id - 1] ?? null;
    }

    public function add($data)
    {
        $this->store[] = $data;
    }

    public function remove($id)
    {
        if (isset($this->store[$id - 1])) {
            unset($this->store[$id - 1]);
        }
    }

    public function persist()
    {
        file_put_contents($this->filePath, json_encode($this->store));
    }
}
