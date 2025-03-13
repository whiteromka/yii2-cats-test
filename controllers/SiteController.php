<?php

namespace app\controllers;

use app\components\YandexWeatherCurl;
use app\models\Cat;
use Yii;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    // site/curl?lat=1&lon=2
    public function actionCurl(float $lat, float $lon)
    {
        $data = (new YandexWeatherCurl($lat, $lon))->request();
        return $this->asJson($data);
    }

    // /site/client
    public function actionClient()
    {
        $client = new Client();
        $url = 'https://api.weather.yandex.ru/v2/forecast?lat=55.7558&lon=37.6178';
        $keyName = 'X-Yandex-Weather-Key';
        $secretKey = Yii::$app->params['YW'];
        $result =  $client
            ->createRequest()
            ->setHeaders([$keyName => $secretKey])
            ->setMethod('GET')
            ->setUrl($url)
            ->send();
        $result = $result->getData();

        debug($result);
        die('!!!');
    }

    public $layout = 'mainDesign';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // cat-api/cat/

    /** /site/index
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*
        // Одна из будущих тем:
        // 1 https://www.yiiframework.com/doc/guide/2.0/ru/start-databases
        // 2 https://www.yiiframework.com/doc/guide/2.0/ru/db-query-builder

        //$catX = Cat::find()->where(['name' => 'Myrzik']);
        //$sql =  $catX->createCommand()->getRawSql();

          // Пример прямого запроса к БД на вставку данных!
//        $db = Yii::$app->getDb();
//        $db->createCommand('INSERT INTO `cat` (`name`) VALUES (:name)', [
//            ':name' => 'Qiang',
//        ])->execute();

//        $db = Yii::$app->getDb();
//        $someCast = $db->createCommand('SELECT * FROM cat WHERE name = :name', [
//            ':name' => 'Vasay',
//        ])->queryAll();
        */
        $catName = Yii::$app->request->get('catName');
        $cat = Cat::find()->where(['name' => 'Myrzik'])->one();
        $cats = Cat::find()->orderBy('price DESC')->where(['name' => $catName])->limit(100)->all();
        $catsSqlQuery = Cat::find()->limit(10)->orderBy('price DESC')->createCommand()->rawSql;

//        $carBmwX5 = Car::find()
//            ->where(['name' => 'bmw'])
//            ->andWhere(['mark' => 'x5'])
//            ->one();
//        $account = Account::find()->where(['email' => 'anna@yandex.ru'])->one();
//        $usersEmail = ['anna@yandex.ru111', 'rom@yandex.ru1111'];
//        $accounts = Account::find()->where(['email' => $usersEmail])->all();

        return $this->render('index', [
            'cat' => $cat,
            'cats' => $cats,
            'catsSqlQuery' => $catsSqlQuery
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        // Если все хорошо то
        $model = new LoginForm();
        // load - загрузить данные в модель для обработки
        //               .......$_POST............
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }


        // остальные случаи
        $model->username = 'вы неугадали';
        $model->password = '!!!!';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (
            $model->load(Yii::$app->request->post())
            && $model->contact(Yii::$app->params['adminEmail'])
        ) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        // About >>>> http://yii2-lessons.local/index.php?r=site%2Fabout
                      //http://yii2-lessons.local/site/about

        // Contact >>> http://yii2-lessons.local/index.php?r=site%2Fcontact
        //             http://yii2-lessons.local/site/contact


        // 1 model >>>> data
        //$user = User::find()->where(['id'=>1])->one();
        $user = [
            'name' => 'Rom',
            'age' => 34
        ];
        $passport = '12334 32432';
        $userList = ['Rom', 'Anna', 'Bob']; // User::find()->all()->names();

        // return $this->render('about');
        return $this->render('about', [
            'user' => $user,
            'passport' => $passport,
            'userList' => $userList
        ]);
    }

    public function actionTest()
    {
        return $this->render('test', [
            'name' => 'Rom!!!!!!!!',
        ]);
    }

    /**
     * url: site/search
     */
    public function actionSearch()
    {
        $cat = new Cat();
        $isLoad = false;
        $dataFromGET = Yii::$app->request->get();
        //$dataFromGET = $_GET;

        // реализация Артура
//        if (!empty($dataFromGET['name'])) {
//            $foundCats = Cat::find()->where(['name' => $cat->name])->all();
//        }

        $foundCats = [];
        if ($cat->load($dataFromGET)) {
            $isLoad = true;
            $foundCats = Cat::find()->where(['name' => $cat->name])->all();
        }

        return $this->render('search', [
            'cat' => $cat,
            'isLoad' => $isLoad,
            'foundCats' => $foundCats
        ]);
    }

}


$data = array(
    'name'  => 'Маффин',
    'price' => 100.0
);

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

$res = json_encode($res, JSON_UNESCAPED_UNICODE);
print_r($res);
