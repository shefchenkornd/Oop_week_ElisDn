<?php


/**
 * а внутри каждого модуля / класса связанность методов и данных должна быть высокая, так сказать на одной волне.
 */
class Employee
{
	private $id;
	private $name;
	private $phones;
	private $address;

	public function __construct($id, Name $name, PhonesCollection $phones, Address $address)
	{
		$this->id = $id;
		$this->name = $name;
		$this->phones = $phones;
		$this->address = $address;
	}

	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getPhones() { return $this->phones->getAll(); }
	public function getAddress() { return $this->address; }

	public function rename(Name $name)
	{
		$this->name = $name;
	}

	public function addPhone(Phone $phone)
	{
		$this->phones->add($phone);
	}

	public function removePhone(Phone $phone)
	{
		$this->phones->remove($phone);
	}

	public function changeAddress(Address $address)
	{
		$this->address = $address;
	}
}
