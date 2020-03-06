<?php

namespace lesson03\example4\demo01;

class Measurer
{
    public function maxSize($obj)
    {
        return max($obj->getWidth(), $obj->getHeight());
    }
}