<?php

namespace lesson05\example02\d2\demo04;

use DirectoryIterator;

// The DirectoryIterator class provides a simple interface for viewing the contents of filesystem directories.
// это аналог функциональных функций scandir()
$dir = dirname(dirname(__DIR__));

$iterator =  new DirectoryIterator($dir);

foreach ($iterator as $item) {
	echo $item->isDir() ? 'Dir: ' : 'File: ';
	echo $item->getFilename() . PHP_EOL;
}

// анонимная функция - это объект типа Closure
$f = function () {};

var_dump($f);