<?php

namespace backend\controllers;

use common\models\InsuranceCountries;
use common\models\Insurances;
use common\models\Plans;
use common\models\PlansSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use common\models\UploadForm;
use Exception;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;

/**
 * PlansController implements the CRUD actions for Plans model.
 */
class PlansController extends Controller
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
     * Lists all Plans models.
     *
     * @return string
     */









     public function actionExport()
     {
         $models = Plans::find()->all();
         if (empty($models)) {
            Yii::$app->session->setFlash('error', 'No Plans data found.');
            return $this->redirect(['index']); 
        }
         $durationLabels = [
             7 => '7 days',
             10 => '10 days',
             15 => '15 days',
             21 => '21 days',
             30 => '1 month',
             60 => '2 months',
             90 => '3 months',
             180 => '6 months',
             365 => '1 year',
             730 => '2 years',
             1095 => '3 years',
         ];
 
         $spreadsheet = new Spreadsheet();
         $sheet = $spreadsheet->getActiveSheet();
 
         $sheet->setCellValue('A1', 'Name');
         $sheet->setCellValue('B1', 'Plan Code');
         $sheet->setCellValue('C1', 'Max age');
         $sheet->setCellValue('D1', 'Min age');
         $sheet->setCellValue('E1', 'Insurance Name');
         $sheet->setCellValue('F1', 'Source Name');
 
         $headerStyle = [
             'fill' => [
                 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                 'startColor' => [
                     'argb' => 'FF808080',
                 ],
                 'font' => [
                     'color' => [
                         'argb' => 'FFFFFFFF',
                     ],
                 ],
             ],
         ];

         $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);
 
         $row = 2;
         
         foreach ($models as $model) {
             $sheet->setCellValue('A' . $row, $model->name);
             $sheet->setCellValue('B' . $row, $model->plan_code);
             $sheet->setCellValue('C' . $row, $model->max_age);
             $sheet->setCellValue('D' . $row, $model->min_age);
             $sheet->setCellValue('E' . $row, $model->insurance->name);
             $sheet->setCellValue('F' . $row, $model->source->source_country);
             $row++;
         }
 
         $writer = new Xlsx($spreadsheet);
         $fileName = 'Plans.xlsx';
         $temp_file = tempnam(sys_get_temp_dir(), $fileName);
         $writer->save($temp_file);
 
         return Yii::$app->response->sendFile($temp_file, $fileName);
     }

     

     public function actionIndex()
     {
         $searchModel = new PlansSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
         $model = new UploadForm();
     
         if (Yii::$app->request->isPost) {
             $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
             if ($model->upload()) {
                 $inputFile = 'images/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
                 try {
                     $spreadsheet = IOFactory::load($inputFile);
                 } catch (Exception $e) {
                     die('Error loading file "' . pathinfo($inputFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                 }
     
                 $sheet = $spreadsheet->getActiveSheet();
                 $highestRow = $sheet->getHighestRow();
                 $highestColumn = $sheet->getHighestColumn();
     
                 $startRow = 2; 
                 for ($row = $startRow; $row <= $highestRow; $row++) {
                     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
     
                     $planCode = $rowData[0][1];
                     $existingPlan = Plans::findOne(['plan_code' => $planCode]);
                     $insuranceName = $rowData[0][4];
                     $insurance = Insurances::find()->where(['name' => $insuranceName])->one();
                     $sourceCountry=$rowData[0][5];

                     $source= InsuranceCountries::find()->where(['source_country' => $sourceCountry])->one();
                    //  if ($existingPlan) {
                    //      continue; 
                    //  }
                    //  if ($insurance) {
                         $newPlan = new Plans();
                         $newPlan->name = $rowData[0][0];
                         $newPlan->plan_code = $rowData[0][1];
                         $newPlan->max_age = $rowData[0][2];
                         $newPlan->min_age = $rowData[0][3];
                         $newPlan->insurance_id = $insurance->id;
                         $newPlan->source_id = $source->id;
                         if (!$newPlan->save()) {
                             print_r($newPlan->getErrors());
                         }

                    //      dd( $rowData[0][0],$rowData[0][1],$rowData[0][2], $rowData[0][3], $rowData[0][4], $rowData[0][5]);
                    //  } else {
                    //      continue;
                    //  }


                    
                 }
             }
         }
     
         return $this->render('index', [
             'searchModel' => $searchModel,
             'model' => $model,
             'dataProvider' => $dataProvider,
         ]);
     }
     


     public function actionMultiple()
     {
         
         
         // dd("shatha");
         $selectedIds = Yii::$app->request->post('selected_ids', []);
     
         if (!empty($selectedIds)) {
             Plans::deleteAll(['id' => $selectedIds]);
             Yii::$app->session->setFlash('success', 'Selected items have been deleted.');
         } else {
             Yii::$app->session->setFlash('error', 'No items were selected for deletion.');
         }
     
         return $this->redirect(['index']); 
     }
     



    /**
     * Displays a single Plans model.
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
     * Creates a new Plans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Plans();

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
     * Updates an existing Plans model.
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
     * Deletes an existing Plans model.
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
     * Finds the Plans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Plans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plans::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
