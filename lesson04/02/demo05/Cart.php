<?php

namespace lesson04\example02\demo05;

/**
 * ЗАДАЧА (часть №1):
 * в одном месте сохраняем в cookie, а в другом месте в $_SESSION
 * а в третьем проекте - корзину для авторизованных пользователей сохраняем в БД, чтобы они могли авторизоваться из любого устройства на нашем сайте
 * и легко управлять своей корзиной!
 */



/**
 * Мы должны создать гибкую архитектуру (с высокоуровневым и низкоуровневым кодом), для этого:
 *
 * создаем основной класс с БИЗНЕС-ЛОГИКОЙ (высокоуровневый код)
 * бизнес-правила будут доступны в виде публичных (public) методов - это будет своего рода верхняя абстакция над любыми фреймворками, если мы захотим их поменять
 *
 * А protected методы (loadItems | saveItems) будут отвечать за низкоуровневую реализацию, которая будет уникальна для каждого FW,
 * на каждом FW будем создавать СВОЙ КЛАСС-АДАПТЕР И НАСЛЕДОВАТЬ ЕГО ОТ основного класса CART
 */
class Cart
{
    protected $items;

    /**
     * этот метод - бизнес-логика, которая не зависит от FW
     */
    public function getItems()
    {
        $this->loadItems();
        return $this->items;
    }


    /**
     * этот метод - бизнес-логика, которая не зависит от FW
     */
    public function add($id, $count)
    {
        $this->loadItems();
        $current = isset($this->items[$id]) ? $this->items[$id] : 0;
        $this->items[$id] = $current + $count;
        $this->saveItems();
    }

    /**
     * этот метод - бизнес-логика, которая не зависит от FW
     */
    public function remove($id)
    {
        $this->loadItems();
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }

        $this->saveItems();
    }

    /**
     * этот метод - бизнес-логика, которая не зависит от FW
     */
    public function clear()
    {
        $this->items = [];
        $this->saveItems();
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    protected function loadItems()
    {
        if ($this->items === null) {
            $this->items = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : [];
        }
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    protected function saveItems()
    {
        if ($this->items === null) {
            $this->items = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : [];
        }
    }
}