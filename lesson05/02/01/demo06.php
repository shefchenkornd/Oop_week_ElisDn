<?php

/**
 * demo04 и demo05 реализовали сами методы интерфейса \Iterator - в общем херней занимались.
 * Как оказалось, существует уже готовый класс \ArrayIterator из стандартной библиотеки SPL
 */
class Collection implements IteratorAggregate {
    private $position = 0;
    private $array = [];

	public function __construct(array $array) {
        $this->array = $array;
        $this->position = 0;
    }

	public function getIterator()
	{
		return new \ArrayIterator($this->array);
	}
}

$collection = new Collection(
    [
        '1008',
        '2308',
        '3408',
        '4508',
        '5008',
    ]
);

foreach($collection as $key => $value) {
     var_dump($key, $value);
    echo "\n";
}