<?php


class TransactionManager
{
    public function execute(callable $function)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            call_user_func($function);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}

class EmployeeService
{
    public function create()
    {
        // как вызвать этот класс TransactionManager с методом execute()
        $transaction = new TransactionManager();
        $transaction->execute(function () use ($employee, $contract, $recruit) { // оборачиваем в анонимную функцию наш код и передаем в класс TransactionManager
            $this->employeeRepository->add($employee);
            $this->contractRepository->add($contract);
            $this->recruitRepository->add($recruit);
        });
    }
}
