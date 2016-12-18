<?php

namespace app\controllers;

use app\models\Statistics;
use IP2Location\Database;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Jenssegers\Agent\Agent;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $ip = $this->getRealIP();
        $sources = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : 'Truy cập trực tiếp';
        $dateLog = date('Y-m-d H:i:s');
        //IP2Location
        $ip2location = new Database(Yii::$app->basePath . '/storage/IP2LOCATION-LITE-DB3.BIN', Database::FILE_IO);
        $address = 'UNKNOW';
        try {
            $ip2locationData = $ip2location->lookup($ip, Database::ALL);
            $address = $ip2locationData['cityName'] . ' - ' . $ip2locationData['regionName'] . ' - ' . $ip2locationData['countryName'];
        } catch (\Exception $e) {
            Yii::trace($e->getMessage());
        }

        //Agent
        $agent = new Agent();
        $data = [
            'date_log' => $dateLog,
            'opera' => $agent->platform() . ' ' . $agent->version($agent->platform()),
            'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
            'sources' => $sources,
            'ip' => $ip,
            'address' => $address,
        ];
        $session = hash_hmac('sha256', json_encode($data), $dateLog);
        $data['sessions'] = $session;

        $sessions = Yii::$app->session;
        $visitor = isset($sessions['__visitor__']) ? $sessions->get('__visitor__') : $sessions->set('__visitor__', $session);

        if (!isset($visitor)) {
            $statistics = new Statistics();
            $statistics->attributes = $data;
            $statistics->save();
        }

        //ContactUS
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['mailTo'])) {
            //Save to database
            $statistics = Statistics::findOne(['sessions' => $visitor]);
            $postMail = Yii::$app->request->post('ContactForm');
            $dataMail = [
                'date_contact' => $dateLog,
                'full_name' => isset($postMail['name']) ? $postMail['name'] : null,
                'email' => isset($postMail['email']) ? $postMail['email'] : null,
                'phone' => isset($postMail['phone']) ? $postMail['phone'] : null,
                'content' => isset($postMail['body']) ? $postMail['body'] : null,
            ];
            $statistics->attributes = $dataMail;
            if($statistics->update()) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->refresh();
            }
        }


        $this->layout = 'landing-page';
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
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
        return $this->render('about');
    }

    function getRealIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }
	
	public function actionValidateForm() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new ContactForm();
        $model->load(Yii::$app->request->post());
        return ActiveForm::validate($model);
    }
}
