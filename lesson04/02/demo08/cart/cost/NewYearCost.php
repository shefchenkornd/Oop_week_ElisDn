<?php

namespace lesson04\example02\demo08\cart\cost;
/**
 * Эффективнее работать с классом \DateTime
 * потому что с его помощью можно складывать/вычитать даты, форматировать и использовать прочие плюшки
 */

class NewYearCost implements CalculatorInterface
{
    private $next;
    private $month;
    private $percent;

    public function __construct(CalculatorInterface $next, \DateTime $month, $percent)
    {
        $this->next = $next;
        $this->month = $month;
        $this->percent = $percent;
    }

    /**
     * эта функция не совсем ЧИСТАЯ, ПОТОМУ ЧТО ОНА ЛЕЗЕТ ЕЩЕ ЗА ДАТОЙ
     * и для нас это будет проблемой протестировать этот функционал
     */
    public function getCost(array $items)
    {
        $cost = $this->next->getCost($items);

        if (date('m') === $this->month->format('m')) {
            return (1 - $this->percent / 100 ) * $cost;
        }

        return $cost;
    }
}

$simple = new SimpleCost();
$newYear = new NewYearCost($simple, 12, 5);
//... по скидкам можно дальше суммировать паровозиком =)
// принцип такой: мы вкладываем объекты в друг друга передавай их следующему

echo $newYear->getCost([]);