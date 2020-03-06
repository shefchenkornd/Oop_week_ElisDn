<?php

namespace lesson04\example02\demo05;

use Sympony\Component\HttpFoundation\Session\Session;

/**
 * ЗАДАЧА (часть №2):
 * в одном месте сохраняем в cookie, а в другом месте в $_SESSION
 * а в третьем проекте - корзину для авторизованных пользователей сохраняем в БД, чтобы они могли авторизоваться из любого устройства на нашем сайте
 * и легко управлять своей корзиной!
 */

/**
 * Наследуем от супер-класса Cart и создаем низко-уровневый код под Sympony
 * аналогично под Laravel и Yii
 */
class SymfonyCart extends Cart
{
    private $session;
    private $sessionKey;

    public function __construct(Session $session, $sessionKey='cart')
    {
        $this->session = $session;
        $this->sessionKey = $sessionKey;
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    protected function loadItems()
    {
        if ($this->items === null) {
            $this->items = $this->session->get($this->sessionKey, []);
        }
    }

    /**
     * этот метод - изменяемый код, низкоуровневый
     */
    protected function saveItems()
    {
        $this->session->set($this->sessionKey, $this->session);
    }
}