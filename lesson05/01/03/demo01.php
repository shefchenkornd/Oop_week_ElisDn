

#############      Ошибочная схема     ###################


         User <-------
                       \
Запрос -> Контроллер -> Модель
  ^                    /
  ⌊-------------------


##########################################################

<?php

/**
 * Проблема:
 * в модели Post::beforeSave() сама лезет через глобальный сервис контейнер (локатор):
 *  - в User модель, чего она делать не должна
 *  - класс Request, где запрашивает user IP, чего модель не должна делать
 * тем самым нарушается архитектурная граница!!!
 */

class Post extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = Yii::$app->user->id;
                $this->user_ip = Yii::$app->request->userIP;
                $this->created_at = time();
            }

            return true;
        }

        return false;
    }
}

class PostController extends Controller
{
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}


?>