<?php

namespace lesson04\example02\demo06;

/**
 * ИНКАПСУЛИРОВАНИЕ ИЗМЕНЧИВОСТИ
 *
 * два участка кода которые могут изменяться
 * первое - это хранилище, сессия / куку / БД и т.д.
 * второе - это подсчёт стоимости корзины с УЧЁТОМ СКИДОК
 *
 * ЧТОБЫ СДЕЛАТЬ КОРЗИНУ ЧИСТОЙ - НУЖНО ВЫНЕСТИ ЭТИ ИЗМЕНЯЮЩИЕСЯ ЧАСТИ В ОТДЕЛЬНЫЙ КОМПОНЕНТ
 * чтобы корзина использовоала эти компоненты внутри себя
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
    public function add($id, $count, $price)
    {
        $this->loadItems();
        $current = isset($this->items[$id]) ? $this->items[$id] : 0;
        $this->items[$id] = new CartItem($id, $current + $count, $price);
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
     * этот метод - один из самых частно МЕНЯЮЩИХСЯ ЧАСТЕЙ КОРЗИНЫ
     * могут добавиться скидки от маркетолога
     */
    public function getCost()
    {
        $this->loadItems();
        $cost = 0;
        /** @var CartItem $item */
        foreach ($this->items as $item) {
            $cost += $item->getCost();
        }

        return $cost;
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