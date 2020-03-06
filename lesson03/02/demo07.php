<?php

namespace lessons03\example02\demo07;

/**
 **************************************************
 *              ДЕЛЕГИРОВАНИЕ
 * ************************************************
 * Используем делегирование в классах парсер и обменник
 * где нам необходимо получить HTML-код страницы для дальнейших действий.
 * Получением занимается класс Loader, ему мы и делегируем данную работу
 */

class Loader
{
    public function load($url)
    {
        return file_get_contents($url);
    }
}

class Parser
{
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getPage($url)
    {
        return $this->loader->load($url);
    }
}

class Exchanger
{
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getRate($currency)
    {
        return $this->loader->load('...?id=' . $currency);
    }
}

$loader = new Loader();

$parser = new Parser($loader);
$parser->getPage('...');

$exchanger = new Exchanger($loader);
$exchanger->getRate('USD');