<?php

/**
 * здесь всё хорошо, кроме того, что все namespace у нас находятся в одном файле
 * в ИДЕАЛЕ ИХ НАДО РАСКИДАТЬ ПО ПАПКАМ.
 * СМ. lesson04/01/php/demo04
 */
namespace demo03\graphics
{
    interface Point
    {
        public function getCoordinates();
    }

    class Canvas
    {
        public function paint(Point $point)
        {
            list($x, $y, $z) = $point->getCoordinates();
            return "[x = $x; y = $y; z = $z]";
        }
    }
}

namespace demo03\points
{
    use demo03\graphics\Point as BasePoint;

    class Point implements BasePoint
    {
        public function getCoordinates()
        {
            //
        }
    }
}

/**
 * Мы можем создать namespace без имени, так можно
 * такой код попадёт в ГЛОБАЛЬНЫЙ namespace
 */
namespace {
    use demo03\graphics\Canvas;
    use demo03\graphics\Point as BasePoint;
    use demo03\points\Point;

    $canvas = new Canvas();
    $point = new Point(3,8,5);

    $canvas->paint($point);

    echo get_class($canvas) . PHP_EOL;
    echo get_class($point) . PHP_EOL;
}