<?php

namespace lesson05\grasp\example01\demo08;

/** @var Order $order */
/**
 * Вот теперь понятно что делает!!!
 */
if ($order->isCancelable()) {
	echo '<button>Отменить заказ</button>';
}

/**
 * GRASP (General Responsibility Assigment Software Patterns - общие шаблоны распределения обязанностей):
 *  1. Information Expert (Информационный эксперт)
 *      Этот шаблон определяет базовый принцип назначения обязанностей: обязаннсть должна быть назначена тому объекту, который владеет
 *      максимумом необходимой информации для её выполнения - и такой объект называется ИНФОРМАЦИООНЫМ ЭКСПЕРТОМ.
 */
class Order
{
	const STATUS_NEW = 1;
	const STATUS_PAID = 2;
	const STATUS_SENT = 3;
	const STATUS_CANCEL = 4;

	public $status;
	public $deliveryDate;

	public function isNew()
	{
		return $this->status == self::STATUS_NEW;
	}

	public function isPaid()
	{
		return $this->status == self::STATUS_PAID;
	}

	public function isOnDelivery()
	{
		return $this->deliveryDate  < time() + 3600 * 72;
	}

	public function isCancelable()
	{
		return $this->isNew() || ($this->isPaid() && !$this->isOnDelivery());
	}
}