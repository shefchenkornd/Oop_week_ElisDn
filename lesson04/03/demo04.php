<?php


namespace lesson04\example03\demo03;

use SoapClient;

/**
 * Для тестов можно создать ФИКТИВНЫХ SoapClient
 */
class DummySoapClient extends SoapClient
{
    public function __construct()
    {
        parent::__construct(null);
    }

    public function SendMessage($params)
    {
        return true;
    }
}


class SmsSender
{
    private $client;

    public function __construct(SoapClient $client)
    {
        $this->client = $client;
    }

    public function send($phone, $text)
    {
        return $this->client->SendMessage([
            'phone' => $phone,
            'text' => $text
        ]);
    }

}

// ДЛЯ РАБОТЫ
$client = new SoapClient('https://api.megafon.ru/api/api.wsdl');
$base = new SmsSender($client);
$base->send('+7908334322', 'Привет!');

// ДЛЯ ТЕСТИРОВАНИЯ
$client = new DummySoapClient();
$base = new SmsSender($client);
$base->send('+7908334322', 'Привет!');