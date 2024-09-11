<?php

namespace backend\controllers;

use common\models\Plans;
use common\models\PlansCoverage;
use common\models\PlansCoverageSearch;
use common\models\PlansItems;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii;


use yii\data\Pagination;

/**
 * CoverageController implements the CRUD actions for PlansCoverage model.
 */
class CoverageController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Allow only authenticated users
                        ],
                    ],
                ],
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
     * Lists all PlansCoverage models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PlansCoverageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          
        ]);
    }

    /**
     * Displays a single PlansCoverage model.
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
     * Creates a new PlansCoverage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PlansCoverage();
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $item = PlansItems::findOne($model->item_id);
                if ($item) {
                    $insuranceId = $item->insurance_id;
                    $planCount = Plans::find()->where(['insurance_id' => $insuranceId])->count();
                    $existingCoverage = PlansCoverage::find()
                        ->where(['item_id' => $model->item_id,'plan_id' => $model->plan_id])
                        ->one();
                        // dd($existingCoverage );
                    if ($existingCoverage) {
                        Yii::$app->session->setFlash('error', 'The coverage already exists.');
                        return $this->redirect(['create']);
                    }
                    
                    $coverageCount = PlansCoverage::find()
                        ->where(['item_id' => $model->item_id])
                        ->count();
                    
                    if ($coverageCount >= $planCount) {
                        Yii::$app->session->setFlash('error', 'The number of coverages exceeds the number of plans for the associated insurance.');
                    } else {
                        if ($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Invalid item ID.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    
    
    public function actionFetchInsurance()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $itemId = Yii::$app->request->get('item_id');
    if ($itemId !== null) {
        $item = PlansItems::findOne($itemId);
        if ($item !== null) {
            return ['insurance_id' => $item->insurance_id];
        }
    }

    return ['insurance_id' => null];
}

public function actionFetchPlans()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $insuranceId = Yii::$app->request->get('insurance_id');
    if ($insuranceId !== null) {
        $plans = Plans::find()->where(['insurance_id' => $insuranceId])->all();
        $data = [];
        foreach ($plans as $plan) {
            $data[$plan->id] = $plan->name;
        }
        return $data;
    }

    return [];
}


    /**
     * Updates an existing PlansCoverage model.
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
     * Deletes an existing PlansCoverage model.
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



    
    public function actionMultiple()
    {
        
        
        // dd("shatha");
        $selectedIds = Yii::$app->request->post('selected_ids', []);
    
        if (!empty($selectedIds)) {
            PlansCoverage::deleteAll(['id' => $selectedIds]);
            Yii::$app->session->setFlash('success', 'Selected items have been deleted.');
        } else {
            Yii::$app->session->setFlash('error', 'No items were selected for deletion.');
        }
    
        return $this->redirect(['index']); 
    }
    


    /**
     * Finds the PlansCoverage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PlansCoverage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlansCoverage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
