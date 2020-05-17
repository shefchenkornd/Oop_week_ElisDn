<?php

/**
 * мы реализовали поведение class Collection как массив, и теперь можно его использовать c оператором foreach
 */

class Collection implements Iterator {
    private $position = 0;
    private $array = [];

    public function __construct(array $array) {
        $this->array = $array;
        $this->position = 0;
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