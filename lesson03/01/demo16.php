<?php

namespace lesson03\example1\demo16;

/**
 * чем static отличается от self
 * тем что в self наследование работает только вверх к базовому классу, как для методов так и для констант, и свойств,
 * а в static (позднее статическое связывание) наследование работает туда и сюда
 * ниже пример
 * demo17 vs demo16
 */
class Base
{
    public static function first()
    {
        return 'first + ' . self::second();
    }

    public static function second()
    {
        return 'second_1';
    }
}

class Sub extends Base
{
    public static function first()
    {
        return 'first + ' . self::second();
    }

    public static function second()
    {
        return 'second_1';
    }
}



echo Base::first() . PHP_EOL;
echo Sub::first() . PHP_EOL;