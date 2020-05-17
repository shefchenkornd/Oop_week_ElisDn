

#############    Правильная схема   ############


Запрос -> Контроллер -> Модель


################################################


<?php
/**
 * Решение проблемы:
 * избавить Post::beforeSave() от внешних зависимостей
 * и перенести всё это в контроллер или в сервисный слой
 */

class Post extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
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
        $model->user_id = Yii::$app->user->id;
        $model->user_ip = Yii::$app->request->userIP;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}


?>