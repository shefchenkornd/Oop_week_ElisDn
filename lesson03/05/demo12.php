<?php

namespace lesson03\example5\demo12;

/**
 * ПОЛИМОРФИЗМ + ИНКАПСУЛЯЦИЯ
 * здесь мы реализовали полиморфизм, благодаря интерфейсу, те. всеядность
 * метода Canvas->paint(Point $point)
 * ИНКАПСУЛЯЦИЯ - скрыли схему работы в сами классы реализуюищие интерфейс Point
 */

interface Point
{
    public function getPointCoordinates();
}

class Canvas
{
    public function paint(Point $point)
    {
        list($x, $y, $z) = $point->getPointCoordinates();
        return "[x = $x; y = $y; z = $z]\n";
    }
}

#################################################################

/**
 * Class DecartPoint
 * @package lesson03\example5\demo12
 */
class DecartPoint implements Point
{
    private $x;
    private $y;
    private $z;

    public function __construct($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function getPointCoordinates()
    {
        return [
            $this->x,
            $this->y,
            $this->z
        ];
    }
}

/**
 * Class CilindricalPoint
 * @package lesson03\example5\demo12
 */
class CilindricalPoint implements Point
{
    private $f;
    private $r;
    private $h;

    public function __construct($f, $r, $h)
    {
        $this->f = $f;
        $this->r = $r;
        $this->h = $h;
    }

    public function getPointCoordinates()
    {
        return [
            $this->r * cos($this->f),
            $this->r * sin($this->f),
            $this->h
        ];
    }
}

/**
 * Class SphericalPoint
 * @package lesson03\example5\demo12
 */
class SphericalPoint implements Point
{
    private $r;
    private $f;
    private $t;

    public function __construct($r, $f, $t)
    {
        $this->r = $r;
        $this->f = $f;
        $this->t = $t;
    }

    public function getPointCoordinates()
    {
        return [
            $this->r * cos($this->f) * sin($this->t),
            $this->r * sin($this->f) * cos($this->t),
            $this->r * cos($this->t)
        ];
    }
}

$canvas = new Canvas();

echo $canvas->paint(new DecartPoint(5,7,-1));
echo $canvas->paint(new CilindricalPoint(8,1,-21));
echo $canvas->paint(new SphericalPoint(3,4,5));