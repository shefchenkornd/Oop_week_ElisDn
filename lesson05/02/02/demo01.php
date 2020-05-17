<?php

namespace lesson05\example02\d2\demo01;

// in ArrayObject implements IteratorAggregate, ArrayAccess, Serializable, Countable
$phones = new \ArrayObject(['801', '802', '803', '804']);
$phones->append('805');

foreach ($phones as $phone) {
	echo $phone . PHP_EOL;
}

echo $phones->serialize();