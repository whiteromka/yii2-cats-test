<?php

namespace app\controllers;

use app\models\Cat;
use app\models\CatPic;
use app\models\CatSearch;
use app\components\CatCreator;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CatPicForm;
use yii\web\UploadedFile;

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

    public function actionPic(int $id)
    {
        $model = new CatPicForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload($id)) {
                Yii::$app->session->setFlash('success', 'Картинки успешно загружены');
                return $this->redirect(['index']);
            }
        }
        return $this->render('pic', [
            'id' => $id,
            'model' => $model
        ]);
    }

    /**
     * /cat/all
     */
    public function actionAll()
    {
        $query = Cat::find()->orderBy(['price' => SORT_ASC]); // Объект запроса
        $countQuery = clone $query; // !!!
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $cats = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('all', [
            'cats' => $cats,
            'pages' => $pages,
        ]);
    }

    public function actionMakePicMain(int $picId)
    {
        // - Все картинки для этого кота сделать is_main = 0

        // - Картинку с $picId сделать главной // update cat_pic set is_main = 1 where id = 1;
        $catPic = CatPic::find()->where(['id' => $picId])->one();
        if ($catPic) {
            $catPic->is_main = 1;
            $catPic->save();
        }
        return $this->redirect(['/cat/index']);
    }
}
