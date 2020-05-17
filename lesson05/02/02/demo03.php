<?php

namespace lesson05\example02\d2\demo03;

// суть этой конструкции в том что у нас имеется вложенные массив данных
// проблема: по старинке мы его бы обходили рекурсивно
// а благодаря этим встроенным классам наш массив как бы вытягивается в одномерный массив и мы спокойно производит обход по нему
$iterator = new \RecursiveIteratorIterator(
	new \RecursiveArrayIterator(
		[
			1 => [
				[111, 112, 113],
				[121, 122, 123]
			],
			2 => [
				[211, 212, 213]
			]
		]
	)
);

foreach ($iterator as $item) {
	echo $item . PHP_EOL;
}