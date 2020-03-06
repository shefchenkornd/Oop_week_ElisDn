<?php

namespace lesson04\example02\demo03;

class CartController
{
    public function actionIndex()
    {
        $item = Yii::$app->cart->getItems();

        return $this->render('index', ['items' => $item]);
    }

    public function actionAdd($id, $count = 1)
    {
        $product = $this->findModel($id);

        Yii::$app->cart->add($product);

        return $this->render('index');
    }

    public function actionRemove($id)
    {
        Yii::$app->cart->add($id);

        return $this->render('index');
    }

    /**
     * Кидание Http ошибок задача контроллера, а не внутренних компонентов
     * @param $id
     * @return mixed
     */
    private function findModel($id)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException('Товар не найден.');
        }

        return $product;
    }
}