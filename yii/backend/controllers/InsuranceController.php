<?php

namespace backend\controllers;

use common\models\Insurances;
use common\models\Insurancessearch;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * InsuranceController implements the CRUD actions for Insurances model.
 */
class InsuranceController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Insurances models.
     *
     * @return string
     */
    public function actionIndex()
{
    $searchModel = new InsurancesSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
      
    ]);
}



    /**
     * Displays a single Insurances model.
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
     * Creates a new Insurances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

     public function actionCreate()
     {
         $model = new Insurances();
     
         if (Yii::$app->request->isPost) {
             if ($model->load(Yii::$app->request->post())) {
                 $uploadedFile = UploadedFile::getInstance($model, 'photo');
                 if ($uploadedFile) {
                     $file = $uploadedFile;
                     $fileName = rand() . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $file->extension;
                     $path = 'images/' . $fileName;
                     if ($uploadedFile->saveAs($path)) {
                         $model->photo = $fileName;
                     } else {
                         Yii::$app->session->setFlash('error', 'Failed to save the uploaded file.');
                     }
                 }
     
                 $uploadedBenefitFile = UploadedFile::getInstance($model, 'benefits_link');
                 if ($uploadedBenefitFile) {
                     $benefitFile = $uploadedBenefitFile;
                     $benefitFileName = $benefitFile->baseName . '_' . time() . '.' . $benefitFile->extension; // Use baseName of the file
                     $benefitPath = 'images/' . $benefitFileName;
                     if ($uploadedBenefitFile->saveAs($benefitPath)) {
                         $model->benefits_link = $benefitFileName;
                     } else {
                         Yii::$app->session->setFlash('error', 'Failed to save the uploaded benefit file.');
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
     * Updates an existing Insurances model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */ public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $oldPhoto = $model->photo; 
    $oldBenefitLink = $model->benefits_link; 

    if (Yii::$app->request->isPost) {
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'photo');

            if ($uploadedFile) {
                $file = $uploadedFile;
                $fileName = rand() . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $path = 'images/' . $fileName;
                if ($uploadedFile->saveAs($path)) {
                    if ($oldPhoto && file_exists('images/' . $oldPhoto)) {
                        unlink('images/' . $oldPhoto);
                    }
                    $model->photo = $fileName;
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save the uploaded photo file.');
                }
            } else {
                $model->photo = $oldPhoto;
            }

            $uploadedBenefitFile = UploadedFile::getInstance($model, 'benefits_link');
            if ($uploadedBenefitFile) {
                $benefitFile = $uploadedBenefitFile;
                $benefitFileName = $benefitFile->baseName . '_' . time() . '.' . $benefitFile->extension; // Use baseName of the file
                $benefitPath = 'images/' . $benefitFileName;
                if ($uploadedBenefitFile->saveAs($benefitPath)) {
                    if ($oldBenefitLink && file_exists('images/' . $oldBenefitLink)) {
                        unlink('images/' . $oldBenefitLink);
                    }
                    $model->benefits_link = $benefitFileName;
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save the uploaded benefit file.');
                }
            } else {
                $model->benefits_link = $oldBenefitLink;
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
     * Deletes an existing Insurances model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $insurances = Insurances::find()->orderBy(['id' => SORT_ASC])->all();
    
        
        $newId = 1;
        foreach ($insurances as $insurance) {
            $insurance->id = $newId++;
            $insurance->save(false); 
        }

        return $this->redirect(['index']);
    }



    

    public function actionMultiple()
    {
        
        
        // dd("shatha");
        $selectedIds = Yii::$app->request->post('selected_ids', []);
    
        if (!empty($selectedIds)) {
            Insurances::deleteAll(['id' => $selectedIds]);
            Yii::$app->session->setFlash('success', 'Selected items have been deleted.');
        } else {
            Yii::$app->session->setFlash('error', 'No items were selected for deletion.');
        }
    
        return $this->redirect(['index']); 
    }
    



    /**
     * Finds the Insurances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Insurances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Insurances::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
