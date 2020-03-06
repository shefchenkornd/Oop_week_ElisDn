<?php

namespace lesson03\example5\demo08;

class Canvas
{
    public function paint(Point $point)
    {
        if ($point instanceof DecartPoint) {
            $x = $point->x;
            $y = $point->y;
            $z = $point->z;
        } elseif ($point instanceof CilindricalPoint) {
            $x = $point->r * cos($point->f);
            $y = $point->r * sin($point->f);
            $z = $point->h;
        } elseif ($point instanceof SphericalPoint) {
            $x = $point->r * cos($point->f) * sin($point->t);
            $y = $point->r * sin($point->f) * cos($point->t);
            $z = $point->r * cos($point->t);
        } else {
            throw new \Exception('Unsupported coordinat system');
        }

        return "[x = $x; y = $y; z = $z]\n";
    }
}

abstract class Point
{
    //
}

#################################################################

class DecartPoint extends Point
{
    public $x;
    public $y;
    public $z;
}

class CilindricalPoint extends Point
{
    public $x;
    public $y;
    public $z;
}

class SphericalPoint extends Point
{
    public $x;
    public $y;
    public $z;
}


#################################################################
$canvas = new Canvas();

$point = new DecartPoint();
$point->x = 5;
$point->y = 3;
$point->z = 4;
echo $canvas->paint($point);


$point = new CilindricalPoint();
$point->f = 2;
$point->r = -3;
$point->h = 2;
echo $canvas->paint($point);


$point = new SphericalPoint();
$point->r = 0;
$point->f = 8;
$point->t = 5;
echo $canvas->paint($point);
