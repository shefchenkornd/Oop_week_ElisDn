<?php

namespace lesson04\example02\demo08\cart\cost;

class SimpleCost implements CalculatorInterface
{
    public function getCost(array $items)
    {
        $cost = 0;
        /** @var CartItem $item */
        foreach ($items as $item) {
            $cost += $item->getCost();
        }

        return $cost;
    }
}
