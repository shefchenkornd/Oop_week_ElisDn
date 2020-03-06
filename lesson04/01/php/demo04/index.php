<?php

use demo04\graphics\Canvas;
use demo04\graphics\Point as BasePoint;
use demo04\points\Point;

$canvas = new Canvas();
$point = new Point(3,8,5);

$canvas->paint($point);

/**
 * НО ЕСЛИ МЫ ЗАПУСТИМ ЭТОТ КОД, ТО ПОЛУЧИМ ОШИБКУ:
 * Uncaught Error: Class 'demo04\graphics\Canvas' not found in ... [path]
 *
 * это всё потому что мы не include'ли наши файлы с Canvas | Point и т.д.
 */

echo get_class($canvas) . PHP_EOL;
echo get_class($point) . PHP_EOL;