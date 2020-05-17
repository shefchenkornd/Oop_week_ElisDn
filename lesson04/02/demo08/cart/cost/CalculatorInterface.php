<?php

namespace lesson04\example02\demo08\cart\cost;

interface CalculatorInterface
{
    public function getCost(array $items);
}