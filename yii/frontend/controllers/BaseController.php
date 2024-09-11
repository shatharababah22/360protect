<?php 




namespace frontend\controllers;

use Yii;
// use yii\base\Controller;

class BaseController extends \yii\web\Controller{
    public function init()
    {
        parent::init();

   
        $language = Yii::$app->request->get('language');
        if ($language !== null) {
            Yii::$app->language = $language;
            Yii::$app->session->set('language', $language);
        } else {
            Yii::$app->language = Yii::$app->session->get('language', 'en-US');
        }
    }
}
