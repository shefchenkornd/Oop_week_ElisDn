<?php

namespace lesson04\example04\demo02;

use lesson04\example02\demo08\cart\cost\SimpleCost;
use lesson04\example02\demo08\cart\storage\SessionStorage;
use lesson04\example02\demo08\Cart;

###########################################################

/**
 * Мы на лету создаём необходимые классы, как в Laravel сервис-контейнеры this->app->bind(...)
 * Dependency injection
 *
 * Class Container
 */
class Container
{
    private $definitions = [];

    public function set($id, $callback)
    {
        $this->definitions[$id] = $callback;
    }

    public function get($id)
    {
        if (!isset($this->definitions[$id])) {
            throw new \Exception('Undefined component ' . $id);
        }

        return call_user_func($this->definitions[$id], $this);
    }
}


###########################################################

$container = new Container();
$container->set('cart.storage', function (Container $container) {
    return new SessionStorage('cart');
});

$container->set('cart.calculator', function (Container $container) {
    return new SimpleCost('cart');
});

$container->set('cart', function (Container $container) {
    return new Cart(
        $container->get('cart.storage'),
        $container->get('cart.calculator')
    );
});

###########################################################

/**
 * чтобы мы не захламляли нашу ОЗУ (иначе никакой памяти нам не хватило) мы на лету создадим необходимый класс,
 * который мы объявили выше
 */
$cart = $container->get('cart');
$cart->add(1, 3, 100);
print_r($cart->getItems());