<?php


class SessionStorage implements StorageInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function load()
    {
        return isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : [];
    }

    public function save(array $items)
    {
        $_SESSION[$this->key] = serialize($items);
    }

}