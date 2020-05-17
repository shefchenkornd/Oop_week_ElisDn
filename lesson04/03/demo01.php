<?php


namespace lesson04\example03\demo01;

use SoapClient;

class SmsSender
{
    private $client;

    public function __construct($url, array $config)
    {
        $this->client = new \SoapClient($url, $config);
    }

    public function send($phone, $text)
    {
        return $this->client->SendMessage([
            'phone' => $phone,
            'text' => $text
        ]);
    }

}

$base = new SmsSender('https://api.megafon.ru/api/api.wsdl');
$base->send('+7908334322', 'Привет!');