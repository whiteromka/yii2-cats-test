<?php

namespace app\controllers;

use app\models\Cat;
use Yii;
use yii\rest\Controller;

class MyApiCatController extends Controller
{
    public function beforeAction($action)
    {
        // Отключаем CSRF-валидацию для всех действий в этом контроллере
        $this->enableCsrfValidation = false;// csrf
        return parent::beforeAction($action);
    }

    private function response(
        bool $success,
        array $data = [],
        $error = [],
        int $statusCode = 200
    )
    {
        Yii::$app->response->statusCode = $statusCode;
        return [
            'success' => $success,
            'data' => $data,
            'error' => $error
        ];
    }

    /**
     * Получить кота по имени
     *
     * http://yii2-lessons.local/my-api-cat/get-by-name?name=A
     */
    public function actionGetByName(string $name)
    {
        $cat = Cat::find()->where(['name' => $name])->asArray()->one();
        if (!$cat) {
            return $this->asJson($this->response(false, [], 'Кот не найден!', 400));
        }
        return $this->asJson($this->response(true, $cat, ''));
    }

    /**
     * Добавить нового кота POST
     *
     * http://yii2-lessons.local/my-api-cat/add
     */
    public function actionAdd()
    {
        try {
            $jsonData = Yii::$app->request->getRawBody();
            $data = json_decode($jsonData, true);;
            $cat = new Cat();
            $cat->load(['Cat' => $data]);
            if ($cat->save()) {
                return $this->asJson($this->response(true, $data, ''));
            }
            return $this->asJson($this->response(false, [], $cat->getFirstErrors(), 400));
        } catch (\Exception $e) {
            return $this->asJson($this->response(false, [], 'произошла ошибка! ' . $e->getMessage(), 500));
        }
    }

    /**
     * Удалить кота DELETE
     *
     * http://yii2-lessons.local/my-api-cat/v1/delete/12
     */
    public function actionDelete(int $id)
    {
        $countDeleted = Cat::deleteAll(['id' => $id]);
        return $this->asJson($this->response(true, ['deleted' => $countDeleted], ''));
    }
}