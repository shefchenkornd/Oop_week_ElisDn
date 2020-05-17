<?php

namespace lesson04\example02\demo07;

/**
 * ИНКАПСУЛИРОВАНИЕ ИЗМЕНЧИВОСТИ (часть №2)
 *
 * два участка кода которые могут изменяться
 * первое - это хранилище, сессия / куку / БД и т.д.
 * второе - это подсчёт стоимости корзины с УЧЁТОМ СКИДОК
 *
 * ЧТОБЫ СДЕЛАТЬ КОРЗИНУ ЧИСТОЙ - НУЖНО ВЫНЕСТИ ЭТИ ИЗМЕНЯЮЩИЕСЯ ЧАСТИ В ОТДЕЛЬНЫЙ КОМПОНЕНТ
 * чтобы корзина использовоала эти компоненты внутри себя
 */

use StorageInterface;

class Cart
{
    protected $items;

    /**
     * Каждому программисту написать свой класс для своего FW
     * @var StorageInterface
     */
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

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
     * поэтому эту задачу нужно делигировать другому компоненту
     */
    public function getCost()
    {
        $this->loadItems();
        $cost = 0;
        /** @var CartItem $item */
        foreach ($this->items as $item) {
            $cost += $item->getCost();
        }

        /**
         * если день равен каждому 15-му числу месяца,
         * то скашиваем 5% скидки
         */
        if (date('d') === 15) {
            $cost *= 0.95;
        }

        /**
         * скидка на дату рождения
         */
        if ($user = \Yii::$app->user-identity) {
            if (date('m-d') === date('m-d', strtotime($user->birthDate))) {
                $cost *= 0.9;
            }
        }

        /**
         * если итоговая стоимость зашкаливает за 1000 РУБЛЕЙ,
         * ТО скидка еще 1%
         */
        if ($cost > 1000) {
            $cost *= 0.99;
        }

        return $cost;
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    private function loadItems()
    {
        if ($this->items === null) {
            $this->items = $this->storage->load();
        }
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    private function saveItems()
    {
        $this->storage->save($this->items);
    }
}