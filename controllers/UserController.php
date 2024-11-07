<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSearch()
    {
        $user = new User();

        // это одно и тоже
//        $post = $_POST;
//        $old = \Yii::$app->request->post();
//        $new = $this->request->post();

        $foundUsers = [];
        $data = $this->request->post(); // Данные из поста
        //                         это включение валидации
        if ($user->load($data /*&& $user->validate()*/ )) {
            /*
             Пробуем найти в БД всех пользователей по зпаросу из post()
             $foundUsers = User::find()->where(['name' => $user->name])->limit(2)->all();// [] / User[]
             $foundUsers = User::find()->limit(2)->all(); // получить первые 2-е записи из БД

            // SELECT * FROM `user` WHERE (`name` LIKE '%o%') AND (`email` LIKE '%%')
            $foundUsers = User::find()
                ->where(['like', 'name', $user->name])
                ->andWhere(['like', 'email', $user->email])
                ->all(); // получить всех из БД у кого имя похоже на ...

            // SELECT * FROM `user` ...
            */
            $foundUsers = User::find()
                ->filterWhere(['like', 'name', "$user->name%", false]) // !!!
                // ->filterWhere("name like 'r%'") // Это тоже что и сверху
                ->andFilterWhere(['like', 'email', $user->email])
                ->andFilterWhere(['status_id' => $user->status_id])
                ->all();
        }
        return $this->render('search', [
            'user' => $user,
            'foundUsers' => $foundUsers
        ]);
    }

    public function actionSearch2()
    {
        $user = new User();
        $foundUsers = [];

        $name = null;
        if (!empty($_POST['User']['name'])) {
            $name = $_POST['User']['name'];
        }

        $email = null;
        if (!empty($_POST['User']['email'])) {
            $email = $_POST['User']['email'];
        }

        $status = null;
        if (!empty($_POST['User']['status'])) {
            $name = $_POST['User']['status'];
        }

        if (!empty($name) || !empty($email) || !empty($status)) {
            $foundUsers = User::find()
                ->filterWhere(['like', 'name', "$name%", false])
                ->andFilterWhere(['like', 'email', $email])
                ->andFilterWhere(['status' => $status])
                ->all();

            // SELECT
            // * FROM user
            // WHERE name LIKE 'r%'
            // AND email LIKE '%@%'
            // AND status = 1
            // LIMIT 1
        }
        return $this->render('search', [
            'user' => $user,
            'foundUsers' => $foundUsers
        ]);
    }
}
