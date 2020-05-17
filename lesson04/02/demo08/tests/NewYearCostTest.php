<?php


namespace lesson04\example02\demo08\tests;

use lesson04\example02\demo08\cart\cost\SimpleCost;
use lesson04\example02\demo08\cart\cost\NewYearCost;


class NewYearCostTest extends \PHPUnit_Framework_TestCase
{
    public function testAction()
    {
        $calculator = new NewYearCost(new SimpleCost(1000), 12, 5);
        $calculator->equal(950, $calculator->getCost([]));
    }

    public function testNone()
    {
        $calculator = new NewYearCost(new SimpleCost(1000), 6, 5);
        $calculator->equal(950, $calculator->getCost([]));
    }
}