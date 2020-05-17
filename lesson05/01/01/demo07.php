<?php

namespace lesson05\grasp\example01\demo07;

/** @var Order $order */
/**
 * а то эти методы делают втроём - ещё не понятно!!!
 */
if ($order->isNew() || ($order->isPaid() && !$order->isOnDelivery())) {
	echo 'button';
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
}