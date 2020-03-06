<?php

namespace lesson03\example4\demo06;

/**
 * оптимально использовать интерфейсы там где абстрактный классы, будет жирно использовать.
 * а нам нужно убедитсья что нужные методы будут в классе Table.
 * Плюс к этому интерфейсы поддерживают множественное наследование
 */

interface Measurable
{
    const ACTIVE = true;

    public function getWidth();
    public function getHeight();
}

class Measurer
{
    public function maxSize(Measurable $obj)
    {
        return max($obj->getWidth(), $obj->getHeight());
    }
}

class Table implements Measurable
{
    public function getWidth()
    {
        return 95;
    }

    public function getHeight()
    {
        return 12;
    }
}

class Kettle implements Measurable
{
    public function move($x, $y) { /***/ }
    public function getWidth() { return 9; }
    public function getHeight() { return 2; }
    public function getColor() { return 0xFF0000; }
}

$measurer = new Measurer();
$table = new Table();

echo $measurer->maxSize($table) . PHP_EOL;