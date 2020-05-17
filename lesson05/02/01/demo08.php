<?php

/**
 * demo04 и demo05 реализовали сами методы интерфейса \Iterator - в общем херней занимались.
 * Как оказалось, существует уже готовый класс \ArrayIterator из стандартной библиотеки SPL
 */
class Collection implements IteratorAggregate, ArrayAccess, Serializable
{
	private $position = 0;
	private $array = [];

	public function __construct(array $array)
	{
		$this->array = $array;
		$this->position = 0;
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->array);
	}

	##################################################
	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->array);
	}

	public function offsetGet($offset)
	{
		return $this->array[$offset];
	}

	public function offsetSet($offset, $value)
	{
		if ($this->has($value)) {
			throw new \DomainException("Item already exists.");
		}

		if ($offset) {
			$this->array[$offset] = $value;
		} else {
			$this->array[] = $value;
		}
	}

	public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }
    ##################################################

	public function serialize()
	{
		return implode(";", $this->array);
	}

	public function unserialize($serialized)
	{
		$this->array = explode(";", $serialized);
	}

	##################################################
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

foreach ($collection as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}

$a = [["43"], "3df", 77, 88];
var_dump(serialize($a));