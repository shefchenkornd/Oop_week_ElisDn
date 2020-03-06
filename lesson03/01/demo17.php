<?php

namespace lesson03\example1\demo17;

/**
 * чем static отличается от self
 * тем что в self наследование работает только вверх к базовому классу, как для методов так и для констант, и свойств,
 * а в static (позднее статическое связывание) наследование работает туда и сюда
 * ниже пример
 * demo17 vs demo16
 */

class Base
{
    const ACTIVE = 1;

    public static function first()
    {
        return 'first + ' . static::second();
    }

    public static function second()
    {
        return 'second_1';
    }

    public function my_const_self()
    {
        return self::ACTIVE;
    }

    public function my_const_static()
    {
        return static::ACTIVE;
    }
}

class Sub extends Base
{
    const ACTIVE = 2;

    public static function first()
    {
        return 'first + ' . static::second();
    }

    public static function second()
    {
        return 'second_2';
    }
}



echo Base::first() . PHP_EOL;
echo Sub::first() . PHP_EOL;

$sub = new Sub();
echo $sub->my_const_self() . PHP_EOL;
echo $sub->my_const_static() . PHP_EOL;
