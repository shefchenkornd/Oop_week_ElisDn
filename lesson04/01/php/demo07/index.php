<?php

use demo08\graphics\Canvas;
use demo08\graphics\Point as BasePoint;
use demo08\points\Point;

/**
 * Пишем свой АВТОЗАГРУЗЧИК ФАЙЛОВ
 */

function autoload($class) {
    require_once dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
}

spl_autoload_register('autoload');

$canvas = new Canvas();
$point = new Point(3,8,5);

$canvas->paint($point);

echo get_class($canvas) . PHP_EOL;
echo get_class($point) . PHP_EOL;