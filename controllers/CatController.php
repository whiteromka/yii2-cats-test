<?php

namespace app\controllers;

use app\models\Cat;
use app\models\CatSearch;
use app\components\CatCreator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatController implements the CRUD actions for Cat model.
 */
class CatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatSearch(); // Создаем поисковую модель

        //http://yii2-lessons.local/cat/index
        //?CatSearch[name]=
        //&CatSearch[breed]=Дворовый кот

//        Так выглядят params:
//        [
//            'CatSearch' => [
//                'id' => '',
//                'name' => 'Vasya',
//                '...'
//            ]
//        ]
        $params = $this->request->queryParams; // получить параметры поиска
        //$params = $_REQUEST; // получить параметры поиска
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Cat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Cat::findOne(['id' => $id]);
        if ($model) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Displays a single Cat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // http://yii2-lessons.local/cat/view?id=2
        $model = $this->findModel($id); // $id = 2 из ссылки в браузере
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Cat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cat();

        if ($this->request->isPost) { // Если запрос был отправлен через метод POST
            // и данные в модель были загружены
            // $model->age = $_POST['age'];
            // $model->... $_POST['class'];
            // ...
            if ($model->load($this->request->post())) {
                if ($model->save()) { // и кот был успешно сохранен в БД
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $cat = $this->findModel($id);
        $cat->delete();
        return $this->redirect(['index']);
    }

    /**
     * Создает N случайных котов
     * url: .../cat/create-cats
     */
    public function actionCreateCats(int $count = 10)
    {
        $creator = new CatCreator();
        $creator->create($count);
        $result = $creator->getInfo();

        return $this->render('create-cats', [
            'result' => $result
        ]);
    }
    // http://yii2-lessons.local/cat/create-cats/1000
    // http://yii2-lessons.local/site/about

    // http://yii2-lessons.local/cat/t
    public function actionT()
    {
        $data = [];
        $data['a'] = 1;
        $data['b'] = 2;
        $data['a'] = 3;

        debug($data);
    }
}
