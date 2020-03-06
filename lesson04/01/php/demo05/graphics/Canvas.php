<?php

namespace demo05\graphics;

/**
 * Ключевое слово namespace должно быть написано в самом верху
 */

class Canvas
{
    public function paint(Point $point)
    {
        list($x, $y, $z) = $point->getCoordinates();
        return "[x = $x; y = $y; z = $z]";
    }
}