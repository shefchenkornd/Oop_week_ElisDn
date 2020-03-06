<?php

use demo08\graphics\Canvas;
use demo08\graphics\Point as BasePoint;
use demo08\points\Point;

/**
 * используем СТАНДАРТНЫЙ АВТОЗАГРУЗЧИК от COMPOSER
 * Шаги:
 * 1) создаем composer.json файл
 * 2) выполняем "composer install"
 * 3) и указываем путь до autoload.php с помощью require_once (см. ниже)
 */

require_once __DIR__ . '/vendor/autoload.php';

$canvas = new Canvas();
$point = new Point(3,8,5);

$canvas->paint($point);

echo get_class($canvas) . PHP_EOL;
echo get_class($point) . PHP_EOL;