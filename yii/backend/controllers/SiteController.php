<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Policy;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
                'class' => \yii\web\ErrorAction::class,
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
        return $this->render('index');
    }










    public function actionFetchSum()
{
    $startDate = Yii::$app->request->get('start_date');
    $endDate = Yii::$app->request->get('end_date');

    if ($startDate && $endDate) {
        $sumPrice = Policy::find()
            ->where(['status' => 1])
            ->andWhere(['between', 'created_at', strtotime($startDate), strtotime($endDate)])
            ->sum('price');

        $sumPrice = $sumPrice ?: 0;

        return $this->asJson([
            'success' => true,
            'sum' => $sumPrice,
        ]);
    }

    return $this->asJson(['success' => false]);
}


    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

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
    
        return $this->redirect(Url::to(['site/login'], true));
    }
}
