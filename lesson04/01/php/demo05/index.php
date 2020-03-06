<?php

use demo05\graphics\Canvas;
use demo05\graphics\Point as BasePoint;
use demo05\points\Point;

include_once __DIR__ . '/graphics/Point.php';
include_once __DIR__ . '/graphics/Canvas.php';
include_once __DIR__ . '/points/Point.php';

$canvas = new Canvas();
$point = new Point(3,8,5);

$canvas->paint($point);

echo get_class($canvas) . PHP_EOL;
echo get_class($point) . PHP_EOL;