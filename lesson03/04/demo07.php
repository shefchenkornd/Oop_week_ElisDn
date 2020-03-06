<?php

namespace lesson03\example4\demo07;

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

interface Movable
{
    public function move($x, $y);
}

interface Visible
{
    public function getPoligons();
}

class Measurer
{
    public function maxSize(Measurable $obj)
    {
        return max($obj->getWidth(), $obj->getHeight());
    }
}

class Physics {
    public function push(Movable $obj, $x, $y) {
        $obj->move($x, $y);
    }
}

/**
 * те. стол имеет размеры, он видимый, но его нельзя сдвинуть
 */
class Table implements Measurable, Visible
{
    public function getWidth() { return 95; }
    public function getHeight() { return 12; }
    public function getColor() { return 0xFF0000; }
    public function getPoligons() { return []; }
}

/**
 * те. Чайник также имеет размеры, он видимый и его МОЖНО сдвинуть!
 */
class Kettle implements Measurable, Movable, Visible
{
    public function move($x, $y) { /***/ }
    public function getWidth() { return 9; }
    public function getHeight() { return 2; }
    public function getColor() { return 0xFF0000; }
    public function getPoligons() { return []; }
}

$measurer = new Measurer();
$table = new Table();

echo $measurer->maxSize($table) . PHP_EOL;