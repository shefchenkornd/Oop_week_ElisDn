<?php

namespace lesson02\example03\demo19;

###############################


class Name
{
    public $first;
    public $last;

    public function __construct($first, $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    public function getFull()
    {
        return $this->last . ' ' . $this->first;
    }
}

class Phone
{
    public $code;
    public $number;

    public function __construct($code, $number)
    {
        $this->code = $code;
        $this->number = $number;
    }

    public function isEqualTo(Phone $phone)
    {
        return $this->code == $phone->code && $this->number == $phone->number;
    }
}

class PhonesCollection
{
    private $phones;

    public function __construct(array $phones)
    {
        foreach ($phones as $phone) {
            if (!$phone instanceof Phone) {
                throw new \InvalidArgumentException('Incorrect phone.');
            }
            $this->phones = $phones;
        }

    }

    public function add(Phone $phone)
    {
        foreach ($this->phones as $item) {
            if ($item->isEqualTo($phone)) {
                throw new \InvalidArgumentException('Phone already exists.');
            }
        }

        $this->phones[] = $phone;

    }

    public function remove(Phone $phone)
    {
        foreach ($this->phones as $i => $item) {
            if ($item->isEqualTo($phone)) {
                unset($this->phones[$i]);
                return;
            }
        }

        throw new \InvalidArgumentException('Phone not found.');
    }

    public function getAll()
    {
        return $this->phones;
    }
}

class Address
{
    public $country;
    public $region;
    public $city;
    public $street;
    public $house;

    public function __construct($country, $region, $city, $street, $house)
    {
        //..... do it!
    }
}

class Employee
{
    private $id;
    private $name;
    private $phones;
    private $address;

    /**
     * Employee constructor.
     *
     * @param                                             $id
     * @param \lesson02\example03\demo19\Name             $name
     * @param \lesson02\example03\demo19\PhonesCollection $phones
     * @param \lesson02\example03\demo19\Address          $address
     */
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


###############################


class StaffService
{
    public function recruitEmployee(Name $name, Phone $phone, Address $address)
    {
        $employee = new Employee($this->generateId(), $name, new PhonesCollection([$phone]), $address);
        $this->save($employee);

        return $employee;
    }

    public function addEmployeePhone($id, Phone $phone)
    {
        $employee = $this->find($id);
        $employee->addPhone($phone);
        $this->save($employee);
    }

    public function removeEmployeePhone($id, Phone $phone)
    {
        $employee = $this->find($id);
        $employee->removePhone($phone);
        $this->save($employee);
    }

    private function generateId()
    {
        return rand(10000, 90000);
    }

    private function find($id)
    {
        return null;
    }

    private function save($employee)
    {
        $file = __DIR__ . '/data/employee_' . $employee['id'] . '.php';
        file_put_contents($file, '<?php return ' . var_export($employee, true) . ';');
    }

}


###############################


$service = new StaffService();

$employee = $service->recruitEmployee(
  new Name('Вася', 'Пупкин'),
  new Phone(7, '9200000000'),
  new Address('Россия', 'Липецкая обл.', 'г. Пушкин', 'ул. Ленина', 1)
);

echo $employee->getName()->getFull();


###############################

$service->addEmployeePhone(1, new Phone(7, '9100000000'));