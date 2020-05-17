<?php

/**
 * в данном случае класс Cart выступает в роли Контроллера, который перенаправляет работу на другие классы
 * причём эти классы не знаю о существовании друг друга!
 */
class Cart
{
	protected $items;
	protected $storage;
	protected $calculator;

	public function __construct(SessionStorage $storage, Calculator $calculator)
	{
		$this->storage = $storage;
		$this->calculator = $calculator;
	}
}


class SessionStorage
{

	public function load() {}
	public function save(array $items) {}

}

class Calculator
{
	public function getCost(array $items) {}
}