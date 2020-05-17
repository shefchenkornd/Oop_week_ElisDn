<?php

/**
 * вместо интерфейса \Iterator, можно использовать другой интерфейс \IteratorAggregate
 * какую проблему он решает:
 *      к примеру, в нашей коллекции уже есть методы current(), key() и прочие, которые мы должны реализовать из интерфейса \Iterator
 *      что же нам делать???
 *      к нам на помощь придёт другой интерфейс \IteratorAggregate и его метод getIterator()
 *      который должен вернуть класс-Collection, реализующую интерфейс \Iterator
 *      таким образом наш основной класс Collection чистый, а всю реализацию мы сделали с помощью \IteratorAggregate
 */
class CollectionIterator implements Iterator {
	private $array = [];

	public function __construct(array $array) {
		$this->array = $array;
	}

	public function rewind() {
		// var_dump(__METHOD__);
		$this->position = 0;
	}

	public function current() {
		// var_dump(__METHOD__);
		return $this->array[$this->position];
	}

	public function key() {
		// var_dump(__METHOD__);
		return $this->position;
	}

	public function next() {
		// var_dump(__METHOD__);
		++$this->position;
	}

	public function valid() {
		// var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}
}

class Collection implements IteratorAggregate {
    private $position = 0;
    private $array = [];

	public function __construct(array $array) {
		$this->array = $array;
		$this->position = 0;
	}

    public function getIterator()
    {
	    return new \CollectionIterator(array_values($this->array));
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