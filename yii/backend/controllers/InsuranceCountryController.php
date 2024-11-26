<?php

namespace backend\controllers;

use common\models\InsuranceCountries;
use common\models\InsuranceCountriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii;

/**
 * InsuranceCountryController implements the CRUD actions for InsuranceCountries model.
 */
class InsuranceCountryController extends Controller
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
     * Lists all InsuranceCountries models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InsuranceCountriesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsuranceCountries model.
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
     * Creates a new InsuranceCountries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  

     public function actionMultiple()
     {
         
         
         $selectedIds = Yii::$app->request->post('selected_ids', []);
     
         if (!empty($selectedIds)) {
             InsuranceCountries::deleteAll(['id' => $selectedIds]);
             Yii::$app->session->setFlash('success', 'Selected items have been deleted.');
         } else {
             Yii::$app->session->setFlash('error', 'No items were selected for deletion.');
         }
     
         return $this->redirect(['index']); 
     }


     public function actionCreate()
     {
        $model = new InsuranceCountries();
   

         if (Yii::$app->request->isPost) {
             if ($model->load(Yii::$app->request->post())) {
                $model->source_country = ucwords( strtolower(trim($model->source_country)));
                 $uploadedFile = UploadedFile::getInstance($model, 'company_logo');
                 if ($uploadedFile) {
                     $file = $uploadedFile;
                     $fileName = rand() . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $file->extension;
                     $path = 'images/' . $fileName;
                     if ($uploadedFile->saveAs($path)) {
                         $model->company_logo = $fileName;
                     } else {
                         Yii::$app->session->setFlash('error', 'Failed to save the uploaded file.');
                     }
                 }
 
 
                 if ($model->save()) {
                     return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing InsuranceCountries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
    $model = $this->findModel($id);

    $oldPhoto = $model->company_logo;

    if (Yii::$app->request->isPost) {
        if ($model->load(Yii::$app->request->post())) {

            $model->source_country = ucwords( strtolower(trim($model->source_country)));

            $uploadedFile = UploadedFile::getInstance($model, 'company_logo');

            if ($uploadedFile) {
                $file = $uploadedFile;
                $fileName = rand() . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $path = 'images/' . $fileName;
                if ($uploadedFile->saveAs($path)) {

                    if ($oldPhoto && file_exists('images/' . $oldPhoto)) {
                        unlink('images/' . $oldPhoto);
                    }
                    $model->company_logo= $fileName;
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save the uploaded file.');
                }
            } else {

                $model->company_logo = $oldPhoto;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
    }

    /**
     * Deletes an existing InsuranceCountries model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
 
    
        \Yii::$app->db->createCommand()
            ->delete('insurance_countries', ['insurance_id' => $id])
            ->execute();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the InsuranceCountries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return InsuranceCountries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsuranceCountries::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
